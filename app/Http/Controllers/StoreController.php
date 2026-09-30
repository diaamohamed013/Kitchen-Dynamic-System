<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\KitchenTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $sections = Section::with(['subcategories' => function($q) {
            $q->where('is_active', true);
        }])->where('is_active', true)->orderBy('display_order')->get();

        $activeSectionId = $request->get('section_id', $sections->first()?->id);
        $activeSubcategoryId = $request->get('subcategory_id');

        $query = Product::where('is_available', true);

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        } elseif ($activeSubcategoryId) {
            $query->where('subcategory_id', $activeSubcategoryId);
        } elseif ($activeSectionId) {
            $subIds = Subcategory::where('section_id', $activeSectionId)->pluck('id');
            $query->whereIn('subcategory_id', $subIds);
        }

        $products = $query->latest()->get();

        $bestSellers = Product::where('is_available', true)
            ->where('is_best_seller', true)
            ->take(4)
            ->get();

        return view('store.index', compact('sections', 'activeSectionId', 'activeSubcategoryId', 'products', 'bestSellers'));
    }

    public function showProduct($id)
    {
        $product = Product::with(['subcategory.section'])->findOrFail($id);
        
        $relatedProducts = Product::where('is_available', true)
            ->where('id', '!=', $product->id)
            ->where('subcategory_id', $product->subcategory_id)
            ->take(3)
            ->get();

        if ($relatedProducts->count() < 3) {
            $fallback = Product::where('is_available', true)
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->take(3 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->merge($fallback);
        }

        return view('store.product', compact('product', 'relatedProducts'));
    }

    public function checkoutPage(Request $request)
    {
        return view('store.checkout');
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'order_type' => 'required|in:dine_in,takeaway,delivery',
            'delivery_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'table_number' => 'nullable|string|max:100',
            'payment_method' => 'nullable|string|in:cash,card,online',
            'simulate_failure' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.special_instructions' => 'nullable|string',
        ]);

        // Support simulated payment failure if requested (for testing dedicated error screens)
        if (!empty($data['simulate_failure'])) {
            return response()->json([
                'status' => 'failed',
                'message' => 'تعذر إتمام عملية الدفع بواسطة البطاقة البنكية، يرجى مراجعة بيانات البطاقة أو اختيار وسيلة دفع أخرى.',
            ], 422);
        }

        $totalAmount = 0;
        $orderItemsData = [];

        foreach ($data['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            $lineTotal = $product->price * $item['quantity'];
            $totalAmount += $lineTotal;

            $orderItemsData[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'total_price' => $lineTotal,
                'special_instructions' => $item['special_instructions'] ?? null,
            ];

            $product->increment('orders_count', $item['quantity']);
        }

        $addressInfo = $data['delivery_address'] ?? $data['table_number'] ?? 'توصيل';
        if (!empty($data['city'])) {
            $addressInfo = $data['city'] . ' - ' . $addressInfo;
        }

        $paymentMethod = $data['payment_method'] ?? 'cash';
        $paymentStatus = ($paymentMethod === 'cash') ? 'pending' : 'paid';

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(5)),
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'order_type' => $data['order_type'],
            'table_number' => $addressInfo,
            'total_amount' => $totalAmount,
            'payment_status' => $paymentStatus,
            'payment_method' => $paymentMethod,
            'notes' => $data['notes'] ?? null,
        ]);

        foreach ($orderItemsData as $itemData) {
            $order->items()->create($itemData);
        }

        // Initialize Kitchen Ticket in 'queued' state for Admin / KDS workflow
        KitchenTicket::create([
            'order_id' => $order->id,
            'status' => 'queued',
            'estimated_prep_minutes' => 15,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم استلام وتأكيد طلبك بنجاح!',
            'order_number' => $order->order_number,
            'order_id' => $order->id,
            'redirect_url' => route('store.order.success', $order->order_number),
        ]);
    }

    public function orderSuccess($orderNumber)
    {
        $order = Order::with(['items.product', 'kitchenTicket'])->where('order_number', $orderNumber)->firstOrFail();
        return view('store.order-success', compact('order'));
    }

    public function orderFailed(Request $request)
    {
        return view('store.order-failed');
    }

    public function trackOrder($orderNumber)
    {
        $order = Order::with(['items.product', 'kitchenTicket'])->where('order_number', $orderNumber)->firstOrFail();
        return view('store.track', compact('order'));
    }
}

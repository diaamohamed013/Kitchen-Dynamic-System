<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\KitchenTicket;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.product', 'kitchenTicket'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function dispatchToKitchen(Order $order)
    {
        $ticket = $order->kitchenTicket;
        if (!$ticket) {
            $ticket = KitchenTicket::create(['order_id' => $order->id]);
        }

        $ticket->update([
            'status' => 'received',
            'dispatched_at' => now(),
        ]);

        return back()->with('success', 'تم تحويل الطلب #' . $order->order_number . ' إلى شاشة المطبخ بنجاح');
    }
}

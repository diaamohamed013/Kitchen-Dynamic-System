<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Section;
use App\Models\KitchenTicket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_sales' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'orders_today' => Order::whereDate('created_at', today())->count(),
            'active_in_kitchen' => KitchenTicket::whereIn('status', ['received', 'preparing'])->count(),
            'queued_dispatch' => KitchenTicket::where('status', 'queued')->count(),
        ];

        $recentOrders = Order::with(['items.product', 'kitchenTicket'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}

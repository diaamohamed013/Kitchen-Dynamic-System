@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900">نظرة عامة على النشاط</h1>
            <p class="text-xs text-slate-500 mt-1">متابعة المبيعات والطلبات قيد الإرسال للمطبخ</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.orders.index') }}" class="bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold px-4 py-2.5 rounded-xl shadow-sm transition">
                إدارة الطلبات الحالية ➔
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div class="text-slate-400 text-xs font-bold mb-1">إجمالي المبيعات المدفوعة</div>
            <div class="text-2xl font-black text-slate-900">{{ number_format($stats['total_sales'], 2) }} <span class="text-sm font-bold text-slate-500">ج.م</span></div>
            <span class="text-xs text-emerald-600 font-bold mt-2 inline-block">↑ تشمل جميع العمليات الناجحة</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div class="text-slate-400 text-xs font-bold mb-1">طلبات اليوم</div>
            <div class="text-2xl font-black text-slate-900">{{ $stats['orders_today'] }}</div>
            <span class="text-xs text-blue-600 font-bold mt-2 inline-block">طلبات واردة</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm border-r-4 border-r-amber-500">
            <div class="text-slate-400 text-xs font-bold mb-1">على النار في المطبخ</div>
            <div class="text-2xl font-black text-amber-600">{{ $stats['active_in_kitchen'] }}</div>
            <span class="text-xs text-amber-600 font-bold mt-2 inline-block">جاري التحضير الآن 🔥</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm border-r-4 border-r-rose-500">
            <div class="text-slate-400 text-xs font-bold mb-1">بانتظار الإرسال للمطبخ</div>
            <div class="text-2xl font-black text-rose-600">{{ $stats['queued_dispatch'] }}</div>
            <span class="text-xs text-rose-600 font-bold mt-2 inline-block">طلبات مدفوعة جديدة</span>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center bg-slate-50">
            <h2 class="font-bold text-slate-900 text-base">أحدث الطلبات</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-rose-600 hover:underline">عرض الكل</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-right text-sm">
                <thead class="bg-slate-100 text-slate-500 font-semibold border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4">رقم الطلب</th>
                        <th class="py-3 px-4">العميل</th>
                        <th class="py-3 px-4">النوع</th>
                        <th class="py-3 px-4">الإجمالي</th>
                        <th class="py-3 px-4">حالة المطبخ</th>
                        <th class="py-3 px-4 text-center">إجراء</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($recentOrders as $order)
                        <tr>
                            <td class="py-3.5 px-4 font-bold text-slate-900">#{{ $order->order_number }}</td>
                            <td class="py-3.5 px-4">{{ $order->customer_name }}</td>
                            <td class="py-3.5 px-4 text-xs">
                                <span class="bg-slate-100 text-slate-700 px-2 py-1 rounded">{{ $order->order_type }}</span>
                            </td>
                            <td class="py-3.5 px-4 font-bold">{{ number_format($order->total_amount, 2) }} ج.م</td>
                            <td class="py-3.5 px-4">
                                @php
                                    $st = $order->kitchenTicket?->status ?? 'queued';
                                    $badges = [
                                        'queued' => ['bg' => 'bg-slate-100 text-slate-600', 'label' => 'قيد الانتظار'],
                                        'received' => ['bg' => 'bg-rose-100 text-rose-700', 'label' => 'وصل المطبخ'],
                                        'preparing' => ['bg' => 'bg-amber-100 text-amber-700', 'label' => 'جاري التحضير'],
                                        'ready' => ['bg' => 'bg-emerald-100 text-emerald-700', 'label' => 'جاهز للاستلام'],
                                        'served' => ['bg' => 'bg-blue-100 text-blue-700', 'label' => 'تم التسليم'],
                                    ];
                                @endphp
                                <span class="text-xs px-2.5 py-1 rounded-full font-bold {{ $badges[$st]['bg'] }}">
                                    {{ $badges[$st]['label'] }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if(!$order->kitchenTicket || $order->kitchenTicket->status === 'queued')
                                    <form action="{{ route('admin.orders.dispatch', $order) }}" method="POST" class="inline">
                                        @csrf
                                        <button class="bg-rose-600 hover:bg-rose-700 text-white text-xs px-3 py-1.5 rounded-lg font-bold transition">
                                            إرسال للمطبخ 👨‍🍳
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-slate-400">تم التحويل بنجاح</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-400">لا توجد طلبات حتى الآن</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

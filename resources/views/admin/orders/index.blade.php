@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-slate-900">إدارة الطلبات الحية وتحويل المطبخ</h1>
            <p class="text-xs text-slate-500 mt-1">التحكم في أوامر التشغيل وإرسالها لشاشة المطبخ</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-right text-sm">
                <thead class="bg-slate-100 text-slate-500 font-semibold border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4">رقم الطلب</th>
                        <th class="py-3.5 px-4">العميل والهاتف</th>
                        <th class="py-3.5 px-4">التفاصيل والأصناف</th>
                        <th class="py-3.5 px-4">الإجمالي والدفع</th>
                        <th class="py-3.5 px-4">حالة شاشة المطبخ</th>
                        <th class="py-3.5 px-4 text-center">الإجراء</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-4 px-4 font-black text-slate-900">
                                #{{ $order->order_number }}
                                <div class="text-xs font-normal text-slate-400">{{ $order->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-bold text-slate-800">{{ $order->customer_name }}</div>
                                <div class="text-xs text-slate-500 font-mono">{{ $order->customer_phone }}</div>
                                <span class="inline-block mt-1 text-[11px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded font-semibold">
                                    {{ $order->order_type }} {{ $order->table_number ? '('.$order->table_number.')' : '' }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <ul class="text-xs space-y-1 text-slate-600">
                                    @foreach($order->items as $item)
                                        <li>
                                            <span class="font-bold text-slate-900">{{ $item->quantity }}x</span> {{ $item->product->name }}
                                            @if($item->special_instructions)
                                                <span class="text-amber-600 text-[10px] bg-amber-50 px-1.5 py-0.5 rounded mr-1">({{ $item->special_instructions }})</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-black text-slate-900">{{ number_format($order->total_amount, 2) }} ج.م</div>
                                <span class="inline-block text-xs bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full mt-1">
                                    {{ $order->payment_status === 'paid' ? 'مدفوع بالكامل' : $order->payment_status }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @php
                                    $st = $order->kitchenTicket?->status ?? 'queued';
                                    $badges = [
                                        'queued' => ['bg' => 'bg-slate-100 text-slate-600', 'label' => 'بانتظار الإرسال'],
                                        'received' => ['bg' => 'bg-rose-100 text-rose-700', 'label' => 'وصل المطبخ (جديد)'],
                                        'preparing' => ['bg' => 'bg-amber-100 text-amber-700', 'label' => 'قيد الطهي 🔥'],
                                        'ready' => ['bg' => 'bg-emerald-100 text-emerald-700', 'label' => 'جاهز للتسليم ✓'],
                                        'served' => ['bg' => 'bg-blue-100 text-blue-700', 'label' => 'تم التسليم بالكامل'],
                                    ];
                                @endphp
                                <span class="text-xs px-2.5 py-1 rounded-full font-bold {{ $badges[$st]['bg'] }}">
                                    {{ $badges[$st]['label'] }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if(!$order->kitchenTicket || $order->kitchenTicket->status === 'queued')
                                    <form action="{{ route('admin.orders.dispatch', $order) }}" method="POST">
                                        @csrf
                                        <button class="bg-rose-600 hover:bg-rose-700 text-white text-xs px-4 py-2 rounded-xl font-bold transition shadow-sm">
                                            إرسال للمطبخ ➔
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-slate-400 font-semibold">قيد معالجة الشيف</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">لا توجد طلبات مسجلة</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

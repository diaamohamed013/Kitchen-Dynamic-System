@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-black text-slate-900">إدارة الوجبات والمنتجات (Products)</h1>
        <p class="text-xs text-slate-500 mt-1">إضافة الأصناف، تحديد الأسعار، وتعيين الأكثر طلباً (Best Sellers)</p>
    </div>

    <!-- Create Product Form -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <h2 class="text-sm font-bold text-slate-700 mb-4">+ إضافة وجبة / صنف جديد</h2>
        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">التصنيف الفرعي</label>
                    <select name="subcategory_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
                        <option value="">اختر التصنيف الفرعي...</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->section->name }} ➔ {{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">اسم الوجبة</label>
                    <input type="text" name="name" required placeholder="مثال: دبل سموكد برجر" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">السعر (ج.م)</label>
                    <input type="number" step="0.5" name="price" required placeholder="185.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">وصف المكونات</label>
                    <input type="text" name="description" placeholder="مكونات الوجبة، نوع الجبن والخبز..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">رابط صورة الوجبة (Image URL)</label>
                    <input type="url" name="image" placeholder="https://..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-4 pt-2">
                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_available" value="1" checked class="rounded text-rose-600 focus:ring-rose-500">
                        متاح للطلب
                    </label>
                    <label class="flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_best_seller" value="1" class="rounded text-amber-500 focus:ring-amber-500">
                        تمييز كـ (الأكثر طلباً 🔥)
                    </label>
                </div>
                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-bold px-6 py-2 rounded-xl text-sm transition">
                    إضافة المنتج للقائمة
                </button>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <table class="w-full text-right text-sm">
            <thead class="bg-slate-100 text-slate-500 font-semibold border-b border-slate-200">
                <tr>
                    <th class="py-3 px-4">الصورة</th>
                    <th class="py-3 px-4">اسم الوجبة والتصنيف</th>
                    <th class="py-3 px-4">السعر</th>
                    <th class="py-3 px-4">المبيعات</th>
                    <th class="py-3 px-4">الأكثر طلباً</th>
                    <th class="py-3 px-4">الحالة</th>
                    <th class="py-3 px-4 text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @foreach($products as $prod)
                    <tr>
                        <td class="py-3 px-4">
                            <img src="{{ $prod->image }}" alt="" class="w-12 h-12 rounded-xl object-cover border border-slate-200">
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-bold text-slate-900">{{ $prod->name }}</div>
                            <div class="text-xs text-slate-400">
                                {{ $prod->subcategory->section->name ?? '' }} ➔ {{ $prod->subcategory->name ?? '' }}
                            </div>
                        </td>
                        <td class="py-3 px-4 font-black text-slate-900">{{ number_format($prod->price, 2) }} ج.م</td>
                        <td class="py-3 px-4 text-xs font-mono">{{ $prod->orders_count }} طلب</td>
                        <td class="py-3 px-4">
                            @if($prod->is_best_seller)
                                <span class="bg-amber-100 text-amber-800 text-[11px] font-bold px-2 py-0.5 rounded-full">🔥 الأكثر طلباً</span>
                            @else
                                <span class="text-slate-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $prod->is_available ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                {{ $prod->is_available ? 'متاح' : 'غير متوفر' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('admin.products.destroy', $prod) }}" method="POST" onsubmit="return confirm('حذف الوجبة؟')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs text-rose-600 hover:text-rose-800 font-bold">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-black text-slate-900">إدارة التصنيفات الفرعية (Subcategories)</h1>
        <p class="text-xs text-slate-500 mt-1">تفريعات الأقسام (مثل: برجر لحم، برجر دجاج داخل قسم الوجبات السريعة)</p>
    </div>

    <!-- Create Subcategory Form -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <h2 class="text-sm font-bold text-slate-700 mb-4">+ إضافة تصنيف فرعي جديد</h2>
        <form action="{{ route('admin.subcategories.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">القسم الرئيسي التابع له</label>
                <select name="section_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
                    <option value="">اختر القسم...</option>
                    @foreach($sections as $sec)
                        <option value="{{ $sec->id }}">{{ $sec->icon }} {{ $sec->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">اسم التصنيف الفرعي</label>
                <input type="text" name="name" required placeholder="مثال: برجر دجاج، مقبلات" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">ترتيب العرض</label>
                <input type="number" name="display_order" value="1" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
            </div>
            <div class="flex items-center gap-3">
                <label class="flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded text-rose-600 focus:ring-rose-500">
                    مفعل
                </label>
                <button type="submit" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white font-bold py-2 rounded-xl text-sm transition">
                    حفظ
                </button>
            </div>
        </form>
    </div>

    <!-- Subcategories Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <table class="w-full text-right text-sm">
            <thead class="bg-slate-100 text-slate-500 font-semibold border-b border-slate-200">
                <tr>
                    <th class="py-3 px-4">اسم التصنيف الفرعي</th>
                    <th class="py-3 px-4">القسم الرئيسي</th>
                    <th class="py-3 px-4">عدد المنتجات</th>
                    <th class="py-3 px-4">الترتيب</th>
                    <th class="py-3 px-4">الحالة</th>
                    <th class="py-3 px-4 text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @foreach($subcategories as $sub)
                    <tr>
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $sub->name }}</td>
                        <td class="py-3 px-4">
                            <span class="bg-slate-100 px-2 py-1 rounded text-xs text-slate-700">
                                {{ $sub->section->icon ?? '' }} {{ $sub->section->name }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-xs font-semibold text-slate-600">{{ $sub->products_count }} وجبة</td>
                        <td class="py-3 px-4 font-mono text-xs">{{ $sub->display_order }}</td>
                        <td class="py-3 px-4">
                            <span class="text-xs px-2.5 py-0.5 rounded-full {{ $sub->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                {{ $sub->is_active ? 'نشط' : 'معطل' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('admin.subcategories.destroy', $sub) }}" method="POST" onsubmit="return confirm('حذف التصنيف؟')" class="inline">
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

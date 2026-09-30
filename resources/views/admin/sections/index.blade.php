@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-slate-900">إدارة الأقسام الرئيسية (Sections)</h1>
            <p class="text-xs text-slate-500 mt-1">تحديد الهيكل الأساسي لقائمة طعام المطعم</p>
        </div>
    </div>

    <!-- Create Section Form -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <h2 class="text-sm font-bold text-slate-700 mb-4">+ إضافة قسم رئيسي جديد</h2>
        <form action="{{ route('admin.sections.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">اسم القسم</label>
                <input type="text" name="name" required placeholder="مثال: وجبات سريعة، مشويات" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">الأيقونة (Emoji أو رمز)</label>
                <input type="text" name="icon" placeholder="🍔 أو 🥩" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">ترتيب الظهور</label>
                <input type="number" name="display_order" value="1" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-rose-500 focus:outline-none">
            </div>
            <div class="flex items-center gap-3">
                <label class="flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded text-rose-600 focus:ring-rose-500">
                    مفعل
                </label>
                <button type="submit" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white font-bold py-2 rounded-xl text-sm transition">
                    حفظ القسم
                </button>
            </div>
        </form>
    </div>

    <!-- Sections Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <table class="w-full text-right text-sm">
            <thead class="bg-slate-100 text-slate-500 font-semibold border-b border-slate-200">
                <tr>
                    <th class="py-3 px-4">الرمز</th>
                    <th class="py-3 px-4">اسم القسم</th>
                    <th class="py-3 px-4">التصنيفات الفرعية</th>
                    <th class="py-3 px-4">إجمالي الوجبات</th>
                    <th class="py-3 px-4">الترتيب</th>
                    <th class="py-3 px-4">الحالة</th>
                    <th class="py-3 px-4 text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @foreach($sections as $section)
                    <tr>
                        <td class="py-3 px-4 text-2xl">{{ $section->icon ?? '📁' }}</td>
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $section->name }}</td>
                        <td class="py-3 px-4 text-xs font-semibold text-slate-600">{{ $section->subcategories_count }} تصنيف</td>
                        <td class="py-3 px-4 text-xs font-semibold text-slate-600">{{ $section->products_count }} وجبة</td>
                        <td class="py-3 px-4 text-xs font-mono">{{ $section->display_order }}</td>
                        <td class="py-3 px-4">
                            <span class="text-xs px-2.5 py-0.5 rounded-full {{ $section->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                {{ $section->is_active ? 'نشط' : 'معطل' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')" class="inline">
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

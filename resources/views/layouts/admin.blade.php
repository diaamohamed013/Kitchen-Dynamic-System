<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | نظام إدارة المطعم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Cairo', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col md:flex-row">
    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-slate-900 text-white flex flex-col shrink-0">
        <div class="p-6 border-b border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-2xl">🍔</span>
                <span class="font-black text-lg text-rose-500">لوحة الإدارة</span>
            </div>
            <a href="{{ route('store.index') }}" target="_blank" class="text-xs bg-slate-800 hover:bg-slate-700 px-2.5 py-1 rounded text-slate-300">المتجر ↗</a>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-rose-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <span>📊</span> الرئيسية والإحصائيات
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.orders.*') ? 'bg-rose-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <span>🛎️</span> الطلبات المباشرة
            </a>
            <a href="{{ route('admin.sections.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.sections.*') ? 'bg-rose-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <span>📑</span> إدارة الأقسام
            </a>
            <a href="{{ route('admin.subcategories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.subcategories.*') ? 'bg-rose-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <span>📂</span> التصنيفات الفرعية
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.products.*') ? 'bg-rose-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <span>🍗</span> الوجبات والمنتجات
            </a>
            <a href="{{ route('kitchen.screen') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-amber-400 bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/20 mt-4">
                <span>👨‍🍳</span> فتح شاشة المطبخ (KDS) ↗
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
            إصدار النظام 2026 • Realtime KDS
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        @if(session('success'))
            <div class="bg-emerald-500 text-white text-sm py-2.5 px-6 font-bold shadow flex justify-between items-center">
                <span>✓ {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white hover:text-emerald-100">✕</button>
            </div>
        @endif

        <main class="flex-1 p-6 lg:p-8 overflow-y-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>

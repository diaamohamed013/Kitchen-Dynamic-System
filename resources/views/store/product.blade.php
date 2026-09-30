<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $product->name }} — مطعم وجبتك الفاخر. تفاصيل المكونات والطلب أونلاين.">
    <title>{{ $product->name }} | مطعم وجبتك</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
/* ============================================
   DESIGN SYSTEM: WARM LUXURY RESTAURANT
   ============================================ */
:root {
    --gold: #C8944A;
    --gold-light: #E8C992;
    --gold-dark: #A87735;
    --gold-glow: rgba(200, 148, 74, 0.3);
    --rust: #BD5D38;
    --rust-hover: #A54B28;
    --rust-light: rgba(189, 93, 56, 0.12);
    --sage: #768A76;
    --dark: #1A1412;
    --dark-card: #231C17;
    --dark-soft: #2E2520;
    --dark-border: rgba(200, 148, 74, 0.15);
    --cream: #FAF5EE;
    --cream-dark: #F0E6D8;
    --text-primary: #FAF5EE;
    --text-muted: #A89888;
    --text-dark: #2B2421;
    --text-dark-muted: #6B5D55;
    --font-display: 'Playfair Display', 'Cairo', serif;
    --font-body: 'Cairo', sans-serif;
    --radius: 16px;
    --radius-lg: 24px;
    --radius-xl: 36px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
    font-family: var(--font-body);
    background:
        radial-gradient(ellipse at 85% 15%, rgba(200, 148, 74, 0.08) 0%, transparent 55%),
        radial-gradient(ellipse at 15% 85%, rgba(189, 93, 56, 0.07) 0%, transparent 50%),
        #FAF5EE;
    color: var(--text-dark);
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
    min-height: 100vh;
}
::selection { background: var(--rust); color: #fff; }
img { display: block; max-width: 100%; }
a { text-decoration: none; color: inherit; }
button { font-family: var(--font-body); cursor: pointer; }

/* Navbar */
.site-nav {
    position: sticky; top: 0; z-index: 500;
    background: rgba(26, 20, 18, 0.96); backdrop-filter: blur(20px);
    box-shadow: 0 4px 30px rgba(0,0,0,0.25);
    padding: 12px 24px; border-bottom: 1px solid rgba(200, 148, 74, 0.2);
}
.nav-wrap {
    max-width: 1280px; margin: 0 auto;
    display: flex; align-items: center; justify-content: space-between;
    height: 58px;
}
.nav-logo { display: flex; align-items: center; gap: 10px; }
.nav-logo-icon {
    width: 40px; height: 40px; border-radius: 12px;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 17px; box-shadow: 0 4px 16px var(--gold-glow);
}
.nav-logo-text { font-family: var(--font-display); font-size: 1.35rem; font-weight: 700; color: #fff; }
.nav-logo-text .plus { color: var(--gold); }
.nav-links { display: flex; align-items: center; gap: 24px; }
.nav-links a { font-size: 0.88rem; font-weight: 600; color: rgba(251,246,240,0.75); transition: color 0.2s; }
.nav-links a:hover { color: var(--gold-light); }
.nav-actions { display: flex; align-items: center; gap: 12px; }
.nav-cart-btn {
    display: flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    border: none; border-radius: 50px; padding: 9px 20px;
    color: #fff; font-weight: 700; font-size: 0.82rem;
    box-shadow: 0 4px 16px var(--gold-glow); transition: all 0.25s;
}
.nav-cart-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(200, 148, 74, 0.5); }
.nav-cart-badge {
    background: #fff; color: var(--rust); font-size: 0.68rem; font-weight: 900;
    padding: 1px 7px; border-radius: 20px; min-width: 16px; text-align: center;
}

/* Breadcrumb */
.breadcrumb-bar {
    max-width: 1280px; margin: 28px auto 0; padding: 0 24px;
    display: flex; align-items: center; gap: 8px;
    font-size: 0.82rem; color: var(--text-dark-muted); flex-wrap: wrap;
}
.breadcrumb-bar a { color: var(--rust); font-weight: 600; }
.breadcrumb-bar a:hover { text-decoration: underline; }
.breadcrumb-bar .sep { font-size: 10px; color: rgba(200, 148, 74, 0.5); }
.breadcrumb-bar .current { color: var(--text-dark); font-weight: 700; }

/* Product Showcase Container */
.product-showcase {
    max-width: 1280px; margin: 24px auto 70px; padding: 0 24px;
}
.showcase-card {
    background: #FFFFFF;
    border: 1px solid rgba(200, 148, 74, 0.22);
    border-radius: var(--radius-xl);
    padding: 44px;
    box-shadow: 0 16px 50px -10px rgba(43, 36, 33, 0.08), 0 2px 10px rgba(0,0,0,0.02);
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 48px;
    position: relative;
}

/* Image Visual Column */
.visual-col {
    display: flex; flex-direction: column; gap: 20px;
}
.visual-box {
    position: relative; width: 100%; max-width: 460px; margin: 0 auto;
    height: 330px; border-radius: 24px; overflow: hidden;
    background: radial-gradient(circle at center, #2C221D 0%, #15100E 100%);
    box-shadow: inset 0 0 20px rgba(0,0,0,0.35), 0 12px 35px rgba(43,36,33,0.1);
    border: 1.5px solid rgba(200, 148, 74, 0.25);
}
.visual-box img {
    width: 100%; height: 100%; object-fit: cover; border-radius: 22px;
    transition: transform 0.6s ease;
}
.visual-box:hover img { transform: scale(1.06); }
.visual-fav {
    position: absolute; top: 16px; left: 16px; z-index: 4;
    width: 42px; height: 42px; border-radius: 50%;
    background: rgba(255,255,255,0.9); backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.95);
    display: flex; align-items: center; justify-content: center;
    color: #4A3E39; font-size: 16px; cursor: pointer; transition: all 0.25s;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
}
.visual-fav:hover { transform: scale(1.1); color: #ef4444; }
.visual-fav.active { color: #ef4444; }

.visual-badge-rating {
    position: absolute; top: 16px; right: 16px; z-index: 3;
    background: rgba(26, 20, 18, 0.85); backdrop-filter: blur(8px);
    color: #fff; font-size: 0.78rem; font-weight: 800;
    padding: 5px 14px; border-radius: 50px;
    display: flex; align-items: center; gap: 6px;
    border: 1px solid rgba(200, 148, 74, 0.3);
}
.visual-badge-rating i { color: #F59E0B; }

.visual-perks {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; max-width: 460px; margin: 0 auto; width: 100%;
}
.perk-box {
    background: rgba(200, 148, 74, 0.08); border: 1px solid rgba(200, 148, 74, 0.18);
    border-radius: 14px; padding: 12px 10px; text-align: center;
}
.perk-box i { color: var(--rust); font-size: 16px; margin-bottom: 4px; display: block; }
.perk-box .val { font-size: 0.78rem; font-weight: 800; color: var(--text-dark); }
.perk-box .lbl { font-size: 0.68rem; color: var(--text-dark-muted); }

/* Details Column */
.details-col { display: flex; flex-direction: column; }
.status-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(118, 138, 118, 0.15); border: 1px solid rgba(118, 138, 118, 0.35);
    color: #3b5f3b; font-size: 0.76rem; font-weight: 800;
    padding: 4px 14px; border-radius: 50px; margin-bottom: 12px; align-self: flex-start;
}
.status-pill.out-of-stock {
    background: rgba(239, 68, 68, 0.12); border-color: rgba(239, 68, 68, 0.3); color: #b91c1c;
}

.details-col h1 {
    font-family: var(--font-display); font-size: clamp(1.8rem, 2.8vw, 2.4rem);
    font-weight: 800; color: #1F1612; margin-bottom: 12px; line-height: 1.25;
}

.prod-price-wrap {
    display: flex; align-items: baseline; gap: 8px; margin-bottom: 18px;
}
.prod-price {
    font-family: var(--font-display); font-size: 2.2rem; font-weight: 800; color: var(--rust);
}
.prod-price small { font-family: var(--font-body); font-size: 0.9rem; font-weight: 800; color: #7A5826; }
.tax-tag {
    font-size: 0.72rem; font-weight: 700; color: #8C786E;
    background: rgba(200, 148, 74, 0.12); padding: 3px 10px; border-radius: 50px;
}

.prod-desc {
    font-size: 0.95rem; color: #5E524B; line-height: 1.8; margin-bottom: 24px;
}

/* Ingredients Chips */
.section-sub-title {
    font-size: 0.84rem; font-weight: 800; color: #1F1612; margin-bottom: 10px;
    display: flex; align-items: center; gap: 6px;
}
.section-sub-title i { color: var(--gold); }
.chips-list { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
.chip-item {
    background: #FAF5EE; border: 1px solid rgba(200, 148, 74, 0.22);
    color: #69502A; font-size: 0.78rem; font-weight: 700;
    padding: 5px 14px; border-radius: 50px;
}

/* Customization Options */
.opt-group { margin-bottom: 22px; }
.opt-boxes { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
.opt-box {
    border: 1.5px solid rgba(200, 148, 74, 0.25); border-radius: 14px;
    padding: 10px 12px; text-align: center; cursor: pointer; transition: all 0.2s;
    background: #FAF5EE;
}
.opt-box.selected {
    border-color: var(--rust); background: rgba(189, 93, 56, 0.08);
    box-shadow: 0 4px 14px rgba(189, 93, 56, 0.15);
}
.opt-box .name { font-size: 0.82rem; font-weight: 800; color: var(--text-dark); }
.opt-box .extra-price { font-size: 0.72rem; color: var(--rust); font-weight: 700; margin-top: 2px; }

/* Checkbox Extras */
.extras-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.extra-card {
    border: 1px solid rgba(200, 148, 74, 0.2); border-radius: 12px;
    padding: 10px 12px; display: flex; align-items: center; justify-content: space-between;
    background: #FAF5EE; cursor: pointer; transition: all 0.2s;
}
.extra-card.selected {
    border-color: var(--gold); background: rgba(200, 148, 74, 0.1);
}
.extra-card span:first-child { font-size: 0.8rem; font-weight: 700; color: var(--text-dark); }
.extra-card span:last-child { font-size: 0.74rem; font-weight: 800; color: var(--rust); }

/* Special Notes */
.notes-input {
    width: 100%; border: 1px solid rgba(200, 148, 74, 0.25); border-radius: 14px;
    padding: 10px 14px; font-size: 0.85rem; font-family: var(--font-body);
    background: #FAF5EE; color: var(--text-dark); outline: none; transition: border-color 0.2s;
    resize: none; height: 68px; margin-bottom: 26px;
}
.notes-input:focus { border-color: var(--gold); }

/* Action Row (Quantity + Buttons) */
.action-row {
    display: flex; align-items: center; gap: 14px; flex-wrap: wrap; margin-top: auto;
    padding-top: 20px; border-top: 1px dashed rgba(200, 148, 74, 0.25);
}
.qty-stepper-big {
    display: inline-flex; align-items: center;
    border: 1.5px solid var(--gold); border-radius: 50px;
    background: #1A1412; padding: 4px;
    box-shadow: 0 4px 14px var(--gold-glow);
}
.qty-stepper-big button {
    width: 38px; height: 38px; border-radius: 50%;
    border: none; background: rgba(200, 148, 74, 0.2);
    color: var(--gold-light); font-size: 15px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s;
}
.qty-stepper-big button:hover { background: var(--gold); color: #1A1412; }
.qty-stepper-big .val {
    width: 44px; text-align: center; font-weight: 900; font-size: 1.05rem; color: #fff;
}

.btn-add-cart-main {
    flex: 1; min-width: 160px;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; border: none; padding: 14px 24px; border-radius: 50px;
    font-weight: 800; font-size: 0.92rem;
    box-shadow: 0 8px 26px rgba(189, 93, 56, 0.35); transition: all 0.25s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-add-cart-main:hover {
    transform: translateY(-2px); box-shadow: 0 12px 32px rgba(189, 93, 56, 0.5);
    background: linear-gradient(135deg, var(--rust-hover), var(--gold));
}

.btn-buy-now {
    background: #1A1412; color: var(--gold-light);
    border: 1.5px solid var(--gold); padding: 13px 22px; border-radius: 50px;
    font-weight: 800; font-size: 0.88rem; transition: all 0.25s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-buy-now:hover {
    background: var(--gold); color: #1A1412; transform: translateY(-2px);
}

/* Related Meals Section */
.related-section {
    max-width: 1280px; margin: 0 auto 90px; padding: 0 24px;
}
.related-header {
    margin-bottom: 28px; display: flex; align-items: flex-end; justify-content: space-between;
}
.related-header h3 {
    font-family: var(--font-display); font-size: 1.6rem; font-weight: 800; color: #1F1612;
}
.related-header h3 em { font-style: italic; color: var(--rust); }
.related-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px;
}

/* Related Cards with Padded Image Style */
.rel-card {
    background: #FFFFFF; border: 1px solid rgba(200, 148, 74, 0.2);
    border-radius: 22px; padding: 14px;
    box-shadow: 0 8px 24px -4px rgba(43, 36, 33, 0.05);
    transition: all 0.3s; display: flex; flex-direction: column;
}
.rel-card:hover {
    transform: translateY(-5px); border-color: rgba(189, 93, 56, 0.35);
    box-shadow: 0 16px 36px -8px rgba(189, 93, 56, 0.16);
}
.rel-img-wrap {
    height: 175px; border-radius: 16px; overflow: hidden; position: relative;
    background: #17110F; display: block; border: 1px solid rgba(200, 148, 74, 0.12);
}
.rel-img-wrap img { width: 100%; height: 100%; object-fit: cover; border-radius: 14px; transition: transform 0.5s ease; }
.rel-card:hover .rel-img-wrap img { transform: scale(1.08); }
.rel-card-body { padding: 14px 4px 2px; display: flex; flex-direction: column; flex: 1; }
.rel-card-body h4 { font-family: var(--font-display); font-size: 1.15rem; font-weight: 800; color: #1F1612; margin-bottom: 6px; }
.rel-card-body p { font-size: 0.8rem; color: #695B53; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 12px; }
.rel-card-foot {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 12px; border-top: 1px dashed rgba(200, 148, 74, 0.2); margin-top: auto;
}
.rel-price { font-family: var(--font-display); font-size: 1.35rem; font-weight: 800; color: var(--rust); }
.rel-price small { font-size: 0.72rem; font-weight: 700; color: #7A5826; }
.btn-rel-add {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; border: none; padding: 7px 16px; border-radius: 50px;
    font-size: 0.78rem; font-weight: 800; transition: all 0.2s;
    display: inline-flex; align-items: center; gap: 4px;
}
.btn-rel-add:hover { transform: translateY(-2px); box-shadow: 0 4px 12px var(--gold-glow); }

/* Cart Drawer */
.cart-overlay {
    position: fixed; inset: 0; z-index: 600;
    background: rgba(10, 8, 6, 0.6); backdrop-filter: blur(8px);
}
.cart-drawer {
    position: fixed; top: 0; left: 0; bottom: 0; z-index: 610;
    width: 100%; max-width: 430px; background: var(--dark);
    border-right: 1px solid var(--dark-border);
    display: flex; flex-direction: column;
    transform: translateX(-100%); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.cart-drawer.open { transform: translateX(0); }
.cart-head {
    padding: 20px 24px; border-bottom: 1px solid var(--dark-border);
    display: flex; align-items: center; justify-content: space-between;
    background: var(--dark-card);
}
.cart-head h3 { font-family: var(--font-display); font-size: 1.25rem; font-weight: 700; color: var(--cream); }
.cart-close {
    width: 34px; height: 34px; border-radius: 10px;
    border: 1px solid var(--dark-border); background: transparent;
    color: var(--text-muted); display: flex; align-items: center; justify-content: center;
    font-size: 14px;
}
.cart-body { flex: 1; overflow-y: auto; padding: 20px 24px; }
.cart-item {
    background: var(--dark-soft); border: 1px solid var(--dark-border); border-radius: var(--radius);
    padding: 16px; margin-bottom: 10px;
}
.cart-item-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
.cart-item-name { font-weight: 700; font-size: 0.9rem; color: var(--cream); }
.cart-item-price { font-size: 0.8rem; color: var(--gold-light); font-weight: 600; }
.cart-rm {
    background: none; border: none; color: var(--rust); font-size: 0.72rem; font-weight: 700;
    padding: 4px 8px; border-radius: 6px;
}
.cart-item-btm { display: flex; align-items: center; justify-content: space-between; }
.qty-group {
    display: inline-flex; align-items: center; border: 1px solid var(--dark-border);
    border-radius: 50px; overflow: hidden;
}
.qty-group button {
    width: 28px; height: 28px; border: none; background: transparent;
    color: var(--text-muted); font-weight: 800; font-size: 13px;
}
.qty-group .qty-val { width: 26px; text-align: center; font-weight: 900; font-size: 0.8rem; color: var(--cream); }
.cart-footer { padding: 20px 24px; border-top: 1px solid var(--dark-border); background: var(--dark-card); }
.cart-total {
    display: flex; justify-content: space-between; align-items: center;
    font-weight: 900; font-size: 1.1rem; color: var(--cream); margin-bottom: 14px;
}
.cart-total span:last-child { color: var(--gold-light); font-family: var(--font-display); font-size: 1.3rem; }
.btn-checkout-drawer {
    width: 100%; padding: 14px; border-radius: 50px; border: none;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; font-weight: 800; font-size: 0.95rem;
    box-shadow: 0 8px 28px var(--gold-glow); display: flex; align-items: center; justify-content: center; gap: 8px;
}

/* Toast */
.toast-bar {
    position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%);
    background: rgba(26, 20, 18, 0.96); backdrop-filter: blur(16px);
    border: 1px solid var(--gold); border-radius: 50px;
    padding: 12px 28px; color: #fff; font-size: 0.88rem; font-weight: 700;
    display: flex; align-items: center; gap: 10px; z-index: 9999;
    box-shadow: 0 14px 40px rgba(0,0,0,0.4), 0 0 30px var(--gold-glow);
}
.toast-bar i { color: var(--gold); font-size: 16px; }

/* Responsive */
@media (max-width: 1024px) {
    .showcase-card { grid-template-columns: 1fr; gap: 32px; padding: 28px; }
    .related-grid { grid-template-columns: repeat(2, 1fr); }
    .visual-box { max-width: 100%; height: 280px; }
}
@media (max-width: 680px) {
    .showcase-card { padding: 20px; }
    .related-grid { grid-template-columns: 1fr; }
    .opt-boxes { grid-template-columns: 1fr; }
    .extras-grid { grid-template-columns: 1fr; }
    .action-row { flex-direction: column; align-items: stretch; }
    .qty-stepper-big { justify-content: center; }
    .nav-links { display: none; }
}
    </style>
</head>
<body x-data="productPage({{ $product->id }}, {{ $product->price }}, '{{ addslashes($product->name) }}')" x-init="initApp()">

    <!-- ===== NAVBAR ===== -->
    <nav class="site-nav">
        <div class="nav-wrap">
            <a href="{{ route('store.index') }}" class="nav-logo">
                <div class="nav-logo-icon"><i class="fas fa-utensils"></i></div>
                <div class="nav-logo-text">وجبتك<span class="plus">+</span></div>
            </a>
            <div class="nav-links">
                <a href="{{ route('store.index') }}"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="{{ route('store.index') }}#menu"><i class="fas fa-book-open"></i> قائمة الطعام</a>
                <a href="{{ route('store.checkout.page') }}"><i class="fas fa-shopping-cart"></i> سلة الطلبات</a>
                <a href="{{ route('kitchen.screen') }}" target="_blank"><i class="fas fa-desktop"></i> شاشة المطبخ KDS</a>
            </div>
            <div class="nav-actions">
                <button @click="cartOpen = true" class="nav-cart-btn" id="cartToggle">
                    <i class="fas fa-shopping-bag"></i>
                    <span>السلة</span>
                    <span class="nav-cart-badge" x-text="cartTotalCount()"></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- ===== BREADCRUMB ===== -->
    <div class="breadcrumb-bar">
        <a href="{{ route('store.index') }}">الرئيسية</a>
        <span class="sep"><i class="fas fa-chevron-left"></i></span>
        <a href="{{ route('store.index') }}#productsGrid">{{ $product->subcategory->section->name ?? 'الأقسام' }}</a>
        <span class="sep"><i class="fas fa-chevron-left"></i></span>
        <a href="{{ route('store.index', ['section_id' => $product->subcategory->section_id, 'subcategory_id' => $product->subcategory_id]) }}#productsGrid">{{ $product->subcategory->name ?? 'الوجبات' }}</a>
        <span class="sep"><i class="fas fa-chevron-left"></i></span>
        <span class="current">{{ $product->name }}</span>
    </div>

    <!-- ===== MAIN PRODUCT SHOWCASE ===== -->
    <main class="product-showcase">
        <div class="showcase-card">

            <!-- Visual Column -->
            <div class="visual-col">
                <div class="visual-box">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">

                    <!-- Favorite Button -->
                    <button type="button" class="visual-fav"
                            :class="{ 'active': favorites.includes({{ $product->id }}) }"
                            @click="toggleFavorite({{ $product->id }})" title="المفضلة">
                        <i :class="favorites.includes({{ $product->id }}) ? 'fas fa-heart' : 'far fa-heart'"></i>
                    </button>

                    <!-- Rating Badge -->
                    <div class="visual-badge-rating">
                        <i class="fas fa-star"></i> 4.9 <small style="color:rgba(255,255,255,0.7);">(148 تقييم)</small>
                    </div>
                </div>

                <div class="visual-perks">
                    <div class="perk-box">
                        <i class="fas fa-clock"></i>
                        <div class="val">12-15 دقيقة</div>
                        <div class="lbl">مدة التحضير</div>
                    </div>
                    <div class="perk-box">
                        <i class="fas fa-fire"></i>
                        <div class="val">680 كالوري</div>
                        <div class="lbl">القيمة الغذائية</div>
                    </div>
                    <div class="perk-box">
                        <i class="fas fa-shield-alt"></i>
                        <div class="val">طازج 100%</div>
                        <div class="lbl">مكونات نقية</div>
                    </div>
                </div>
            </div>

            <!-- Details Column -->
            <div class="details-col">
                @if($product->is_available)
                    <span class="status-pill"><i class="fas fa-check-circle"></i> متوفر حالياً • جاهز للتحضير الفوري</span>
                @else
                    <span class="status-pill out-of-stock"><i class="fas fa-times-circle"></i> غير متوفر مؤقتاً</span>
                @endif

                <h1>{{ $product->name }}</h1>

                <div class="prod-price-wrap">
                    <div class="prod-price">
                        <span x-text="computedTotalPrice()"></span>
                        <small>ج.م</small>
                    </div>
                    <span class="tax-tag">شامل الضريبة • سعر خاص</span>
                </div>

                <p class="prod-desc">{{ $product->description }}</p>

                <!-- Ingredients -->
                <div class="section-sub-title">
                    <i class="fas fa-utensils"></i> المكونات الأساسية وتفاصيل النكهة:
                </div>
                <div class="chips-list">
                    <span class="chip-item">🥩 لحم بلدي طازج</span>
                    <span class="chip-item">🧀 جبنة شيدر أصلية</span>
                    <span class="chip-item">🍔 خبز بريوش يومي</span>
                    <span class="chip-item">🥣 صوص الشيف السري</span>
                    <span class="chip-item">🌿 خضروات مقرمشة</span>
                </div>

                <!-- Customization Option: Size -->
                <div class="opt-group">
                    <div class="section-sub-title">
                        <i class="fas fa-layer-group"></i> اختر حجم الوجبة:
                    </div>
                    <div class="opt-boxes">
                        <div class="opt-box" :class="{ 'selected': selectedSize === 'regular' }" @click="selectedSize = 'regular'; sizeExtra = 0">
                            <div class="name">عادي (Single)</div>
                            <div class="extra-price">الحجم القياسي</div>
                        </div>
                        <div class="opt-box" :class="{ 'selected': selectedSize === 'large' }" @click="selectedSize = 'large'; sizeExtra = 25">
                            <div class="name">لارج (Double)</div>
                            <div class="extra-price">+25 ج.م</div>
                        </div>
                        <div class="opt-box" :class="{ 'selected': selectedSize === 'combo' }" @click="selectedSize = 'combo'; sizeExtra = 50">
                            <div class="name">سوبر كومبو</div>
                            <div class="extra-price">+ بطاطس ومشروب (+50 ج.م)</div>
                        </div>
                    </div>
                </div>

                <!-- Extras & Addons -->
                <div class="opt-group">
                    <div class="section-sub-title">
                        <i class="fas fa-plus-circle"></i> إضافات مقترحة حسب رغبتك:
                    </div>
                    <div class="extras-grid">
                        <div class="extra-card" :class="{ 'selected': extras.includes('extra_cheese') }" @click="toggleExtra('extra_cheese', 15)">
                            <span>🧀 جبنة شيدر إضافية</span>
                            <span>+15 ج.م</span>
                        </div>
                        <div class="extra-card" :class="{ 'selected': extras.includes('bacon') }" @click="toggleExtra('bacon', 20)">
                            <span>🥓 بيكون بقري مقرمش</span>
                            <span>+20 ج.م</span>
                        </div>
                        <div class="extra-card" :class="{ 'selected': extras.includes('jalapeno') }" @click="toggleExtra('jalapeno', 10)">
                            <span>🌶️ شرائح هالبينو حارة</span>
                            <span>+10 ج.م</span>
                        </div>
                        <div class="extra-card" :class="{ 'selected': extras.includes('special_sauce') }" @click="toggleExtra('special_sauce', 12)">
                            <span>🥣 صوص خاص إضافي</span>
                            <span>+12 ج.م</span>
                        </div>
                    </div>
                </div>

                <!-- Notes for Kitchen -->
                <div class="section-sub-title">
                    <i class="fas fa-pen"></i> ملاحظات خاصة للشيف (اختياري):
                </div>
                <textarea x-model="specialInstructions" placeholder="مثال: بدون بصل، صوص جانبي، تسوية زيادة..." class="notes-input"></textarea>

                <!-- Actions -->
                <div class="action-row">
                    <div class="qty-stepper-big">
                        <button type="button" @click="if(quantity > 1) quantity--">−</button>
                        <span class="val" x-text="quantity"></span>
                        <button type="button" @click="quantity++">+</button>
                    </div>

                    <button type="button" class="btn-add-cart-main" @click="addToCartWithCustomization()">
                        <i class="fas fa-shopping-bag"></i> أضف للطلب (<span x-text="computedTotalPrice() + ' ج.م'"></span>)
                    </button>

                    <button type="button" class="btn-buy-now" @click="buyNow()">
                        <i class="fas fa-bolt"></i> شراء فوري
                    </button>
                </div>

            </div>

        </div>
    </main>

    <!-- ===== RELATED / RECOMMENDED MEALS ===== -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <section class="related-section">
        <div class="related-header">
            <div>
                <h3>أطباق أخرى <em>قد تنال إعجابك</em></h3>
                <p style="font-size:0.88rem;color:var(--text-dark-muted);margin-top:4px;">تشكيلة موصى بها من طهاتنا تناسب اختياراتك</p>
            </div>
            <a href="{{ route('store.index') }}#productsGrid" style="font-size:0.86rem;font-weight:700;color:var(--rust);">
                عرض القائمة كاملة <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <div class="related-grid">
            @foreach($relatedProducts as $rel)
                <div class="rel-card">
                    <a href="{{ route('store.product', $rel->id) }}" class="rel-img-wrap" title="عرض تفاصيل الوجبة">
                        <img src="{{ $rel->image }}" alt="{{ $rel->name }}" loading="lazy">
                    </a>
                    <div class="rel-card-body">
                        <h4><a href="{{ route('store.product', $rel->id) }}">{{ $rel->name }}</a></h4>
                        <p>{{ $rel->description }}</p>
                        <div class="rel-card-foot">
                            <span class="rel-price">{{ number_format($rel->price, 0) }} <small>ج.م</small></span>
                            <button type="button" class="btn-rel-add"
                                    @click="addSimpleToCart({{ $rel->id }}, '{{ addslashes($rel->name) }}', {{ $rel->price }})">
                                <i class="fas fa-plus"></i> أضف
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- ===== CART DRAWER ===== -->
    <div x-show="cartOpen" class="cart-overlay" @click="cartOpen = false" style="display:none;"></div>
    <div class="cart-drawer" :class="{ 'open': cartOpen }">
        <div class="cart-head">
            <h3><i class="fas fa-shopping-bag" style="color:var(--gold);"></i> سلة طلبك (<span x-text="cartTotalCount()"></span>)</h3>
            <button @click="cartOpen = false" class="cart-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-body">
            <template x-for="(item, index) in cart" :key="index">
                <div class="cart-item">
                    <div class="cart-item-top">
                        <div>
                            <div class="cart-item-name" x-text="item.name"></div>
                            <div class="cart-item-price" x-text="(item.price * item.quantity).toFixed(2) + ' ج.م'"></div>
                            <div x-show="item.special_instructions" style="font-size:0.72rem;color:var(--text-muted);margin-top:2px;" x-text="'ملاحظات: ' + item.special_instructions"></div>
                        </div>
                        <button @click="removeFromCart(index)" class="cart-rm"><i class="fas fa-trash-alt"></i> إزالة</button>
                    </div>
                    <div class="cart-item-btm">
                        <div class="qty-group">
                            <button @click="item.quantity > 1 ? item.quantity-- : removeFromCart(index)">−</button>
                            <span class="qty-val" x-text="item.quantity"></span>
                            <button @click="item.quantity++">+</button>
                        </div>
                        <span style="font-size:0.75rem;color:var(--gold-light);" x-text="'سعر القطعة: ' + item.price + ' ج.م'"></span>
                    </div>
                </div>
            </template>
            <div x-show="cart.length === 0" style="text-align:center;padding:50px 20px;color:var(--text-muted);">
                <i class="fas fa-shopping-basket" style="font-size:2.5rem;color:var(--rust);margin-bottom:12px;"></i>
                <p style="font-weight:700;color:var(--cream);">سلتك فارغة حالياً</p>
                <p style="font-size:0.8rem;margin-top:4px;">اختر وجباتك المفضلة لبدء طلبك</p>
            </div>
        </div>
        <div class="cart-footer" x-show="cart.length > 0">
            <div class="cart-total">
                <span>الإجمالي:</span>
                <span x-text="cartTotalPrice() + ' ج.م'"></span>
            </div>
            <a href="{{ route('store.checkout.page') }}" class="btn-checkout-drawer">
                <i class="fas fa-credit-card"></i> إتمام الطلب والدفع ↗
            </a>
        </div>
    </div>

    <!-- Floating Toast Confirmation -->
    <div class="toast-bar" x-show="toastMessage"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-4"
         style="display:none;">
        <i class="fas fa-check-circle"></i>
        <span x-text="toastMessage"></span>
    </div>

    <script>
    function productPage(productId, basePrice, productName) {
        return {
            productId: productId,
            basePrice: basePrice,
            productName: productName,
            quantity: 1,
            selectedSize: 'regular',
            sizeExtra: 0,
            extras: [],
            extrasTotal: 0,
            specialInstructions: '',
            cartOpen: false,
            cart: [],
            favorites: [],
            toastMessage: '',
            toastTimer: null,
            initApp() {
                try {
                    const savedCart = localStorage.getItem('kds_cart');
                    if (savedCart) this.cart = JSON.parse(savedCart);
                } catch(e) {}
                try {
                    const favs = localStorage.getItem('kds_favorites');
                    if (favs) this.favorites = JSON.parse(favs);
                } catch(e) {}
            },
            saveCart() {
                try { localStorage.setItem('kds_cart', JSON.stringify(this.cart)); } catch(e) {}
            },
            toggleFavorite(id) {
                const idx = this.favorites.indexOf(id);
                if (idx > -1) { this.favorites.splice(idx, 1); } else { this.favorites.push(id); }
                localStorage.setItem('kds_favorites', JSON.stringify(this.favorites));
            },
            toggleExtra(key, price) {
                const idx = this.extras.indexOf(key);
                if (idx > -1) {
                    this.extras.splice(idx, 1);
                    this.extrasTotal -= price;
                } else {
                    this.extras.push(key);
                    this.extrasTotal += price;
                }
            },
            unitPrice() {
                return this.basePrice + this.sizeExtra + this.extrasTotal;
            },
            computedTotalPrice() {
                return (this.unitPrice() * this.quantity).toFixed(0);
            },
            showToast(msg) {
                this.toastMessage = msg;
                if (this.toastTimer) clearTimeout(this.toastTimer);
                this.toastTimer = setTimeout(() => { this.toastMessage = ''; }, 2600);
            },
            addToCartWithCustomization() {
                let note = '';
                if (this.selectedSize === 'large') note += 'حجم كبير (Large). ';
                if (this.selectedSize === 'combo') note += 'سوبر كومبو. ';
                if (this.extras.length > 0) note += 'إضافات: ' + this.extras.join(', ') + '. ';
                if (this.specialInstructions) note += 'ملاحظات: ' + this.specialInstructions;

                const finalUnitPrice = this.unitPrice();
                const displayName = this.productName + (this.selectedSize !== 'regular' ? ' (' + (this.selectedSize === 'large' ? 'لارج' : 'كومبو') + ')' : '');

                this.cart.push({
                    product_id: this.productId,
                    name: displayName,
                    price: finalUnitPrice,
                    quantity: this.quantity,
                    special_instructions: note.trim()
                });
                this.saveCart();
                this.showToast('تمت إضافة ' + displayName + ' إلى طلبك بنجاح ✓');
                this.cartOpen = true;
            },
            addSimpleToCart(id, name, price) {
                const existing = this.cart.find(i => i.product_id === id);
                if (existing) { existing.quantity++; } else {
                    this.cart.push({ product_id: id, name, price, quantity: 1, special_instructions: '' });
                }
                this.saveCart();
                this.showToast('تمت إضافة ' + name + ' إلى سلتك ✓');
            },
            buyNow() {
                this.addToCartWithCustomization();
                setTimeout(() => {
                    window.location.href = "{{ route('store.checkout.page') }}";
                }, 300);
            },
            removeFromCart(index) {
                this.cart.splice(index, 1);
                this.saveCart();
            },
            cartTotalCount() { return this.cart.reduce((s, i) => s + i.quantity, 0); },
            cartTotalPrice() { return this.cart.reduce((s, i) => s + (i.price * i.quantity), 0).toFixed(2); }
        }
    }
    </script>
</body>
</html>

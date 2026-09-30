<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="إتمام الطلب والدفع — مطعم وجبتك الفاخر. تجربة دفع آمنة وتوصيل فوري ساخن.">
    <title>إتمام الطلب والدفع | مطعم وجبتك</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
/* ============================================
   DESIGN SYSTEM: WARM LUXURY CHECKOUT
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
    max-width: 1200px; margin: 0 auto;
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
.nav-back {
    display: flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 700;
    color: var(--gold-light); background: rgba(255,255,255,0.06); padding: 7px 18px; border-radius: 50px;
    border: 1px solid rgba(200, 148, 74, 0.3); transition: all 0.2s;
}
.nav-back:hover { background: rgba(200, 148, 74, 0.15); transform: translateX(2px); }

/* Main Container */
.checkout-wrapper {
    max-width: 1100px; margin: 36px auto 90px; padding: 0 20px;
}

/* Stepper Progress Indicator */
.stepper-progress {
    display: flex; align-items: center; justify-content: space-between;
    max-width: 860px; margin: 0 auto 42px; position: relative;
}
.stepper-progress::before {
    content: ''; position: absolute; top: 22px; left: 40px; right: 40px; height: 3px;
    background: rgba(200, 148, 74, 0.2); z-index: 1;
}
.stepper-progress-fill {
    position: absolute; top: 22px; right: 40px; height: 3px;
    background: linear-gradient(90deg, var(--rust), var(--gold));
    z-index: 2; transition: width 0.4s ease;
}
.step-node {
    display: flex; flex-direction: column; align-items: center; gap: 8px;
    position: relative; z-index: 3; cursor: pointer;
}
.step-circle {
    width: 44px; height: 44px; border-radius: 50%;
    background: #FAF5EE; border: 2.5px solid rgba(200, 148, 74, 0.3);
    color: var(--text-dark-muted); font-weight: 800; font-size: 14px;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}
.step-node.active .step-circle {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    border-color: #fff; color: #fff;
    box-shadow: 0 6px 20px var(--gold-glow); transform: scale(1.1);
}
.step-node.completed .step-circle {
    background: #231C17; border-color: var(--gold); color: var(--gold-light);
}
.step-label {
    font-size: 0.78rem; font-weight: 700; color: var(--text-dark-muted);
    transition: color 0.2s; white-space: nowrap;
}
.step-node.active .step-label { color: var(--rust); font-weight: 800; }
.step-node.completed .step-label { color: var(--text-dark); }

/* Step Card Layout */
.step-card {
    background: #FFFFFF;
    border: 1px solid rgba(200, 148, 74, 0.22);
    border-radius: var(--radius-xl);
    padding: 38px 42px;
    box-shadow: 0 16px 50px -10px rgba(43, 36, 33, 0.08), 0 2px 8px rgba(0,0,0,0.02);
    position: relative;
}
.step-header {
    margin-bottom: 28px; padding-bottom: 20px;
    border-bottom: 1px dashed rgba(200, 148, 74, 0.25);
    display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 12px;
}
.step-header h2 {
    font-family: var(--font-display); font-size: 1.6rem; font-weight: 800; color: #1F1612;
}
.step-header h2 em { font-style: italic; color: var(--rust); }
.step-header p { font-size: 0.88rem; color: var(--text-dark-muted); margin-top: 4px; }

/* STEP 1: CART REVIEW */
.cart-table {
    display: flex; flex-direction: column; gap: 14px; margin-bottom: 28px;
}
.cart-row {
    background: #FAF5EE; border: 1px solid rgba(200, 148, 74, 0.18);
    border-radius: 18px; padding: 16px 20px;
    display: grid; grid-template-columns: 1fr auto auto auto;
    align-items: center; gap: 20px;
}
.cart-row-title { font-weight: 800; font-size: 1rem; color: #1F1612; margin-bottom: 4px; }
.cart-row-notes { font-size: 0.78rem; color: var(--text-dark-muted); }
.cart-row-price {
    font-family: var(--font-display); font-size: 1.25rem; font-weight: 800; color: var(--rust);
}
.cart-row-price small { font-family: var(--font-body); font-size: 0.74rem; color: #7A5826; }
.row-stepper {
    display: inline-flex; align-items: center; border: 1.5px solid var(--gold);
    border-radius: 50px; background: #1A1412; padding: 2px 4px;
}
.row-stepper button {
    width: 28px; height: 28px; border-radius: 50%; border: none;
    background: rgba(200, 148, 74, 0.2); color: var(--gold-light);
    font-size: 12px; font-weight: 800; display: flex; align-items: center; justify-content: center;
}
.row-stepper button:hover { background: var(--gold); color: #1A1412; }
.row-stepper span { width: 32px; text-align: center; font-weight: 800; font-size: 0.85rem; color: #fff; }
.btn-row-del {
    background: none; border: none; color: #b91c1c; font-size: 14px;
    padding: 6px; border-radius: 8px; transition: all 0.2s;
}
.btn-row-del:hover { background: rgba(239,68,68,0.1); transform: scale(1.1); }

/* Cart Summary Box */
.summary-box {
    background: #FAF5EE; border: 1px solid rgba(200, 148, 74, 0.25);
    border-radius: 18px; padding: 22px 26px; margin-bottom: 28px;
}
.summary-line {
    display: flex; align-items: center; justify-content: space-between;
    font-size: 0.9rem; color: var(--text-dark-muted); margin-bottom: 10px;
}
.summary-line.total {
    font-size: 1.25rem; font-weight: 800; color: #1F1612; margin-top: 14px;
    padding-top: 14px; border-top: 1px dashed rgba(200, 148, 74, 0.3);
}
.summary-line.total span:last-child {
    font-family: var(--font-display); font-size: 1.55rem; color: var(--rust);
}

/* STEP 2: DELIVERY INFO */
.form-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 24px;
}
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.full { grid-column: 1 / -1; }
.form-label {
    font-size: 0.82rem; font-weight: 800; color: #2A211D;
    display: flex; align-items: center; gap: 6px;
}
.form-label i { color: var(--gold); }
.form-input, .form-select, .form-textarea {
    width: 100%; border: 1.5px solid rgba(200, 148, 74, 0.25); border-radius: 12px;
    padding: 12px 16px; font-size: 0.88rem; font-family: var(--font-body);
    background: #FAF5EE; color: var(--text-dark); outline: none; transition: all 0.25s;
}
.form-input:focus, .form-select:focus, .form-textarea:focus {
    border-color: var(--gold); box-shadow: 0 0 0 3px var(--gold-glow); background: #fff;
}
.form-textarea { resize: none; height: 80px; }

/* Delivery Type Toggle */
.order-type-tabs {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 24px;
}
.type-tab {
    background: #FAF5EE; border: 1.5px solid rgba(200, 148, 74, 0.22);
    border-radius: 14px; padding: 14px; text-align: center; cursor: pointer; transition: all 0.2s;
}
.type-tab.active {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    border-color: transparent; color: #fff;
    box-shadow: 0 6px 18px rgba(189, 93, 56, 0.35);
}
.type-tab i { font-size: 20px; margin-bottom: 6px; display: block; }
.type-tab .title { font-size: 0.85rem; font-weight: 800; }

/* STEP 3: PAYMENT METHODS */
.pay-options {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 28px;
}
.pay-card {
    background: #FAF5EE; border: 1.5px solid rgba(200, 148, 74, 0.25);
    border-radius: 16px; padding: 18px 16px; text-align: center; cursor: pointer; transition: all 0.25s;
}
.pay-card.active {
    border-color: var(--rust); background: rgba(189, 93, 56, 0.08);
    box-shadow: 0 6px 20px rgba(189, 93, 56, 0.15);
}
.pay-card-icon {
    width: 48px; height: 48px; border-radius: 12px; margin: 0 auto 12px;
    background: #fff; border: 1px solid rgba(200, 148, 74, 0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: var(--rust);
}
.pay-card.active .pay-card-icon {
    background: var(--rust); color: #fff; border-color: var(--rust);
}
.pay-card h4 { font-size: 0.88rem; font-weight: 800; color: #1F1612; margin-bottom: 4px; }
.pay-card p { font-size: 0.72rem; color: var(--text-dark-muted); line-height: 1.4; }

/* Card simulation fields */
.card-details-box {
    background: #FAF5EE; border: 1px solid rgba(200, 148, 74, 0.25);
    border-radius: 16px; padding: 22px; margin-bottom: 24px;
}
.card-details-box h5 {
    font-size: 0.86rem; font-weight: 800; color: #1F1612; margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
}
.card-inputs-grid {
    display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 12px;
}

/* STEP 4: ORDER REVIEW */
.review-grid {
    display: grid; grid-template-columns: 1.3fr 1fr; gap: 24px; margin-bottom: 28px;
}
.review-box {
    background: #FAF5EE; border: 1px solid rgba(200, 148, 74, 0.22);
    border-radius: 18px; padding: 22px;
}
.review-box h4 {
    font-size: 0.95rem; font-weight: 800; color: #1F1612; margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
}
.review-list { display: flex; flex-direction: column; gap: 10px; font-size: 0.85rem; }
.review-item { display: flex; justify-content: space-between; color: var(--text-dark); }
.review-item small { color: var(--text-dark-muted); }

/* STEP 5: RESULT STATES (SUCCESS / FAILED) */
.result-screen {
    text-align: center; padding: 48px 24px;
}
.result-icon-wrap {
    width: 90px; height: 90px; border-radius: 50%;
    margin: 0 auto 24px; display: flex; align-items: center; justify-content: center;
    font-size: 38px;
}
.result-icon-wrap.success {
    background: linear-gradient(135deg, #10B981, #059669); color: #fff;
    box-shadow: 0 12px 35px rgba(16, 185, 129, 0.35);
}
.result-icon-wrap.failed {
    background: linear-gradient(135deg, var(--rust), #991b1b); color: #fff;
    box-shadow: 0 12px 35px rgba(189, 93, 56, 0.35);
}
.result-screen h2 {
    font-family: var(--font-display); font-size: 2.2rem; font-weight: 800;
    color: #1F1612; margin-bottom: 12px;
}
.result-screen p {
    font-size: 0.95rem; color: #6E5F57; max-width: 520px; margin: 0 auto 28px; line-height: 1.8;
}
.order-num-pill {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(200, 148, 74, 0.12); border: 1.5px solid var(--gold);
    color: var(--rust); font-weight: 800; font-size: 1.1rem;
    padding: 8px 24px; border-radius: 50px; margin-bottom: 28px;
}
.result-actions {
    display: flex; align-items: center; justify-content: center; gap: 14px; flex-wrap: wrap;
}

/* Navigation Buttons between steps */
.step-nav-bar {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 24px; border-top: 1px dashed rgba(200, 148, 74, 0.25);
    margin-top: 20px;
}
.btn-step-prev {
    background: transparent; border: 1.5px solid rgba(200, 148, 74, 0.35);
    color: #5E524B; padding: 12px 26px; border-radius: 50px;
    font-weight: 700; font-size: 0.88rem; transition: all 0.2s;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-step-prev:hover { border-color: var(--rust); color: var(--rust); }
.btn-step-next {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; border: none; padding: 14px 34px; border-radius: 50px;
    font-weight: 800; font-size: 0.95rem;
    box-shadow: 0 8px 24px rgba(189, 93, 56, 0.35); transition: all 0.25s;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-step-next:hover {
    transform: translateY(-2px); box-shadow: 0 12px 30px rgba(189, 93, 56, 0.45);
}
.btn-step-next:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

/* Empty Cart State */
.empty-cart-view {
    text-align: center; padding: 60px 20px;
}
.empty-cart-view i { font-size: 3.5rem; color: var(--rust); margin-bottom: 16px; }
.empty-cart-view h3 { font-family: var(--font-display); font-size: 1.5rem; margin-bottom: 8px; }
.empty-cart-view p { color: var(--text-dark-muted); font-size: 0.9rem; margin-bottom: 24px; }

@media (max-width: 768px) {
    .step-card { padding: 24px 18px; }
    .cart-row { grid-template-columns: 1fr; gap: 10px; }
    .form-grid { grid-template-columns: 1fr; }
    .pay-options { grid-template-columns: 1fr; }
    .card-inputs-grid { grid-template-columns: 1fr; }
    .review-grid { grid-template-columns: 1fr; }
    .order-type-tabs { grid-template-columns: 1fr; }
    .stepper-progress { overflow-x: auto; padding-bottom: 10px; }
}
    </style>
</head>
<body x-data="checkoutApp()" x-init="initCheckout()">

    <!-- ===== NAVBAR ===== -->
    <nav class="site-nav">
        <div class="nav-wrap">
            <a href="{{ route('store.index') }}" class="nav-logo">
                <div class="nav-logo-icon"><i class="fas fa-utensils"></i></div>
                <div class="nav-logo-text">وجبتك<span class="plus">+</span></div>
            </a>
            <a href="{{ route('store.index') }}#menu" class="nav-back">
                <i class="fas fa-arrow-right"></i> متابعة تصفح القائمة
            </a>
        </div>
    </nav>

    <!-- ===== CHECKOUT CONTAINER ===== -->
    <main class="checkout-wrapper">

        <!-- Progress Stepper Indicator (Visible during steps 1-4) -->
        <template x-if="currentStep <= 4">
            <div class="stepper-progress">
                <div class="stepper-progress-fill" :style="'width: ' + ((currentStep - 1) / 3 * 100) + '%'"></div>

                <!-- Step 1 -->
                <div class="step-node" :class="{ 'active': currentStep === 1, 'completed': currentStep > 1 }" @click="goToStep(1)">
                    <div class="step-circle">
                        <template x-if="currentStep > 1"><i class="fas fa-check"></i></template>
                        <template x-if="currentStep <= 1"><span>1</span></template>
                    </div>
                    <span class="step-label">سلة الطلبات</span>
                </div>

                <!-- Step 2 -->
                <div class="step-node" :class="{ 'active': currentStep === 2, 'completed': currentStep > 2 }" @click="goToStep(2)">
                    <div class="step-circle">
                        <template x-if="currentStep > 2"><i class="fas fa-check"></i></template>
                        <template x-if="currentStep <= 2"><span>2</span></template>
                    </div>
                    <span class="step-label">بيانات التوصيل</span>
                </div>

                <!-- Step 3 -->
                <div class="step-node" :class="{ 'active': currentStep === 3, 'completed': currentStep > 3 }" @click="goToStep(3)">
                    <div class="step-circle">
                        <template x-if="currentStep > 3"><i class="fas fa-check"></i></template>
                        <template x-if="currentStep <= 3"><span>3</span></template>
                    </div>
                    <span class="step-label">طريقة الدفع</span>
                </div>

                <!-- Step 4 -->
                <div class="step-node" :class="{ 'active': currentStep === 4, 'completed': currentStep > 4 }" @click="goToStep(4)">
                    <div class="step-circle">
                        <template x-if="currentStep > 4"><i class="fas fa-check"></i></template>
                        <template x-if="currentStep <= 4"><span>4</span></template>
                    </div>
                    <span class="step-label">مراجعة وتأكيد</span>
                </div>
            </div>
        </template>

        <!-- ==============================================
             STEP 1: CART REVIEW
             ============================================== -->
        <div class="step-card" x-show="currentStep === 1" x-transition>
            <div class="step-header">
                <div>
                    <h2>مراجعة <em>سلة الطلبات</em></h2>
                    <p>تحقق من الوجبات المحددة والكميات قبل استكمال بيانات التوصيل</p>
                </div>
                <span style="font-weight:700;font-size:0.86rem;color:var(--rust);">
                    <i class="fas fa-box-open"></i> <span x-text="cartTotalCount()"></span> وجبات في طلبك
                </span>
            </div>

            <!-- Empty Cart View -->
            <template x-if="cart.length === 0">
                <div class="empty-cart-view">
                    <i class="fas fa-shopping-basket"></i>
                    <h3>سلة طلباتك فارغة حالياً</h3>
                    <p>يبدو أنك لم تختر أي وجبات بعد، استكشف قائمتنا الشهية واختر ما تشتهيه!</p>
                    <a href="{{ route('store.index') }}#menu" class="btn-step-next">
                        <i class="fas fa-utensils"></i> تصفح قائمة الطعام الآن
                    </a>
                </div>
            </template>

            <!-- Populated Cart -->
            <template x-if="cart.length > 0">
                <div>
                    <div class="cart-table">
                        <template x-for="(item, index) in cart" :key="index">
                            <div class="cart-row">
                                <div>
                                    <div class="cart-row-title" x-text="item.name"></div>
                                    <div class="cart-row-notes" x-show="item.special_instructions" x-text="'ملاحظات: ' + item.special_instructions"></div>
                                </div>
                                <div class="row-stepper">
                                    <button type="button" @click="decreaseQty(index)">−</button>
                                    <span x-text="item.quantity"></span>
                                    <button type="button" @click="increaseQty(index)">+</button>
                                </div>
                                <div class="cart-row-price">
                                    <span x-text="(item.price * item.quantity).toFixed(0)"></span>
                                    <small>ج.م</small>
                                </div>
                                <button type="button" class="btn-row-del" @click="removeItem(index)" title="حذف الوجبة">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Summary Box -->
                    <div class="summary-box">
                        <div class="summary-line">
                            <span>قيمة الوجبات (Subtotal):</span>
                            <span x-text="cartSubtotal().toFixed(0) + ' ج.م'"></span>
                        </div>
                        <div class="summary-line">
                            <span>رسوم التوصيل السريع (Delivery Fee):</span>
                            <span>20 ج.م</span>
                        </div>
                        <div class="summary-line" style="color:#059669;font-weight:700;">
                            <span>خصم الطلب أونلاين (Online Promo):</span>
                            <span>-15 ج.م</span>
                        </div>
                        <div class="summary-line total">
                            <span>إجمالي الحساب النهائي:</span>
                            <span x-text="cartFinalTotal().toFixed(0) + ' ج.م'"></span>
                        </div>
                    </div>

                    <div class="step-nav-bar">
                        <a href="{{ route('store.index') }}#menu" class="btn-step-prev">
                            <i class="fas fa-arrow-right"></i> مواصلة التسوق
                        </a>
                        <button type="button" class="btn-step-next" @click="currentStep = 2">
                            <span>متابعة بيانات التوصيل</span> <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- ==============================================
             STEP 2: DELIVERY INFORMATION
             ============================================== -->
        <div class="step-card" x-show="currentStep === 2" x-transition>
            <div class="step-header">
                <div>
                    <h2>بيانات <em>التوصيل والاستلام</em></h2>
                    <p>أدخل بياناتك ليصلك طلبك ساخناً وطازجاً في أسرع وقت</p>
                </div>
            </div>

            <!-- Order Type Selector -->
            <div class="order-type-tabs">
                <div class="type-tab" :class="{ 'active': deliveryData.order_type === 'delivery' }" @click="deliveryData.order_type = 'delivery'">
                    <i class="fas fa-motorcycle"></i>
                    <div class="title">توصيل سريع للمنزل</div>
                </div>
                <div class="type-tab" :class="{ 'active': deliveryData.order_type === 'takeaway' }" @click="deliveryData.order_type = 'takeaway'">
                    <i class="fas fa-shopping-bag"></i>
                    <div class="title">استلام من الفرع</div>
                </div>
                <div class="type-tab" :class="{ 'active': deliveryData.order_type === 'dine_in' }" @click="deliveryData.order_type = 'dine_in'">
                    <i class="fas fa-chair"></i>
                    <div class="title">تناول في المطعم (صالة)</div>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-user"></i> اسم العميل الكريم *</label>
                    <input type="text" x-model="deliveryData.customer_name" placeholder="مثال: أحمد مصطفى" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-phone"></i> رقم الهاتف المحمول *</label>
                    <input type="tel" x-model="deliveryData.customer_phone" placeholder="مثال: 01012345678" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-map-marker-alt"></i> المدينة / المنطقة *</label>
                    <select x-model="deliveryData.city" class="form-select">
                        <option value="القاهرة الجديدة - التجمع">القاهرة الجديدة - التجمع</option>
                        <option value="المعادي ودجلة">المعادي ودجلة</option>
                        <option value="الشيخ زايد وأكتوبر">الشيخ زايد وأكتوبر</option>
                        <option value="مصر الجديدة ومدينة نصر">مصر الجديدة ومدينة نصر</option>
                        <option value="الدقي والمهندسين">الدقي والمهندسين</option>
                        <option value="وسط البلد والزمالك">وسط البلد والزمالك</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-home"></i> العنوان بالتفصيل (الشارع، العمارة، الشقة) *</label>
                    <input type="text" x-model="deliveryData.delivery_address" placeholder="مثال: شارع التسعين الشمالي، عمارة 12، شقة 4" class="form-input">
                </div>

                <div class="form-group full">
                    <label class="form-label"><i class="fas fa-comment-dots"></i> تعليمات إضافية للتوصيل (علامة مميزة، وقت مفضل)</label>
                    <textarea x-model="deliveryData.notes" placeholder="مثال: بجوار مسجد الحمد، يرجى الاتصال عند الوصول..." class="form-textarea"></textarea>
                </div>
            </div>

            <div class="step-nav-bar">
                <button type="button" class="btn-step-prev" @click="currentStep = 1">
                    <i class="fas fa-arrow-right"></i> العودة للسلة
                </button>
                <button type="button" class="btn-step-next" @click="validateStep2()">
                    <span>متابعة لطريقة الدفع</span> <i class="fas fa-arrow-left"></i>
                </button>
            </div>
        </div>

        <!-- ==============================================
             STEP 3: PAYMENT METHOD
             ============================================== -->
        <div class="step-card" x-show="currentStep === 3" x-transition>
            <div class="step-header">
                <div>
                    <h2>اختر <em>وسيلة الدفع</em></h2>
                    <p>نوفر لك طرق دفع متعددة وآمنة ومشفرة بالكامل</p>
                </div>
                <div style="font-size:0.88rem;color:var(--text-dark-muted);">
                    المبلغ المطلوب سداده: <strong style="color:var(--rust);font-size:1.1rem;" x-text="cartFinalTotal().toFixed(0) + ' ج.م'"></strong>
                </div>
            </div>

            <!-- Payment Options Cards -->
            <div class="pay-options">
                <!-- COD -->
                <div class="pay-card" :class="{ 'active': paymentMethod === 'cash' }" @click="paymentMethod = 'cash'">
                    <div class="pay-card-icon"><i class="fas fa-money-bill-wave"></i></div>
                    <h4>دفع عند الاستلام</h4>
                    <p>ادفع نقداً لمندوب التوصيل فور استلام وجبتك</p>
                </div>

                <!-- Card -->
                <div class="pay-card" :class="{ 'active': paymentMethod === 'card' }" @click="paymentMethod = 'card'">
                    <div class="pay-card-icon"><i class="fas fa-credit-card"></i></div>
                    <h4>بطاقة بنكية / فيزا</h4>
                    <p>دفع آمن وفوري بفيزا أو ماستركارد أو ميزة</p>
                </div>

                <!-- Online / Wallet -->
                <div class="pay-card" :class="{ 'active': paymentMethod === 'online' }" @click="paymentMethod = 'online'">
                    <div class="pay-card-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h4>محفظة إلكترونية / إنستاباي</h4>
                    <p>فودافون كاش، محفظة البنك، أو تطبيق InstaPay</p>
                </div>
            </div>

            <!-- Simulated Card Inputs if Card chosen -->
            <div class="card-details-box" x-show="paymentMethod === 'card'" x-transition>
                <h5><i class="fas fa-lock" style="color:var(--gold);"></i> بيانات البطاقة الائتمانية (مشفرة وآمنة 100%)</h5>
                <div class="card-inputs-grid">
                    <div class="form-group">
                        <label class="form-label">رقم البطاقة (Card Number)</label>
                        <input type="text" x-model="cardData.number" placeholder="4242 •••• •••• 4242" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">تاريخ الانتهاء</label>
                        <input type="text" x-model="cardData.expiry" placeholder="MM / YY" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">رمز الأمان CVV</label>
                        <input type="password" maxlength="4" x-model="cardData.cvv" placeholder="•••" class="form-input">
                    </div>
                </div>

                <!-- Optional Testing Switch for Simulated Payment Failure -->
                <div style="margin-top:14px;padding-top:12px;border-top:1px dashed rgba(200,148,74,0.2);display:flex;align-items:center;gap:8px;font-size:0.78rem;color:var(--text-dark-muted);">
                    <input type="checkbox" id="simFail" x-model="simulateFailure">
                    <label for="simFail" style="cursor:pointer;">تجربة محاكاة فشل الدفع (لاختبار شاشة خطأ الدفع Payment Failed)</label>
                </div>
            </div>

            <div class="step-nav-bar">
                <button type="button" class="btn-step-prev" @click="currentStep = 2">
                    <i class="fas fa-arrow-right"></i> بيانات التوصيل
                </button>
                <button type="button" class="btn-step-next" @click="currentStep = 4">
                    <span>مراجعة الطلب النهائية</span> <i class="fas fa-arrow-left"></i>
                </button>
            </div>
        </div>

        <!-- ==============================================
             STEP 4: ORDER REVIEW & CONFIRMATION
             ============================================== -->
        <div class="step-card" x-show="currentStep === 4" x-transition>
            <div class="step-header">
                <div>
                    <h2>مراجعة الطلب <em>والتأكيد النهائي</em></h2>
                    <p>يرجى التأكد من صحة كافة تفاصيل طلبك قبل إرساله إلى المطبخ</p>
                </div>
            </div>

            <div class="review-grid">
                <!-- Meals summary -->
                <div class="review-box">
                    <h4><i class="fas fa-utensils" style="color:var(--gold);"></i> الوجبات المطلوبة:</h4>
                    <div class="review-list">
                        <template x-for="(item, idx) in cart" :key="idx">
                            <div class="review-item">
                                <div>
                                    <strong x-text="item.quantity + ' × ' + item.name"></strong>
                                    <div style="font-size:0.74rem;color:var(--text-dark-muted);" x-show="item.special_instructions" x-text="item.special_instructions"></div>
                                </div>
                                <span style="font-weight:700;color:var(--rust);" x-text="(item.price * item.quantity).toFixed(0) + ' ج.م'"></span>
                            </div>
                        </template>
                    </div>

                    <div style="margin-top:16px;padding-top:14px;border-top:1px dashed rgba(200,148,74,0.25);">
                        <div class="review-item" style="margin-bottom:6px;">
                            <span>قيمة الوجبات:</span>
                            <span x-text="cartSubtotal().toFixed(0) + ' ج.م'"></span>
                        </div>
                        <div class="review-item" style="margin-bottom:6px;">
                            <span>التوصيل السريع:</span>
                            <span>20 ج.م</span>
                        </div>
                        <div class="review-item" style="margin-bottom:6px;color:#059669;">
                            <span>خصم التطبيق أونلاين:</span>
                            <span>-15 ج.م</span>
                        </div>
                        <div class="review-item" style="font-size:1.15rem;font-weight:900;margin-top:10px;padding-top:10px;border-top:1px solid rgba(200,148,74,0.2);">
                            <span>الإجمالي الكلي:</span>
                            <span style="color:var(--rust);" x-text="cartFinalTotal().toFixed(0) + ' ج.م'"></span>
                        </div>
                    </div>
                </div>

                <!-- Customer & Delivery Summary -->
                <div class="review-box">
                    <h4><i class="fas fa-map-marked-alt" style="color:var(--gold);"></i> تفاصيل التوصيل والدفع:</h4>
                    <div class="review-list">
                        <div class="review-item">
                            <small>العميل:</small>
                            <span x-text="deliveryData.customer_name"></span>
                        </div>
                        <div class="review-item">
                            <small>الهاتف:</small>
                            <span x-text="deliveryData.customer_phone"></span>
                        </div>
                        <div class="review-item">
                            <small>المدينة:</small>
                            <span x-text="deliveryData.city"></span>
                        </div>
                        <div class="review-item">
                            <small>العنوان:</small>
                            <span x-text="deliveryData.delivery_address"></span>
                        </div>
                        <div class="review-item">
                            <small>نوع الطلب:</small>
                            <span>
                                <template x-if="deliveryData.order_type === 'delivery'">توصيل سريع</template>
                                <template x-if="deliveryData.order_type === 'takeaway'">استلام من الفرع</template>
                                <template x-if="deliveryData.order_type === 'dine_in'">تناول في المطعم</template>
                            </span>
                        </div>
                        <div class="review-item">
                            <small>طريقة الدفع:</small>
                            <strong style="color:var(--rust);">
                                <template x-if="paymentMethod === 'cash'">💵 دفع عند الاستلام</template>
                                <template x-if="paymentMethod === 'card'">💳 بطاقة بنكية (فيزا)</template>
                                <template x-if="paymentMethod === 'online'">📱 محفظة إلكترونية</template>
                            </strong>
                        </div>
                        <div class="review-item" x-show="deliveryData.notes">
                            <small>ملاحظات:</small>
                            <span x-text="deliveryData.notes"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-nav-bar">
                <button type="button" class="btn-step-prev" @click="currentStep = 3" :disabled="isSubmitting">
                    <i class="fas fa-arrow-right"></i> تعديل طريقة الدفع
                </button>
                <button type="button" class="btn-step-next" @click="submitOrderFinal()" :disabled="isSubmitting">
                    <span x-show="!isSubmitting">
                        <i class="fas fa-check-circle"></i> تأكيد الطلب والدفع الآن (<span x-text="cartFinalTotal().toFixed(0) + ' ج.م'"></span>)
                    </span>
                    <span x-show="isSubmitting">
                        <i class="fas fa-spinner fa-spin"></i> جاري معالجة الطلب...
                    </span>
                </button>
            </div>
        </div>

        <!-- ==============================================
             STEP 5: RESULT SCREEN — SUCCESSFUL PAYMENT
             ============================================== -->
        <div class="step-card" x-show="currentStep === 5 && paymentResult === 'success'" x-transition>
            <div class="result-screen">
                <div class="result-icon-wrap success">
                    <i class="fas fa-check"></i>
                </div>
                <h2>تم تأكيد طلبك والدفع بنجاح! 🎉</h2>
                <p>
                    شكراً لاختيارك مطعم وجبتك. تم إرسال تذكرة طلبك مباشرة إلى شاشة المطبخ KDS وبدأ الشيف في تحضير طعامك بكل شغف وعناية.
                </p>

                <div>
                    <span class="order-num-pill">
                        <i class="fas fa-receipt"></i> رقم الطلب: <span x-text="createdOrderNumber"></span>
                    </span>
                </div>

                <div style="background:#FAF5EE;border:1px solid rgba(200,148,74,0.22);border-radius:18px;max-width:540px;margin:0 auto 30px;padding:20px;text-align:right;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:0.88rem;">
                        <span style="color:var(--text-dark-muted);">وقت التوصيل المتوقع:</span>
                        <strong style="color:#059669;"><i class="fas fa-clock"></i> 20-25 دقيقة</strong>
                    </div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:0.88rem;">
                        <span style="color:var(--text-dark-muted);">حالة التذكرة في المطبخ:</span>
                        <strong style="color:var(--rust);"><i class="fas fa-fire"></i> قيد الانتظار في شاشة KDS</strong>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:0.88rem;">
                        <span style="color:var(--text-dark-muted);">المبلغ المسدد:</span>
                        <strong style="color:var(--text-dark);font-family:var(--font-display);font-size:1.1rem;" x-text="cartFinalTotal().toFixed(0) + ' ج.م'"></strong>
                    </div>
                </div>

                <div class="result-actions">
                    <a :href="'/track/' + createdOrderNumber" class="btn-step-next" style="text-decoration:none;">
                        <i class="fas fa-satellite-dish"></i> تتبع حالة الطلب لحظياً (KDS Track)
                    </a>
                    <a href="{{ route('store.index') }}" class="btn-step-prev" style="text-decoration:none;">
                        <i class="fas fa-home"></i> العودة للرئيسية
                    </a>
                </div>
            </div>
        </div>

        <!-- ==============================================
             STEP 5: RESULT SCREEN — FAILED PAYMENT
             ============================================== -->
        <div class="step-card" x-show="currentStep === 5 && paymentResult === 'failed'" x-transition>
            <div class="result-screen">
                <div class="result-icon-wrap failed">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h2 style="color:#b91c1c;">تعذر إتمام عملية الدفع ⚠️</h2>
                <p x-text="errorMessage || 'نأسف، لم نتمكن من إتمام عملية الدفع عبر البطاقة البنكية بسبب انتهاء جلسة الاتصال بالبنك أو عدم كفاية الرصيد. لم يتم خصم أي مبالغ من حسابك.'"></p>

                <div class="result-actions">
                    <button type="button" class="btn-step-next" @click="currentStep = 3; simulateFailure = false;">
                        <i class="fas fa-redo-alt"></i> إعادة محاولة الدفع (Try Again)
                    </button>
                    <button type="button" class="btn-step-prev" @click="switchCodAndSubmit()">
                        <i class="fas fa-money-bill-wave"></i> الدفع عند الاستلام بدلاً من ذلك
                    </button>
                    <button type="button" class="btn-step-prev" @click="currentStep = 1">
                        <i class="fas fa-shopping-basket"></i> العودة لمراجعة السلة
                    </button>
                </div>
            </div>
        </div>

    </main>

    <script>
    function checkoutApp() {
        return {
            currentStep: 1,
            paymentResult: '', // 'success' or 'failed'
            createdOrderNumber: '',
            errorMessage: '',
            simulateFailure: false,
            isSubmitting: false,
            cart: [],
            deliveryData: {
                order_type: 'delivery',
                customer_name: '',
                customer_phone: '',
                city: 'القاهرة الجديدة - التجمع',
                delivery_address: '',
                notes: ''
            },
            paymentMethod: 'cash', // 'cash', 'card', 'online'
            cardData: {
                number: '',
                expiry: '',
                cvv: ''
            },
            initCheckout() {
                try {
                    const savedCart = localStorage.getItem('kds_cart');
                    if (savedCart) this.cart = JSON.parse(savedCart);
                } catch(e) {}

                // Pre-fill location from initial modal if available
                const savedLoc = localStorage.getItem('kds_customer_location');
                if (savedLoc) {
                    this.deliveryData.city = savedLoc;
                    this.deliveryData.delivery_address = savedLoc;
                }
            },
            saveCart() {
                try { localStorage.setItem('kds_cart', JSON.stringify(this.cart)); } catch(e) {}
            },
            goToStep(step) {
                if (this.cart.length === 0 && step > 1) return;
                if (step === 3 && !this.validateStep2(false)) return;
                this.currentStep = step;
            },
            cartTotalCount() {
                return this.cart.reduce((s, i) => s + i.quantity, 0);
            },
            cartSubtotal() {
                return this.cart.reduce((s, i) => s + (i.price * i.quantity), 0);
            },
            cartFinalTotal() {
                const sub = this.cartSubtotal();
                if (sub <= 0) return 0;
                return Math.max(0, sub + 20 - 15); // + 20 delivery, - 15 discount
            },
            increaseQty(index) {
                this.cart[index].quantity++;
                this.saveCart();
            },
            decreaseQty(index) {
                if (this.cart[index].quantity > 1) {
                    this.cart[index].quantity--;
                } else {
                    this.removeItem(index);
                }
                this.saveCart();
            },
            removeItem(index) {
                this.cart.splice(index, 1);
                this.saveCart();
            },
            validateStep2(advance = true) {
                if (!this.deliveryData.customer_name || this.deliveryData.customer_name.trim() === '') {
                    alert('يرجى إدخال اسم العميل');
                    return false;
                }
                if (!this.deliveryData.customer_phone || this.deliveryData.customer_phone.trim() === '') {
                    alert('يرجى إدخال رقم الهاتف للتواصل');
                    return false;
                }
                if (!this.deliveryData.delivery_address || this.deliveryData.delivery_address.trim() === '') {
                    alert('يرجى إدخال عنوان التوصيل');
                    return false;
                }
                if (advance) {
                    this.currentStep = 3;
                }
                return true;
            },
            async submitOrderFinal() {
                if (this.cart.length === 0) {
                    alert('سلة الطلبات فارغة!');
                    return;
                }
                this.isSubmitting = true;
                this.errorMessage = '';

                try {
                    const response = await fetch('{{ route("store.checkout") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            customer_name: this.deliveryData.customer_name,
                            customer_phone: this.deliveryData.customer_phone,
                            order_type: this.deliveryData.order_type,
                            city: this.deliveryData.city,
                            delivery_address: this.deliveryData.delivery_address,
                            payment_method: this.paymentMethod,
                            simulate_failure: this.simulateFailure,
                            notes: this.deliveryData.notes,
                            items: this.cart
                        })
                    });

                    const res = await response.json();

                    if (response.ok && res.status === 'success') {
                        this.createdOrderNumber = res.order_number;
                        this.paymentResult = 'success';
                        this.currentStep = 5;
                        // Clear cart
                        this.cart = [];
                        this.saveCart();
                    } else {
                        // Payment Failed
                        this.errorMessage = res.message || 'فشلت عملية الدفع';
                        this.paymentResult = 'failed';
                        this.currentStep = 5;
                    }
                } catch (err) {
                    this.errorMessage = 'حدث خطأ في الاتصال بالخادم، يرجى إعادة المحاولة';
                    this.paymentResult = 'failed';
                    this.currentStep = 5;
                } finally {
                    this.isSubmitting = false;
                }
            },
            switchCodAndSubmit() {
                this.paymentMethod = 'cash';
                this.simulateFailure = false;
                this.submitOrderFinal();
            }
        }
    }
    </script>
</body>
</html>

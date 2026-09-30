<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم تأكيد الطلب بنجاح | مطعم وجبتك</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --gold: #C8944A; --rust: #BD5D38; --dark: #1A1412; --cream: #FAF5EE;
            --font-display: 'Playfair Display', 'Cairo', serif; --font-body: 'Cairo', sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font-body);
            background: radial-gradient(circle at center, #FAF5EE 0%, #F0E6D8 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 24px; color: #2B2421;
        }
        .success-box {
            background: #fff; border: 1px solid rgba(200, 148, 74, 0.25);
            border-radius: 32px; max-width: 580px; width: 100%;
            padding: 48px 36px; text-align: center;
            box-shadow: 0 20px 60px -15px rgba(43, 36, 33, 0.12);
        }
        .icon-wrap {
            width: 88px; height: 88px; border-radius: 50%; margin: 0 auto 24px;
            background: linear-gradient(135deg, #10B981, #059669); color: #fff;
            display: flex; align-items: center; justify-content: center; font-size: 38px;
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.35);
        }
        h1 { font-family: var(--font-display); font-size: 2rem; font-weight: 800; margin-bottom: 12px; }
        p { font-size: 0.92rem; color: #6E5F57; line-height: 1.8; margin-bottom: 24px; }
        .order-pill {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(200, 148, 74, 0.12); border: 1.5px solid var(--gold);
            color: var(--rust); font-weight: 800; font-size: 1.05rem;
            padding: 8px 24px; border-radius: 50px; margin-bottom: 24px;
        }
        .details-card {
            background: #FAF5EE; border-radius: 16px; padding: 18px 20px;
            text-align: right; margin-bottom: 28px; font-size: 0.88rem;
        }
        .details-line { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .btn-track {
            background: linear-gradient(135deg, var(--rust), var(--gold));
            color: #fff; text-decoration: none; padding: 14px 28px; border-radius: 50px;
            font-weight: 800; font-size: 0.92rem; display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 8px 24px rgba(189, 93, 56, 0.35);
        }
        .btn-home {
            background: transparent; color: #5E524B; text-decoration: none; padding: 14px 24px;
            border-radius: 50px; font-weight: 700; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 6px;
            border: 1px solid rgba(200, 148, 74, 0.3); margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="success-box">
        <div class="icon-wrap"><i class="fas fa-check"></i></div>
        <h1>تم استلام طلبك وتأكيد الدفع بنجاح! 🎉</h1>
        <p>بدأ فريق الطهاة في تحضير طعامك مباشرة عبر شاشة المطبخ KDS ليتم تسليمه لك في قمة القرمشة والحرارة.</p>

        <div class="order-pill">
            <i class="fas fa-receipt"></i> رقم الطلب: {{ $order->order_number }}
        </div>

        <div class="details-card">
            <div class="details-line">
                <span style="color:#7A6E66;">اسم العميل:</span>
                <strong>{{ $order->customer_name }}</strong>
            </div>
            <div class="details-line">
                <span style="color:#7A6E66;">وقت التوصيل المقدر:</span>
                <strong style="color:#059669;"><i class="fas fa-clock"></i> 20-25 دقيقة</strong>
            </div>
            <div class="details-line">
                <span style="color:#7A6E66;">إجمالي المبلغ:</span>
                <strong style="color:var(--rust);">{{ number_format($order->total_amount, 0) }} ج.م</strong>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;">
            <a href="{{ route('store.track', $order->order_number) }}" class="btn-track">
                <i class="fas fa-satellite-dish"></i> تتبع الطلب مباشرة عبر KDS
            </a>
            <a href="{{ route('store.index') }}" class="btn-home">
                <i class="fas fa-home"></i> العودة للصفحة الرئيسية
            </a>
        </div>
    </div>
</body>
</html>

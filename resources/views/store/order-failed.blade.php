<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعذر إتمام الدفع | مطعم وجبتك</title>
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
        .failed-box {
            background: #fff; border: 1px solid rgba(200, 148, 74, 0.25);
            border-radius: 32px; max-width: 560px; width: 100%;
            padding: 48px 36px; text-align: center;
            box-shadow: 0 20px 60px -15px rgba(43, 36, 33, 0.12);
        }
        .icon-wrap {
            width: 88px; height: 88px; border-radius: 50%; margin: 0 auto 24px;
            background: linear-gradient(135deg, var(--rust), #991b1b); color: #fff;
            display: flex; align-items: center; justify-content: center; font-size: 38px;
            box-shadow: 0 12px 35px rgba(189, 93, 56, 0.35);
        }
        h1 { font-family: var(--font-display); font-size: 2rem; font-weight: 800; margin-bottom: 12px; color: #b91c1c; }
        p { font-size: 0.92rem; color: #6E5F57; line-height: 1.8; margin-bottom: 28px; }
        .btn-try {
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
    <div class="failed-box">
        <div class="icon-wrap"><i class="fas fa-exclamation-triangle"></i></div>
        <h1>تعذر إتمام عملية الدفع ⚠️</h1>
        <p>نأسف، لم نتمكن من معالجة عملية الدفع الخاصة بك عبر البطاقة البنكية. قد يكون ذلك بسبب انتهاء مهلة الجلسة أو خطأ في بيانات البطاقة. يمكنك المحاولة مرة أخرى أو اختيار الدفع عند الاستلام.</p>

        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;">
            <a href="{{ route('store.checkout.page') }}" class="btn-try">
                <i class="fas fa-redo-alt"></i> العودة والمحاولة مرة أخرى (Try Again)
            </a>
            <a href="{{ route('store.index') }}" class="btn-home">
                <i class="fas fa-home"></i> العودة للصفحة الرئيسية
            </a>
        </div>
    </div>
</body>
</html>

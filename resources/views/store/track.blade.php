<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>متابعة الطلب #{{ $order->order_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #FAF8F3 0%, #F5EEE4 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 24px; color: #221611;
        }
        .track-card {
            max-width: 480px; width: 100%;
            background: white; border-radius: 28px;
            box-shadow: 0 20px 60px rgba(82,64,55,0.08), 0 4px 12px rgba(82,64,55,0.04);
            overflow: hidden;
            border: 1px solid rgba(82,64,55,0.08);
        }
        .track-top {
            background: linear-gradient(135deg, #221611, #3a261e);
            padding: 40px 32px 36px; text-align: center; position: relative; overflow: hidden;
        }
        .track-top::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at 50% 0%, rgba(217,72,25,0.2) 0%, transparent 60%);
        }
        .track-top * { position: relative; z-index: 1; }
        .track-icon {
            width: 64px; height: 64px; border-radius: 50%;
            background: linear-gradient(135deg, #D94819, #f97316);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px; font-size: 28px;
            box-shadow: 0 8px 24px rgba(217,72,25,0.35);
        }
        .track-top h1 {
            font-size: 22px; font-weight: 900; color: white; margin-bottom: 6px;
        }
        .track-top .order-num {
            font-size: 13px; color: rgba(255,255,255,0.5); font-weight: 600;
            font-variant-numeric: tabular-nums;
        }

        .track-body { padding: 32px; }

        /* ===== STATUS TIMELINE ===== */
        @php
            $ticketStatus = $order->kitchenTicket?->status ?? 'queued';
            $allSteps = ['queued', 'received', 'preparing', 'ready', 'served'];
            $currentIdx = array_search($ticketStatus, $allSteps);
            $stepsData = [
                'queued'    => ['icon' => '💳', 'title' => 'تم الدفع وبانتظار الإرسال', 'desc' => 'طلبك مسجل وتم تأكيد دفعه بنجاح.'],
                'received'  => ['icon' => '📥', 'title' => 'وصل المطبخ', 'desc' => 'الشيف استلم تذكرتك للتو.'],
                'preparing' => ['icon' => '🔥', 'title' => 'جاري الطهي والتحضير', 'desc' => 'وجبتك الشهية على النار الآن.'],
                'ready'     => ['icon' => '✅', 'title' => 'جاهز للاستلام / التسليم', 'desc' => 'الوجبة ساخنة وجاهزة للتسليم فوراً!'],
                'served'    => ['icon' => '🎉', 'title' => 'تم التسليم بالهناء والشفاء', 'desc' => 'نتمنى لك وجبة ممتعة!'],
            ];
        @endphp

        .timeline { margin-bottom: 28px; }
        .step {
            display: flex; gap: 16px; position: relative;
            padding-bottom: 24px;
        }
        .step:last-child { padding-bottom: 0; }
        .step::before {
            content: ''; position: absolute;
            right: 17px; top: 36px; width: 2px;
            height: calc(100% - 36px);
            background: #e2e8f0;
        }
        .step:last-child::before { display: none; }
        .step.active::before { background: linear-gradient(to bottom, #e11d48, #e2e8f0); }
        .step.done::before { background: #e11d48; }
        .step-dot {
            width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; border: 2px solid #e2e8f0;
            background: white; position: relative; z-index: 1;
        }
        .step.done .step-dot { border-color: #e11d48; background: #fff1f2; }
        .step.active .step-dot {
            border-color: #e11d48; background: #e11d48;
            box-shadow: 0 0 0 6px rgba(225,29,72,0.15);
            animation: pulse-active 2s ease infinite;
        }
        @keyframes pulse-active {
            0%, 100% { box-shadow: 0 0 0 4px rgba(225,29,72,0.15); }
            50% { box-shadow: 0 0 0 8px rgba(225,29,72,0.08); }
        }
        .step-content { flex: 1; padding-top: 4px; }
        .step-title {
            font-size: 14px; font-weight: 800; color: #94a3b8;
        }
        .step.done .step-title, .step.active .step-title { color: #0f172a; }
        .step-desc {
            font-size: 12px; color: #94a3b8; margin-top: 2px;
        }
        .step.active .step-desc { color: #64748b; }

        /* ===== BILL ===== */
        .bill { border-top: 2px dashed #e2e8f0; padding-top: 20px; margin-bottom: 24px; }
        .bill-title {
            font-size: 12px; font-weight: 800; color: #64748b; margin-bottom: 12px;
            display: flex; align-items: center; gap: 6px;
        }
        .bill-item {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 13px; color: #475569; padding: 6px 0;
        }
        .bill-item .name { font-weight: 600; }
        .bill-item .amount { font-weight: 800; color: #0f172a; }
        .bill-total {
            display: flex; justify-content: space-between; align-items: center;
            padding-top: 12px; border-top: 2px solid #e2e8f0;
            margin-top: 8px;
            font-weight: 900; font-size: 16px; color: #0f172a;
        }

        /* ===== ACTIONS ===== */
        .track-actions { display: flex; gap: 10px; }
        .btn-back {
            flex: 1; padding: 14px; border-radius: 16px; border: none;
            background: #0f172a; color: white; font-weight: 800; font-size: 13px;
            cursor: pointer; font-family: 'Cairo'; text-decoration: none;
            text-align: center; transition: all 0.25s ease;
        }
        .btn-back:hover { background: #1e293b; }
        .btn-refresh {
            padding: 14px 20px; border-radius: 16px;
            border: 2px solid #e2e8f0; background: white;
            color: #e11d48; font-weight: 800; font-size: 13px;
            cursor: pointer; font-family: 'Cairo'; transition: all 0.25s ease;
        }
        .btn-refresh:hover { background: #fff1f2; border-color: #fecdd3; }
    </style>
</head>
<body>
    <div class="track-card">
        <div class="track-top">
            <div class="track-icon">🎉</div>
            <h1>تم استلام طلبك بنجاح!</h1>
            <p class="order-num">رقم الطلب: #{{ $order->order_number }}</p>
        </div>

        <div class="track-body">
            @php
                $ticketStatus = $order->kitchenTicket?->status ?? 'queued';
                $allSteps = ['queued', 'received', 'preparing', 'ready', 'served'];
                $currentIdx = array_search($ticketStatus, $allSteps);
                $stepsData = [
                    'queued'    => ['icon' => '💳', 'title' => 'تم الدفع وبانتظار الإرسال', 'desc' => 'طلبك مسجل وتم تأكيد دفعه بنجاح.'],
                    'received'  => ['icon' => '📥', 'title' => 'وصل المطبخ', 'desc' => 'الشيف استلم تذكرتك.'],
                    'preparing' => ['icon' => '🔥', 'title' => 'جاري الطهي والتحضير', 'desc' => 'وجبتك الشهية على النار الآن.'],
                    'ready'     => ['icon' => '✅', 'title' => 'جاهز للاستلام', 'desc' => 'الوجبة جاهزة للتسليم فوراً!'],
                    'served'    => ['icon' => '🎉', 'title' => 'تم التسليم', 'desc' => 'نتمنى لك وجبة ممتعة!'],
                ];
            @endphp

            <div class="timeline">
                @foreach($allSteps as $idx => $step)
                    @php
                        $state = $idx < $currentIdx ? 'done' : ($idx === $currentIdx ? 'active' : '');
                    @endphp
                    <div class="step {{ $state }}">
                        <div class="step-dot">
                            @if($idx < $currentIdx)
                                ✓
                            @elseif($idx === $currentIdx)
                                {{ $stepsData[$step]['icon'] }}
                            @else
                                {{ $idx + 1 }}
                            @endif
                        </div>
                        <div class="step-content">
                            <div class="step-title">{{ $stepsData[$step]['title'] }}</div>
                            <div class="step-desc">{{ $stepsData[$step]['desc'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bill">
                <div class="bill-title">🧾 تفاصيل الفاتورة</div>
                @foreach($order->items as $it)
                    <div class="bill-item">
                        <span class="name">{{ $it->quantity }}x {{ $it->product->name }}</span>
                        <span class="amount">{{ number_format($it->total_price, 2) }} ج.م</span>
                    </div>
                @endforeach
                <div class="bill-total">
                    <span>الإجمالي المدفوع:</span>
                    <span>{{ number_format($order->total_amount, 2) }} ج.م</span>
                </div>
            </div>

            <div class="track-actions">
                <a href="{{ route('store.index') }}" class="btn-back">🍽️ العودة لقائمة الطعام</a>
                <button onclick="window.location.reload()" class="btn-refresh">↻ تحديث</button>
            </div>
        </div>
    </div>
</body>
</html>

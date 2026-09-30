<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="شاشة المطبخ الذكية KDS — نظام متطور ومريح للعين لإدارة وتتبع مراحل إعداد الوجبات في الوقت الفعلي.">
    <title>شاشة المطبخ الذكية | KDS Live</title>
    
    <!-- Google Fonts: Cairo & Tajawal for modern, crystal-clear Arabic typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        /* ========================================================
           DEFAULT THEME: MODERN SLATE TITANIUM (Glare-Free, Soft on Eyes)
           ======================================================== */
        :root {
            --bg-canvas: #13161C;
            --bg-nav: rgba(19, 22, 28, 0.96);
            --bg-subnav: #0F1116;
            
            --surface-column: #1A1E26;
            --surface-card: #232834;
            --surface-card-hover: #292F3D;
            --surface-inner: #191D26;
            --surface-active: #2F3647;
            --surface-header: rgba(26, 30, 38, 0.98);

            --border-subtle: #292F3E;
            --border-card: #353D50;
            --border-light: #48536C;
            --border-inner: #29303F;

            --text-primary: #F8FAFC;
            --text-secondary: #CBD5E1;
            --text-muted: #94A3B8;
            --text-faint: #64748B;

            --badge-table-bg: rgba(217, 119, 6, 0.16);
            --badge-table-border: rgba(217, 119, 6, 0.4);
            --badge-table-text: #FDE68A;

            --note-bg: rgba(217, 119, 6, 0.12);
            --note-border: rgba(217, 119, 6, 0.35);
            --note-text: #FDE68A;

            --inst-bg: rgba(217, 119, 6, 0.18);
            --inst-border: rgba(217, 119, 6, 0.4);
            --inst-text: #FDE68A;

            --burnt-orange: #EA580C;
            --burnt-orange-bright: #F97316;
            --burnt-orange-glow: rgba(234, 88, 12, 0.28);
            
            --gold: #D97706;
            --gold-bright: #F59E0B;
            --gold-glow: rgba(217, 119, 6, 0.25);

            --emerald: #10B981;
            --emerald-glow: rgba(16, 185, 129, 0.24);

            --shadow-card: 0 8px 24px rgba(0, 0, 0, 0.35);
            --shadow-hover: 0 12px 30px rgba(0, 0, 0, 0.45);

            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-pill: 9999px;

            --font-display: 'Tajawal', sans-serif;
            --font-body: 'Cairo', sans-serif;
        }

        /* ========================================================
           LIGHT / DAYLIGHT KITCHEN THEME (Maximum Contrast & Ultra-Clear Text)
           ======================================================== */
        body.theme-light {
            --bg-canvas: #EDF2F7;
            --bg-nav: #FFFFFF;
            --bg-subnav: #E2E8F0;
            
            --surface-column: #E2E8F0;
            --surface-card: #FFFFFF;
            --surface-card-hover: #F8FAFC;
            --surface-inner: #F1F5F9;
            --surface-active: #CBD5E1;
            --surface-header: #FFFFFF;

            --border-subtle: #CBD5E1;
            --border-card: #CBD5E1;
            --border-light: #94A3B8;
            --border-inner: #CBD5E1;

            --text-primary: #0F172A;
            --text-secondary: #0F172A;
            --text-muted: #334155;
            --text-faint: #475569;

            --badge-table-bg: #FEF3C7;
            --badge-table-border: #D97706;
            --badge-table-text: #78350F;

            --note-bg: #FFFBEB;
            --note-border: #F59E0B;
            --note-text: #78350F;

            --inst-bg: #FEF3C7;
            --inst-border: #D97706;
            --inst-text: #78350F;

            --shadow-card: 0 4px 16px rgba(15, 23, 42, 0.08);
            --shadow-hover: 0 8px 24px rgba(15, 23, 42, 0.14);
        }

        /* ====== DAYLIGHT MODE ULTRA-SHARP READABILITY OVERRIDES ====== */
        body.theme-light .kds-nav {
            background: #FFFFFF !important;
            border-bottom: 2px solid #CBD5E1 !important;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
        }

        body.theme-light .kds-main-title {
            color: #0F172A !important;
        }

        body.theme-light .kds-sub-title {
            color: #475569 !important;
            font-weight: 700;
        }

        body.theme-light .kds-stat-pill {
            background: #FFFFFF !important;
            border: 1.5px solid #CBD5E1 !important;
            color: #0F172A !important;
        }

        body.theme-light .kds-stat-pill .st-name {
            color: #334155 !important;
            font-weight: 700;
        }

        body.theme-light .kds-stat-pill .st-count {
            background: #F1F5F9 !important;
            color: #64748B !important;
            font-weight: 800;
            border: 1px solid #E2E8F0 !important;
        }

        body.theme-light .kds-stat-pill.has-orders {
            border-color: #CBD5E1 !important;
            background: #FFFFFF !important;
        }

        body.theme-light .kds-stat-pill.has-orders .st-count {
            background: #0F172A !important;
            color: #FFFFFF !important;
            border: none !important;
        }

        body.theme-light .kds-clock-box {
            background: #FFFFFF !important;
            border: 1px solid #CBD5E1 !important;
            color: #0F172A !important;
            font-weight: 800;
        }

        body.theme-light .kds-btn {
            background: #FFFFFF !important;
            border: 1px solid #CBD5E1 !important;
            color: #0F172A !important;
            font-weight: 700;
            border-radius: 8px !important;
        }

        body.theme-light .kds-btn:hover {
            background: #F1F5F9 !important;
            border-color: #94A3B8 !important;
            color: #0F172A !important;
        }

        body.theme-light .kds-btn.primary {
            background: #0F172A !important;
            border: 1px solid #1E293B !important;
            color: #FFFFFF !important;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.15) !important;
        }

        body.theme-light .kds-btn.primary:hover {
            background: #1E293B !important;
        }

        body.theme-light .kds-btn.theme-toggle {
            background: #F1F5F9 !important;
            color: #0F172A !important;
            border: 1px solid #CBD5E1 !important;
            font-weight: 700;
        }

        body.theme-light .kds-subnav {
            background: #E2E8F0 !important;
            border-bottom: 2px solid #CBD5E1 !important;
        }

        body.theme-light .kds-filter-label {
            color: #0F172A !important;
            font-weight: 900;
            font-size: 0.82rem;
        }

        body.theme-light .kds-filter-btn {
            background: #FFFFFF !important;
            border: 1.5px solid #CBD5E1 !important;
            color: #1E293B !important;
            font-weight: 800;
            font-size: 0.78rem;
        }

        body.theme-light .kds-filter-btn:hover {
            border-color: #0F172A !important;
            color: #0F172A !important;
        }

        body.theme-light .kds-filter-btn.active {
            background: #0F172A !important;
            border-color: #0F172A !important;
            color: #FFFFFF !important;
            font-weight: 900;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.25);
        }

        body.theme-light .kds-scroll-helper {
            color: #0F172A !important;
            font-weight: 900;
            font-size: 0.82rem;
        }

        body.theme-light .kds-nav-arrow {
            background: #FFFFFF !important;
            border: 1.5px solid #CBD5E1 !important;
            color: #0F172A !important;
            font-weight: 900;
        }

        body.theme-light .kds-column {
            background: #E2E8F0 !important;
            border: 1.5px solid #CBD5E1 !important;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06);
        }

        body.theme-light .kds-col-header {
            background: #FFFFFF !important;
            border-bottom: 2px solid #E2E8F0 !important;
        }

        body.theme-light .kds-col-title {
            color: #0F172A !important;
            font-weight: 900;
            font-size: 1.18rem;
        }

        body.theme-light .kds-col-sub {
            color: #475569 !important;
            font-weight: 800;
            font-size: 0.78rem;
        }

        body.theme-light .kds-col-badge {
            background: #F1F5F9 !important;
            border: 1.5px solid #CBD5E1 !important;
        }

        body.theme-light .kds-col-count {
            color: #0F172A !important;
            font-weight: 900;
            font-size: 0.95rem;
        }

        body.theme-light .kds-card {
            background: #FFFFFF !important;
            border: 1.5px solid #CBD5E1 !important;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08);
        }

        body.theme-light .kds-card:hover {
            border-color: #94A3B8 !important;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.12);
        }

        body.theme-light .kds-order-num {
            color: #0F172A !important;
            font-weight: 900;
            font-size: 1.4rem;
        }

        body.theme-light .kds-badge {
            background: #F1F5F9;
            border: 1.5px solid #CBD5E1;
            color: #0F172A;
            font-weight: 800;
        }

        body.theme-light .kds-badge-table {
            background: #FEF3C7 !important;
            border: 1.5px solid #D97706 !important;
            color: #78350F !important;
            font-weight: 900 !important;
            font-size: 0.8rem;
        }

        body.theme-light .kds-timer-pill {
            background: #F1F5F9 !important;
            border: 1.5px solid #94A3B8 !important;
            color: #0F172A !important;
            font-weight: 900;
        }

        body.theme-light .kds-timer-pill.is-urgent {
            background: #FEE2E2 !important;
            border: 1.5px solid #DC2626 !important;
            color: #991B1B !important;
            font-weight: 900 !important;
        }

        body.theme-light .kds-customer-name {
            color: #0F172A !important;
            font-weight: 900;
            font-size: 0.88rem;
        }

        body.theme-light .cust-phone {
            color: #334155 !important;
            font-weight: 800;
            font-size: 0.8rem;
        }

        body.theme-light .kds-order-note {
            background: #FFFBEB !important;
            border: 1.5px solid #F59E0B !important;
            color: #78350F !important;
            font-weight: 900 !important;
            font-size: 0.82rem !important;
            line-height: 1.4;
            box-shadow: 0 1px 3px rgba(217, 119, 6, 0.08);
        }

        body.theme-light .kds-card-items-wrap {
            background: #F8FAFC !important;
            border: 1.5px solid #CBD5E1 !important;
        }

        body.theme-light .kds-items-header {
            border-bottom: 1.5px solid #E2E8F0 !important;
            color: #334155 !important;
            font-weight: 900;
        }

        body.theme-light .kds-items-label {
            color: #1E293B !important;
            font-weight: 900;
            font-size: 0.82rem;
        }

        body.theme-light .kds-items-total-qty {
            color: #0F172A !important;
            font-weight: 900;
        }

        body.theme-light .kds-item-qty {
            background: #0F172A !important;
            color: #FFFFFF !important;
            border: 1px solid #0F172A !important;
            font-weight: 900;
            font-size: 0.85rem;
        }

        body.theme-light .kds-item-name {
            color: #0F172A !important;
            font-weight: 900;
            font-size: 0.96rem;
        }

        body.theme-light .kds-item-inst {
            background: #FEF3C7 !important;
            border: 1px solid #D97706 !important;
            color: #78350F !important;
            font-weight: 800 !important;
            font-size: 0.72rem !important;
            border-radius: 6px !important;
            padding: 2px 7px !important;
        }

        body.theme-light .kds-btn-action {
            background: #0F172A !important;
            border: 1px solid #1E293B !important;
            color: #FFFFFF !important;
            font-weight: 800 !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.12) !important;
            text-shadow: none !important;
        }

        body.theme-light .kds-btn-action * {
            color: #FFFFFF !important;
            font-weight: 800 !important;
        }

        body.theme-light .kds-btn-action:hover {
            background: #1E293B !important;
            border-color: #334155 !important;
            box-shadow: 0 3px 8px rgba(15, 23, 42, 0.2) !important;
        }

        body.theme-light .kds-btn-complete {
            background: #334155 !important;
            border: 1px solid #1E293B !important;
            color: #FFFFFF !important;
        }

        body.theme-light .kds-btn-more {
            background: #F1F5F9 !important;
            border: 1px solid #CBD5E1 !important;
            color: #334155 !important;
            border-radius: 8px !important;
        }

        body.theme-light .kds-btn-more:hover {
            background: #E2E8F0 !important;
            border-color: #94A3B8 !important;
            color: #0F172A !important;
        }

        body.theme-light .kds-dropdown-menu {
            background: #FFFFFF !important;
            border: 1.5px solid #CBD5E1 !important;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
        }

        body.theme-light .kds-dropdown-title {
            color: #475569 !important;
            font-weight: 800;
            border-bottom: 1.5px solid #E2E8F0 !important;
        }

        body.theme-light .kds-dropdown-item {
            color: #0F172A !important;
            font-weight: 800;
        }

        body.theme-light .kds-dropdown-item:hover {
            background: #F1F5F9 !important;
            color: #EA580C !important;
        }

        body.theme-light .kds-empty-title {
            color: #0F172A !important;
            font-weight: 900;
            font-size: 1.05rem;
        }

        body.theme-light .kds-empty-sub {
            color: #475569 !important;
            font-weight: 700;
            font-size: 0.85rem;
        }

        body.theme-light .kds-empty-icon {
            opacity: 0.75;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            background: var(--bg-canvas);
            color: var(--text-primary);
            font-family: var(--font-body);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            user-select: none;
            transition: background 0.25s ease, color 0.25s ease;
        }

        ::selection {
            background: var(--burnt-orange);
            color: #ffffff;
        }

        /* ====== TOP NAVIGATION ====== */
        .kds-nav {
            position: sticky;
            top: 0;
            z-index: 100;
            height: 74px;
            background: var(--bg-nav);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .kds-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
        }

        .kds-logo-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--burnt-orange), #C2410C);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 14px var(--burnt-orange-glow);
        }

        .kds-titles {
            display: flex;
            flex-direction: column;
        }

        .kds-main-title {
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 900;
            letter-spacing: -0.01em;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .kds-main-title em {
            font-style: normal;
            color: var(--burnt-orange);
        }

        .kds-live-indicator {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: var(--emerald);
            padding: 2px 9px;
            border-radius: var(--radius-pill);
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.05em;
        }

        .kds-live-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--emerald);
            box-shadow: 0 0 6px var(--emerald);
            animation: livePulse 2s ease infinite;
        }

        @keyframes livePulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.3); opacity: 0.5; }
        }

        .kds-sub-title {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 1px;
            font-weight: 700;
        }

        /* Center Dynamic Stats Bar */
        .kds-stats-scroller {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            overflow-x: auto;
            scrollbar-width: none;
            padding: 0 10px;
        }
        .kds-stats-scroller::-webkit-scrollbar { display: none; }

        .kds-stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--surface-inner);
            border: 1px solid var(--border-subtle);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.74rem;
            font-weight: 700;
            color: var(--text-secondary);
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .kds-stat-pill:hover {
            border-color: var(--border-light);
            background: var(--surface-card);
        }

        .kds-stat-pill .st-icon {
            font-size: 0.8rem;
        }

        .kds-stat-pill .st-name {
            color: var(--text-secondary);
            font-weight: 700;
        }

        .kds-stat-pill .st-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            border-radius: 10px;
            font-size: 0.72rem;
            font-weight: 800;
            background: rgba(128, 128, 128, 0.15);
            color: var(--text-muted);
        }

        .kds-stat-pill.has-orders .st-count {
            background: var(--surface-active);
            color: var(--text-primary);
            border: 1px solid var(--border-light);
            box-shadow: none;
        }

        /* Controls Section */
        .kds-nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .kds-clock-box {
            background: var(--surface-inner);
            border: 1px solid var(--border-subtle);
            padding: 6px 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-primary);
            font-variant-numeric: tabular-nums;
        }

        .kds-clock-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold-bright);
        }

        .kds-btn {
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid var(--border-subtle);
            background: var(--surface-inner);
            color: var(--text-primary);
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.18s ease;
        }

        .kds-btn:hover {
            background: var(--surface-card);
            color: var(--text-primary);
            border-color: var(--border-light);
            transform: translateY(-1px);
        }

        .kds-btn.primary {
            background: #252B38;
            border: 1px solid #3A455A;
            color: #ffffff !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .kds-btn.primary:hover {
            background: #2E3747;
            border-color: #55627D;
        }

        .kds-btn.theme-toggle {
            background: var(--surface-inner);
            border: 1px solid var(--border-subtle);
            color: var(--text-primary);
            font-weight: 700;
        }

        .kds-btn.icon-only {
            width: 38px;
            height: 38px;
            padding: 0;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .is-spinning {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* ====== SUBNAV: FILTERS & HORIZONTAL SCROLL CONTROLS ====== */
        .kds-subnav {
            background: var(--bg-subnav);
            border-bottom: 1px solid var(--border-subtle);
            padding: 8px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            font-size: 0.76rem;
        }

        .kds-filters {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .kds-filter-label {
            color: var(--text-muted);
            font-weight: 800;
            margin-left: 4px;
        }

        .kds-filter-btn {
            background: var(--surface-inner);
            border: 1px solid var(--border-subtle);
            color: var(--text-secondary);
            padding: 5px 12px;
            border-radius: var(--radius-pill);
            cursor: pointer;
            font-family: var(--font-body);
            font-size: 0.74rem;
            font-weight: 700;
            transition: all 0.2s;
        }

        .kds-filter-btn:hover {
            color: var(--text-primary);
            border-color: var(--border-light);
        }

        .kds-filter-btn.active {
            background: var(--burnt-orange) !important;
            color: #FFFFFF !important;
            border-color: var(--burnt-orange);
            font-weight: 900;
            box-shadow: 0 2px 8px var(--burnt-orange-glow);
        }

        .kds-scroll-helper {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 0.74rem;
            font-weight: 700;
        }

        .kds-nav-arrow {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--surface-inner);
            border: 1px solid var(--border-subtle);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .kds-nav-arrow:hover {
            background: var(--surface-card);
            color: var(--text-primary);
            border-color: var(--border-light);
        }

        /* ====== WORKFLOW BOARD (HORIZONTAL WORKFLOW) ====== */
        .kds-board-container {
            position: relative;
            min-height: calc(100vh - 120px);
            background: var(--bg-canvas);
        }

        .kds-board {
            display: flex;
            flex-direction: row;
            gap: 20px;
            padding: 20px 24px 36px;
            min-height: calc(100vh - 120px);
            overflow-x: auto;
            overflow-y: hidden;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .kds-board::-webkit-scrollbar {
            height: 8px;
        }
        .kds-board::-webkit-scrollbar-track {
            background: var(--bg-canvas);
            border-radius: var(--radius-pill);
            margin: 0 24px;
        }
        .kds-board::-webkit-scrollbar-thumb {
            background: var(--border-card);
            border-radius: var(--radius-pill);
        }
        .kds-board::-webkit-scrollbar-thumb:hover {
            background: var(--burnt-orange);
        }

        /* ====== STATUS COLUMN COMPONENT ====== */
        .kds-column {
            flex: 1 1 360px;
            min-width: 350px;
            max-width: 440px;
            background: var(--surface-column);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-lg);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: var(--shadow-card);
            transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
        }

        .kds-board.few-cols .kds-column {
            flex: 1 1 0px;
            max-width: none;
        }

        .kds-column:hover {
            border-color: var(--border-light);
            box-shadow: var(--shadow-hover);
        }

        /* Column Header */
        .kds-col-header {
            padding: 16px 18px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface-header);
            border-bottom: 1px solid var(--border-subtle);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .kds-col-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .kds-col-icon {
            font-size: 1.3rem;
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-subtle);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kds-col-text {
            display: flex;
            flex-direction: column;
        }

        .kds-col-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 900;
            color: var(--text-primary);
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .kds-col-sub {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 700;
            margin-top: 2px;
        }

        .kds-col-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            padding: 4px 12px;
            border-radius: var(--radius-pill);
        }

        .kds-col-pulse {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .kds-col-count {
            font-size: 0.88rem;
            font-weight: 900;
            color: var(--text-primary);
            font-variant-numeric: tabular-nums;
        }

        .kds-col-line {
            height: 3px;
            width: 100%;
        }

        /* Tickets List Inside Column */
        .kds-tickets-list {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
            max-height: calc(100vh - 220px);
        }

        .kds-tickets-list::-webkit-scrollbar {
            width: 6px;
        }
        .kds-tickets-list::-webkit-scrollbar-track {
            background: transparent;
        }
        .kds-tickets-list::-webkit-scrollbar-thumb {
            background: var(--border-subtle);
            border-radius: var(--radius-pill);
        }
        .kds-tickets-list::-webkit-scrollbar-thumb:hover {
            background: var(--border-light);
        }

        /* ====== TICKET CARD ====== */
        /* CRITICAL: flex-shrink: 0 ensures cards NEVER get squashed in multi-ticket columns */
        .kds-card {
            flex-shrink: 0;
            width: 100%;
            background: var(--surface-card);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            position: relative;
            transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease, opacity 0.3s ease, background 0.2s ease;
        }

        .kds-card:hover {
            transform: translateY(-2px);
            border-color: var(--border-light);
            box-shadow: var(--shadow-hover);
            background: var(--surface-card-hover);
        }

        .kds-card-accent-bar {
            height: 4px;
            width: 100%;
        }

        .kds-card-inner {
            padding: 16px;
        }

        /* Card Header */
        .kds-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 12px;
        }

        .kds-card-id-block {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .kds-order-num {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .kds-order-badges {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .kds-badge {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            border: 1px solid var(--border-subtle);
            background: var(--surface-inner);
            color: var(--text-secondary);
        }

        .kds-type-dine_in {
            background: rgba(59, 130, 246, 0.12);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #93C5FD;
        }

        .kds-type-takeaway {
            background: rgba(245, 158, 11, 0.12);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #FCD34D;
        }

        .kds-type-delivery {
            background: rgba(168, 85, 247, 0.12);
            border: 1px solid rgba(168, 85, 247, 0.3);
            color: #D8B4FE;
        }

        body.theme-light .kds-type-dine_in {
            background: #EFF6FF !important;
            border: 1px solid #BFDBFE !important;
            color: #1D4ED8 !important;
            font-weight: 800 !important;
        }

        body.theme-light .kds-type-takeaway {
            background: #FFFBEB !important;
            border: 1px solid #FDE68A !important;
            color: #92400E !important;
            font-weight: 800 !important;
        }

        body.theme-light .kds-type-delivery {
            background: #FAF5FF !important;
            border: 1px solid #E9D5FF !important;
            color: #7E22CE !important;
            font-weight: 800 !important;
        }

        .kds-badge-table {
            color: var(--badge-table-text) !important;
            border: 1px solid var(--badge-table-border) !important;
            background: var(--badge-table-bg) !important;
            font-weight: 800;
            border-radius: 6px;
            padding: 2px 8px;
            max-width: 180px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Timer Pill */
        .kds-timer-pill {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 3px 8px;
            border-radius: 6px;
            background: var(--surface-inner);
            border: 1px solid var(--border-subtle);
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--gold-bright);
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        body.theme-light .kds-timer-pill {
            background: #F1F5F9;
            border-color: #CBD5E1;
            color: #0F172A;
            font-weight: 900;
        }

        .kds-timer-pill.is-urgent {
            background: rgba(239, 68, 68, 0.15) !important;
            border-color: rgba(239, 68, 68, 0.45) !important;
            color: #EF4444 !important;
            animation: urgentPulse 1.4s ease infinite;
        }

        @keyframes urgentPulse {
            0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            50% { transform: scale(1.04); box-shadow: 0 0 8px rgba(239, 68, 68, 0.3); }
        }

        /* Customer & Notes */
        .kds-card-customer {
            margin-bottom: 12px;
            font-size: 0.78rem;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .kds-customer-name {
            color: var(--text-secondary);
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .cust-phone {
            color: var(--text-muted);
            font-size: 0.74rem;
            font-family: monospace;
            font-weight: 700;
        }

        .kds-order-note {
            color: var(--note-text) !important;
            background: var(--note-bg) !important;
            border: 1px solid var(--note-border) !important;
            padding: 6px 10px;
            border-radius: var(--radius-sm);
            font-size: 0.76rem;
            font-weight: 800;
            line-height: 1.4;
        }

        /* Items List Box (Always clearly demarcated and readable) */
        .kds-card-items-wrap {
            background: var(--surface-inner);
            border: 1px solid var(--border-inner);
            border-radius: var(--radius-md);
            padding: 10px 12px;
            margin-bottom: 14px;
        }

        .kds-items-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 6px;
            margin-bottom: 8px;
            border-bottom: 1px solid var(--border-inner);
            font-size: 0.74rem;
            color: var(--text-muted);
            font-weight: 800;
        }

        .kds-items-total-qty {
            color: var(--text-secondary);
            font-weight: 900;
        }

        .kds-items-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .kds-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            font-size: 0.9rem;
        }

        .kds-item-info {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        .kds-item-qty {
            min-width: 26px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--surface-active);
            border: 1px solid var(--border-card);
            border-radius: 6px;
            font-weight: 900;
            font-size: 0.82rem;
            color: var(--text-primary);
        }

        body.theme-light .kds-item-qty {
            background: #0F172A;
            color: #FFFFFF !important;
            border-color: #0F172A;
        }

        .kds-item-name {
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.3;
        }

        .kds-item-inst {
            font-size: 0.72rem;
            font-weight: 700;
            background: var(--inst-bg) !important;
            color: var(--inst-text) !important;
            border: 1px solid var(--inst-border) !important;
            padding: 2px 7px;
            border-radius: 6px;
            max-width: 140px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Card Footer & Action Buttons */
        .kds-card-footer {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* UNIFIED EXECUTIVE ACTION BUTTON: SLEEK, MODERN, BALANCED, ZERO CLOWN COLORS */
        .kds-btn-action {
            flex: 1;
            height: 38px;
            padding: 0 14px;
            border-radius: 8px;
            border: 1px solid #353E52;
            background: #252B38 !important;
            color: #F8FAFC !important;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            text-shadow: none;
            transition: all 0.18s ease;
        }

        .kds-btn-action * {
            color: #F8FAFC !important;
            font-weight: 800 !important;
        }

        .kds-btn-action:hover {
            background: #2D3546 !important;
            border-color: #55627D !important;
            color: #FFFFFF !important;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
        }

        .kds-btn-action:active {
            transform: scale(0.98);
        }

        .kds-btn-action:disabled {
            opacity: 0.45;
            cursor: not-allowed;
            transform: none !important;
        }

        .kds-btn-complete {
            background: #1E2430 !important;
            border: 1px solid #333D50 !important;
            color: #F8FAFC !important;
            box-shadow: none;
        }

        .kds-btn-complete:hover {
            background: #293242 !important;
            border-color: #4A566E !important;
        }

        .kds-btn-more {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: var(--surface-inner);
            border: 1px solid var(--border-subtle);
            color: var(--text-muted);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.18s;
            flex-shrink: 0;
        }

        .kds-btn-more:hover {
            color: var(--text-primary);
            border-color: var(--border-light);
            background: var(--surface-active);
        }

        /* Dropdown Menu */
        .kds-dropdown-wrap {
            position: relative;
        }

        .kds-dropdown-menu {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 0;
            z-index: 50;
            min-width: 180px;
            background: var(--surface-card);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-md);
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            padding: 6px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .kds-dropdown-title {
            padding: 6px 10px;
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-subtle);
            margin-bottom: 4px;
        }

        .kds-dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: var(--radius-sm);
            border: none;
            background: transparent;
            color: var(--text-primary);
            font-family: var(--font-body);
            font-size: 0.76rem;
            font-weight: 700;
            cursor: pointer;
            text-align: right;
            width: 100%;
            transition: background 0.15s, color 0.15s;
        }

        .kds-dropdown-item:hover {
            background: var(--surface-inner);
            color: var(--burnt-orange);
        }

        /* Empty State */
        .kds-col-empty {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
            text-align: center;
        }

        .kds-empty-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            max-width: 220px;
        }

        .kds-empty-icon {
            font-size: 2.8rem;
            opacity: 0.45;
            margin-bottom: 4px;
        }

        .kds-empty-title {
            font-size: 0.95rem;
            font-weight: 900;
            color: var(--text-primary);
        }

        .kds-empty-sub {
            font-size: 0.74rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* ====== ORDER MOVEMENT ANIMATIONS ====== */
        .kds-card-moving-out {
            transform: scale(0.95) translateX(-20px);
            opacity: 0.25;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
        }

        .kds-card-just-arrived {
            animation: cardArrival 0.75s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes cardArrival {
            0% {
                opacity: 0;
                transform: translateY(-16px) scale(0.96);
                box-shadow: 0 0 24px var(--burnt-orange-bright);
            }
            50% {
                opacity: 1;
                transform: translateY(2px) scale(1.02);
                box-shadow: 0 0 16px var(--gold-bright);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
                box-shadow: var(--shadow-card);
            }
        }

        /* ====== ADVANCED RESPONSIVE DESIGN (MOBILE, TABLET, DESKTOP) ====== */
        .kds-mobile-stage-nav {
            display: none;
        }

        @media (max-width: 1024px) {
            .kds-nav {
                height: 64px;
                padding: 0 16px;
            }
            .kds-sub-title {
                display: none;
            }
            .kds-stats-scroller {
                display: none;
            }
            .kds-subnav {
                padding: 8px 16px;
            }
            .kds-board {
                padding: 16px;
                gap: 14px;
            }
            .kds-column {
                min-width: 300px;
                max-width: 340px;
            }
        }

        @media (max-width: 768px) {
            .kds-nav {
                height: 56px;
                padding: 0 12px;
                gap: 8px;
            }
            .kds-logo-wrap {
                width: 34px;
                height: 34px;
                font-size: 16px;
                border-radius: 8px;
            }
            .kds-main-title {
                font-size: 0.95rem;
            }
            .kds-live-indicator {
                display: none;
            }
            .kds-clock-box {
                display: none;
            }
            .kds-nav-actions {
                gap: 4px;
            }
            .kds-btn {
                height: 34px;
                padding: 0 8px;
                font-size: 0.74rem;
                border-radius: 6px;
            }
            .kds-btn .btn-text {
                display: none; /* Hide button text labels on mobile to prevent overflow */
            }
            .kds-btn.icon-only {
                width: 34px;
                height: 34px;
            }

            /* Mobile Subnav Filters */
            .kds-subnav {
                padding: 6px 12px;
                overflow-x: auto;
                white-space: nowrap;
                flex-wrap: nowrap;
                scrollbar-width: none;
            }
            .kds-subnav::-webkit-scrollbar { display: none; }
            .kds-scroll-helper {
                display: none; /* Desktop scroll arrows not needed on touch */
            }
            .kds-filters {
                display: flex;
                gap: 6px;
                flex-shrink: 0;
            }
            .kds-filter-label {
                display: none;
            }
            .kds-filter-btn {
                padding: 5px 10px;
                font-size: 0.72rem;
                border-radius: 6px;
                flex-shrink: 0;
            }

            /* Mobile Stage Quick-Navigation Tabs */
            .kds-mobile-stage-nav {
                display: flex;
                align-items: center;
                gap: 6px;
                padding: 6px 12px;
                background: var(--bg-subnav);
                border-bottom: 1px solid var(--border-subtle);
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }
            .kds-mobile-stage-nav::-webkit-scrollbar { display: none; }

            .kds-mobile-stage-tab {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                padding: 5px 10px;
                border-radius: 6px;
                border: 1px solid var(--border-subtle);
                background: var(--surface-inner);
                color: var(--text-secondary);
                font-family: var(--font-body);
                font-size: 0.72rem;
                font-weight: 700;
                cursor: pointer;
                flex-shrink: 0;
                transition: all 0.15s;
            }

            .kds-mobile-stage-tab.active {
                background: #0F172A;
                color: #FFFFFF;
                border-color: #0F172A;
            }

            body:not(.theme-light) .kds-mobile-stage-tab.active {
                background: #3B4459;
                color: #FFFFFF;
                border-color: #4F5B75;
            }

            .kds-stage-count {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 17px;
                height: 17px;
                padding: 0 4px;
                border-radius: 5px;
                font-size: 0.68rem;
                font-weight: 800;
                background: rgba(128, 128, 128, 0.2);
                color: inherit;
            }

            /* Mobile Board & Columns: Clean Swipe Snapping */
            .kds-board-container {
                min-height: calc(100vh - 150px);
            }
            .kds-board {
                padding: 10px 12px 24px;
                gap: 12px;
                min-height: calc(100vh - 150px);
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
            }
            .kds-column {
                min-width: calc(100vw - 24px);
                max-width: calc(100vw - 24px);
                scroll-snap-align: center;
                scroll-snap-stop: always;
                border-radius: 12px;
            }
            .kds-tickets-list {
                max-height: calc(100vh - 250px);
                padding: 12px;
                gap: 12px;
            }
            .kds-col-header {
                padding: 12px 14px;
            }
            .kds-col-title {
                font-size: 1.05rem;
            }
            .kds-card {
                border-radius: 10px;
            }
            .kds-card-inner {
                padding: 12px;
            }
            .kds-order-num {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body x-data="kitchenApp()" x-init="startLiveSync()" :class="{ 'theme-light': theme === 'light' }">

    <!-- Audio chime when new order arrives in kitchen -->
    <audio id="bellAudio" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

    <!-- ====== TOP NAVIGATION ====== -->
    <nav class="kds-nav">
        <!-- Brand & Live Indicator -->
        <div class="kds-brand">
            <div class="kds-logo-wrap">👨‍🍳</div>
            <div class="kds-titles">
                <div class="kds-main-title">
                    شاشة المطبخ <em>الذكية</em>
                    <span class="kds-live-indicator">
                        <span class="kds-live-dot"></span> مباشر
                    </span>
                </div>
                <div class="kds-sub-title">إدارة مراحل إعداد الوجبات بتصميم مريح وعالي الوضوح</div>
            </div>
        </div>

        <!-- Center: Dynamic Status Stats Counters -->
        <div class="kds-stats-scroller">
            <template x-for="st in statuses" :key="st.key">
                <div class="kds-stat-pill" 
                     :class="{ 'has-orders': ticketsByStatus(st.key).length > 0 }"
                     :style="'--pill-accent: ' + st.color">
                    <span class="st-icon" x-text="st.icon"></span>
                    <span class="st-name" x-text="st.short_name"></span>
                    <span class="st-count" x-text="ticketsByStatus(st.key).length">0</span>
                </div>
            </template>
        </div>

        <!-- Right: Actions & Controls -->
        <div class="kds-nav-actions">
            <!-- Digital Clock -->
            <div class="kds-clock-box">
                <span class="kds-clock-dot"></span>
                <span x-text="currentTime">--:--:--</span>
            </div>

            <!-- Eye-Friendly Theme Toggle (Dark Slate vs Crisp Daylight Mode) -->
            <button type="button" 
                    @click="toggleTheme()" 
                    class="kds-btn theme-toggle" 
                    :title="theme === 'light' ? 'التبديل إلى الوضع الليلي المريح' : 'التبديل إلى وضع الإضاءة النهارية الفاتحة'">
                <span x-text="theme === 'light' ? '🌙' : '☀️'"></span>
                <span class="btn-text" x-text="theme === 'light' ? ' الوضع الليلي' : ' الوضع النهاري'"></span>
            </button>

            <!-- Sound Mute/Unmute Toggle -->
            <button type="button" 
                    @click="toggleSound()" 
                    class="kds-btn icon-only" 
                    :title="soundEnabled ? 'كتم التنبيهات الصوتية' : 'تفعيل التنبيهات الصوتية'">
                <span x-text="soundEnabled ? '🔔' : '🔕'"></span>
            </button>

            <!-- Fullscreen Button -->
            <button type="button" 
                    @click="toggleFullscreen()" 
                    class="kds-btn icon-only" 
                    title="ملء الشاشة">
                <span>⛶</span>
            </button>

            <!-- Link to Admin -->
            <a href="{{ route('admin.dashboard') }}" class="kds-btn">
                <span>📊</span>
                <span class="btn-text">الإدارة</span>
            </a>

            <!-- Manual Refresh -->
            <button type="button" 
                    @click="refreshData(true)" 
                    class="kds-btn primary">
                <span :class="{ 'is-spinning': isFetching }">↻</span>
                <span class="btn-text">تحديث</span>
            </button>
        </div>
    </nav>

    <!-- ====== SUBNAV: FILTERS & HORIZONTAL SCROLL CONTROLS ====== -->
    <div class="kds-subnav">
        <!-- Order Type Filters -->
        <div class="kds-filters">
            <span class="kds-filter-label">نوع الطلب:</span>
            <button type="button" 
                    class="kds-filter-btn" 
                    :class="{ 'active': filterType === 'all' }" 
                    @click="filterType = 'all'">
                الكل (<span x-text="tickets.length"></span>)
            </button>
            <button type="button" 
                    class="kds-filter-btn" 
                    :class="{ 'active': filterType === 'dine_in' }" 
                    @click="filterType = 'dine_in'">
                🏠 صالة (<span x-text="countByType('dine_in')"></span>)
            </button>
            <button type="button" 
                    class="kds-filter-btn" 
                    :class="{ 'active': filterType === 'takeaway' }" 
                    @click="filterType = 'takeaway'">
                🥡 سفري (<span x-text="countByType('takeaway')"></span>)
            </button>
            <button type="button" 
                    class="kds-filter-btn" 
                    :class="{ 'active': filterType === 'delivery' }" 
                    @click="filterType = 'delivery'">
                🚗 توصيل (<span x-text="countByType('delivery')"></span>)
            </button>
        </div>

        <!-- Scroll navigation helpers for wide boards with many columns -->
        <div class="kds-scroll-helper">
            <span x-text="'المراحل المتاحة: ' + statuses.length + ' أعمدة'"></span>
            <button type="button" @click="scrollBoard(-380)" class="kds-nav-arrow" title="تمرير لليمين">➔</button>
            <button type="button" @click="scrollBoard(380)" class="kds-nav-arrow" title="تمرير لليسار">←</button>
        </div>
    </div>

    <!-- Mobile Horizontal Stage Quick-Switcher (Only visible on mobile screens) -->
    <div class="kds-mobile-stage-nav">
        <template x-for="st in statuses" :key="st.key">
            <button type="button" 
                    class="kds-mobile-stage-tab" 
                    :class="{ 'active': activeMobileStage === st.key }"
                    @click="goToMobileStage(st.key)">
                <span x-text="st.icon"></span>
                <span x-text="st.short_name"></span>
                <span class="kds-stage-count" x-text="ticketsByStatus(st.key).length"></span>
            </button>
        </template>
    </div>

    <!-- ====== DYNAMIC KANBAN BOARD ====== -->
    <main class="kds-board-container">
        <div class="kds-board" 
             id="kdsBoard"
             :class="{ 'few-cols': statuses.length <= 3 }">
            
            <!-- Dynamic Columns Loop: One Reusable Column Component per Database Configured Status -->
            <template x-for="(status, colIndex) in statuses" :key="status.key">
                @include('kitchen.components.status-column')
            </template>

        </div>
    </main>

    <script>
        function kitchenApp() {
            return {
                statuses: @json($statuses),
                tickets: [],
                currentTime: '',
                isFetching: false,
                soundEnabled: true,
                theme: localStorage.getItem('kds_theme') || 'dark',
                filterType: 'all',
                activeMobileStage: 'queued',
                movingTicketId: null,
                arrivedTicketId: null,
                processingTickets: {},
                previousCountFirstStage: 0,

                goToMobileStage(key) {
                    this.activeMobileStage = key;
                    const col = document.getElementById('col-' + key);
                    if (col) {
                        col.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                    }
                },

                startLiveSync() {
                    if (this.statuses.length > 0) {
                        this.activeMobileStage = this.statuses[0].key;
                    }
                    this.updateClock();
                    this.fetchTickets();
                    setInterval(() => this.fetchTickets(), 3000);
                    setInterval(() => this.updateClock(), 1000);
                    setInterval(() => this.fetchStatuses(), 6000);
                },

                toggleTheme() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('kds_theme', this.theme);
                },

                updateClock() {
                    this.currentTime = new Date().toLocaleTimeString('ar-EG', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: true
                    });
                },

                async fetchStatuses() {
                    try {
                        const res = await fetch('{{ route("kitchen.api.statuses") }}');
                        if (res.ok) {
                            const newStatuses = await res.json();
                            if (JSON.stringify(newStatuses) !== JSON.stringify(this.statuses)) {
                                this.statuses = newStatuses;
                            }
                        }
                    } catch (err) {}
                },

                async fetchTickets() {
                    try {
                        this.isFetching = true;
                        const res = await fetch('{{ route("kitchen.api.tickets") }}');
                        if (!res.ok) throw new Error('API error');
                        const data = await res.json();
                        
                        if (this.statuses.length > 0) {
                            const firstStageKey = this.statuses[0].key;
                            const currentFirstStageCount = data.filter(t => t.status === firstStageKey).length;
                            
                            if (currentFirstStageCount > this.previousCountFirstStage && this.previousCountFirstStage !== 0) {
                                this.playChime();
                            }
                            this.previousCountFirstStage = currentFirstStageCount;
                        }

                        this.tickets = data;
                    } catch (err) {
                        console.error('KDS Ticket fetch error:', err);
                    } finally {
                        this.isFetching = false;
                    }
                },

                async refreshData(manual = false) {
                    await Promise.all([this.fetchStatuses(), this.fetchTickets()]);
                },

                playChime() {
                    if (this.soundEnabled) {
                        const audio = document.getElementById('bellAudio');
                        if (audio) {
                            audio.currentTime = 0;
                            audio.play().catch(() => {});
                        }
                    }
                },

                toggleSound() {
                    this.soundEnabled = !this.soundEnabled;
                },

                toggleFullscreen() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen().catch(() => {});
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen().catch(() => {});
                        }
                    }
                },

                scrollBoard(offset) {
                    const board = document.getElementById('kdsBoard');
                    if (board) {
                        board.scrollBy({ left: -offset, behavior: 'smooth' });
                    }
                },

                ticketsByStatus(statusKey) {
                    return this.tickets.filter(t => {
                        const matchesStatus = (t.status === statusKey);
                        if (!matchesStatus) return false;
                        if (this.filterType === 'all') return true;
                        return t.order?.order_type === this.filterType;
                    });
                },

                countByType(type) {
                    return this.tickets.filter(t => t.order?.order_type === type).length;
                },

                totalItemsCount(ticket) {
                    return (ticket.order?.items || []).reduce((acc, it) => acc + (parseInt(it.quantity) || 1), 0);
                },

                cleanTableInfo(val) {
                    if (!val) return '';
                    if (val.length > 20) {
                        const parts = val.split('-');
                        return '📍 ' + (parts[parts.length - 1] || parts[0]).trim();
                    }
                    return val.startsWith('طاولة') ? val : ('📍 ' + val);
                },

                getStatusName(statusKey) {
                    const found = this.statuses.find(s => s.key === statusKey);
                    return found ? found.name : statusKey;
                },

                fmtType(t) {
                    const map = {
                        'dine_in': '🏠 صالة',
                        'takeaway': '🥡 سفري',
                        'delivery': '🚗 توصيل'
                    };
                    return map[t] || t || 'طلب';
                },

                calcTimeAgo(dateStr) {
                    if (!dateStr) return 'الآن';
                    const diffMs = Date.now() - new Date(dateStr).getTime();
                    const minutes = Math.floor(diffMs / 60000);
                    if (minutes <= 0) return 'الآن';
                    if (minutes < 60) return minutes + ' د';
                    const hours = Math.floor(minutes / 60);
                    const remMin = minutes % 60;
                    return hours + ' س ' + (remMin > 0 ? remMin + ' د' : '');
                },

                isUrgent(ticket) {
                    if (ticket.status !== 'preparing') return false;
                    const baseDate = ticket.started_at || ticket.dispatched_at;
                    if (!baseDate) return false;
                    const minutes = Math.floor((Date.now() - new Date(baseDate).getTime()) / 60000);
                    const threshold = ticket.estimated_prep_minutes || 15;
                    return minutes >= threshold;
                },

                isProcessing(ticketId) {
                    return !!this.processingTickets[ticketId];
                },

                async advanceStatus(ticket, nextStatusKey) {
                    if (!nextStatusKey || this.isProcessing(ticket.id)) return;

                    this.processingTickets[ticket.id] = true;
                    this.movingTicketId = ticket.id;

                    await new Promise(r => setTimeout(r, 200));

                    try {
                        const res = await fetch(`/kitchen/api/tickets/${ticket.id}/status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status: nextStatusKey })
                        });

                        if (!res.ok) throw new Error('Status update failed');
                        const data = await res.json();
                        
                        const idx = this.tickets.findIndex(t => t.id === ticket.id);
                        if (idx !== -1) {
                            if (data.ticket) {
                                this.tickets[idx] = data.ticket;
                            } else {
                                this.tickets[idx].status = nextStatusKey;
                            }
                        }

                        this.arrivedTicketId = ticket.id;
                        setTimeout(() => {
                            if (this.arrivedTicketId === ticket.id) {
                                this.arrivedTicketId = null;
                            }
                        }, 800);

                    } catch (err) {
                        console.error('Error changing ticket status:', err);
                        alert('تعذر تحديث حالة التذكرة، يرجى المحاولة مرة أخرى.');
                        await this.fetchTickets();
                    } finally {
                        this.movingTicketId = null;
                        this.processingTickets[ticket.id] = false;
                    }
                },

                async completeTicket(ticket) {
                    if (this.isProcessing(ticket.id)) return;
                    if (!confirm(`هل أنت متأكد من إنهاء وإكمال الطلب #${ticket.order?.order_number || ticket.id}؟`)) return;

                    const servedStatus = this.statuses.find(s => s.key === 'served')?.key || 'served';
                    await this.advanceStatus(ticket, servedStatus);
                }
            };
        }
    </script>
</body>
</html>

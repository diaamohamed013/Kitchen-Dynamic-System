<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="مطعم وجبتك الذكية — تجربة طعام استثنائية. أشهى المشويات والبرجر الفاخر والأطباق الطازجة.">
    <title>مطعم وجبتك | تجربة طعام أصيلة</title>

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
    --sage-light: rgba(118, 138, 118, 0.15);
    --dark: #1A1412;
    --dark-card: #231C17;
    --dark-soft: #2E2520;
    --dark-border: rgba(200, 148, 74, 0.15);
    --cream: #FBF6F0;
    --cream-dark: #F0E6D8;
    --text-primary: #FBF6F0;
    --text-muted: #A89888;
    --text-dark: #2B2421;
    --text-dark-muted: #7A6E66;
    --font-display: 'Playfair Display', 'Cairo', serif;
    --font-body: 'Cairo', sans-serif;
    --radius: 16px;
    --radius-lg: 24px;
    --radius-xl: 40px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: var(--font-body); background: var(--cream); color: var(--text-dark); -webkit-font-smoothing: antialiased; overflow-x: hidden; }
::selection { background: var(--rust); color: #fff; }
img { display: block; max-width: 100%; }
a { text-decoration: none; color: inherit; }
button { font-family: var(--font-body); cursor: pointer; }
ul { list-style: none; }

/* ============================================
   LOCATION MODAL
   ============================================ */
.loc-overlay {
    position: fixed; inset: 0; z-index: 10000;
    background: rgba(10, 8, 6, 0.85);
    backdrop-filter: blur(20px);
    display: flex; align-items: center; justify-content: center;
    padding: 20px;
}
.loc-card {
    background: var(--dark); border: 1px solid var(--dark-border);
    border-radius: var(--radius-xl); max-width: 520px; width: 100%;
    padding: 44px 36px 36px; text-align: center; position: relative;
    box-shadow: 0 40px 100px rgba(0,0,0,0.6), 0 0 80px var(--gold-glow);
}
.loc-card::before {
    content: ''; position: absolute; top: -1px; left: 20%; right: 20%; height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}
.loc-icon-wrap {
    width: 72px; height: 72px; border-radius: 50%;
    background: linear-gradient(135deg, var(--rust), var(--gold));
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px; font-size: 28px; color: #fff;
    box-shadow: 0 12px 40px rgba(200, 148, 74, 0.35);
}
.loc-card h2 {
    font-family: var(--font-display); font-size: 1.8rem; font-weight: 700;
    color: var(--cream); margin-bottom: 8px;
}
.loc-card .subtitle { font-size: 0.88rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 24px; }

.service-toggle {
    display: flex; gap: 6px; background: var(--dark-soft); padding: 4px;
    border-radius: 50px; margin-bottom: 22px;
}
.service-toggle button {
    flex: 1; border: none; background: transparent; padding: 10px;
    border-radius: 50px; font-size: 0.82rem; font-weight: 700;
    color: var(--text-muted); transition: all 0.25s;
    display: flex; align-items: center; justify-content: center; gap: 6px;
}
.service-toggle button.active {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; box-shadow: 0 4px 16px var(--gold-glow);
}

.loc-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 18px; }
.loc-btn {
    background: var(--dark-soft); border: 1px solid var(--dark-border);
    border-radius: 12px; padding: 10px 14px; font-size: 0.82rem; font-weight: 600;
    color: var(--text-muted); transition: all 0.2s; text-align: right;
    display: flex; align-items: center; gap: 8px;
}
.loc-btn:hover, .loc-btn.selected {
    border-color: var(--gold); color: var(--gold-light); background: rgba(200, 148, 74, 0.08);
}
.loc-btn i { color: var(--gold); font-size: 12px; }

.loc-search {
    position: relative; margin-bottom: 20px;
}
.loc-search input {
    width: 100%; background: var(--dark-soft); border: 1px solid var(--dark-border);
    border-radius: 14px; padding: 13px 44px 13px 16px; font-size: 0.88rem;
    font-family: var(--font-body); color: var(--cream); outline: none;
    transition: all 0.25s;
}
.loc-search input::placeholder { color: var(--text-muted); }
.loc-search input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px var(--gold-glow); }
.loc-search i { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); }

.loc-confirm {
    width: 100%; padding: 15px; border: none; border-radius: 50px;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; font-weight: 800; font-size: 0.95rem;
    box-shadow: 0 8px 32px var(--gold-glow); transition: all 0.3s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.loc-confirm:hover { transform: translateY(-2px); box-shadow: 0 14px 40px rgba(200, 148, 74, 0.45); }

/* Blur content behind */
#siteWrap { transition: filter 0.5s, opacity 0.5s; }
#siteWrap.blurred { filter: blur(14px) saturate(0.5); pointer-events: none; user-select: none; }

/* ============================================
   NAVBAR — FLOATING GLASS ON DARK HERO
   ============================================ */
.site-nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 500;
    padding: 14px 24px; transition: all 0.35s ease;
}
.site-nav.scrolled {
    padding: 0 24px;
    background: rgba(26, 20, 18, 0.95);
    backdrop-filter: blur(20px);
    box-shadow: 0 4px 30px rgba(0,0,0,0.3);
}
.nav-wrap {
    max-width: 1280px; margin: 0 auto;
    display: flex; align-items: center; justify-content: space-between;
    height: 64px;
}
.nav-logo { display: flex; align-items: center; gap: 10px; }
.nav-logo-icon {
    width: 42px; height: 42px; border-radius: 12px;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 18px;
    box-shadow: 0 4px 16px var(--gold-glow);
}
.nav-logo-text {
    font-family: var(--font-display); font-size: 1.4rem; font-weight: 700;
    color: #fff;
}
.nav-logo-text .plus { color: var(--gold); }
.nav-logo-text .sub { display: block; font-family: var(--font-body); font-size: 0.65rem; color: var(--text-muted); font-weight: 500; margin-top: -4px; letter-spacing: 2px; text-transform: uppercase; }

.nav-links { display: flex; align-items: center; gap: 28px; }
.nav-links a {
    font-size: 0.88rem; font-weight: 600; color: rgba(251,246,240,0.7);
    transition: color 0.2s; position: relative;
}
.nav-links a:hover, .nav-links a.active { color: var(--gold-light); }
.nav-links a.active::after {
    content: ''; position: absolute; bottom: -6px; left: 0; right: 0;
    height: 2px; background: var(--gold); border-radius: 2px;
}

.nav-actions { display: flex; align-items: center; gap: 12px; }
.nav-loc-btn {
    display: flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1); border-radius: 50px;
    padding: 7px 16px; font-size: 0.78rem; font-weight: 600;
    color: rgba(251,246,240,0.8); transition: all 0.2s; cursor: pointer;
}
.nav-loc-btn:hover { border-color: var(--gold); color: var(--gold-light); }
.nav-loc-btn i { color: var(--gold); }

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

/* ============================================
   HERO — FULL SCREEN CINEMATIC
   ============================================ */
.hero {
    position: relative; min-height: 100vh; display: flex; align-items: center;
    overflow: hidden; background: var(--dark);
}
.hero-bg {
    position: absolute; inset: 0;
    background: url('/images/hero-main.jpg') center/cover no-repeat;
}
.hero-bg::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(
        to right,
        rgba(26,20,18,0.95) 0%,
        rgba(26,20,18,0.8) 35%,
        rgba(26,20,18,0.4) 65%,
        rgba(26,20,18,0.2) 100%
    );
}
.hero-bg::before {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 200px;
    background: linear-gradient(to top, var(--dark), transparent);
    z-index: 1;
}
.hero-content {
    position: relative; z-index: 2; max-width: 1280px; margin: 0 auto;
    padding: 160px 32px 100px; width: 100%;
}
.hero-inner { max-width: 620px; }

.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(200, 148, 74, 0.12); border: 1px solid rgba(200, 148, 74, 0.3);
    border-radius: 50px; padding: 8px 20px;
    font-size: 0.82rem; font-weight: 700; color: var(--gold-light);
    margin-bottom: 28px;
    animation: fadeInUp 0.8s ease forwards;
}
.hero-badge .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--gold); animation: pulse 2s infinite; }

@keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }

.hero h1 {
    font-family: var(--font-display); font-weight: 700;
    font-size: clamp(2.8rem, 5vw, 4.2rem); line-height: 1.15;
    color: #fff; margin-bottom: 22px;
    animation: fadeInUp 0.8s ease 0.1s forwards; opacity: 0;
}
.hero h1 em { font-style: italic; color: var(--gold-light); }

.hero-desc {
    font-size: 1.05rem; color: var(--text-muted); line-height: 1.9;
    margin-bottom: 36px; max-width: 520px;
    animation: fadeInUp 0.8s ease 0.2s forwards; opacity: 0;
}

.hero-btns {
    display: flex; flex-wrap: wrap; gap: 14px; margin-bottom: 48px;
    animation: fadeInUp 0.8s ease 0.3s forwards; opacity: 0;
}
.btn-hero-primary {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; border: none; padding: 15px 34px; border-radius: 50px;
    font-weight: 800; font-size: 0.95rem;
    display: inline-flex; align-items: center; gap: 10px;
    box-shadow: 0 8px 32px var(--gold-glow); transition: all 0.3s;
}
.btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 44px rgba(200, 148, 74, 0.5); }
.btn-hero-outline {
    background: transparent; border: 1.5px solid rgba(251,246,240,0.25);
    color: var(--cream); padding: 14px 28px; border-radius: 50px;
    font-weight: 700; font-size: 0.92rem; transition: all 0.3s;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-hero-outline:hover { border-color: var(--gold); color: var(--gold-light); background: rgba(200, 148, 74, 0.06); }

.hero-stats {
    display: flex; gap: 40px;
    animation: fadeInUp 0.8s ease 0.4s forwards; opacity: 0;
}
.hero-stat { text-align: right; }
.hero-stat .val { font-family: var(--font-display); font-size: 1.8rem; font-weight: 700; color: var(--gold-light); }
.hero-stat .lbl { font-size: 0.78rem; color: var(--text-muted); margin-top: 2px; }

/* Floating food decorations */
.hero-float-1, .hero-float-2 {
    position: absolute; z-index: 3; pointer-events: none;
}
.hero-float-1 {
    bottom: 60px; left: 45%; width: 280px; height: 280px;
    border-radius: 50%; border: 1px solid rgba(200, 148, 74, 0.12);
    animation: float 6s ease-in-out infinite;
}
.hero-float-2 {
    top: 25%; left: 62%; width: 160px; height: 160px;
    border-radius: 50%; border: 1px solid rgba(200, 148, 74, 0.08);
    animation: float 8s ease-in-out infinite reverse;
}
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ============================================
   SECTION STYLES (LIGHT SECTIONS)
   ============================================ */
.section { padding: 90px 28px; }
.section-dark { background: var(--dark); color: var(--cream); }
.section-cream { background: var(--cream); }
.section-warm { background: var(--cream-dark); }

.section-header {
    max-width: 1280px; margin: 0 auto 48px;
    display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px;
}
.section-header h2 {
    font-family: var(--font-display); font-weight: 700;
    font-size: clamp(1.8rem, 3vw, 2.6rem); color: inherit;
}
.section-header h2 em { font-style: italic; color: var(--rust); }
.section-header p { font-size: 0.92rem; color: var(--text-dark-muted); margin-top: 6px; line-height: 1.7; }
.section-dark .section-header p { color: var(--text-muted); }

.section-link {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.86rem; font-weight: 700; color: var(--rust);
    transition: gap 0.2s;
}
.section-link:hover { gap: 14px; }

/* Animate on scroll */
[data-reveal] { opacity: 0; transform: translateY(32px); transition: all 0.7s cubic-bezier(0.16, 1, 0.3, 1); }
[data-reveal].visible { opacity: 1; transform: none; }

/* ============================================
   CATEGORIES — HORIZONTAL SCROLL CAROUSEL
   ============================================ */
.cats-scroll-wrap {
    max-width: 1280px; margin: 0 auto;
    overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none;
    padding-bottom: 10px;
}
.cats-scroll-wrap::-webkit-scrollbar { display: none; }
.cats-scroll {
    display: flex; gap: 24px; min-width: min-content;
}
.cat-card {
    flex: 0 0 320px; position: relative; border-radius: var(--radius-lg);
    overflow: hidden; cursor: pointer; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    border: 2px solid transparent;
}
.cat-card:hover { transform: translateY(-8px) scale(1.02); }
.cat-card.active { border-color: var(--gold);}
.cat-card-img {
    width: 100%; height: 220px; object-fit: cover;
    transition: transform 0.6s ease;
}
.cat-card:hover .cat-card-img { transform: scale(1.1); }
.cat-card-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 30%, rgba(26,20,18,0.92) 100%);
}
.cat-card-badge {
    position: absolute; top: 16px; right: 16px;
    background: rgba(26,20,18,0.7); backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff; font-size: 0.72rem; font-weight: 700;
    padding: 5px 14px; border-radius: 50px;
}
.cat-card-active-badge {
    position: absolute; top: 16px; left: 16px;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; font-size: 0.7rem; font-weight: 800;
    padding: 4px 12px; border-radius: 50px;
    box-shadow: 0 4px 12px var(--gold-glow);
}
.cat-card-info {
    position: absolute; bottom: 0; left: 0; right: 0; padding: 24px 22px;
}
.cat-card-info h3 {
    font-family: var(--font-display); font-size: 1.4rem; font-weight: 700;
    color: #fff; margin-bottom: 6px;
}
.cat-card-info p { font-size: 0.8rem; color: rgba(251,246,240,0.7); line-height: 1.5; }
.cat-card-info .cat-meta {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: 14px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.1);
}
.cat-card-info .cat-count { font-size: 0.74rem; font-weight: 700; color: var(--gold-light); }
.cat-card-info .cat-arrow {
    font-size: 0.78rem; font-weight: 700; color: var(--gold-light);
    display: flex; align-items: center; gap: 6px;
}

/* Subcategory pills */
.sub-pills-bar {
    max-width: 1280px; margin: 28px auto 0;
    display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
    background: var(--dark-card); border: 1px solid var(--dark-border);
    border-radius: 50px; padding: 6px 12px 6px 18px;
}
.sub-pills-label {
    font-size: 0.82rem; font-weight: 800; color: var(--gold);
    display: flex; align-items: center; gap: 6px; padding-left: 14px;
    border-left: 1px solid var(--dark-border);
}
.sub-pill {
    padding: 7px 18px; border-radius: 50px; font-size: 0.8rem; font-weight: 700;
    border: 1px solid var(--dark-border); background: transparent;
    color: var(--text-muted); transition: all 0.2s;
}
.sub-pill:hover { border-color: var(--gold); color: var(--gold-light); }
.sub-pill.active {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    border-color: transparent; color: #fff;
    box-shadow: 0 4px 12px var(--gold-glow);
}

/* ============================================
   BEST SELLERS — PREMIUM CARDS (DARK BG)
   ============================================ */
.plates-grid {
    max-width: 1280px; margin: 0 auto;
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 22px;
}
.dish-card {
    background: var(--dark-card); border: 1px solid var(--dark-border);
    border-radius: var(--radius-lg); padding: 14px;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    display: flex; flex-direction: column;
}
.dish-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 48px rgba(0,0,0,0.4), 0 0 0 1px var(--dark-border);
    border-color: rgba(200, 148, 74, 0.35);
}
.dish-card-img {
    position: relative; overflow: hidden; height: 180px;
    border-radius: 16px; background: #140E0C;
    box-shadow: inset 0 0 14px rgba(0,0,0,0.4);
    border: 1px solid rgba(200, 148, 74, 0.15);
    display: block;
}
.dish-card-img img { width: 100%; height: 100%; object-fit: cover; border-radius: 14px; transition: transform 0.5s ease; }
.dish-card:hover .dish-card-img img { transform: scale(1.08); }
.dish-card-body { padding: 14px 4px 2px; display: flex; flex-direction: column; flex: 1; }
.dish-card-body h4 {
    font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
    color: var(--cream); margin-bottom: 6px;
}
.dish-card-body .dish-desc {
    font-size: 0.78rem; color: var(--text-muted); line-height: 1.6;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; margin-bottom: 16px;
}
.dish-card-foot {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 14px; border-top: 1px solid var(--dark-border);
}
.dish-price {
    font-family: var(--font-display); font-size: 1.25rem; font-weight: 700; color: var(--gold-light);
}
.dish-price small { font-family: var(--font-body); font-size: 0.72rem; color: var(--text-muted); }
.btn-add-dish {
    background: rgba(200, 148, 74, 0.12); border: 1px solid rgba(200, 148, 74, 0.3);
    color: var(--gold-light); padding: 8px 16px; border-radius: 50px;
    font-size: 0.78rem; font-weight: 800; transition: all 0.2s;
    display: flex; align-items: center; gap: 6px;
}
.btn-add-dish:hover {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    border-color: transparent; color: #fff;
    box-shadow: 0 4px 16px var(--gold-glow);
}

/* ============================================
   PRODUCTS GRID — DELUXE WARM GOURMET SECTION
   ============================================ */
.section-cream {
    background:
        radial-gradient(ellipse at 85% 15%, rgba(200, 148, 74, 0.1) 0%, transparent 55%),
        radial-gradient(ellipse at 15% 85%, rgba(189, 93, 56, 0.08) 0%, transparent 50%),
        #FAF5EE;
    position: relative;
    padding: 95px 28px;
}
.section-cream::before {
    content: ''; position: absolute; top: 0; left: 8%; right: 8%; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(200, 148, 74, 0.35), transparent);
}

.section-tag-warm {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(200, 148, 74, 0.12); border: 1px solid rgba(200, 148, 74, 0.3);
    color: var(--rust); font-size: 0.8rem; font-weight: 800;
    padding: 6px 18px; border-radius: 50px; margin-bottom: 14px;
}

.dishes-count-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: #fff; border: 1px solid rgba(200, 148, 74, 0.25);
    color: var(--rust); font-size: 0.78rem; font-weight: 800;
    padding: 6px 14px; border-radius: 50px;
    box-shadow: 0 2px 8px rgba(43, 36, 33, 0.05);
}

.products-filter-bar {
    max-width: 1280px; margin: 0 auto 36px;
    display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
    background: #fff; border: 1px solid rgba(200, 148, 74, 0.2);
    border-radius: 50px; padding: 6px 12px 6px 18px;
    box-shadow: 0 4px 16px rgba(43, 36, 33, 0.04);
}
.products-filter-label {
    font-size: 0.82rem; font-weight: 800; color: var(--rust);
    display: flex; align-items: center; gap: 6px; padding-left: 14px;
    border-left: 1px solid rgba(200, 148, 74, 0.2);
}
.menu-filter-pill {
    padding: 8px 18px; border-radius: 50px; font-size: 0.82rem; font-weight: 700;
    border: 1px solid transparent; background: transparent;
    color: #6E5F57; transition: all 0.2s;
    display: inline-flex; align-items: center; gap: 6px;
}
.menu-filter-pill:hover {
    color: var(--rust); background: rgba(200, 148, 74, 0.08);
}
.menu-filter-pill.active {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; font-weight: 800;
    box-shadow: 0 4px 14px rgba(189, 93, 56, 0.35);
}

.products-grid {
    /* max-width: 1280px; */
     margin: 0 auto;
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;
    padding: 0 65px;
}

.product-card {
    background: #FFFFFF;
    border: 1px solid rgba(200, 148, 74, 0.22);
    border-radius: 24px;
    padding: 16px;
    box-shadow: 0 8px 24px -4px rgba(43, 36, 33, 0.05), 0 2px 6px rgba(0,0,0,0.02);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    position: relative;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 48px -10px rgba(189, 93, 56, 0.16), 0 0 0 1.5px rgba(200, 148, 74, 0.35);
    border-color: rgba(189, 93, 56, 0.35);
}

.product-card-img-wrap {
    position: relative;
    width: 100%;
    height: 195px;
    border-radius: 18px;
    overflow: hidden;
    background: radial-gradient(circle at center, #2C221D 0%, #15100E 100%);
    box-shadow: inset 0 0 14px rgba(0,0,0,0.25);
    border: 1px solid rgba(200, 148, 74, 0.15);
    display: block;
}
.product-card-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 16px;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
.product-card:hover .product-card-img-wrap img {
    transform: scale(1.08);
}
.product-card-img-wrap::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 50px;
    background: linear-gradient(to top, rgba(20, 14, 11, 0.65), transparent);
    pointer-events: none;
}

.product-fav {
    position: absolute; top: 12px; left: 12px; z-index: 4;
    width: 36px; height: 36px; border-radius: 50%;
    background: rgba(255,255,255,0.88); backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.9);
    display: flex; align-items: center; justify-content: center;
    color: #4A3E39; font-size: 14px; cursor: pointer; transition: all 0.25s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
}
.product-fav:hover { transform: scale(1.12); background: #fff; color: #ef4444; }
.product-fav.active { color: #ef4444; background: #fff; }

.product-rating-badge {
    position: absolute; top: 12px; right: 12px; z-index: 3;
    background: rgba(26, 20, 18, 0.82); backdrop-filter: blur(8px);
    color: #fff; font-size: 0.72rem; font-weight: 800;
    padding: 4px 10px; border-radius: 50px;
    display: flex; align-items: center; gap: 4px;
    border: 1px solid rgba(200, 148, 74, 0.3);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.product-rating-badge i { color: #F59E0B; }
.product-rating-badge small { color: rgba(255,255,255,0.65); font-size: 0.65rem; font-weight: 600; }

.product-tag-chip {
    position: absolute; bottom: 10px; right: 12px; z-index: 3;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; font-size: 0.7rem; font-weight: 800;
    padding: 4px 10px; border-radius: 50px;
    display: flex; align-items: center; gap: 4px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.product-time-chip {
    position: absolute; bottom: 10px; left: 12px; z-index: 3;
    background: rgba(26, 20, 18, 0.75); backdrop-filter: blur(6px);
    color: var(--cream); font-size: 0.68rem; font-weight: 700;
    padding: 3px 8px; border-radius: 50px;
    display: flex; align-items: center; gap: 4px;
}

.product-card-body {
    padding: 16px 4px 4px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.product-card-body h4 {
    font-family: var(--font-display);
    font-size: 1.3rem;
    font-weight: 800;
    color: #1F1612;
    margin-bottom: 10px;
    line-height: 1.35;
    transition: color 0.2s;
}
.product-card:hover .product-card-body h4 {
    color: var(--rust);
}

.ingredient-chips {
    display: flex; flex-wrap: wrap; gap: 6px;
    margin-bottom: 12px;
}
.ingredient-chip {
    background: rgba(200, 148, 74, 0.1);
    border: 1px solid rgba(200, 148, 74, 0.22);
    color: #7A5826;
    font-size: 0.73rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.product-card-body .desc {
    font-size: 0.86rem;
    color: #695B53;
    line-height: 1.7;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 16px;
    flex: 1;
}

.product-micro-meta {
    display: flex; align-items: center; justify-content: space-between;
    font-size: 0.74rem; font-weight: 700; color: #8C786E;
    padding-bottom: 14px;
}
.product-micro-meta span { display: inline-flex; align-items: center; gap: 4px; }
.product-micro-meta i { color: var(--gold); }

.product-card-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 16px;
    border-top: 1px dashed rgba(200, 148, 74, 0.25);
    margin-top: auto;
}
.product-price-box {
    display: flex;
    flex-direction: column;
}
.product-price {
    font-family: var(--font-display);
    font-size: 1.55rem;
    font-weight: 800;
    color: var(--rust);
    display: flex;
    align-items: baseline;
    gap: 4px;
    line-height: 1;
}
.product-price small {
    font-family: var(--font-body);
    font-size: 0.76rem;
    font-weight: 800;
    color: #7A5826;
    background: rgba(200, 148, 74, 0.14);
    padding: 2px 7px;
    border-radius: 6px;
}
.product-price-tax {
    font-size: 0.68rem;
    color: #9C8C82;
    font-weight: 600;
    margin-top: 4px;
}

.btn-add-product {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff;
    border: none;
    padding: 11px 22px;
    border-radius: 50px;
    font-size: 0.84rem;
    font-weight: 800;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 6px 18px rgba(189, 93, 56, 0.25);
}
.btn-add-product:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(189, 93, 56, 0.4);
    background: linear-gradient(135deg, var(--rust-hover), var(--gold));
}

.card-qty-stepper {
    display: inline-flex;
    align-items: center;
    background: #1A1412;
    border: 1.5px solid var(--gold);
    border-radius: 50px;
    padding: 4px 6px;
    box-shadow: 0 4px 16px var(--gold-glow);
    animation: popIn 0.2s ease;
}
@keyframes popIn {
    0% { transform: scale(0.9); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
.card-qty-stepper button {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: none;
    background: rgba(200, 148, 74, 0.2);
    color: var(--gold-light);
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}
.card-qty-stepper button:hover {
    background: var(--gold);
    color: #1A1412;
    transform: scale(1.1);
}
.stepper-count {
    padding: 0 12px;
    font-weight: 800;
    font-size: 0.82rem;
    color: #fff;
    white-space: nowrap;
}

.empty-state {
    grid-column: 1 / -1; text-align: center; padding: 80px 20px; color: var(--text-dark-muted);
}
.empty-state i { font-size: 3rem; color: var(--rust); margin-bottom: 14px; }

/* ============================================
   ORDER ONLINE CTA — GLASS DARK
   ============================================ */
.cta-section { padding: 80px 28px; background: var(--cream-dark); }
.cta-banner {
    max-width: 1280px; margin: 0 auto; border-radius: var(--radius-xl);
    overflow: hidden; position: relative;
    background: linear-gradient(135deg, var(--dark) 0%, #2E2520 50%, var(--dark-card) 100%);
    display: grid; grid-template-columns: 1.3fr 0.7fr; min-height: 420px;
}
.cta-banner::before {
    content: ''; position: absolute; inset: 0; pointer-events: none;
    background:
        radial-gradient(circle at 75% 25%, rgba(200, 148, 74, 0.2) 0%, transparent 50%),
        radial-gradient(circle at 25% 75%, rgba(118, 138, 118, 0.15) 0%, transparent 40%);
}
.cta-content { padding: 56px 48px; position: relative; z-index: 2; }
.cta-tag {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(200, 148, 74, 0.1); border: 1px solid rgba(200, 148, 74, 0.25);
    border-radius: 50px; padding: 6px 16px;
    font-size: 0.78rem; font-weight: 700; color: var(--gold-light); margin-bottom: 20px;
}
.cta-content h3 {
    font-family: var(--font-display); font-weight: 700;
    font-size: clamp(1.8rem, 3.2vw, 2.6rem); line-height: 1.3;
    color: #fff; margin-bottom: 16px;
}
.cta-content h3 em { font-style: italic; color: var(--gold-light); }
.cta-content p { font-size: 0.95rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 28px; max-width: 500px; }
.cta-perks { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 32px; }
.cta-perk {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.84rem; font-weight: 600; color: rgba(251,246,240,0.85);
}
.cta-perk i {
    width: 30px; height: 30px; border-radius: 8px;
    background: rgba(200, 148, 74, 0.15); border: 1px solid rgba(200, 148, 74, 0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; color: var(--gold-light); flex-shrink: 0;
}
.cta-btns { display: flex; flex-wrap: wrap; gap: 12px; }
.btn-cta-main {
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; border: none; padding: 14px 30px; border-radius: 50px;
    font-weight: 800; font-size: 0.92rem;
    box-shadow: 0 8px 28px var(--gold-glow); transition: all 0.3s;
    display: flex; align-items: center; gap: 8px;
}
.btn-cta-main:hover { transform: translateY(-2px); box-shadow: 0 12px 36px rgba(200, 148, 74, 0.5); }
.btn-cta-glass {
    background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15);
    color: #fff; padding: 13px 24px; border-radius: 50px;
    font-weight: 700; font-size: 0.88rem; transition: all 0.25s;
    display: flex; align-items: center; gap: 8px; backdrop-filter: blur(6px);
}
.btn-cta-glass:hover { background: rgba(255,255,255,0.12); border-color: rgba(200, 148, 74, 0.3); }

.cta-visual {
    display: flex; align-items: center; justify-content: center; position: relative; z-index: 2; padding: 32px;
}
.cta-art {
    background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-lg); padding: 32px; text-align: center;
    max-width: 280px; width: 100%; backdrop-filter: blur(10px);
}
.cta-art .art-icon { font-size: 48px; color: var(--gold-light); margin-bottom: 12px; }
.cta-art h5 { font-family: var(--font-display); font-size: 1.2rem; font-weight: 700; color: #fff; margin-bottom: 6px; }
.cta-art p { font-size: 0.8rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 14px; }
.cta-art .chip {
    background: rgba(118, 138, 118, 0.2); border: 1px solid rgba(118, 138, 118, 0.3);
    color: #d0e0d0; padding: 5px 14px; border-radius: 50px;
    font-size: 0.72rem; font-weight: 700; display: inline-block;
}

/* ============================================
   FOOTER
   ============================================ */
.site-footer {
    background: var(--dark); color: rgba(251,246,240,0.7);
    padding: 72px 28px 28px; position: relative;
}
.site-footer::before {
    content: ''; position: absolute; top: 0; left: 10%; right: 10%; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(200, 148, 74, 0.3), transparent);
}
.footer-grid {
    max-width: 1280px; margin: 0 auto 48px;
    display: grid; grid-template-columns: 1.5fr 1fr 1fr 1.2fr; gap: 36px;
}
.footer-brand h4 {
    font-family: var(--font-display); font-size: 1.35rem; font-weight: 700;
    color: #fff; margin-bottom: 12px; display: flex; align-items: center; gap: 10px;
}
.footer-brand p { font-size: 0.85rem; color: var(--text-muted); line-height: 1.75; margin-bottom: 18px; }
.footer-socials { display: flex; gap: 8px; }
.soc-icon {
    width: 38px; height: 38px; border-radius: 10px;
    background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted); font-size: 15px; transition: all 0.2s;
}
.soc-icon:hover { background: var(--rust); border-color: var(--rust); color: #fff; }

.footer-col h5 {
    font-family: var(--font-display); font-size: 1.05rem; font-weight: 700;
    color: #fff; margin-bottom: 16px; position: relative; padding-bottom: 10px;
}
.footer-col h5::after {
    content: ''; position: absolute; bottom: 0; right: 0; width: 28px; height: 2px;
    background: var(--gold); border-radius: 2px;
}
.footer-list { display: flex; flex-direction: column; gap: 10px; }
.footer-list a { font-size: 0.85rem; color: var(--text-muted); transition: all 0.2s; display: flex; align-items: center; gap: 6px; }
.footer-list a:hover { color: var(--gold-light); transform: translateX(-4px); }

.footer-info { display: flex; align-items: flex-start; gap: 10px; font-size: 0.84rem; color: var(--text-muted); margin-bottom: 12px; line-height: 1.6; }
.footer-info i { color: var(--gold); margin-top: 3px; font-size: 13px; flex-shrink: 0; }

.footer-bottom {
    max-width: 1280px; margin: 0 auto; padding-top: 24px;
    border-top: 1px solid rgba(255,255,255,0.06);
    display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between;
    font-size: 0.78rem; color: var(--text-muted); gap: 12px;
}
.footer-tags { display: flex; gap: 8px; flex-wrap: wrap; }
.footer-tag {
    background: rgba(255,255,255,0.04); padding: 4px 12px; border-radius: 50px;
    font-size: 0.72rem; font-weight: 600; color: var(--text-muted);
}

/* ============================================
   CART DRAWER
   ============================================ */
.cart-overlay {
    position: fixed; inset: 0; z-index: 600;
    background: rgba(10, 8, 6, 0.6); backdrop-filter: blur(8px);
    transition: opacity 0.3s;
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
.cart-head h3 {
    font-family: var(--font-display); font-size: 1.25rem; font-weight: 700;
    color: var(--cream); display: flex; align-items: center; gap: 10px;
}
.cart-close {
    width: 34px; height: 34px; border-radius: 10px;
    border: 1px solid var(--dark-border); background: transparent;
    color: var(--text-muted); display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; font-size: 14px;
}
.cart-close:hover { border-color: var(--gold); color: var(--gold-light); }

.cart-body { flex: 1; overflow-y: auto; padding: 20px 24px; }
.cart-item {
    background: var(--dark-soft); border: 1px solid var(--dark-border); border-radius: var(--radius);
    padding: 16px; margin-bottom: 10px;
}
.cart-item-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
.cart-item-name { font-weight: 700; font-size: 0.9rem; color: var(--cream); }
.cart-item-price { font-size: 0.8rem; color: var(--gold-light); font-weight: 600; }
.cart-rm {
    background: none; border: none; color: var(--rust); font-size: 0.72rem; font-weight: 700;
    padding: 4px 8px; border-radius: 6px; transition: background 0.2s;
}
.cart-rm:hover { background: var(--rust-light); }
.cart-item-btm { display: flex; align-items: center; gap: 10px; }
.qty-group {
    display: inline-flex; align-items: center; border: 1px solid var(--dark-border);
    border-radius: 50px; overflow: hidden;
}
.qty-group button {
    width: 30px; height: 30px; border: none; background: transparent;
    color: var(--text-muted); font-weight: 800; font-size: 14px;
    transition: background 0.15s;
}
.qty-group button:hover { background: var(--dark-card); }
.qty-group .qty-val { width: 28px; text-align: center; font-weight: 900; font-size: 0.82rem; color: var(--cream); }
.cart-note {
    flex: 1; border: 1px solid var(--dark-border); border-radius: 50px;
    padding: 6px 14px; font-size: 0.74rem; font-family: var(--font-body);
    color: var(--cream); background: var(--dark-card); outline: none;
    transition: border-color 0.2s;
}
.cart-note::placeholder { color: var(--text-muted); }
.cart-note:focus { border-color: var(--gold); }

.cart-empty { text-align: center; padding: 60px 16px; color: var(--text-muted); }
.cart-empty i { font-size: 3rem; color: var(--gold); opacity: 0.6; margin-bottom: 12px; }

.cart-footer { padding: 20px 24px; border-top: 1px solid var(--dark-border); background: var(--dark-card); }
.checkout-fields { display: flex; flex-direction: column; gap: 8px; margin-bottom: 14px; }
.ck-input {
    width: 100%; border: 1px solid var(--dark-border); border-radius: 12px;
    padding: 10px 14px; font-size: 0.85rem; font-family: var(--font-body);
    color: var(--cream); background: var(--dark-soft); outline: none; transition: all 0.2s;
}
.ck-input::placeholder { color: var(--text-muted); }
.ck-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px var(--gold-glow); }
.ck-row { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.ck-select {
    width: 100%; border: 1px solid var(--dark-border); border-radius: 12px;
    padding: 10px 14px; font-size: 0.85rem; font-family: var(--font-body);
    color: var(--cream); background: var(--dark-soft); outline: none; appearance: none;
}
.cart-total {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 0; border-top: 1px solid var(--dark-border);
    font-weight: 900; font-size: 1.1rem; color: var(--cream); margin-bottom: 14px;
}
.cart-total span:last-child { color: var(--gold-light); font-family: var(--font-display); font-size: 1.3rem; }
.btn-checkout {
    width: 100%; padding: 14px; border-radius: 50px; border: none;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    color: #fff; font-weight: 800; font-size: 0.95rem; font-family: var(--font-body);
    box-shadow: 0 8px 28px var(--gold-glow); transition: all 0.3s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-checkout:hover { transform: translateY(-2px); box-shadow: 0 12px 36px rgba(200, 148, 74, 0.5); }
.btn-checkout:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

/* Cart bounce */
@keyframes cartBounce { 0% { transform: scale(1); } 30% { transform: scale(0.9); } 60% { transform: scale(1.1); } 100% { transform: scale(1); } }
.bounce { animation: cartBounce 0.4s ease; }

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 1080px) {
    .nav-links { display: none; }
    .plates-grid { grid-template-columns: repeat(2, 1fr); }
    .products-grid { grid-template-columns: repeat(2, 1fr); }
    .cta-banner { grid-template-columns: 1fr; }
    .cta-visual { padding: 20px 48px 48px; }
    .footer-grid { grid-template-columns: 1fr 1fr; gap: 28px; }
    .hero-stats { gap: 28px; }
    .hero-float-1, .hero-float-2 { display: none; }
}
@media (max-width: 680px) {
    .hero { min-height: auto; }
    .hero-content { padding: 130px 20px 70px; }
    .hero h1 { font-size: 2.2rem; }
    .hero-stats { gap: 20px; flex-wrap: wrap; }
    .section { padding: 60px 18px; }
    .cat-card { flex: 0 0 260px; }
    .plates-grid { grid-template-columns: 1fr; }
    .products-grid { grid-template-columns: 1fr; }
    .cart-drawer { max-width: 100%; }
    .nav-wrap { gap: 8px; }
    .nav-loc-btn { display: none; }
    .footer-grid { grid-template-columns: 1fr; }
    .cta-perks { grid-template-columns: 1fr; }
    .sub-pills-bar { border-radius: var(--radius); padding: 8px; flex-direction: column; align-items: stretch; }
    .sub-pills-label { border-left: none; border-bottom: 1px solid var(--dark-border); padding: 0 0 8px; margin-bottom: 4px; }
    .loc-grid { grid-template-columns: 1fr; }
}

/* Toast confirmation */
.toast-bar {
    position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%);
    background: rgba(26, 20, 18, 0.95); backdrop-filter: blur(16px);
    border: 1px solid var(--gold); border-radius: 50px;
    padding: 12px 28px; color: #fff; font-size: 0.88rem; font-weight: 700;
    display: flex; align-items: center; gap: 10px; z-index: 9999;
    box-shadow: 0 14px 40px rgba(0,0,0,0.4), 0 0 30px var(--gold-glow);
}
.toast-bar i { color: var(--gold); font-size: 16px; }

/* Sticky bottom cart preview on mobile */
.mobile-cart-bar {
    position: fixed; bottom: 16px; left: 16px; right: 16px; z-index: 450;
    background: linear-gradient(135deg, var(--rust), var(--gold-dark));
    border-radius: 50px; padding: 14px 24px;
    display: flex; align-items: center; justify-content: space-between;
    color: #fff; font-weight: 800; font-size: 0.92rem;
    box-shadow: 0 12px 35px rgba(189, 93, 56, 0.45);
    cursor: pointer;
}
@media (min-width: 681px) {
    .mobile-cart-bar { display: none !important; }
}
@media (max-width: 680px) {
    .products-filter-bar { border-radius: var(--radius); padding: 8px; flex-direction: column; align-items: stretch; }
    .products-filter-label { border-left: none; border-bottom: 1px solid rgba(200, 148, 74, 0.2); padding: 0 0 8px; margin-bottom: 4px; }
}
    </style>
</head>
<body x-data="storeApp()" x-init="initApp()">

<!-- ===== LOCATION MODAL ===== -->
<div x-show="locationModalOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="loc-overlay" id="locationModal" style="display:none;">

    <div class="loc-card" @click.away="if(customerLocation) locationModalOpen = false">
        <div class="loc-icon-wrap"><i class="fas fa-map-marker-alt"></i></div>
        <h2>أهلاً بك في وجبتك<span style="color:var(--gold);">+</span></h2>
        <p class="subtitle">يسعدنا استقبالك! حدد موقعك للاطلاع على القائمة وبدء تجربة الطعم الأصيل.</p>

        <div class="service-toggle">
            <button type="button" :class="{ 'active': checkoutData.order_type === 'delivery' }" @click="checkoutData.order_type = 'delivery'">
                <i class="fas fa-motorcycle"></i> توصيل
            </button>
            <button type="button" :class="{ 'active': checkoutData.order_type === 'takeaway' }" @click="checkoutData.order_type = 'takeaway'">
                <i class="fas fa-shopping-bag"></i> استلام
            </button>
            <button type="button" :class="{ 'active': checkoutData.order_type === 'dine_in' }" @click="checkoutData.order_type = 'dine_in'">
                <i class="fas fa-chair"></i> صالة
            </button>
        </div>

        <div class="loc-grid">
            <template x-for="loc in quickLocations" :key="loc">
                <button type="button" class="loc-btn" :class="{ 'selected': customerLocation === loc }" @click="selectQuickLocation(loc)">
                    <i class="fas fa-map-pin"></i> <span x-text="loc"></span>
                </button>
            </template>
        </div>

        <div class="loc-search">
            <i class="fas fa-search"></i>
            <input type="text" x-model="customerLocation" @keyup.enter="confirmLocation()"
                   placeholder="أو اكتب اسم المنطقة..." id="customLocationInput">
        </div>

        <button type="button" class="loc-confirm" @click="confirmLocation()" id="confirmLocationBtn">
            <span>تأكيد ومتابعة</span> <i class="fas fa-arrow-left"></i>
        </button>
    </div>
</div>

<!-- ===== MAIN SITE ===== -->
<div id="siteWrap" :class="locationModalOpen ? 'blurred' : ''">

    <!-- ===== NAVBAR ===== -->
    <nav class="site-nav" id="mainNav">
        <div class="nav-wrap">
            <a href="{{ route('store.index') }}" class="nav-logo">
                <div class="nav-logo-icon"><i class="fas fa-utensils"></i></div>
                <div class="nav-logo-text">
                    وجبتك<span class="plus">+</span>
                    <span class="sub">Premium Dining</span>
                </div>
            </a>

            <div class="nav-links">
                <a href="#hero" class="active">الرئيسية</a>
                <a href="#categories">القائمة</a>
                <a href="#popular">الأكثر طلباً</a>
                <a href="#orderOnline">اطلب أونلاين</a>
                <a href="{{ route('kitchen.screen') }}" target="_blank">شاشة المطبخ</a>
            </div>

            <div class="nav-actions">
                <button type="button" class="nav-loc-btn" @click="locationModalOpen = true" id="navLocationBtn">
                    <i class="fas fa-map-marker-alt"></i>
                    <span x-text="customerLocation || 'حدد موقعك'"></span>
                </button>
                <a href="{{ route('admin.dashboard') }}" style="font-size:0.78rem;font-weight:600;color:rgba(251,246,240,0.5);display:flex;align-items:center;gap:4px;">
                    <i class="fas fa-cog"></i>
                </a>
                <button @click="cartOpen = true" class="nav-cart-btn" id="cartToggle">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="nav-cart-badge" x-text="cartTotalCount()"></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    @if(!request('search'))
    <header class="hero" id="hero">
        <div class="hero-bg"></div>
        <div class="hero-float-1"></div>
        <div class="hero-float-2"></div>
        <div class="hero-content">
            <div class="hero-inner">
                <div class="hero-badge">
                    <span class="dot"></span>
                    ضيافة فاخرة • تحضير طازج على أيدي أمهر الطهاة
                </div>
                <h1>
                    استمتع بأشهى<br>المأكولات <em>والمشويات</em><br>الأصيلة لدينا.
                </h1>
                <p class="hero-desc">
                    نجمع لك أصالة المشويات الشرقية على الفحم مع فخامة البرجر المدخن والعصائر المنعشة. لحوم بلدي طازجة 100% وتتبيلات غنية تُعد خصيصاً لتمنحك مذاقاً لا يُنسى.
                </p>
                <div class="hero-btns">
                    <a href="#menu" class="btn-hero-primary" onclick="document.getElementById('menu').scrollIntoView({behavior:'smooth'}); return false;">
                        <i class="fas fa-concierge-bell"></i> اطلب الآن
                    </a>
                    <a href="#categories" class="btn-hero-outline">
                        <i class="fas fa-book-open"></i> تصفح القائمة
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="val">4.9 <i class="fas fa-star" style="font-size:0.7em;color:#F59E0B;"></i></div>
                        <div class="lbl">+1,500 عميل سعيد</div>
                    </div>
                    <div class="hero-stat">
                        <div class="val">15<span style="font-size:0.6em;">د</span></div>
                        <div class="lbl">متوسط التوصيل</div>
                    </div>
                    <div class="hero-stat">
                        <div class="val">100%</div>
                        <div class="lbl">لحوم بلدي طازجة</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @endif

    <main id="menu">

        <!-- ===== CATEGORIES (DARK SECTION + HORIZONTAL SCROLL) ===== -->
        <section class="section section-dark" id="categories">
            <div class="section-header" data-reveal>
                <div>
                    <h2>افتح <em>القائمة</em></h2>
                    <p>تصفح أصنافنا المتنوعة من أشهى المأكولات والمشويات والعصائر</p>
                </div>
                <a href="#productsGrid" class="section-link" style="color:var(--gold-light);">
                    عرض كل الوجبات <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            @php
                $catMeta = [
                    'fast-food' => [
                        'image' => '/images/cat-burgers.jpg',
                        'tag' => 'الأكثر شعبية',
                        'desc' => 'برجر أنجوس فاخر، تشيكن مقرمش، وبطاطس ودجز بالجبنة',
                        'badge' => 'وجبات سريعة',
                    ],
                    'grills' => [
                        'image' => '/images/cat-grills.jpg',
                        'tag' => 'على الفحم الأصيل',
                        'desc' => 'كباب وكفتة بلدي، ميكس جريل مشوي بتتبيلة الشيف الخاصة',
                        'badge' => 'مشويات شرقية',
                    ],
                    'drinks-desserts' => [
                        'image' => '/images/cat-drinks.jpg',
                        'tag' => 'انتعاش طبيعي',
                        'desc' => 'موهيتو فريش بالنكهات، عصائر طازجة وحلويات شهية',
                        'badge' => 'مشروبات وحلويات',
                    ],
                ];
            @endphp

            <div class="cats-scroll-wrap" data-reveal style="transition-delay:100ms">
                <div class="cats-scroll">
                    @foreach($sections as $sec)
                        @php
                            $meta = $catMeta[$sec->slug] ?? [
                                'image' => '/images/hero-banner.jpg',
                                'tag' => 'قسم مميز',
                                'desc' => 'تشكيلة مختارة بعناية من أشهى المأكولات',
                                'badge' => $sec->name,
                            ];
                            $isActive = ($activeSectionId == $sec->id);
                        @endphp
                        <a href="{{ route('store.index', ['section_id' => $sec->id]) }}"
                           class="cat-card {{ $isActive ? 'active' : '' }}" id="cat-card-{{ $sec->id }}">
                            <img src="{{ $meta['image'] }}" alt="{{ $sec->name }}" class="cat-card-img" loading="lazy">
                            <div class="cat-card-overlay"></div>
                            <span class="cat-card-badge">{{ $meta['tag'] }}</span>
                            @if($isActive)
                                <span class="cat-card-active-badge"><i class="fas fa-check"></i> القسم النشط</span>
                            @endif
                            <div class="cat-card-info">
                                <h3>{{ $sec->name }}</h3>
                                <p>{{ $meta['desc'] }}</p>
                                <div class="cat-meta">
                                    <span class="cat-count">{{ $sec->subcategories->count() }} تصنيفات</span>
                                    <span class="cat-arrow">استكشف <i class="fas fa-arrow-left"></i></span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            @php $currentSection = $sections->firstWhere('id', $activeSectionId) ?? $sections->first(); @endphp
            @if($currentSection && $currentSection->subcategories->count() > 0)
                <div class="sub-pills-bar" data-reveal style="transition-delay:180ms">
                    <div class="sub-pills-label">
                        <i class="fas fa-filter"></i>
                        تصنيفات {{ $currentSection->name }}:
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:6px;">
                        <a href="{{ route('store.index', ['section_id' => $activeSectionId]) }}"
                           class="sub-pill {{ empty($activeSubcategoryId) ? 'active' : '' }}">عرض الكل</a>
                        @foreach($currentSection->subcategories as $sub)
                            <a href="{{ route('store.index', ['section_id' => $activeSectionId, 'subcategory_id' => $sub->id]) }}"
                               class="sub-pill {{ $activeSubcategoryId == $sub->id ? 'active' : '' }}">{{ $sub->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <!-- ===== BEST SELLERS (DARK) ===== -->
        @if($bestSellers->count() > 0 && !request('search'))
        <section class="section section-dark" id="popular" style="padding-top:30px;">
            <div class="section-header" data-reveal>
                <div>
                    <h2>أشهر أطباقنا <em>والأكثر مبيعاً</em></h2>
                    <p style="color:var(--text-muted);">أطباق متميزة يحبها عملاؤنا — أضفها لطلبك بلمسة واحدة</p>
                </div>
                <span class="hero-badge" style="margin:0;animation:none;opacity:1;"><i class="fas fa-award"></i> موصى به من الشيف</span>
            </div>
            <div class="plates-grid">
                @foreach($bestSellers as $idx => $bProduct)
                    <div class="dish-card" data-reveal style="transition-delay:{{ $idx * 80 }}ms" id="bestseller-{{ $bProduct->id }}">
                        <a href="{{ route('store.product', $bProduct->id) }}" class="dish-card-img" title="عرض تفاصيل الوجبة">
                            <img src="{{ $bProduct->image }}" alt="{{ $bProduct->name }}" loading="lazy">
                            <button type="button" class="dish-fav"
                                    :class="{ 'active': favorites.includes({{ $bProduct->id }}) }"
                                    @click.prevent.stop="toggleFavorite({{ $bProduct->id }})" title="المفضلة">
                                <i :class="favorites.includes({{ $bProduct->id }}) ? 'fas fa-heart' : 'far fa-heart'"></i>
                            </button>
                            <span class="dish-rating"><i class="fas fa-star"></i> الأعلى تقييماً</span>
                        </a>
                        <div class="dish-card-body">
                            <h4><a href="{{ route('store.product', $bProduct->id) }}" style="color:inherit;text-decoration:none;">{{ $bProduct->name }}</a></h4>
                            <p class="dish-desc">{{ $bProduct->description }}</p>
                            <div class="dish-card-foot">
                                <span class="dish-price">{{ number_format($bProduct->price, 0) }} <small>ج.م</small></span>
                                <div>
                                    <template x-if="getCartQty({{ $bProduct->id }}) === 0">
                                        <button type="button" class="btn-add-dish"
                                                @click="addToCart({{ $bProduct->id }}, '{{ addslashes($bProduct->name) }}', {{ $bProduct->price }})">
                                            <i class="fas fa-plus"></i> أضف
                                        </button>
                                    </template>
                                    <template x-if="getCartQty({{ $bProduct->id }}) > 0">
                                        <div class="card-qty-stepper" style="padding:2px 4px;">
                                            <button type="button" @click="decreaseQty({{ $bProduct->id }})" title="إنقاص">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="stepper-count" style="padding:0 8px;font-size:0.78rem;" x-text="getCartQty({{ $bProduct->id }})"></span>
                                            <button type="button" @click="increaseQty({{ $bProduct->id }}, '{{ addslashes($bProduct->name) }}', {{ $bProduct->price }})" title="زيادة">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- ===== PRODUCTS GRID (DELUXE WARM GOURMET SECTION) ===== -->
        <section class="section section-cream" id="productsGrid">
            <div class="section-header" data-reveal>
                <div>
                    <span class="section-tag-warm">
                        <i class="fas fa-fire-flame-curved"></i> تحضير طازج على يد أمهر الطهاة
                    </span>
                    <h2>
                        @if(request('search'))
                            نتائج البحث عن "<em>{{ request('search') }}</em>"
                        @elseif($currentSection)
                            قائمة أطباق <em>{{ $currentSection->name }}</em>
                        @else
                            قائمة <em>الأطباق</em> الكاملة
                        @endif
                    </h2>
                    <p>تشكيلة شهية محضرة يومياً من أجود المكونات الطازجة والتتبيلات الأصيلة الغنية</p>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    <span class="dishes-count-pill">
                        <i class="fas fa-check-circle"></i> {{ $products->count() }} أطباق جاهزة للطلب الآن
                    </span>
                </div>
            </div>

            @if($currentSection && $currentSection->subcategories->count() > 0)
                <div class="products-filter-bar" data-reveal style="transition-delay:80ms">
                    <div class="products-filter-label">
                        <i class="fas fa-filter"></i> اختر التصنيف:
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:6px;">
                        <a href="{{ route('store.index', ['section_id' => $activeSectionId]) }}#productsGrid"
                           class="menu-filter-pill {{ empty($activeSubcategoryId) ? 'active' : '' }}">
                            <i class="fas fa-border-all"></i> كل {{ $currentSection->name }}
                        </a>
                        @foreach($currentSection->subcategories as $sub)
                            <a href="{{ route('store.index', ['section_id' => $activeSectionId, 'subcategory_id' => $sub->id]) }}#productsGrid"
                               class="menu-filter-pill {{ $activeSubcategoryId == $sub->id ? 'active' : '' }}">
                                {{ $sub->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @php
                $dishMeta = [
                    'دبل سموكد بيكون برجر' => [
                        'tag' => '🔥 أنجوس مدخن',
                        'rating' => '4.9',
                        'reviews' => '148',
                        'time' => '15 د',
                        'calories' => '720 كالوري',
                        'chips' => ['🥓 بيكون بقري مقرمش', '🧀 دبل شيدر ذائبة', '🍔 صوص باربكيو مدخن'],
                    ],
                    'مشروم سويس برجر' => [
                        'tag' => '👑 اختيار الشيف',
                        'rating' => '4.8',
                        'reviews' => '96',
                        'time' => '12 د',
                        'calories' => '650 كالوري',
                        'chips' => ['🍄 مشروم طازج', '🧀 إيمنتال سويسرية', '🥩 صوص كريمي فاخر'],
                    ],
                    'رانش زينجر سوبر كرانشي' => [
                        'tag' => '🌶️ كرانشي حار',
                        'rating' => '4.9',
                        'reviews' => '210',
                        'time' => '10 د',
                        'calories' => '590 كالوري',
                        'chips' => ['🍗 صدور دجاج كرانشي', '🥣 صوص رانش متبل', '🌶️ حلقات هالبينو'],
                    ],
                    'بطاطس ودجز بالجبنة والبيكون' => [
                        'tag' => '🧀 الأكثر مبيعاً',
                        'rating' => '4.7',
                        'reviews' => '180',
                        'time' => '8 د',
                        'calories' => '420 كالوري',
                        'chips' => ['🥔 بطاطس ودجز ذهبية', '🧀 صوص شيدر ساخن', '🥓 فتات بيكون مقرمش'],
                    ],
                    'وجبة ميكس كباب وكفتة مشوية' => [
                        'tag' => '🔥 فحم بلدي أصيل',
                        'rating' => '5.0',
                        'reviews' => '340',
                        'time' => '20 د',
                        'calories' => '850 كالوري',
                        'chips' => ['🥩 لحم بلدي 100%', '🍢 مشوي على الفحم', '🍚 أرز بسمتي فاخر'],
                    ],
                    'موهيتو توت بري وباشن فروت' => [
                        'tag' => '❄️ فريش طبيعي',
                        'rating' => '4.8',
                        'reviews' => '115',
                        'time' => '5 د',
                        'calories' => '180 كالوري',
                        'chips' => ['🫐 توت وباشن فروت', '🍋 ليمون فريش', '🌿 أوراق نعناع طازجة'],
                    ],
                ];
            @endphp

            <div class="products-grid">
                @forelse($products as $idx => $product)
                    @php
                        $meta = $dishMeta[$product->name] ?? [
                            'tag' => ($product->is_best_seller ? '⭐ الأكثر طلباً' : '👨‍🍳 طازج ولذيذ'),
                            'rating' => '4.8',
                            'reviews' => '65+',
                            'time' => '12 د',
                            'calories' => 'طازج يومياً',
                            'chips' => ['🌿 مكونات طازجة', '👨‍🍳 وصفة الشيف', '✨ تحضير فوري'],
                        ];
                    @endphp
                    <div class="product-card" data-reveal style="transition-delay:{{ ($idx % 3) * 80 }}ms" id="product-{{ $product->id }}">
                        <a href="{{ route('store.product', $product->id) }}" class="product-card-img-wrap" title="عرض تفاصيل الوجبة">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">
                            
                            <!-- Favorite Button -->
                            <button type="button" class="product-fav"
                                    :class="{ 'active': favorites.includes({{ $product->id }}) }"
                                    @click.prevent.stop="toggleFavorite({{ $product->id }})" title="أضف للمفضلة">
                                <i :class="favorites.includes({{ $product->id }}) ? 'fas fa-heart' : 'far fa-heart'"></i>
                            </button>

                            <!-- Rating Badge -->
                            <div class="product-rating-badge">
                                <i class="fas fa-star"></i> {{ $meta['rating'] }}
                                <small>({{ $meta['reviews'] }})</small>
                            </div>

                            <!-- Signature Badge -->
                            <span class="product-tag-chip">{{ $meta['tag'] }}</span>

                            <!-- Time Badge -->
                            <span class="product-time-chip"><i class="far fa-clock"></i> {{ $meta['time'] }}</span>
                        </a>

                        <div class="product-card-body">
                            <h4>
                                <a href="{{ route('store.product', $product->id) }}" style="color:inherit;text-decoration:none;">{{ $product->name }}</a>
                            </h4>

                            <!-- Ingredient Chips -->
                            <div class="ingredient-chips">
                                @foreach($meta['chips'] as $chip)
                                    <span class="ingredient-chip">{{ $chip }}</span>
                                @endforeach
                            </div>

                            <p class="desc">{{ $product->description }}</p>

                            <div class="product-micro-meta">
                                <span><i class="fas fa-fire"></i> {{ $meta['calories'] }}</span>
                                <span><i class="fas fa-shield-alt"></i> لحوم طازجة 100%</span>
                            </div>

                            <div class="product-card-foot">
                                <div class="product-price-box">
                                    <span class="product-price">
                                        {{ number_format($product->price, 0) }}
                                        <small>ج.م</small>
                                    </span>
                                    <span class="product-price-tax">شامل الضريبة • سعر خاص</span>
                                </div>

                                <div>
                                    <template x-if="getCartQty({{ $product->id }}) === 0">
                                        <button type="button" class="btn-add-product"
                                                @click="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})">
                                            <i class="fas fa-plus"></i> أضف للطلب
                                        </button>
                                    </template>
                                    <template x-if="getCartQty({{ $product->id }}) > 0">
                                        <div class="card-qty-stepper">
                                            <button type="button" @click="decreaseQty({{ $product->id }})" title="إنقاص">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="stepper-count" x-text="getCartQty({{ $product->id }}) + ' في طلبك'"></span>
                                            <button type="button" @click="increaseQty({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})" title="زيادة">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-search"></i>
                        <h4 style="font-family:var(--font-display);font-size:1.3rem;margin-bottom:6px;">لا توجد وجبات تطابق البحث</h4>
                        <p style="font-size:0.88rem;">جرب قسم آخر أو كلمة بحث مختلفة.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- ===== ORDER ONLINE CTA ===== -->
        <section class="cta-section" id="orderOnline">
            <div class="cta-banner" data-reveal>
                <div class="cta-content">
                    <span class="cta-tag"><i class="fas fa-bolt" style="color:var(--gold-light);"></i> اطلب مباشرة أونلاين</span>
                    <h3>اطلب أونلاين الآن<br><em>واستمتع بتوصيل ساخن</em> حتى باب منزلك.</h3>
                    <p>تجربة طلب رقمية سلسة، راقب تحضير طعامك مباشرة عبر شاشة المطبخ KDS مع تغليف حراري يحفظ القرمشة.</p>
                    <div class="cta-perks">
                        <div class="cta-perk"><i class="fas fa-shipping-fast"></i> توصيل خلال 15-20 دقيقة</div>
                        <div class="cta-perk"><i class="fas fa-mobile-alt"></i> متابعة حية عبر KDS</div>
                        <div class="cta-perk"><i class="fas fa-percentage"></i> خصم 15% أول طلب</div>
                        <div class="cta-perk"><i class="fas fa-box"></i> تغليف حراري معقم</div>
                    </div>
                    <div class="cta-btns">
                        <button type="button" @click="document.getElementById('menu').scrollIntoView({behavior:'smooth'})" class="btn-cta-main">
                            <i class="fas fa-shopping-cart"></i> اطلب أونلاين الآن
                        </button>
                        <a href="{{ route('kitchen.screen') }}" target="_blank" class="btn-cta-glass">
                            <i class="fas fa-eye"></i> راقب المطبخ ↗
                        </a>
                    </div>
                </div>
                <div class="cta-visual">
                    <div class="cta-art">
                        <div class="art-icon"><i class="fas fa-motorcycle"></i></div>
                        <h5>توصيل سريع وآمن</h5>
                        <p>حقائب حرارية معزولة تضمن وصول الطعام بجودة المطعم.</p>
                        <span class="chip">دفع عند الاستلام أو إلكتروني</span>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="site-footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <h4>
                    <div class="nav-logo-icon" style="width:34px;height:34px;font-size:15px;"><i class="fas fa-utensils"></i></div>
                    مطعم وجبتك+
                </h4>
                <p>مطعمك المفضل للبرجر الفاخر والمشويات الشرقية الأصيلة على الفحم. نحرص على تقديم تجربة ضيافة راقية لا تُنسى.</p>
                <div class="footer-socials">
                    <a href="#" class="soc-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="soc-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="soc-icon"><i class="fab fa-tiktok"></i></a>
                    <a href="https://wa.me/201012345678" target="_blank" class="soc-icon"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h5>روابط سريعة</h5>
                <div class="footer-list">
                    <a href="#hero"><i class="fas fa-angle-left"></i> الرئيسية</a>
                    <a href="#categories"><i class="fas fa-angle-left"></i> القائمة</a>
                    <a href="#popular"><i class="fas fa-angle-left"></i> الأكثر طلباً</a>
                    <a href="#orderOnline"><i class="fas fa-angle-left"></i> اطلب أونلاين</a>
                    <a href="{{ route('kitchen.screen') }}" target="_blank"><i class="fas fa-angle-left"></i> شاشة المطبخ</a>
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-angle-left"></i> لوحة الإدارة</a>
                </div>
            </div>
            <div class="footer-col">
                <h5>ساعات العمل</h5>
                <div class="footer-list" style="gap:8px;">
                    <span style="color:#c8b8a8;"><strong>السبت - الأربعاء:</strong><br>11:00 ص – 1:30 ص</span>
                    <span style="color:#c8b8a8;"><strong>الخميس - الجمعة:</strong><br>11:00 ص – 3:00 ص</span>
                    <span style="color:var(--gold-light);font-weight:700;"><strong>التوصيل:</strong><br>متاح 24/7</span>
                </div>
            </div>
            <div class="footer-col">
                <h5>الموقع والتواصل</h5>
                <div class="footer-info"><i class="fas fa-map-marker-alt"></i> شارع التسعين الشمالي، التجمع الخامس، القاهرة</div>
                <div class="footer-info"><i class="fas fa-phone-alt"></i> <span dir="ltr">+20 105 555 4444</span></div>
                <div class="footer-info"><i class="fab fa-whatsapp"></i> واتساب: 01012345678</div>
                <div class="footer-info"><i class="fas fa-envelope"></i> orders@wajbatak.com</div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2026 مطعم وجبتك+ (Smart Meal). جميع الحقوق محفوظة.</span>
            <div class="footer-tags">
                <span class="footer-tag"><i class="fas fa-check-circle" style="color:var(--sage);"></i> لحوم طازجة 100%</span>
                <span class="footer-tag"><i class="fas fa-shipping-fast" style="color:var(--gold);"></i> توصيل فوري</span>
                <span class="footer-tag"><i class="fas fa-lock"></i> دفع آمن</span>
            </div>
        </div>
    </footer>

</div>

<!-- ===== CART DRAWER ===== -->
<div x-show="cartOpen" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="cart-overlay" @click="cartOpen = false" style="display:none;"></div>

<div class="cart-drawer" :class="{ 'open': cartOpen }" id="cartPanel">
    <div class="cart-head">
        <h3><i class="fas fa-shopping-bag" style="color:var(--gold);"></i> سلة طلباتك</h3>
        <button @click="cartOpen = false" class="cart-close">✕</button>
    </div>
    <div class="cart-body">
        <template x-for="(item, index) in cart" :key="index">
            <div class="cart-item">
                <div class="cart-item-top">
                    <div>
                        <div class="cart-item-name" x-text="item.name"></div>
                        <div class="cart-item-price" x-text="(item.price * item.quantity).toFixed(2) + ' ج.م'"></div>
                    </div>
                    <button @click="removeFromCart(index)" class="cart-rm"><i class="fas fa-trash-alt"></i> إزالة</button>
                </div>
                <div class="cart-item-btm">
                    <div class="qty-group">
                        <button @click="item.quantity > 1 ? item.quantity-- : removeFromCart(index)">−</button>
                        <span class="qty-val" x-text="item.quantity"></span>
                        <button @click="item.quantity++">+</button>
                    </div>
                    <input type="text" x-model="item.special_instructions" placeholder="ملاحظات للشيف..." class="cart-note">
                </div>
            </div>
        </template>
        <div x-show="cart.length === 0" class="cart-empty">
            <i class="fas fa-shopping-basket"></i>
            <p style="font-weight:700;font-size:0.92rem;color:var(--cream);">سلتك فارغة حالياً</p>
            <p style="font-size:0.8rem;margin-top:4px;">اختر أطباقك المفضلة من القائمة!</p>
        </div>
    </div>
    <div class="cart-footer" x-show="cart.length > 0">
        <div class="checkout-fields">
            <input type="text" x-model="checkoutData.customer_name" placeholder="الاسم الكامل" class="ck-input">
            <input type="text" x-model="checkoutData.customer_phone" placeholder="رقم الهاتف" class="ck-input">
            <div class="ck-row">
                <select x-model="checkoutData.order_type" class="ck-select">
                    <option value="delivery">🚗 توصيل</option>
                    <option value="takeaway">🥡 استلام</option>
                    <option value="dine_in">🏠 صالة</option>
                </select>
                <input type="text" x-model="checkoutData.table_number" placeholder="العنوان / الطاولة" class="ck-input">
            </div>
        </div>
        <div class="cart-total">
            <span>إجمالي الطلب:</span>
            <span x-text="cartTotalPrice() + ' ج.م'"></span>
        </div>
        <div style="display:flex;flex-direction:column;gap:10px;">
            <a href="{{ route('store.checkout.page') }}" class="btn-checkout" style="text-align:center;justify-content:center;">
                <i class="fas fa-credit-card"></i> إتمام الطلب والدفع ↗
            </a>
            <button type="button" @click="submitOrder()" :disabled="isSubmitting" class="btn-checkout" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.15);box-shadow:none;">
                <span x-show="!isSubmitting"><i class="fas fa-bolt"></i> طلب سريع فوري</span>
                <span x-show="isSubmitting"><i class="fas fa-spinner fa-spin"></i> جاري الإرسال...</span>
            </button>
        </div>
    </div>
</div>

<script>
// Navbar scroll effect
window.addEventListener('scroll', () => {
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 40);
});

// Scroll reveal
const revealObs = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); revealObs.unobserve(e.target); }
    });
}, { threshold: 0.1 });
document.querySelectorAll('[data-reveal]').forEach(el => revealObs.observe(el));

function storeApp() {
    return {
        locationModalOpen: false,
        customerLocation: '',
        favorites: [],
        quickLocations: [
            'القاهرة الجديدة - التجمع',
            'المعادي ودجلة',
            'الشيخ زايد وأكتوبر',
            'مصر الجديدة ومدينة نصر',
            'الدقي والمهندسين',
            'وسط البلد والزمالك'
        ],
        cartOpen: false,
        cart: [],
        isSubmitting: false,
        checkoutData: {
            customer_name: 'أحمد سعيد',
            customer_phone: '01055554444',
            order_type: 'delivery',
            table_number: ''
        },
        initApp() {
            const urlParams = new URLSearchParams(window.location.search);
            const paramLoc = urlParams.get('loc');
            if (paramLoc) {
                this.customerLocation = decodeURIComponent(paramLoc);
                localStorage.setItem('kds_customer_location', this.customerLocation);
                this.checkoutData.table_number = this.customerLocation;
                this.locationModalOpen = false;
            } else {
                const savedLoc = localStorage.getItem('kds_customer_location');
                if (savedLoc) {
                    this.customerLocation = savedLoc;
                    this.checkoutData.table_number = savedLoc;
                    this.locationModalOpen = false;
                } else {
                    this.locationModalOpen = true;
                }
            }
            try {
                const favs = localStorage.getItem('kds_favorites');
                if (favs) this.favorites = JSON.parse(favs);
            } catch(e) {}
            try {
                const savedCart = localStorage.getItem('kds_cart');
                if (savedCart) this.cart = JSON.parse(savedCart);
            } catch(e) {}
        },
        saveCart() {
            try { localStorage.setItem('kds_cart', JSON.stringify(this.cart)); } catch(e) {}
        },
        selectQuickLocation(loc) { this.customerLocation = loc; },
        confirmLocation() {
            if (!this.customerLocation || this.customerLocation.trim() === '') {
                this.customerLocation = 'القاهرة الجديدة - التجمع';
            }
            localStorage.setItem('kds_customer_location', this.customerLocation);
            this.checkoutData.table_number = this.customerLocation;
            this.locationModalOpen = false;
        },
        toggleFavorite(id) {
            const idx = this.favorites.indexOf(id);
            if (idx > -1) { this.favorites.splice(idx, 1); } else { this.favorites.push(id); }
            localStorage.setItem('kds_favorites', JSON.stringify(this.favorites));
        },
        toastMessage: '',
        toastTimer: null,
        showToast(msg) {
            this.toastMessage = msg;
            if (this.toastTimer) clearTimeout(this.toastTimer);
            this.toastTimer = setTimeout(() => { this.toastMessage = ''; }, 2400);
        },
        getCartQty(id) {
            const item = this.cart.find(i => i.product_id === id);
            return item ? item.quantity : 0;
        },
        increaseQty(id, name, price) {
            this.addToCart(id, name, price, false);
        },
        decreaseQty(id) {
            const item = this.cart.find(i => i.product_id === id);
            if (!item) return;
            if (item.quantity > 1) {
                item.quantity--;
            } else {
                const idx = this.cart.indexOf(item);
                if (idx > -1) this.cart.splice(idx, 1);
            }
            this.saveCart();
            const btn = document.getElementById('cartToggle');
            if (btn) { btn.classList.add('bounce'); setTimeout(() => btn.classList.remove('bounce'), 450); }
        },
        addToCart(id, name, price, openDrawer = false) {
            const existing = this.cart.find(i => i.product_id === id);
            if (existing) { existing.quantity++; } else {
                this.cart.push({ product_id: id, name, price, quantity: 1, special_instructions: '' });
            }
            this.saveCart();
            if (openDrawer) {
                this.cartOpen = true;
            }
            this.showToast('تمت إضافة ' + name + ' إلى سلتك ✓');
            const btn = document.getElementById('cartToggle');
            if (btn) { btn.classList.add('bounce'); setTimeout(() => btn.classList.remove('bounce'), 450); }
        },
        removeFromCart(index) {
            this.cart.splice(index, 1);
            this.saveCart();
        },
        cartTotalCount() { return this.cart.reduce((s, i) => s + i.quantity, 0); },
        cartTotalPrice() { return this.cart.reduce((s, i) => s + (i.price * i.quantity), 0).toFixed(2); },
        async submitOrder() {
            if (this.cart.length === 0) return;
            if (!this.checkoutData.customer_name || !this.checkoutData.customer_phone) {
                alert('يرجى كتابة الاسم ورقم الهاتف');
                return;
            }
            this.isSubmitting = true;
            try {
                const response = await fetch('{{ route("store.checkout") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({
                        customer_name: this.checkoutData.customer_name,
                        customer_phone: this.checkoutData.customer_phone,
                        order_type: this.checkoutData.order_type,
                        table_number: this.checkoutData.table_number || this.customerLocation || 'توصيل',
                        items: this.cart
                    })
                });
                const res = await response.json();
                if (res.status === 'success') {
                    window.location.href = '/track/' + res.order_number;
                } else {
                    alert('خطأ: ' + (res.message || 'تعذر تسجيل الطلب'));
                }
            } catch (err) {
                alert('خطأ في الاتصال، حاول مرة أخرى');
            } finally { this.isSubmitting = false; }
        }
    }
}
</script>

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

<!-- Mobile Sticky Order Bar -->
<div class="mobile-cart-bar" x-show="cartTotalCount() > 0" @click="cartOpen = true" style="display:none;">
    <div style="display:flex;align-items:center;gap:10px;">
        <i class="fas fa-shopping-bag"></i>
        <span>عرض السلة (<span x-text="cartTotalCount()"></span>)</span>
    </div>
    <div style="display:flex;align-items:center;gap:8px;">
        <span x-text="cartTotalPrice() + ' ج.م'"></span>
        <i class="fas fa-arrow-left"></i>
    </div>
</div>
</body>
</html>

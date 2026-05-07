<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg-deep:    #06040f;
            --bg-mid:     #0d0820;
            --bg-card:    rgba(255,255,255,0.04);
            --purple:     #7c3aed;
            --purple-lt:  #a78bfa;
            --blue:       #3b82f6;
            --gold:       #f59e0b;
            --text-main:  #f0eaff;
            --text-muted: rgba(196,181,253,0.6);
            --border:     rgba(139,92,246,0.25);
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg-deep);
            color: var(--text-main);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ─── STARS ─────────────────────────────────────── */
        #stars-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        /* ─── AMBIENT ORBS ───────────────────────────────── */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            pointer-events: none;
            z-index: 0;
        }
        .orb-1 { width: 500px; height: 500px; background: rgba(124,58,237,0.12); top: -150px; left: -150px; }
        .orb-2 { width: 400px; height: 400px; background: rgba(59,130,246,0.10); bottom: -100px; right: -100px; }
        .orb-3 { width: 300px; height: 300px; background: rgba(245,158,11,0.06); top: 40%; left: 50%; transform: translate(-50%,-50%); }

        /* ─── NAVBAR ─────────────────────────────────────── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(6,4,15,0.7);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .nav-brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--purple), var(--blue));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .nav-brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.1;
        }
        .nav-brand-sub {
            font-size: 10px;
            color: var(--text-muted);
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }
        .nav-links a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.25s ease;
            color: rgba(196,181,253,0.8);
            border: 1px solid transparent;
        }
        .nav-links a:hover {
            color: var(--text-main);
            background: rgba(139,92,246,0.15);
            border-color: var(--border);
        }
        .nav-links .btn-login {
            border-color: var(--border);
        }
        .nav-links .btn-register {
            background: linear-gradient(135deg, var(--purple), #4f46e5);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(124,58,237,0.35);
        }
        .nav-links .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 22px rgba(124,58,237,0.55);
            background: linear-gradient(135deg, #6d28d9, var(--purple));
        }

        /* Hamburger (mobile) */
        .nav-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 6px;
        }
        .nav-toggle span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--purple-lt);
            border-radius: 2px;
            transition: all 0.3s;
        }

        /* ─── HERO ───────────────────────────────────────── */
        .hero {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 140px 2rem 60px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(124,58,237,0.18);
            border: 1px solid rgba(124,58,237,0.45);
            color: var(--purple-lt);
            font-size: 12px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 7px 20px;
            border-radius: 50px;
            margin-bottom: 2rem;
            animation: fadeUp 0.8s ease both;
        }
        .hero-badge::before { content: '✦'; color: var(--gold); }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.8rem, 6vw, 5.5rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.25rem;
            animation: fadeUp 0.8s 0.1s ease both;
        }
        .hero-title .line1 {
            display: block;
            background: linear-gradient(135deg, #e9d5ff 0%, var(--purple-lt) 50%, #93c5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-title .line2 {
            display: block;
            color: rgba(255,255,255,0.9);
        }

        .hero-desc {
            font-size: clamp(0.95rem, 2vw, 1.15rem);
            color: var(--text-muted);
            max-width: 520px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
            animation: fadeUp 0.8s 0.2s ease both;
        }

        /* ─── SEARCH ─────────────────────────────────────── */
        .search-wrap {
            position: relative;
            z-index: 10;
            max-width: 540px;
            margin: 0 auto 3rem;
            padding: 0 1rem;
            animation: fadeUp 0.8s 0.3s ease both;
        }
        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            border-radius: 60px;
            padding: 10px 10px 10px 22px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .search-box:focus-within {
            border-color: rgba(139,92,246,0.6);
            box-shadow: 0 0 0 4px rgba(124,58,237,0.12);
        }
        .search-box input {
            flex: 1;
            background: none;
            border: none;
            outline: none;
            color: var(--text-main);
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
        }
        .search-box input::placeholder { color: rgba(196,181,253,0.3); }
        .search-submit {
            background: linear-gradient(135deg, var(--purple), #4f46e5);
            border: none;
            color: white;
            padding: 9px 22px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.25s;
            white-space: nowrap;
        }
        .search-submit:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 16px rgba(124,58,237,0.5);
        }

        /* ─── 3D BOOKSHELF ───────────────────────────────── */
        .shelf-scene {
            position: relative;
            z-index: 10;
            perspective: 1000px;
            max-width: 780px;
            margin: 0 auto 1.5rem;
            padding: 0 1rem;
            animation: fadeUp 0.8s 0.4s ease both;
        }
        .shelf-inner {
            transform: rotateX(8deg) rotateY(-4deg);
            transform-style: preserve-3d;
            animation: floatShelf 7s ease-in-out infinite;
        }
        @keyframes floatShelf {
            0%,100% { transform: rotateX(8deg) rotateY(-4deg); }
            50%      { transform: rotateX(10deg) rotateY(4deg); }
        }
        .shelf-row {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 7px;
            padding: 0 16px;
            transform-style: preserve-3d;
        }
        .shelf-plank {
            width: 100%;
            height: 13px;
            background: linear-gradient(180deg, #8b6340 0%, #5c3e22 60%, #3c2610 100%);
            border-radius: 3px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.7), 0 2px 0 rgba(255,210,120,0.07) inset;
            margin-top: -1px;
        }
        .shelf-plank::after {
            content: '';
            display: block;
            height: 10px;
            background: linear-gradient(180deg, rgba(0,0,0,0.45), transparent);
            border-radius: 0 0 3px 3px;
            margin-top: 13px;
        }

        /* Individual book */
        .book {
            position: relative;
            transform-style: preserve-3d;
            cursor: pointer;
            flex-shrink: 0;
            transition: transform 0.4s cubic-bezier(.34,1.56,.64,1);
        }
        .book:hover { transform: translateY(-24px) translateZ(20px) rotateY(-18deg); }

        .book-spine {
            position: relative;
            overflow: hidden;
            border-radius: 2px 0 0 2px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .book-spine::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(255,255,255,0.18) 0%, transparent 35%, rgba(0,0,0,0.25) 100%);
        }
        .book-label {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
            font-size: 9.5px;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
            letter-spacing: 0.8px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.7);
            padding: 8px 0;
            font-family: 'DM Sans', sans-serif;
            position: relative;
            z-index: 1;
        }
        .book-pages {
            position: absolute;
            right: -5px; top: 3px; bottom: 3px;
            width: 5px;
            background: repeating-linear-gradient(180deg, #e8dfc8 0px, #e8dfc8 1px, #d4c9af 2px, #e8dfc8 3px);
            border-radius: 0 1px 1px 0;
            transform: rotateY(90deg) translateZ(-3px);
        }
        .book-top {
            position: absolute;
            top: -5px; left: 2px; right: -4px;
            height: 6px;
            border-radius: 1px;
        }

        /* ─── CTA BUTTONS ────────────────────────────────── */
        .cta-row {
            position: relative;
            z-index: 10;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
            padding: 1.5rem 1rem 3rem;
            animation: fadeUp 0.8s 0.5s ease both;
        }
        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 26px;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .cta-primary {
            background: linear-gradient(135deg, var(--purple), #4f46e5);
            color: white;
            box-shadow: 0 4px 22px rgba(124,58,237,0.45);
        }
        .cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 32px rgba(124,58,237,0.65);
        }
        .cta-ghost {
            background: rgba(255,255,255,0.05);
            color: rgba(196,181,253,0.85);
            border: 1px solid var(--border);
        }
        .cta-ghost:hover {
            background: rgba(139,92,246,0.14);
            transform: translateY(-2px);
            color: var(--text-main);
        }

        /* ─── STATS ──────────────────────────────────────── */
        .stats {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            margin: 0 2rem 4rem;
            animation: fadeUp 0.8s 0.6s ease both;
        }
        .stat {
            text-align: center;
            padding: 1.5rem 2.5rem;
            border-right: 1px solid var(--border);
        }
        .stat:last-child { border-right: none; }
        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #c084fc, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-label {
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: 3px;
        }

        /* ─── CATEGORY CARDS ─────────────────────────────── */
        .section {
            position: relative;
            z-index: 10;
            max-width: 900px;
            margin: 0 auto 5rem;
            padding: 0 2rem;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }
        .section-sub {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 1.75rem;
            letter-spacing: 0.5px;
        }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 12px;
        }
        .cat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }
        .cat-card:hover {
            transform: translateY(-4px);
            border-color: rgba(139,92,246,0.5);
            background: rgba(139,92,246,0.08);
            box-shadow: 0 8px 24px rgba(124,58,237,0.2);
        }
        .cat-icon { font-size: 28px; margin-bottom: 8px; display: block; }
        .cat-name { font-size: 13px; font-weight: 600; margin-bottom: 2px; }
        .cat-count { font-size: 11px; color: var(--text-muted); }

        /* ─── FOOTER ─────────────────────────────────────── */
        footer {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 2rem;
            border-top: 1px solid var(--border);
            font-size: 13px;
            color: var(--text-muted);
        }
        footer a { color: var(--purple-lt); text-decoration: none; }
        footer a:hover { text-decoration: underline; }

        /* ─── ANIMATIONS ─────────────────────────────────── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── RESPONSIVE ─────────────────────────────────── */
        @media (max-width: 640px) {
            .nav-links { display: none; }
            .nav-links.open {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 64px; left: 0; right: 0;
                background: rgba(6,4,15,0.97);
                padding: 1rem;
                border-bottom: 1px solid var(--border);
                gap: 8px;
            }
            .nav-links.open a { width: 100%; justify-content: center; }
            .nav-toggle { display: flex; }
            .stat { padding: 1rem 1.5rem; }
            .shelf-scene { overflow-x: auto; }
        }
    </style>
</head>
<body>

<!-- Ambient effects -->
<canvas id="stars-canvas"></canvas>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>

<!-- ═══════════════════════════════ NAVBAR ════════════════════════════════ -->
<nav>
    <a href="{{ url('/') }}" class="nav-brand">
        <div class="nav-brand-icon">📚</div>
        <div>
            <div class="nav-brand-text">Bookify</div>
            <div class="nav-brand-sub">beli buku online</div>
        </div>
    </a>

    <ul class="nav-links" id="navLinks">
        <li><a href="{{ url('/katalog') }}">Katalog</a></li>
        <li><a href="{{ url('/tentang') }}">Tentang</a></li>

        @auth
            {{-- Jika sudah login tampilkan dashboard & logout --}}
            <li>
                <a href="{{ url('/dashboard') }}">
                    👤 {{ Auth::user()->name }}
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="btn-login">
                        Keluar
                    </a>
                </form>
            </li>
        @else
            {{-- Belum login: tampilkan login & register --}}
            <li>
                <a href="{{ route('login') }}" class="btn-login">
                    Masuk
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="btn-register">
                     Daftar
                </a>
            </li>
        @endauth
    </ul>

    <!-- Mobile toggle -->
    <div class="nav-toggle" id="navToggle" onclick="toggleNav()">
        <span></span><span></span><span></span>
    </div>
</nav>

<!-- ═══════════════════════════════ HERO ═════════════════════════════════ -->
<section class="hero">
    <div class="hero-badge">Platform Beli Buku Online</div>
    <h1 class="hero-title">
        <span class="line1">Temukan Buku Favorit,</span>
        <span class="line2">Mulai Petualanganmu.</span>
    </h1>
    <p class="hero-desc">
        Jelajahi ribuan buku dari berbagai kategori.
        Beli buku dengan mudah, cepat, dan terpercaya.
    </p>
</section>

<!-- ═══════════════════════════════ SEARCH ═══════════════════════════════ -->
<div class="search-wrap">
    <form method="GET" action="{{ url('/katalog') }}">
        <div class="search-box">
            <span style="font-size:18px; color:rgba(139,92,246,0.6);">🔍</span>
            <input
                type="text"
                name="q"
                placeholder="Cari judul, penulis, atau kategori..."
                value="{{ request('q') }}"
            />
            <button type="submit" class="search-submit">Cari Buku</button>
        </div>
    </form>
</div>

<!-- ═══════════════════════════════ BOOKSHELF ════════════════════════════ -->
<div class="shelf-scene">
    <div class="shelf-inner">
        <div class="shelf-row" id="shelfRow"></div>
        <div class="shelf-plank"></div>
    </div>
</div>

<!-- ═══════════════════════════════ CTA BUTTONS ══════════════════════════ -->
<div class="cta-row">
    <a href="{{ url('/katalog') }}" class="cta-btn cta-primary">📖 Jelajahi Koleksi</a>
    <a href="{{ url('/pinjam') }}"  class="cta-btn cta-ghost">🔖 Beli Buku</a>
    @guest
    @endguest
</div>

<!-- ═══════════════════════════════ STATS ════════════════════════════════ -->
<div class="stats">
    <div class="stat">
        <div class="stat-num">12,450</div>
        <div class="stat-label">Koleksi Buku</div>
    </div>
    <div class="stat">
        <div class="stat-num">3,200</div>
        <div class="stat-label">Pengguna Aktif</div>
    </div>
    <div class="stat">
        <div class="stat-num">850</div>
        <div class="stat-label">Buku Tersedia</div>
    </div>
    <div class="stat">
        <div class="stat-num">24/7</div>
        <div class="stat-label">Akses Digital</div>
    </div>
</div>

<!-- ═══════════════════════════════ KATEGORI ═════════════════════════════ -->
<div class="section">
    <h2 class="section-title">Jelajahi Kategori</h2>
    <p class="section-sub">Pilih kategori favorit Anda</p>
    <div class="cards-grid">
        <a href="{{ url('/katalog?kategori=fiksi') }}" class="cat-card">
            <span class="cat-icon">📖</span>
            <div class="cat-name">Fiksi &amp; Novel</div>
            <div class="cat-count">1.240 buku</div>
        </a>
        <a href="{{ url('/katalog?kategori=sains') }}" class="cat-card">
            <span class="cat-icon">🔬</span>
            <div class="cat-name">Sains &amp; Teknologi</div>
            <div class="cat-count">980 buku</div>
        </a>
        <a href="{{ url('/katalog?kategori=sejarah') }}" class="cat-card">
            <span class="cat-icon">🏛️</span>
            <div class="cat-name">Sejarah</div>
            <div class="cat-count">720 buku</div>
        </a>
        <a href="{{ url('/katalog?kategori=bisnis') }}" class="cat-card">
            <span class="cat-icon">💼</span>
            <div class="cat-name">Bisnis &amp; Ekonomi</div>
            <div class="cat-count">654 buku</div>
        </a>
        <a href="{{ url('/katalog?kategori=agama') }}" class="cat-card">
            <span class="cat-icon">🕌</span>
            <div class="cat-name">Agama &amp; Spiritual</div>
            <div class="cat-count">530 buku</div>
        </a>
        <a href="{{ url('/katalog?kategori=anak') }}" class="cat-card">
            <span class="cat-icon">🧒</span>
            <div class="cat-name">Buku Anak</div>
            <div class="cat-count">460 buku</div>
        </a>
        <a href="{{ url('/katalog?kategori=jurnal') }}" class="cat-card">
            <span class="cat-icon">📝</span>
            <div class="cat-name">Jurnal &amp; Riset</div>
            <div class="cat-count">310 buku</div>
        </a>
        <a href="{{ url('/katalog') }}" class="cat-card" style="border-style:dashed;">
            <span class="cat-icon">🗂️</span>
            <div class="cat-name">Semua Kategori</div>
            <div class="cat-count">Lihat selengkapnya →</div>
        </a>
    </div>
</div>

<!-- ═══════════════════════════════ FOOTER ═══════════════════════════════ -->
<footer>
    <p>© {{ date('Y') }} Bookify · Dibangun dengan ❤️ menggunakan
        <a href="https://laravel.com" target="_blank">Laravel</a>
    </p>
</footer>

<!-- ═══════════════════════════════ SCRIPTS ══════════════════════════════ -->
<script>
/* ── Stars canvas ── */
(function() {
    const c  = document.getElementById('stars-canvas');
    const cx = c.getContext('2d');
    function resize() { c.width = innerWidth; c.height = innerHeight; }
    resize();
    window.addEventListener('resize', resize);

    const stars = Array.from({ length: 120 }, () => ({
        x: Math.random(), y: Math.random(),
        r: Math.random() * 1.4 + 0.3,
        a: Math.random(),
        s: 0.003 + Math.random() * 0.007,
        d: Math.random() > 0.5 ? 1 : -1
    }));

    function draw() {
        cx.clearRect(0, 0, c.width, c.height);
        stars.forEach(s => {
            s.a += s.s * s.d;
            if (s.a > 1 || s.a < 0.1) s.d *= -1;
            cx.beginPath();
            cx.arc(s.x * c.width, s.y * c.height, s.r, 0, Math.PI * 2);
            cx.fillStyle = `rgba(220,210,255,${s.a})`;
            cx.fill();
        });
        requestAnimationFrame(draw);
    }
    draw();
})();

/* ── Build book shelf ── */
(function() {
    const booksData = [
        { title: 'Sejarah Nusantara',   color: '#5b21b6', top: '#4c1d95', h: 135, w: 26 },
        { title: 'Fiksi Sains',          color: '#1d4ed8', top: '#1e3a8a', h: 112, w: 22 },
        { title: 'Puisi Indonesia',      color: '#065f46', top: '#064e3b', h: 122, w: 20 },
        { title: 'Filsafat Timur',       color: '#78350f', top: '#451a03', h: 148, w: 28 },
        { title: 'Teknologi 2024',       color: '#831843', top: '#500724', h: 119, w: 24 },
        { title: 'Ekonomi Global',       color: '#134e4a', top: '#042f2e', h: 133, w: 26 },
        { title: 'Novel Klasik',         color: '#3b0764', top: '#2e1065', h: 126, w: 22 },
        { title: 'Sains & Alam',         color: '#14532d', top: '#052e16', h: 142, w: 30 },
        { title: 'Hukum & HAM',          color: '#7f1d1d', top: '#450a0a', h: 116, w: 20 },
        { title: 'Psikologi',            color: '#1e3a5f', top: '#0c1a2e', h: 130, w: 24 },
        { title: 'Biografi Tokoh',       color: '#312e81', top: '#1e1b4b', h: 140, w: 26 },
        { title: 'Kuliner Nusantara',    color: '#431407', top: '#7c2d12', h: 114, w: 22 },
    ];

    const shelf = document.getElementById('shelfRow');
    booksData.forEach(b => {
        const el = document.createElement('div');
        el.className = 'book';
        el.style.cssText = `width:${b.w}px; height:${b.h}px;`;
        el.innerHTML = `
            <div class="book-spine" style="width:${b.w}px;height:${b.h}px;background:linear-gradient(90deg,${b.color},${b.top});">
                <span class="book-label">${b.title}</span>
            </div>
            <div class="book-pages"></div>
            <div class="book-top" style="background:linear-gradient(90deg,${b.color},${b.top});"></div>
        `;
        shelf.appendChild(el);
    });
})();

/* ── Mobile nav toggle ── */
function toggleNav() {
    document.getElementById('navLinks').classList.toggle('open');
}
</script>

</body>
</html>
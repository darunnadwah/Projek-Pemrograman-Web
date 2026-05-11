<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bookify</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #050510;
            --bg-mid: #0a0a1f;
            --bg-card: rgba(255,255,255,0.04);
            --bg-card-hover: rgba(255,255,255,0.07);
            --border: rgba(255,255,255,0.08);
            --border-hover: rgba(138,99,255,0.4);
            --purple: #7c3aed;
            --purple-light: #a78bfa;
            --purple-glow: rgba(124,58,237,0.25);
            --accent: #c4b5fd;
            --text-primary: #f1f0ff;
            --text-secondary: #9490b5;
            --text-muted: #5c5880;
            --star: rgba(255,255,255,0.6);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-deep);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── STARFIELD ── */
        .starfield {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .starfield::before, .starfield::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(1px 1px at 10% 15%, var(--star) 0%, transparent 100%),
                radial-gradient(1px 1px at 25% 40%, rgba(255,255,255,0.4) 0%, transparent 100%),
                radial-gradient(1.5px 1.5px at 40% 8%, var(--star) 0%, transparent 100%),
                radial-gradient(1px 1px at 55% 55%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 70% 22%, var(--star) 0%, transparent 100%),
                radial-gradient(1.5px 1.5px at 85% 70%, rgba(255,255,255,0.5) 0%, transparent 100%),
                radial-gradient(1px 1px at 15% 80%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 92% 12%, var(--star) 0%, transparent 100%),
                radial-gradient(1px 1px at 60% 88%, rgba(255,255,255,0.4) 0%, transparent 100%),
                radial-gradient(1.5px 1.5px at 33% 65%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 78% 45%, var(--star) 0%, transparent 100%),
                radial-gradient(1px 1px at 5% 55%, rgba(255,255,255,0.35) 0%, transparent 100%),
                radial-gradient(1px 1px at 47% 30%, rgba(255,255,255,0.4) 0%, transparent 100%),
                radial-gradient(1.5px 1.5px at 20% 95%, var(--star) 0%, transparent 100%),
                radial-gradient(1px 1px at 65% 5%, rgba(255,255,255,0.5) 0%, transparent 100%);
        }
        .starfield::after {
            background-image:
                radial-gradient(1px 1px at 8% 35%, rgba(200,180,255,0.4) 0%, transparent 100%),
                radial-gradient(1px 1px at 30% 72%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1.5px 1.5px at 50% 50%, rgba(200,180,255,0.5) 0%, transparent 100%),
                radial-gradient(1px 1px at 75% 85%, rgba(255,255,255,0.4) 0%, transparent 100%),
                radial-gradient(1px 1px at 90% 40%, rgba(200,180,255,0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 18% 60%, rgba(255,255,255,0.35) 0%, transparent 100%),
                radial-gradient(1.5px 1.5px at 42% 18%, rgba(200,180,255,0.4) 0%, transparent 100%),
                radial-gradient(1px 1px at 62% 75%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 88% 25%, rgba(200,180,255,0.5) 0%, transparent 100%);
            animation: twinkle 6s ease-in-out infinite alternate;
        }
        @keyframes twinkle {
            0% { opacity: 0.6; }
            100% { opacity: 1; }
        }

        /* Ambient glow blobs */
        .glow-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
        }
        .glow-blob-1 {
            width: 500px; height: 400px;
            background: radial-gradient(circle, rgba(124,58,237,0.12) 0%, transparent 70%);
            top: -100px; left: -100px;
        }
        .glow-blob-2 {
            width: 400px; height: 350px;
            background: radial-gradient(circle, rgba(91,33,182,0.1) 0%, transparent 70%);
            bottom: 20%; right: -80px;
        }

        /* ── NAVBAR ── */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2.5rem;
            height: 64px;
            background: rgba(5,5,16,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .nav-logo {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }
        .nav-brand-text { line-height: 1.1; }
        .nav-brand-text strong {
            display: block;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: 0.02em;
        }
        .nav-brand-text span {
            font-size: 0.6rem;
            color: var(--text-muted);
            letter-spacing: 0.12em;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.4rem 0.9rem;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-links a:hover, .nav-links a.active {
            color: var(--text-primary);
            background: rgba(255,255,255,0.06);
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .nav-cart {
            position: relative;
            width: 38px; height: 38px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 1rem;
        }
        .nav-cart:hover { border-color: var(--border-hover); color: var(--text-primary); }
        .cart-badge {
            position: absolute;
            top: -5px; right: -5px;
            background: var(--purple);
            color: white;
            font-size: 0.6rem;
            font-weight: 700;
            width: 17px; height: 17px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid var(--bg-deep);
        }
        .nav-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7c3aed, #c084fc);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid rgba(124,58,237,0.4);
        }

        /* ── LAYOUT ── */
        .layout {
            position: relative;
            z-index: 1;
            display: flex;
            min-height: calc(100vh - 64px);
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 220px;
            flex-shrink: 0;
            padding: 1.5rem 1rem;
            border-right: 1px solid var(--border);
            background: rgba(5,5,16,0.6);
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
        }
        .sidebar-section-label {
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            text-transform: uppercase;
            padding: 0 0.75rem;
            margin-bottom: 0.4rem;
            margin-top: 1.25rem;
        }
        .sidebar-section-label:first-child { margin-top: 0; }
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.55rem 0.75rem;
            border-radius: 9px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
        }
        .sidebar-item:hover {
            background: var(--bg-card-hover);
            color: var(--text-primary);
        }
        .sidebar-item.active {
            background: rgba(124,58,237,0.15);
            color: var(--accent);
            border: 1px solid rgba(124,58,237,0.25);
        }
        .sidebar-item .icon { font-size: 1rem; width: 20px; text-align: center; }
        .sidebar-badge {
            margin-left: auto;
            background: var(--purple);
            color: white;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 10px;
        }

        /* ── MAIN CONTENT ── */
        main {
            flex: 1;
            padding: 2rem 2.5rem;
            overflow-y: auto;
        }

        /* ── GREETING BANNER ── */
        .greeting-banner {
            background: linear-gradient(135deg, rgba(124,58,237,0.15) 0%, rgba(91,33,182,0.08) 50%, rgba(10,10,31,0) 100%);
            border: 1px solid rgba(124,58,237,0.2);
            border-radius: 18px;
            padding: 1.75rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .greeting-banner::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(124,58,237,0.2) 0%, transparent 70%);
            pointer-events: none;
        }
        .greeting-text .subtitle {
            font-size: 0.78rem;
            color: var(--purple-light);
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
        }
        .greeting-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--text-primary);
            line-height: 1.1;
        }
        .greeting-text h1 span { color: var(--accent); }
        .greeting-text p {
            margin-top: 0.4rem;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }
        .greeting-cta {
            display: flex;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        .btn-primary {
            background: var(--purple);
            color: white;
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-primary:hover {
            background: #6d28d9;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(124,58,237,0.35);
        }
        .btn-outline {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            padding: 0.6rem 1.25rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-outline:hover { border-color: var(--border-hover); color: var(--text-primary); }

        /* ── STATS GRID ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem;
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--purple), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .stat-card:hover {
            background: var(--bg-card-hover);
            border-color: rgba(124,58,237,0.25);
            transform: translateY(-2px);
        }
        .stat-card:hover::after { opacity: 1; }
        .stat-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 0.9rem;
        }
        .stat-icon.purple { background: rgba(124,58,237,0.2); }
        .stat-icon.blue { background: rgba(59,130,246,0.15); }
        .stat-icon.green { background: rgba(16,185,129,0.15); }
        .stat-icon.amber { background: rgba(245,158,11,0.15); }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 900;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 0.3rem;
        }
        .stat-label {
            font-size: 0.78rem;
            color: var(--text-secondary);
            font-weight: 500;
        }
        .stat-change {
            font-size: 0.72rem;
            margin-top: 0.4rem;
            display: flex;
            align-items: center;
            gap: 3px;
        }
        .stat-change.up { color: #34d399; }
        .stat-change.muted { color: var(--text-muted); }

        /* ── SECTION HEADER ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
        }
        .section-link {
            font-size: 0.78rem;
            color: var(--purple-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .section-link:hover { color: var(--accent); }

        /* ── TWO COL ── */
        .two-col { display: grid; grid-template-columns: 1fr 360px; gap: 1.5rem; margin-bottom: 2rem; }

        /* ── BOOK CARDS (Continue Reading) ── */
        .reading-list { display: flex; flex-direction: column; gap: 0.75rem; }
        .book-row {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.22s;
            cursor: pointer;
        }
        .book-row:hover {
            background: var(--bg-card-hover);
            border-color: var(--border-hover);
            transform: translateX(3px);
        }
        .book-thumb {
            width: 46px;
            height: 64px;
            border-radius: 7px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }
        .book-info { flex: 1; min-width: 0; }
        .book-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.15rem;
        }
        .book-author { font-size: 0.75rem; color: var(--text-muted); margin-bottom: 0.5rem; }
        .progress-bar-wrap {
            height: 4px;
            background: rgba(255,255,255,0.07);
            border-radius: 4px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, var(--purple), var(--purple-light));
            transition: width 0.5s ease;
        }
        .book-meta {
            text-align: right;
            flex-shrink: 0;
        }
        .book-pct { font-size: 0.78rem; color: var(--accent); font-weight: 600; }
        .book-pages { font-size: 0.68rem; color: var(--text-muted); margin-top: 2px; }
        .btn-read {
            margin-top: 0.4rem;
            background: rgba(124,58,237,0.15);
            border: 1px solid rgba(124,58,237,0.3);
            color: var(--purple-light);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }
        .btn-read:hover { background: rgba(124,58,237,0.25); color: var(--accent); }

        /* ── ORDER HISTORY (right col) ── */
        .order-list { display: flex; flex-direction: column; gap: 0.6rem; }
        .order-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 0.9rem 1rem;
            transition: all 0.2s;
        }
        .order-item:hover { background: var(--bg-card-hover); border-color: rgba(124,58,237,0.2); }
        .order-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.45rem;
        }
        .order-id { font-size: 0.7rem; color: var(--text-muted); font-weight: 500; }
        .order-status {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            letter-spacing: 0.04em;
        }
        .status-delivered { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.2); }
        .status-shipping  { background: rgba(59,130,246,0.15); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); }
        .status-processing{ background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); }
        .order-title {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .order-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-date { font-size: 0.7rem; color: var(--text-muted); }
        .order-price { font-size: 0.82rem; font-weight: 700; color: var(--accent); }

        /* ── REKOMENDASI BOOKS ── */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .book-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
        }
        .book-card:hover {
            background: var(--bg-card-hover);
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(124,58,237,0.15);
        }
        .book-cover {
            width: 100%;
            aspect-ratio: 3/4;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 0.9rem;
            position: relative;
            overflow: hidden;
        }
        .book-cover-badge {
            position: absolute;
            top: 6px; right: 6px;
            background: var(--purple);
            color: white;
            font-size: 0.58rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 5px;
            letter-spacing: 0.04em;
        }
        .book-card .book-title { font-size: 0.82rem; }
        .book-card .book-author { font-size: 0.72rem; margin-bottom: 0.5rem; }
        .book-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 0.5rem;
        }
        .stars { color: #fbbf24; font-size: 0.7rem; letter-spacing: 1px; }
        .rating-val { font-size: 0.7rem; color: var(--text-muted); }
        .book-price { font-size: 0.9rem; font-weight: 700; color: var(--text-primary); }
        .book-price-old { font-size: 0.7rem; color: var(--text-muted); text-decoration: line-through; margin-left: 4px; }
        .book-add-btn {
            margin-top: 0.65rem;
            width: 100%;
            background: rgba(124,58,237,0.12);
            border: 1px solid rgba(124,58,237,0.25);
            color: var(--purple-light);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.45rem;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }
        .book-add-btn:hover {
            background: var(--purple);
            color: white;
            border-color: var(--purple);
        }

        /* ── WISHLIST & KATEGORI ROW ── */
        .bottom-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; }

        .wishlist-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem; }
        .wishlist-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem;
            display: flex;
            gap: 0.65rem;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .wishlist-item:hover { background: var(--bg-card-hover); border-color: rgba(124,58,237,0.2); }
        .wish-cover {
            width: 36px; height: 48px;
            border-radius: 5px;
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .wish-title { font-size: 0.75rem; font-weight: 600; color: var(--text-primary); line-height: 1.3; }
        .wish-price { font-size: 0.7rem; color: var(--accent); font-weight: 600; margin-top: 2px; }

        .category-list { display: flex; flex-direction: column; gap: 0.5rem; }
        .category-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .category-item:hover { background: var(--bg-card-hover); border-color: rgba(124,58,237,0.2); }
        .cat-icon { font-size: 1.1rem; width: 28px; text-align: center; }
        .cat-name { font-size: 0.83rem; font-weight: 500; color: var(--text-primary); flex: 1; }
        .cat-count { font-size: 0.7rem; color: var(--text-muted); }
        .cat-arrow { color: var(--text-muted); font-size: 0.7rem; }

        /* ── PROMO BANNER ── */
        .promo-banner {
            background: linear-gradient(135deg, rgba(124,58,237,0.2) 0%, rgba(168,85,247,0.1) 50%, rgba(91,33,182,0.15) 100%);
            border: 1px solid rgba(124,58,237,0.3);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .promo-banner::before {
            content: '✦';
            position: absolute;
            font-size: 8rem;
            color: rgba(124,58,237,0.08);
            right: 160px;
            top: -20px;
        }
        .promo-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(124,58,237,0.2);
            border: 1px solid rgba(124,58,237,0.3);
            border-radius: 20px;
            padding: 3px 12px;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--purple-light);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        .promo-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }
        .promo-sub { font-size: 0.82rem; color: var(--text-secondary); }

        /* ── RESPONSIVE ── */
        @media (max-width: 1200px) {
            .books-grid { grid-template-columns: repeat(4, 1fr); }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 900px) {
            .two-col { grid-template-columns: 1fr; }
            .bottom-row { grid-template-columns: 1fr; }
            .sidebar { display: none; }
            .books-grid { grid-template-columns: repeat(3, 1fr); }
        }

        /* ── SCROLL ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(124,58,237,0.25); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(124,58,237,0.4); }

        /* Entry animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.5s ease forwards; opacity: 0; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.12s; }
        .delay-3 { animation-delay: 0.2s; }
        .delay-4 { animation-delay: 0.28s; }
    </style>
</head>
<body>

<div class="starfield"></div>
<div class="glow-blob glow-blob-1"></div>
<div class="glow-blob glow-blob-2"></div>

<!-- NAVBAR -->
<nav>
    <a href="/" class="nav-brand">
        <div class="nav-logo">📚</div>
        <div class="nav-brand-text">
            <strong>Bookify</strong>
            <span>BELI BUKU ONLINE</span>
        </div>
    </a>

    <div class="nav-links">
        <a href="#" class="active">Dashboard</a>
        <a href="#">Katalog</a>
        <a href="#">Pesanan</a>
        <a href="#">Wishlist</a>
    </div>

    <div class="nav-right">
        <a href="#" class="nav-cart">
            🛒
            <span class="cart-badge">3</span>
        </a>
        <div class="nav-avatar">RS</div>
    </div>
</nav>

<!-- LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-section-label">Menu</div>
        <a href="#" class="sidebar-item active">
            <span class="icon">🏠</span> Dashboard
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">📖</span> Sedang Dibaca
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">📦</span> Pesanan Saya
            <span class="sidebar-badge">2</span>
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">❤️</span> Wishlist
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">⭐</span> Ulasan Saya
        </a>

        <div class="sidebar-section-label">Jelajahi</div>
        <a href="#" class="sidebar-item">
            <span class="icon">🔮</span> Fiksi
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">🧠</span> Non-fiksi
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">💼</span> Bisnis
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">🌱</span> Self-help
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">🔬</span> Sains
        </a>

        <div class="sidebar-section-label">Akun</div>
        <a href="#" class="sidebar-item">
            <span class="icon">👤</span> Profil
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">⚙️</span> Pengaturan
        </a>
        <a href="#" class="sidebar-item">
            <span class="icon">🚪</span> Keluar
        </a>
    </aside>

    <!-- MAIN -->
    <main>

        <!-- Greeting Banner -->
        <div class="greeting-banner fade-up delay-1">
            <div class="greeting-text">
                <div class="subtitle">✦ Selamat Datang Kembali</div>
                <h1>Hai, <span>Nabila Alya Chalisa</span> 👋</h1>
                <p>Kamu punya 2 pesanan dalam perjalanan & 3 buku belum selesai dibaca.</p>
            </div>
            <div class="greeting-cta">
                <button class="btn-outline">Lacak Pesanan</button>
                <button class="btn-primary">Lanjut Membaca</button>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid fade-up delay-2">
            <div class="stat-card">
                <div class="stat-icon purple">📚</div>
                <div class="stat-value">24</div>
                <div class="stat-label">Total Buku Dibeli</div>
                <div class="stat-change up">↑ +3 bulan ini</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">📖</div>
                <div class="stat-value">3</div>
                <div class="stat-label">Sedang Dibaca</div>
                <div class="stat-change muted">dari 5 buku aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">✅</div>
                <div class="stat-value">18</div>
                <div class="stat-label">Buku Selesai</div>
                <div class="stat-change up">↑ 75% selesai rate</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon amber">❤️</div>
                <div class="stat-value">12</div>
                <div class="stat-label">Di Wishlist</div>
                <div class="stat-change muted">Rp 1,2jt est. total</div>
            </div>
        </div>

        <!-- Promo Banner -->
        <div class="promo-banner fade-up delay-3">
            <div>
                <div class="promo-tag">✦ Penawaran Terbatas</div>
                <div class="promo-title">Flash Sale Akhir Bulan — Diskon s/d 50%</div>
                <div class="promo-sub">Ribuan judul pilihan dengan harga terbaik. Berakhir dalam 2 hari 14 jam.</div>
            </div>
            <button class="btn-primary">Lihat Promo →</button>
        </div>

        <!-- Continue Reading + Recent Orders -->
        <div class="two-col fade-up delay-3">
            <div>
                <div class="section-header">
                    <div class="section-title">Lanjutkan Membaca</div>
                    <a href="#" class="section-link">Lihat semua →</a>
                </div>
                <div class="reading-list">
                    <div class="book-row">
                        <div class="book-thumb" style="background:rgba(124,58,237,0.15)">🌌</div>
                        <div class="book-info">
                            <div class="book-title">Sapiens: Riwayat Singkat Umat Manusia</div>
                            <div class="book-author">Yuval Noah Harari</div>
                            <div class="progress-bar-wrap"><div class="progress-bar-fill" style="width:68%"></div></div>
                        </div>
                        <div class="book-meta">
                            <div class="book-pct">68%</div>
                            <div class="book-pages">hal 272/400</div>
                            <button class="btn-read">Lanjut</button>
                        </div>
                    </div>
                    <div class="book-row">
                        <div class="book-thumb" style="background:rgba(16,185,129,0.12)">🌿</div>
                        <div class="book-info">
                            <div class="book-title">Atomic Habits</div>
                            <div class="book-author">James Clear</div>
                            <div class="progress-bar-wrap"><div class="progress-bar-fill" style="width:33%"></div></div>
                        </div>
                        <div class="book-meta">
                            <div class="book-pct">33%</div>
                            <div class="book-pages">hal 88/265</div>
                            <button class="btn-read">Lanjut</button>
                        </div>
                    </div>
                    <div class="book-row">
                        <div class="book-thumb" style="background:rgba(245,158,11,0.12)">🏆</div>
                        <div class="book-info">
                            <div class="book-title">The Psychology of Money</div>
                            <div class="book-author">Morgan Housel</div>
                            <div class="progress-bar-wrap"><div class="progress-bar-fill" style="width:12%"></div></div>
                        </div>
                        <div class="book-meta">
                            <div class="book-pct">12%</div>
                            <div class="book-pages">hal 25/209</div>
                            <button class="btn-read">Lanjut</button>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="section-header">
                    <div class="section-title">Pesanan Terbaru</div>
                    <a href="#" class="section-link">Lihat semua →</a>
                </div>
                <div class="order-list">
                    <div class="order-item">
                        <div class="order-top">
                            <div class="order-id">#BKF-20482</div>
                            <div class="order-status status-shipping">Dikirim</div>
                        </div>
                        <div class="order-title">Ikigai + The Almanack of Naval</div>
                        <div class="order-bottom">
                            <div class="order-date">8 Mei 2026</div>
                            <div class="order-price">Rp 178.000</div>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="order-top">
                            <div class="order-id">#BKF-20391</div>
                            <div class="order-status status-processing">Diproses</div>
                        </div>
                        <div class="order-title">Deep Work — Cal Newport</div>
                        <div class="order-bottom">
                            <div class="order-date">10 Mei 2026</div>
                            <div class="order-price">Rp 95.000</div>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="order-top">
                            <div class="order-id">#BKF-20104</div>
                            <div class="order-status status-delivered">Diterima</div>
                        </div>
                        <div class="order-title">Atomic Habits — James Clear</div>
                        <div class="order-bottom">
                            <div class="order-date">28 Apr 2026</div>
                            <div class="order-price">Rp 89.000</div>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="order-top">
                            <div class="order-id">#BKF-19875</div>
                            <div class="order-status status-delivered">Diterima</div>
                        </div>
                        <div class="order-title">Sapiens — Yuval Noah Harari</div>
                        <div class="order-bottom">
                            <div class="order-date">15 Apr 2026</div>
                            <div class="order-price">Rp 135.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekomendasi Buku -->
        <div class="fade-up delay-4">
            <div class="section-header">
                <div class="section-title">Rekomendasi Untukmu</div>
                <a href="#" class="section-link">Lihat semua →</a>
            </div>
            <div class="books-grid">
                <div class="book-card">
                    <div class="book-cover" style="background:rgba(124,58,237,0.15)">
                        🔮<span class="book-cover-badge">BARU</span>
                    </div>
                    <div class="book-title">The Midnight Library</div>
                    <div class="book-author">Matt Haig</div>
                    <div class="book-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-val">4.8</span>
                    </div>
                    <div><span class="book-price">Rp 115.000</span></div>
                    <button class="book-add-btn">+ Keranjang</button>
                </div>
                <div class="book-card">
                    <div class="book-cover" style="background:rgba(59,130,246,0.12)">
                        🌊
                    </div>
                    <div class="book-title">Project Hail Mary</div>
                    <div class="book-author">Andy Weir</div>
                    <div class="book-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-val">4.9</span>
                    </div>
                    <div><span class="book-price">Rp 128.000</span><span class="book-price-old">Rp 160.000</span></div>
                    <button class="book-add-btn">+ Keranjang</button>
                </div>
                <div class="book-card">
                    <div class="book-cover" style="background:rgba(16,185,129,0.1)">
                        🌿<span class="book-cover-badge">SALE</span>
                    </div>
                    <div class="book-title">The Subtle Art of Not Giving a F*ck</div>
                    <div class="book-author">Mark Manson</div>
                    <div class="book-rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-val">4.3</span>
                    </div>
                    <div><span class="book-price">Rp 79.000</span><span class="book-price-old">Rp 110.000</span></div>
                    <button class="book-add-btn">+ Keranjang</button>
                </div>
                <div class="book-card">
                    <div class="book-cover" style="background:rgba(245,158,11,0.1)">
                        💡
                    </div>
                    <div class="book-title">Think Again</div>
                    <div class="book-author">Adam Grant</div>
                    <div class="book-rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-val">4.5</span>
                    </div>
                    <div><span class="book-price">Rp 105.000</span></div>
                    <button class="book-add-btn">+ Keranjang</button>
                </div>
                <div class="book-card">
                    <div class="book-cover" style="background:rgba(236,72,153,0.1)">
                        🌸<span class="book-cover-badge">BARU</span>
                    </div>
                    <div class="book-title">Fourth Wing</div>
                    <div class="book-author">Rebecca Yarros</div>
                    <div class="book-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-val">4.7</span>
                    </div>
                    <div><span class="book-price">Rp 145.000</span></div>
                    <button class="book-add-btn">+ Keranjang</button>
                </div>
            </div>
        </div>

        <!-- Wishlist + Kategori -->
        <div class="bottom-row fade-up delay-4">
            <div>
                <div class="section-header">
                    <div class="section-title">Wishlist Saya</div>
                    <a href="#" class="section-link">Kelola →</a>
                </div>
                <div class="wishlist-grid">
                    <div class="wishlist-item">
                        <div class="wish-cover" style="background:rgba(124,58,237,0.15)">🏰</div>
                        <div>
                            <div class="wish-title">The Name of the Wind</div>
                            <div class="wish-price">Rp 132.000</div>
                        </div>
                    </div>
                    <div class="wishlist-item">
                        <div class="wish-cover" style="background:rgba(16,185,129,0.12)">🧬</div>
                        <div>
                            <div class="wish-title">The Gene: An Intimate History</div>
                            <div class="wish-price">Rp 155.000</div>
                        </div>
                    </div>
                    <div class="wishlist-item">
                        <div class="wish-cover" style="background:rgba(59,130,246,0.12)">🚀</div>
                        <div>
                            <div class="wish-title">Elon Musk — Walter Isaacson</div>
                            <div class="wish-price">Rp 199.000</div>
                        </div>
                    </div>
                    <div class="wishlist-item">
                        <div class="wish-cover" style="background:rgba(245,158,11,0.12)">📊</div>
                        <div>
                            <div class="wish-title">The Lean Startup</div>
                            <div class="wish-price">Rp 98.000</div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="section-header">
                    <div class="section-title">Kategori Favoritmu</div>
                    <a href="#" class="section-link">Semua kategori →</a>
                </div>
                <div class="category-list">
                    <div class="category-item">
                        <div class="cat-icon">🔮</div>
                        <div class="cat-name">Fiksi & Fantasi</div>
                        <div class="cat-count">1.240 buku</div>
                        <div class="cat-arrow">›</div>
                    </div>
                    <div class="category-item">
                        <div class="cat-icon">🧠</div>
                        <div class="cat-name">Pengembangan Diri</div>
                        <div class="cat-count">870 buku</div>
                        <div class="cat-arrow">›</div>
                    </div>
                    <div class="category-item">
                        <div class="cat-icon">💼</div>
                        <div class="cat-name">Bisnis & Karir</div>
                        <div class="cat-count">650 buku</div>
                        <div class="cat-arrow">›</div>
                    </div>
                    <div class="category-item">
                        <div class="cat-icon">🔬</div>
                        <div class="cat-name">Sains & Teknologi</div>
                        <div class="cat-count">490 buku</div>
                        <div class="cat-arrow">›</div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

</body>
</html>
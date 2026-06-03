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
            color: white;
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
        .nav-avatar-link {
            text-decoration: none;
            color: inherit;
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
            color: white;
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
        .sidebar-item svg { width: 16px; height: 16px; flex-shrink: 0; }
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
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .greeting-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--text-primary);
            line-height: 1.1;
            display: flex;
            align-items: center;
            gap: 8px;
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
            z-index: 10;
        }
        .btn-link-action {
            text-decoration: none;
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
            display: inline-flex;
            align-items: center;
            gap: 6px;
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
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-outline:hover { border-color: var(--border-hover); color: var(--text-primary); }

        /* ── STATS GRID ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card-link {
            text-decoration: none;
            color: inherit;
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem;
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
            height: 100%;
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
            margin-bottom: 0.9rem;
        }
        .stat-icon svg { width: 18px; height: 18px; color: white; }
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
            text-decoration: none;
            color: inherit;
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
            overflow: hidden;
        }
        .book-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
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
            margin-bottom: 0.9rem;
            position: relative;
            overflow: hidden;
            background: rgba(255,255,255,0.05);
        }
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            z-index: 2;
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
        .book-price-row {
            margin-top: auto;
        }
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
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
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
        }
        .wishlist-item:hover { background: var(--bg-card-hover); border-color: rgba(124,58,237,0.2); }
        .wish-cover {
            width: 36px; height: 48px;
            border-radius: 5px;
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            background: rgba(255,255,255,0.05);
        }
        .wish-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .wish-info { min-width: 0; flex: 1; }
        .wish-title { font-size: 0.75rem; font-weight: 600; color: var(--text-primary); line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
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
            text-decoration: none;
            color: inherit;
        }
        .category-item:hover { background: var(--bg-card-hover); border-color: rgba(124,58,237,0.2); }
        .cat-icon { width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; }
        .cat-icon svg { width: 18px; height: 18px; color: var(--purple-light); }
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

        /* Empty states */
        .empty-state-small {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            border: 1px dashed rgba(255,255,255,0.05);
            border-radius: 10px;
        }
        .empty-state-small svg {
            width: 24px;
            height: 24px;
            margin-bottom: 8px;
            color: var(--text-muted);
            opacity: 0.5;
        }

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
    <a href="{{ url('/') }}" class="nav-brand">
        <div class="nav-logo">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
        </div>
        <div class="nav-brand-text">
            <strong>Bookify</strong>
            <span>BELI BUKU ONLINE</span>
        </div>
    </a>

    <div class="nav-links">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('books.index') }}">Katalog</a>
        <a href="{{ route('orders.index') }}">Pesanan</a>
        <a href="{{ route('wishlist.index') }}">Wishlist</a>
    </div>

    <div class="nav-right">
        <a href="{{ route('cart.index') }}" class="nav-cart">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            <span class="cart-badge">{{ count((array) session('cart', [])) }}</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="nav-avatar-link">
            <div class="nav-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
        </a>
    </div>
</nav>

<!-- LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-section-label">Menu</div>
        <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="{{ route('reading.index') }}" class="sidebar-item {{ request()->routeIs('reading.index') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Sedang Dibaca
        </a>
        <a href="{{ route('orders.index') }}" class="sidebar-item {{ request()->routeIs('orders.index') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Pesanan Saya
            @if($stats['purchased_count'] > 0)
                <span class="sidebar-badge">{{ $stats['purchased_count'] }}</span>
            @endif
        </a>
        <a href="{{ route('wishlist.index') }}" class="sidebar-item {{ request()->routeIs('wishlist.index') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            Wishlist
        </a>

        <div class="sidebar-section-label">Jelajahi</div>
        <a href="{{ route('books.index', ['category' => [1]]) }}" class="sidebar-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.905 0-5.64-.78-8.006-2.147m16.012 0a11.953 11.953 0 0 0-8.006 2.147"/></svg>
            Fiksi & Novel
        </a>
        <a href="{{ route('books.index', ['category' => [2]]) }}" class="sidebar-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            Sains & Teknologi
        </a>
        <a href="{{ route('books.index', ['category' => [4]]) }}" class="sidebar-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="7" width="18" height="13" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            Bisnis & Ekonomi
        </a>

        <div class="sidebar-section-label">Akun</div>
        <a href="{{ route('profile.edit') }}" class="sidebar-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Profil
        </a>
        <a href="{{ route('settings.index') }}" class="sidebar-item {{ request()->routeIs('settings.index') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33 1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            Pengaturan
        </a>

        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
            @csrf
        </form>
        <a href="{{ route('logout') }}" 
           class="sidebar-item logout-item" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
            Keluar
        </a>       
    </aside>

    <!-- MAIN -->
    <main>

        <!-- Greeting Banner -->
        <div class="greeting-banner fade-up delay-1">
            <div class="greeting-text">
                <div class="subtitle">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Selamat Datang Kembali
                </div>
                <h1>Hai, <span>{{ Auth::user()->name }}</span> 
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-left: 6px;"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </h1>
                <p>Kamu memiliki {{ $stats['purchased_count'] }} transaksi di Bookify &amp; {{ $stats['reading_count'] }} buku aktif dalam progres membaca.</p>
            </div>
            <div class="greeting-cta">
                <a href="{{ route('orders.index') }}" class="btn-link-action">
                    <button class="btn-outline">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                        Lacak Pesanan
                    </button>
                </a>
                <a href="{{ route('reading.index') }}" class="btn-link-action">
                    <button class="btn-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15z"/></svg>
                        Lanjut Membaca
                    </button>
                </a>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid fade-up delay-2">
            <a href="{{ route('orders.index') }}" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div class="stat-value">{{ $stats['purchased_count'] }}</div>
                    <div class="stat-label">Total Buku Dibeli</div>
                    <div class="stat-change up">Transaksi Sukses</div>
                </div>
            </a>
            <a href="{{ route('reading.index') }}" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="stat-value">{{ $stats['reading_count'] }}</div>
                    <div class="stat-label">Sedang Dibaca</div>
                    <div class="stat-change muted">buku aktif saat ini</div>
                </div>
            </a>
            <a href="{{ route('reading.index') }}" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="stat-value">{{ $stats['finished_count'] }}</div>
                    <div class="stat-label">Buku Selesai</div>
                    <div class="stat-change up">Telah selesai dibaca</div>
                </div>
            </a>
            <a href="{{ route('wishlist.index') }}" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon amber">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div class="stat-value">{{ $stats['wishlist_count'] }}</div>
                    <div class="stat-label">Di Wishlist</div>
                    <div class="stat-change muted">Buku diincar</div>
                </div>
            </a>
        </div>

        <!-- Promo Banner -->
        <div class="promo-banner fade-up delay-3">
            <div>
                <div class="promo-tag">✦ Penawaran Terbatas</div>
                <div class="promo-title">Flash Sale Akhir Bulan — Diskon s/d 50%</div>
                <div class="promo-sub">Ribuan judul pilihan dengan harga terbaik. Jelajahi katalog sekarang juga.</div>
            </div>
            <a href="{{ route('books.index') }}">
                <button class="btn-primary">Lihat Promo →</button>
            </a>
        </div>

        <!-- Continue Reading + Recent Orders -->
        <div class="two-col fade-up delay-3">
            <div>
                <div class="section-header">
                    <div class="section-title">Lanjutkan Membaca</div>
                    <a href="{{ route('reading.index') }}" class="section-link">Lihat semua →</a>
                </div>
                <div class="reading-list">
                    @forelse($readingBooks as $book)
                        <a href="{{ route('reading.index') }}" class="book-row">
                            <div class="book-thumb">
                                @if($book->image)
                                    <img src="{{ $book->image }}" alt="{{ $book->title }}">
                                @else
                                    <div style="background:#7c6af7;width:100%;height:100%;"></div>
                                @endif
                            </div>
                            <div class="book-info">
                                <div class="book-title">{{ $book->title }}</div>
                                <div class="book-author">{{ $book->author->name ?? 'Penulis' }}</div>
                                <div class="progress-bar-wrap"><div class="progress-bar-fill" style="width:{{ $book->progress }}%"></div></div>
                            </div>
                            <div class="book-meta">
                                <div class="book-pct">{{ $book->progress }}%</div>
                                <div class="book-pages">hal {{ $book->current_page }}/{{ $book->total_pages }}</div>
                                <button class="btn-read">Lanjut</button>
                            </div>
                        </a>
                    @empty
                        <div class="empty-state-small">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <p>Tidak ada buku yang sedang dibaca.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="section-header">
                    <div class="section-title">Pesanan Terbaru</div>
                    <a href="{{ route('orders.index') }}" class="section-link">Lihat semua →</a>
                </div>
                <div class="order-list">
                    @forelse($recentOrders as $order)
                        <div class="order-item">
                            <div class="order-top">
                                <div class="order-id">#BKF-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                <div class="order-status {{ $order->status == 'pending' ? 'status-processing' : 'status-delivered' }}">
                                    {{ ucfirst($order->status) }}
                                </div>
                            </div>
                            <div class="order-title">Pesanan Buku #{{ $order->id }}</div>
                            <div class="order-bottom">
                                <div class="order-date">{{ $order->created_at->format('d M Y') }}</div>
                                <div class="order-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state-small">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <p>Belum ada pesanan terbaru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Rekomendasi Buku -->
        <div class="fade-up delay-4">
            <div class="section-header">
                <div class="section-title">Rekomendasi Untukmu</div>
                <a href="{{ route('books.index') }}" class="section-link">Lihat semua →</a>
            </div>
            <div class="books-grid">
                @foreach($recommendations as $book)
                    <div class="book-card">
                        <div class="book-cover">
                            @if($book->image)
                                <img src="{{ $book->image }}" alt="{{ $book->title }}">
                            @else
                                <div style="background:#5b4fe0;width:100%;height:100%;"></div>
                            @endif
                            @if($loop->first || $loop->last)
                                <span class="book-cover-badge">BARU</span>
                            @endif
                        </div>
                        <div class="book-title">{{ $book->title }}</div>
                        <div class="book-author">{{ $book->author->name ?? 'Penulis' }}</div>
                        <div class="book-rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating-val">4.8</span>
                        </div>
                        <div class="book-price-row">
                            <span class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        </div>
                        <form action="{{ route('cart.add', $book->id) }}" method="POST" style="margin-top:auto;">
                            @csrf
                            <button type="submit" class="book-add-btn">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                                + Keranjang
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Wishlist + Kategori -->
        <div class="bottom-row fade-up delay-4">
            <div>
                <div class="section-header">
                    <div class="section-title">Wishlist Saya</div>
                    <a href="{{ route('wishlist.index') }}" class="section-link">Kelola →</a>
                </div>
                <div class="wishlist-grid">
                    @forelse($wishlistBooks as $book)
                        <a href="{{ route('wishlist.index') }}" class="wishlist-item">
                            <div class="wish-cover">
                                @if($book->image)
                                    <img src="{{ $book->image }}" alt="{{ $book->title }}">
                                @else
                                    <div style="background:#7c6af7;width:100%;height:100%;"></div>
                                @endif
                            </div>
                            <div class="wish-info">
                                <div class="wish-title">{{ $book->title }}</div>
                                <div class="wish-price">Rp {{ number_format($book->price, 0, ',', '.') }}</div>
                            </div>
                        </a>
                    @empty
                        <div class="empty-state-small" style="grid-column: span 2;">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <p>Wishlist Anda masih kosong.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="section-header">
                    <div class="section-title">Kategori Buku</div>
                    <a href="{{ route('books.index') }}" class="section-link">Semua kategori →</a>
                </div>
                <div class="category-list">
                    @foreach($categories->take(4) as $cat)
                        <a href="{{ route('books.index', ['category' => [$cat->id]]) }}" class="category-item">
                            <div class="cat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
                            </div>
                            <div class="cat-name">{{ $cat->name }}</div>
                            <div class="cat-count">{{ $cat->books_count }} buku</div>
                            <div class="cat-arrow">›</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </main>
</div>

    <script>
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if(!this.classList.contains('logout-item')) {
                    document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
    </script>

</body>
</html>
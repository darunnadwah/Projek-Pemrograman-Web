<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard – Bookify</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #080810;
            color: #f0f0ff;
            min-height: 100vh;
        }

        /* ── Navbar ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 40px;
            background: rgba(8,8,16,0.9);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            backdrop-filter: blur(20px);
        }

        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }

        .nav-logo {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: white;
        }
        .nav-logo svg { width: 18px; height: 18px; }

        .nav-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 17px; color: #f0f0ff; font-weight: 700; line-height: 1;
        }

        .nav-badge {
            display: inline-block;
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.05em;
            margin-left: 8px;
        }

        .nav-links { display: flex; align-items: center; gap: 28px; }

        .nav-links a {
            color: #c0bce8; font-size: 14px; text-decoration: none; opacity: 0.7;
            transition: opacity 0.2s;
        }
        .nav-links a:hover { opacity: 1; }
        .nav-links a.active { color: #ff6b6b; opacity: 1; }

        .btn-logout {
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: #ffffff !important;
            border: none; border-radius: 50px;
            padding: 8px 20px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: box-shadow 0.2s;
            opacity: 1 !important;
        }
        .btn-logout:hover { box-shadow: 0 0 20px rgba(255,107,107,0.4); }

        /* ── Main ── */
        main {
            padding-top: 70px;
            padding: 70px 40px 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* ── Header ── */
        .admin-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 40px;
        }

        .greeting {
            font-family: 'Playfair Display', serif;
            font-size: 32px; font-weight: 700; color: #f0f0ff;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .greeting em { font-style: italic; color: #ff6b6b; }

        .subtext {
            font-size: 14px; color: #5a5680;
        }

        .admin-badge {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid rgba(255, 107, 107, 0.3);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .admin-badge svg { width: 14px; height: 14px; }

        /* ── Stats Grid ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 15px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            border-color: rgba(255, 107, 107, 0.5);
            box-shadow: 0 0 20px rgba(255, 107, 107, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 107, 107, 0.4), transparent);
        }

        .stat-icon {
            width: 48px; height: 48px;
            background: rgba(255, 107, 107, 0.15);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 12px;
            color: #ff6b6b;
        }
        .stat-icon svg { width: 22px; height: 22px; }

        .stat-label {
            font-size: 12px; color: #8880c0;
            letter-spacing: 0.05em; text-transform: uppercase;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 24px; font-weight: 600; color: #f0f0ff;
        }

        .stat-sub {
            font-size: 11px; color: #5a5680;
            margin-top: 6px;
        }

        /* ── Content Grid ── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .content-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 15px;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        .content-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 107, 107, 0.4), transparent);
        }

        .card-title {
            font-size: 18px; font-weight: 600; color: #f0f0ff;
            margin-bottom: 16px;
            display: flex; align-items: center; gap: 10px;
        }

        .card-title svg {
            width: 20px; height: 20px; color: #ff6b6b;
        }

        /* ── Quick Actions ── */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 12px;
        }

        .action-btn {
            background: rgba(255, 107, 107, 0.1);
            border: 1px solid rgba(255, 107, 107, 0.3);
            color: #ff9999;
            border-radius: 10px;
            padding: 12px 16px;
            text-align: center;
            text-decoration: none;
            font-size: 13px; font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .action-btn:hover {
            background: rgba(255, 107, 107, 0.2);
            border-color: rgba(255, 107, 107, 0.6);
            color: #ffb3b3;
        }
        .action-btn svg { width: 14px; height: 14px; }

        /* ── Activity list ── */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .activity-item {
            background: rgba(255, 107, 107, 0.05);
            border-left: 3px solid rgba(255, 107, 107, 0.5);
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .activity-item svg {
            width: 16px; height: 16px; color: #ff6b6b; flex-shrink: 0;
        }

        .activity-empty {
            text-align: center;
            padding: 24px 16px;
            color: #5a5680;
            font-size: 13px;
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .content-grid { grid-template-columns: 1fr; }
            main { padding: 70px 24px 40px; }
            nav { padding: 14px 24px; }
        }

        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .admin-header { flex-direction: column; gap: 16px; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <a href="/" class="nav-brand">
            <div class="nav-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33 1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            </div>
            <div>
                <div class="nav-brand-name">Bookify<span class="nav-badge">ADMIN</span></div>
            </div>
        </a>
        <div class="nav-links">
            <a href="/books" class="active">Dashboard</a>
            <a href="/admin/books">Kelola Buku</a>
            <a href="/admin/users">Kelola User</a>
            <a href="/admin/orders">Pesanan</a>
            <a href="/logout" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
        </div>
    </nav>

    <!-- Hidden logout form -->
    <form id="logout-form" action="/logout" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Main -->
    <main>
        <!-- Header -->
        <div class="admin-header">
            <div>
                <h1 class="greeting">Halo, <em>{{ Auth::user()->name }}</em> 
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; color: #ff6b6b; margin-left: 6px;"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </h1>
                <p class="subtext">Dashboard admin Bookify</p>
            </div>
            <div class="admin-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33 1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Administrator
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15z"/></svg>
                </div>
                <div class="stat-label">Total Buku</div>
                <div class="stat-value">850</div>
                <div class="stat-sub">Dalam perpustakaan</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="stat-label">Total User</div>
                <div class="stat-value">3,200</div>
                <div class="stat-sub">User terdaftar</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div class="stat-label">Pesanan Aktif</div>
                <div class="stat-value">124</div>
                <div class="stat-sub">Perlu diproses</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2" ry="2"/><line x1="12" y1="18" x2="12" y2="18.01"/><line x1="12" y1="6" x2="12" y2="14"/></svg>
                </div>
                <div class="stat-label">Pendapatan Bulan Ini</div>
                <div class="stat-value">Rp 45M</div>
                <div class="stat-sub">Total transaksi</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Quick Actions -->
            <div class="content-card">
                <div class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    Aksi Cepat
                </div>
                <div class="quick-actions">
                    <a href="/admin/books/create" class="action-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Tambah Buku
                    </a>
                    <a href="/admin/books" class="action-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15z"/></svg>
                        Kelola Buku
                    </a>
                    <a href="/admin/users" class="action-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        Kelola User
                    </a>
                    <a href="/admin/orders" class="action-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Pesanan
                    </a>
                    <a href="/admin/reports" class="action-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        Laporan
                    </a>
                    <a href="/admin/settings" class="action-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33 1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        Pengaturan
                    </a>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="content-card">
                <div class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9m-9.73 13a3 3 0 0 0 5.46 0"/></svg>
                    Aktivitas Terbaru
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        User baru "Siti Nurhaliza" terdaftar
                    </div>
                    <div class="activity-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Pesanan #1234 dikonfirmasi
                    </div>
                    <div class="activity-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15z"/></svg>
                        Buku "Filosofi Jawa" ditambahkan
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="content-card">
                <div class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Status Sistem
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33 1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        Server Status: Online
                    </div>
                    <div class="activity-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                        Database: Connected
                    </div>
                    <div class="activity-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        Performance: Excellent
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>
</html>

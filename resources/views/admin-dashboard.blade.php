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
            font-size: 17px;
        }

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
        }

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
            font-size: 24px;
            margin-bottom: 12px;
        }

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

        .card-title-icon {
            font-size: 20px;
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
            display: inline-block;
        }

        .action-btn:hover {
            background: rgba(255, 107, 107, 0.2);
            border-color: rgba(255, 107, 107, 0.6);
            color: #ffb3b3;
        }

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
        }

        .activity-icon {
            margin-right: 8px;
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
            <div class="nav-logo">⚙️</div>
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
                <h1 class="greeting">Halo, <em>{{ Auth::user()->name }}</em> 👋</h1>
                <p class="subtext">Dashboard admin Bookify</p>
            </div>
            <div class="admin-badge">⚙️ Administrator</div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-label">Total Buku</div>
                <div class="stat-value">850</div>
                <div class="stat-sub">Dalam perpustakaan</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Total User</div>
                <div class="stat-value">3,200</div>
                <div class="stat-sub">User terdaftar</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-label">Pesanan Aktif</div>
                <div class="stat-value">124</div>
                <div class="stat-sub">Perlu diproses</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">💰</div>
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
                    <span class="card-title-icon">⚡</span>
                    Aksi Cepat
                </div>
                <div class="quick-actions">
                    <a href="/admin/books/create" class="action-btn">➕ Tambah Buku</a>
                    <a href="/admin/books" class="action-btn">📚 Kelola Buku</a>
                    <a href="/admin/users" class="action-btn">👥 Kelola User</a>
                    <a href="/admin/orders" class="action-btn">📦 Pesanan</a>
                    <a href="/admin/reports" class="action-btn">📊 Laporan</a>
                    <a href="/admin/settings" class="action-btn">⚙️ Pengaturan</a>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="content-card">
                <div class="card-title">
                    <span class="card-title-icon">🔔</span>
                    Aktivitas Terbaru
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <span class="activity-icon">👤</span>
                        User baru "Siti Nurhaliza" terdaftar
                    </div>
                    <div class="activity-item">
                        <span class="activity-icon">📦</span>
                        Pesanan #1234 dikonfirmasi
                    </div>
                    <div class="activity-item">
                        <span class="activity-icon">📚</span>
                        Buku "Filosofi Jawa" ditambahkan
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="content-card">
                <div class="card-title">
                    <span class="card-title-icon">✅</span>
                    Status Sistem
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <span class="activity-icon">⚙️</span>
                        Server Status: Online
                    </div>
                    <div class="activity-item">
                        <span class="activity-icon">💾</span>
                        Database: Connected
                    </div>
                    <div class="activity-item">
                        <span class="activity-icon">📈</span>
                        Performance: Excellent
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>
</html>

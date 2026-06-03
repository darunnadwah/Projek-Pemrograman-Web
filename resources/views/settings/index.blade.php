<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan – Bookify</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #070711;
            color: #f0f0ff;
            min-height: 100vh;
        }
        .bg-grid {
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
            z-index: -2; pointer-events: none;
        }
        .orb1 { position: fixed; top: -150px; left: -120px; width: 500px; height: 500px; background: rgba(124,106,247,0.15); border-radius: 50%; filter: blur(80px); z-index: -1; pointer-events: none; }
        .orb2 { position: fixed; bottom: -100px; right: -100px; width: 300px; height: 300px; background: rgba(255,107,107,0.1); border-radius: 50%; filter: blur(80px); z-index: -1; pointer-events: none; }

        nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(7,7,17,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 14px 40px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: #f0f0ff; }
        .nav-logo {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #7c6af7, #4f46e5);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .nav-logo svg { width: 18px; height: 18px; color: white; }
        .nav-brand-name { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; }
        .back-btn {
            display: flex; align-items: center; gap: 6px;
            color: #a99ef5; text-decoration: none; font-weight: 600;
            transition: all 0.2s;
        }
        .back-btn:hover { color: #c4baf9; }

        .container { max-width: 700px; margin: 0 auto; padding: 40px; }

        .header { margin-bottom: 36px; }
        .header-title {
            font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 900;
            background: linear-gradient(135deg, #f0f0ff, #a99ef5);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; margin-bottom: 8px;
        }
        .header-sub { color: #8880c0; font-size: 14px; }

        /* User Info Card */
        .user-card {
            display: flex; align-items: center; gap: 20px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 24px; margin-bottom: 28px;
        }
        .user-avatar {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7c3aed, #c084fc);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; font-weight: 700; color: white;
            flex-shrink: 0;
        }
        .user-name { font-size: 1.05rem; font-weight: 700; color: #f0f0ff; }
        .user-email { font-size: 0.82rem; color: #8880c0; margin-top: 2px; }

        /* Section */
        .section-label {
            font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em;
            color: #5c5880; text-transform: uppercase;
            margin-bottom: 10px; padding-left: 4px;
        }

        .section-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 28px;
        }

        /* Menu Item */
        .menu-item {
            display: flex; align-items: center; gap: 14px;
            padding: 16px 20px;
            text-decoration: none; color: #f0f0ff;
            transition: all 0.2s;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            cursor: pointer;
        }
        .menu-item:last-child { border-bottom: none; }
        .menu-item:hover {
            background: rgba(255,255,255,0.04);
        }
        .menu-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .menu-icon.purple { background: rgba(124,58,237,0.15); color: #a78bfa; }
        .menu-icon.blue { background: rgba(59,130,246,0.15); color: #93c5fd; }
        .menu-icon.green { background: rgba(34,197,94,0.15); color: #86efac; }
        .menu-icon.amber { background: rgba(245,158,11,0.15); color: #fbbf24; }
        .menu-icon.red { background: rgba(239,68,68,0.15); color: #fca5a5; }
        .menu-icon svg { width: 16px; height: 16px; }
        .menu-text { flex: 1; }
        .menu-title { font-size: 0.9rem; font-weight: 600; }
        .menu-desc { font-size: 0.75rem; color: #8880c0; margin-top: 2px; }
        .menu-arrow { color: #5c5880; flex-shrink: 0; }
        .menu-arrow svg { width: 16px; height: 16px; }

        /* Danger Item */
        .menu-item.danger { color: #fca5a5; }
        .menu-item.danger:hover { background: rgba(239,68,68,0.06); }

        /* Footer */
        .settings-footer {
            text-align: center; margin-top: 40px;
            padding-top: 20px;
        }
        .footer-text { font-size: 0.75rem; color: #3d3a55; line-height: 1.8; }

        @media (max-width: 768px) {
            .container { padding: 24px; }
            nav { padding: 12px 20px; }
        }
    </style>
</head>
<body>
    <div class="bg-grid"></div>
    <div class="orb1"></div>
    <div class="orb2"></div>

    <nav>
        <a href="{{ route('dashboard') }}" class="nav-brand">
            <div class="nav-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
            </div>
            <div class="nav-brand-name">Bookify</div>
        </a>
        <a href="{{ route('dashboard') }}" class="back-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali ke Dashboard
        </a>
    </nav>

    <div class="container">
        <div class="header">
            <h1 class="header-title">Pengaturan</h1>
            <p class="header-sub">Kelola akun dan preferensi Anda</p>
        </div>

        <!-- User Info -->
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
            </div>
        </div>

        <!-- Akun -->
        <div class="section-label">Akun</div>
        <div class="section-card">
            <a href="{{ route('profile.edit') }}?back=settings" class="menu-item">
                <div class="menu-icon purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="menu-text">
                    <div class="menu-title">Edit Profil</div>
                    <div class="menu-desc">Ubah nama dan alamat email</div>
                </div>
                <div class="menu-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></div>
            </a>
            <a href="{{ route('profile.edit') }}?tab=password&back=settings" class="menu-item">
                <div class="menu-icon blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div class="menu-text">
                    <div class="menu-title">Ubah Kata Sandi</div>
                    <div class="menu-desc">Perbarui kata sandi akun Anda</div>
                </div>
                <div class="menu-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></div>
            </a>
        </div>

        <!-- Aktivitas -->
        <div class="section-label">Aktivitas</div>
        <div class="section-card">
            <a href="{{ route('orders.index') }}?back=settings" class="menu-item">
                <div class="menu-icon green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div class="menu-text">
                    <div class="menu-title">Riwayat Pesanan</div>
                    <div class="menu-desc">Lihat semua transaksi pembelian buku</div>
                </div>
                <div class="menu-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></div>
            </a>
            <a href="{{ route('wishlist.index') }}?back=settings" class="menu-item">
                <div class="menu-icon amber">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <div class="menu-text">
                    <div class="menu-title">Wishlist Saya</div>
                    <div class="menu-desc">Kelola daftar buku yang diinginkan</div>
                </div>
                <div class="menu-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></div>
            </a>
            <a href="{{ route('reading.index') }}?back=settings" class="menu-item">
                <div class="menu-icon blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div class="menu-text">
                    <div class="menu-title">Sedang Dibaca</div>
                    <div class="menu-desc">Lihat progres buku yang sedang dibaca</div>
                </div>
                <div class="menu-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></div>
            </a>
        </div>

        <!-- Lainnya -->
        <div class="section-label">Lainnya</div>
        <div class="section-card">
            <a href="{{ route('about') }}?back=settings" class="menu-item">
                <div class="menu-icon purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                </div>
                <div class="menu-text">
                    <div class="menu-title">Tentang Bookify</div>
                    <div class="menu-desc">Informasi tentang aplikasi</div>
                </div>
                <div class="menu-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></div>
            </a>
            <a href="{{ route('profile.edit') }}?tab=delete&back=settings" class="menu-item danger">
                <div class="menu-icon red">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </div>
                <div class="menu-text">
                    <div class="menu-title">Hapus Akun</div>
                    <div class="menu-desc">Hapus akun secara permanen</div>
                </div>
                <div class="menu-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></div>
            </a>
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
            <a href="#" class="menu-item danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="menu-icon red">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                </div>
                <div class="menu-text">
                    <div class="menu-title">Keluar</div>
                    <div class="menu-desc">Logout dari akun Anda</div>
                </div>
                <div class="menu-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></div>
            </a>
        </div>

        <div class="settings-footer">
            <div class="footer-text">
                Bookify v1.0.0 · © {{ date('Y') }} Bookify
            </div>
        </div>
    </div>
</body>
</html>

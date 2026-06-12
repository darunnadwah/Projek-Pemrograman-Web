<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Bookify' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #080810; color: #f0f0ff; min-height: 100vh; }
        nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; display: flex; align-items: center; justify-content: space-between; padding: 14px 40px; background: rgba(8,8,16,0.95); border-bottom: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(20px); }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-logo { width: 36px; height: 36px; background: linear-gradient(135deg, #ff6b6b, #ee5a6f); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; }
        .nav-logo svg { width: 18px; height: 18px; }
        .nav-brand-name { font-family: 'Playfair Display', serif; font-size: 17px; color: #f0f0ff; font-weight: 700; line-height: 1; }
        .nav-badge { display: inline-block; background: rgba(255, 107, 107, 0.2); color: #ff6b6b; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: 600; letter-spacing: 0.05em; margin-left: 8px; }
        .nav-links { display: flex; align-items: center; gap: 22px; flex-wrap: wrap; }
        .nav-links a { color: #c0bce8; font-size: 14px; text-decoration: none; opacity: 0.75; transition: opacity 0.2s; }
        .nav-links a:hover, .nav-links a.active { opacity: 1; color: #ff6b6b; }
        .btn-logout { background: linear-gradient(135deg, #ff6b6b, #ee5a6f); color: #ffffff !important; border: none; border-radius: 50px; padding: 8px 20px; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; transition: box-shadow 0.2s; }
        .btn-logout:hover { box-shadow: 0 0 20px rgba(255,107,107,0.4); }
        main { padding-top: 90px; padding: 70px 40px 40px; max-width: 1400px; margin: 0 auto; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; gap: 16px; }
        .greeting { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #f0f0ff; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .greeting em { font-style: italic; color: #ff6b6b; }
        .subtext { font-size: 14px; color: #8b88b6; }
        .admin-badge { background: rgba(255, 107, 107, 0.15); color: #ff6b6b; padding: 8px 16px; border-radius: 50px; font-size: 12px; font-weight: 600; border: 1px solid rgba(255, 107, 107, 0.3); display: inline-flex; align-items: center; gap: 8px; }
        .card { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 15px; padding: 24px; overflow: hidden; }
        .card-title { font-size: 18px; font-weight: 600; color: #f0f0ff; margin-bottom: 16px; display: flex; align-items: center; gap: 10px; }
        .card-title svg { width: 20px; height: 20px; color: #ff6b6b; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 15px; padding: 24px; position: relative; overflow: hidden; }
        .stat-icon { width: 48px; height: 48px; background: rgba(255, 107, 107, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; color: #ff6b6b; }
        .stat-label { font-size: 12px; color: #8880c0; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 6px; }
        .stat-value { font-size: 24px; font-weight: 600; color: #f0f0ff; }
        .stat-sub { font-size: 11px; color: #8b88b6; margin-top: 6px; }
        .quick-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; }
        .action-btn { background: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.3); color: #ff9999; border-radius: 10px; padding: 14px 16px; text-align: center; text-decoration: none; font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }
        .action-btn:hover { background: rgba(255, 107, 107, 0.2); border-color: rgba(255, 107, 107, 0.6); color: #ffb3b3; }
        .action-btn svg { width: 16px; height: 16px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { padding: 14px 16px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .table th { color: #b8b4d0; font-size: 12px; text-transform: uppercase; letter-spacing: 0.06em; }
        .table td { color: #e6e3ff; font-size: 14px; }
        .table tbody tr:hover { background: rgba(255,255,255,0.04); }
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
        .badge-admin { background: rgba(255, 107, 107, 0.16); color: #ff7a7a; }
        .badge-user { background: rgba(93, 145, 255, 0.15); color: #8fb4ff; }
        .input-group { display: grid; gap: 12px; margin-bottom: 20px; }
        label { color: #c7c5e0; font-size: 13px; }
        input, select, textarea { width: 100%; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.04); color: #f0f0ff; border-radius: 12px; padding: 12px 14px; font-size: 14px; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: rgba(255,107,107,0.6); box-shadow: 0 0 0 3px rgba(255,107,107,0.1); }

        /* Enhanced dark select for admin theme */
        .select-dark {
            min-width: 150px;
            border-radius: 12px;
            padding: 12px 40px 12px 14px;
            background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
            color: #f0f0ff;
            border: 1px solid rgba(255,255,255,0.08);
            font-size: 14px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px 12px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.02);
        }
        .select-dark:focus {
            outline: none;
            border-color: rgba(255,107,107,0.6);
            box-shadow: 0 0 0 4px rgba(255,107,107,0.06);
        }
        /* draw a subtle caret using layered linear-gradients */
        .select-dark {
            background-image: linear-gradient(45deg, transparent 50%, #ff6b6b 50%), linear-gradient(135deg, #ff6b6b 50%, transparent 50%);
            background-position: calc(100% - 18px) calc(50% - 4px), calc(100% - 12px) calc(50% - 4px);
            background-size: 6px 6px, 6px 6px;
        }
        .select-dark option {
            background: #0b0b10;
            color: #f0f0ff;
        }
        .select-dark option:hover, .select-dark option:checked {
            background: #111117;
            color: #fff;
        }
        /* For Windows/Edge/IE styled dropdown arrows */
        .select-dark::-ms-expand { display: none; }
        .button { display: inline-flex; align-items: center; gap: 8px; justify-content: center; padding: 12px 20px; border-radius: 999px; border: none; cursor: pointer; font-weight: 700; text-decoration: none; }
        .button-primary { background: linear-gradient(135deg, #ff6b6b, #ee5a6f); color: #fff; }
        .button-secondary { background: rgba(255,255,255,0.08); color: #f0f0ff; border: 1px solid rgba(255,255,255,0.12); }
        .button-danger { background: rgba(255, 93, 93, 0.15); color: #ffb3b3; border: 1px solid rgba(255,93,93,0.32); }
        .alert { border-radius: 14px; padding: 14px 18px; margin-bottom: 24px; font-size: 14px; }
        .alert-success { background: rgba(31, 151, 85, 0.12); color: #b7f4c1; border: 1px solid rgba(31, 151, 85, 0.2); }
        .alert-error { background: rgba(255, 55, 75, 0.12); color: #ffb3c5; border: 1px solid rgba(255, 55, 75, 0.2); }
        .form-actions { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-top: 12px; }
        @media (max-width: 1024px) { main { padding: 70px 24px 40px; } .admin-header { flex-direction: column; align-items: flex-start; } }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="nav-brand">
            <div class="nav-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33 1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            </div>
            <div class="nav-brand-name">Bookify<span class="nav-badge">ADMIN</span></div>
        </a>
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">Kelola Buku</a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Kelola User</a>
            <a href="{{ route('logout') }}" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
        </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

    <main>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>

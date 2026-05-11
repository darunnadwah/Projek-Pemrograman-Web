<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar – Bookify</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #080810;
            color: #f0f0ff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        /* ── Background layers ── */
        .bk-bg { position: fixed; inset: 0; pointer-events: none; overflow: hidden; z-index: 0; }

        .bk-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        .bk-orb1 {
            position: absolute; top: -80px; left: 50%; transform: translateX(-50%);
            width: 600px; height: 340px;
            background: radial-gradient(ellipse, rgba(124,106,247,0.18) 0%, transparent 70%);
        }
        .bk-orb2 {
            position: absolute; bottom: -80px; left: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(ellipse, rgba(79,70,229,0.12) 0%, transparent 70%);
        }
        .bk-orb3 {
            position: absolute; top: 40%; right: -80px;
            width: 300px; height: 300px;
            background: radial-gradient(ellipse, rgba(124,106,247,0.08) 0%, transparent 70%);
        }

        .bk-stars {
            position: absolute; inset: 0;
            background-image:
                radial-gradient(1.2px 1.2px at 6% 8%, rgba(255,255,255,0.5) 0%, transparent 100%),
                radial-gradient(0.8px 0.8px at 20% 4%, rgba(255,255,255,0.35) 0%, transparent 100%),
                radial-gradient(1px 1px at 33% 10%, rgba(255,255,255,0.4) 0%, transparent 100%),
                radial-gradient(0.7px 0.7px at 50% 3%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1.3px 1.3px at 68% 7%, rgba(255,255,255,0.45) 0%, transparent 100%),
                radial-gradient(0.9px 0.9px at 81% 2%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1.1px 1.1px at 91% 9%, rgba(255,255,255,0.4) 0%, transparent 100%),
                radial-gradient(1px 1px at 2.5% 29%, rgba(255,255,255,0.35) 0%, transparent 100%),
                radial-gradient(1.2px 1.2px at 98% 26%, rgba(255,255,255,0.4) 0%, transparent 100%),
                radial-gradient(0.9px 0.9px at 4% 57%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 96% 54%, rgba(255,255,255,0.35) 0%, transparent 100%),
                radial-gradient(1.1px 1.1px at 3% 83%, rgba(255,255,255,0.4) 0%, transparent 100%),
                radial-gradient(0.8px 0.8px at 97% 80%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 17% 89%, rgba(255,255,255,0.35) 0%, transparent 100%),
                radial-gradient(0.9px 0.9px at 80% 91%, rgba(255,255,255,0.3) 0%, transparent 100%),
                radial-gradient(1px 1px at 10% 20%, rgba(124,106,247,0.6) 0%, transparent 100%),
                radial-gradient(1.2px 1.2px at 90% 17%, rgba(124,106,247,0.5) 0%, transparent 100%),
                radial-gradient(1px 1px at 94% 71%, rgba(124,106,247,0.4) 0%, transparent 100%),
                radial-gradient(0.9px 0.9px at 6% 75%, rgba(124,106,247,0.4) 0%, transparent 100%);
        }

        /* ── Navbar ── */
        nav {
            position: relative; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 40px;
            background: rgba(8,8,16,0.7);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            backdrop-filter: blur(20px);
        }

        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }

        .nav-logo {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #7c6af7, #4f46e5);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
        }

        .nav-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 17px; color: #f0f0ff; font-weight: 700; line-height: 1;
        }
        .nav-brand-sub {
            font-size: 8px; color: #6660a0;
            letter-spacing: 0.15em; text-transform: uppercase;
        }

        .nav-links { display: flex; align-items: center; gap: 28px; }

        .nav-links a {
            color: #c0bce8; font-size: 14px; text-decoration: none; opacity: 0.7;
            transition: opacity 0.2s;
        }
        .nav-links a:hover { opacity: 1; }
        .nav-links a.active { color: #a99ef5; opacity: 1; }

        .btn-masuk {
            background: linear-gradient(135deg, #7c6af7, #5b4fe0);
            color: #ffffff !important;
            border: none; border-radius: 50px;
            padding: 8px 20px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: box-shadow 0.2s;
            opacity: 1 !important;
        }
        .btn-masuk:hover { box-shadow: 0 0 20px rgba(124,106,247,0.4); }

        /* ── Main content ── */
        main {
            position: relative; z-index: 10;
            flex: 1;
            display: flex; align-items: center; justify-content: center;
            padding: 40px 20px;
        }

        /* ── Card ── */
        .register-card {
            width: 100%; max-width: 450px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 38px 34px;
            position: relative; overflow: hidden;
            animation: fadeUp 0.55s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .register-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(124,106,247,0.6), transparent);
        }

        .register-card::after {
            content: '';
            position: absolute; top: -60px; left: 50%; transform: translateX(-50%);
            width: 200px; height: 200px;
            background: radial-gradient(ellipse, rgba(124,106,247,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .card-deco {
            position: absolute; right: 22px; top: 22px;
            opacity: 0.05; pointer-events: none;
        }

        /* ── Header ── */
        .card-header { text-align: center; margin-bottom: 24px; }

        .card-badge {
            display: inline-flex; align-items: center; gap: 6px;
            border: 1px solid rgba(124,106,247,0.3); border-radius: 50px;
            padding: 4px 14px; font-size: 10px; color: #a99ef5;
            letter-spacing: 0.12em; text-transform: uppercase;
            margin-bottom: 14px; background: rgba(124,106,247,0.06);
        }
        .badge-dot {
            width: 5px; height: 5px;
            background: #7c6af7; border-radius: 50%;
            display: inline-block; flex-shrink: 0;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px; font-weight: 700; color: #f0f0ff;
            line-height: 1.2; margin: 0 0 8px;
        }
        .card-title em { font-style: italic; color: #a99ef5; }

        .card-sub { font-size: 13px; color: #5a5680; margin: 0; }

        /* ── Pills ── */
        .card-pills {
            display: flex; gap: 6px; justify-content: center;
            flex-wrap: wrap; margin-bottom: 24px;
        }
        .card-pill {
            font-size: 10px; padding: 3px 10px; border-radius: 50px;
            border: 1px solid rgba(124,106,247,0.2);
            color: #7068b0; background: rgba(124,106,247,0.04);
        }

        /* ── Form ── */
        .form-group { margin-bottom: 16px; }

        .form-label {
            display: block; font-size: 11px; font-weight: 500;
            color: #8880c0; margin-bottom: 7px;
            letter-spacing: 0.08em; text-transform: uppercase;
        }

        /* ── Input: 1 warna putih penuh, ikon + teks menyatu ── */
        .input-wrap {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.92);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-wrap:focus-within {
            border-color: rgba(124,106,247,0.7);
            box-shadow: 0 0 0 3px rgba(124,106,247,0.18);
        }

        .input-icon-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            flex-shrink: 0;
            color: #7c6af7;
            font-size: 17px;
            background: transparent;
        }

        .form-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            padding: 11px 14px 11px 0;
            color: #1a1a2e;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
        }
        .form-input::placeholder { color: #9090b0; }

        .form-error { font-size: 12px; color: #f87171; margin-top: 5px; }

        /* ── Submit button ── */
        .btn-daftar-submit {
            width: 100%;
            background: linear-gradient(135deg, #7c6af7 0%, #5040d0 100%);
            color: #ffffff;
            border: none; border-radius: 50px;
            padding: 13px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600;
            cursor: pointer; letter-spacing: 0.02em;
            box-shadow: 0 4px 30px rgba(124,106,247,0.35);
            transition: box-shadow 0.2s, transform 0.1s;
            margin-top: 10px;
        }
        .btn-daftar-submit:hover { box-shadow: 0 6px 36px rgba(124,106,247,0.5); }
        .btn-daftar-submit:active { transform: scale(0.98); }

        /* ── Divider ── */
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 20px 0;
        }
        .divider-line { flex: 1; height: 1px; background: rgba(255,255,255,0.06); }
        .divider-text { font-size: 11px; color: #3a3860; }

        /* ── Login row ── */
        .login-row { text-align: center; font-size: 12px; color: #4a4870; }
        .login-row a {
            color: #a99ef5; text-decoration: none; font-weight: 500;
            transition: color 0.2s;
        }
        .login-row a:hover { color: #c4baf9; }
    </style>
</head>
<body>

    <!-- Background -->
    <div class="bk-bg">
        <div class="bk-grid"></div>
        <div class="bk-stars"></div>
        <div class="bk-orb1"></div>
        <div class="bk-orb2"></div>
        <div class="bk-orb3"></div>
    </div>

    <!-- Navbar -->
    <nav>
        <a href="/" class="nav-brand">
            <div class="nav-logo">📚</div>
            <div>
                <div class="nav-brand-name">Bookify</div>
                <div class="nav-brand-sub">Beli Buku Online</div>
            </div>
        </a>
        <div class="nav-links">
            <a href="/katalog">Katalog</a>
            <a href="/tentang">Tentang</a>
            <a href="{{ route('login') }}">Masuk</a>
            <a href="{{ route('register') }}" class="active btn-masuk">Daftar</a>
        </div>
    </nav>

    <!-- Main -->
    <main>
        <div class="register-card">

            <!-- Deco circle -->
            <svg class="card-deco" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="40" cy="40" r="38" stroke="white" stroke-width="1"/>
                <circle cx="40" cy="40" r="28" stroke="white" stroke-width="0.5"/>
                <line x1="2" y1="40" x2="78" y2="40" stroke="white" stroke-width="0.5"/>
                <line x1="40" y1="2" x2="40" y2="78" stroke="white" stroke-width="0.5"/>
            </svg>

            <!-- Header -->
            <div class="card-header">
                <div class="card-badge">
                    <span class="badge-dot"></span>
                    Bergabunglah Dengan Kami
                </div>
                <h1 class="card-title">Daftar ke <em>Bookify</em></h1>
                <p class="card-sub">Mulai jelajahi koleksi buku terbaik kami</p>
            </div>

            <!-- Pills -->
            <div class="card-pills">
                <span class="card-pill">📚 12.450 Buku</span>
                <span class="card-pill">⚡ Akses 24/7</span>
                <span class="card-pill">🔒 Aman & Terpercaya</span>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <div class="input-wrap">
                        <div class="input-icon-box">
                            <i class="ti ti-user" aria-hidden="true"></i>
                        </div>
                        <input
                            id="name"
                            class="form-input"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama lengkap"
                            required autofocus autocomplete="name"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="form-error" />
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <div class="input-icon-box">
                            <i class="ti ti-mail" aria-hidden="true"></i>
                        </div>
                        <input
                            id="email"
                            class="form-input"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="email@contoh.com"
                            required autocomplete="email"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="form-error" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi</label>
                    <div class="input-wrap">
                        <div class="input-icon-box">
                            <i class="ti ti-lock" aria-hidden="true"></i>
                        </div>
                        <input
                            id="password"
                            class="form-input"
                            type="password"
                            name="password"
                            placeholder="Buat kata sandi yang kuat"
                            required autocomplete="new-password"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="form-error" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="input-wrap">
                        <div class="input-icon-box">
                            <i class="ti ti-lock-check" aria-hidden="true"></i>
                        </div>
                        <input
                            id="password_confirmation"
                            class="form-input"
                            type="password"
                            name="password_confirmation"
                            placeholder="Konfirmasi kata sandi"
                            required autocomplete="new-password"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="form-error" />
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-daftar-submit">
                    Daftar Sekarang →
                </button>

                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-text">atau</span>
                    <div class="divider-line"></div>
                </div>

                <div class="login-row">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Masuk di sini</a>
                </div>

            </form>
        </div>
    </main>

</body>
</html>

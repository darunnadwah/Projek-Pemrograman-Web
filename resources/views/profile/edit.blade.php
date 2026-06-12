@php
    $referer = request()->headers->get('referer');
    $currentPath = request()->path();
    if ($referer && !str_contains($referer, $currentPath)) {
        session(['back_url_' . $currentPath => $referer]);
    }
    $backUrl = session('back_url_' . $currentPath, auth()->user()?->role === 'admin' ? route('admin.dashboard') : route('dashboard'));
    $backLabel = 'Kembali ke Dashboard';
    if (str_contains($backUrl, '/settings')) {
        $backLabel = 'Kembali ke Pengaturan';
    } elseif (str_contains($backUrl, '/dashboard')) {
        $backLabel = 'Kembali ke Dashboard';
    } else {
        $backLabel = 'Kembali';
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya – Bookify</title>
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

        /* Navbar */
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

        /* Container */
        .container { max-width: 800px; margin: 0 auto; padding: 40px; }

        /* Header */
        .header { margin-bottom: 40px; text-align: center; }
        .header-title {
            font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 900;
            background: linear-gradient(135deg, #f0f0ff, #a99ef5);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; margin-bottom: 8px;
        }
        .header-sub { color: #8880c0; font-size: 14px; }

        /* Profile Avatar */
        .profile-avatar-section {
            display: flex; flex-direction: column; align-items: center;
            margin-bottom: 40px;
        }
        .profile-avatar {
            width: 100px; height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7c3aed, #c084fc);
            display: flex; align-items: center; justify-content: center;
            font-size: 2.2rem; font-weight: 700; color: white;
            border: 4px solid rgba(124,58,237,0.4);
            margin-bottom: 16px;
            position: relative;
        }
        .profile-avatar::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px solid rgba(124,106,247,0.15);
        }
        .profile-name {
            font-size: 1.3rem; font-weight: 700; color: #f0f0ff;
            margin-bottom: 4px;
        }
        .profile-email { font-size: 0.9rem; color: #8880c0; }
        .profile-member-since {
            font-size: 0.75rem; color: #5c5880;
            margin-top: 8px;
            display: flex; align-items: center; gap: 6px;
        }

        /* Alert */
        .alert {
            padding: 14px 20px; border-radius: 12px; font-size: 13px;
            display: flex; align-items: center; gap: 10px;
            animation: slideDown 0.3s ease; margin-bottom: 24px;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
        }

        /* Section Card */
        .section-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 28px; margin-bottom: 24px;
            transition: all 0.3s;
        }
        .section-card:hover {
            border-color: rgba(124,106,247,0.25);
            background: rgba(255,255,255,0.05);
        }
        .section-header {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 20px; padding-bottom: 16px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .section-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .section-icon.purple { background: rgba(124,58,237,0.15); color: #a78bfa; }
        .section-icon.blue { background: rgba(59,130,246,0.15); color: #93c5fd; }
        .section-icon.red { background: rgba(239,68,68,0.15); color: #fca5a5; }
        .section-icon svg { width: 18px; height: 18px; }
        .section-title-text { font-size: 1rem; font-weight: 700; color: #f0f0ff; }
        .section-desc { font-size: 0.8rem; color: #8880c0; margin-top: 2px; }

        /* Form */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block; margin-bottom: 8px;
            font-size: 0.8rem; font-weight: 600;
            color: #9e97d9; text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 12px 16px;
            color: #f0f0ff;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: all 0.2s;
        }
        .form-input::placeholder { color: #5a5680; }
        .form-input:focus {
            outline: none;
            border-color: rgba(124,106,247,0.5);
            box-shadow: 0 0 0 3px rgba(124,106,247,0.15);
            background: rgba(255,255,255,0.08);
        }
        .form-input:disabled {
            opacity: 0.5; cursor: not-allowed;
        }
        .form-error {
            font-size: 0.75rem; color: #fca5a5;
            margin-top: 6px;
        }
        .form-row {
            display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #7c6af7, #5b4fe0);
            color: white; border: none; border-radius: 10px;
            padding: 12px 28px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-primary:hover {
            box-shadow: 0 8px 25px rgba(124,106,247,0.35);
            transform: translateY(-2px);
        }
        .btn-danger {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5; border-radius: 10px;
            padding: 12px 28px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-danger:hover {
            background: rgba(239,68,68,0.25);
            border-color: rgba(239,68,68,0.5);
            transform: translateY(-1px);
        }
        .btn-cancel {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: #9490b5; border-radius: 10px;
            padding: 12px 28px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-cancel:hover { border-color: rgba(255,255,255,0.2); color: #f0f0ff; }

        .form-actions {
            display: flex; align-items: center; gap: 16px; margin-top: 24px;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 999;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(4px);
            align-items: center; justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: #12122a;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 32px; width: 100%; max-width: 480px;
            animation: modalIn 0.3s ease;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-title { font-size: 1.1rem; font-weight: 700; color: #f0f0ff; margin-bottom: 8px; }
        .modal-desc { font-size: 0.85rem; color: #8880c0; margin-bottom: 20px; line-height: 1.6; }
        .modal-actions {
            display: flex; gap: 12px; justify-content: flex-end; margin-top: 20px;
        }

        /* Saved Badge */
        .saved-badge {
            display: inline-flex; align-items: center; gap: 6px;
            color: #86efac; font-size: 0.85rem; font-weight: 500;
            animation: fadeInOut 2s ease forwards;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; }
            15% { opacity: 1; }
            85% { opacity: 1; }
            100% { opacity: 0; }
        }

        /* Tab Navigation */
        .tab-nav {
            display: flex; gap: 4px; margin-bottom: 32px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px; padding: 4px;
        }
        .tab-btn {
            flex: 1; padding: 10px 16px;
            border: none; border-radius: 8px;
            background: transparent;
            color: #8880c0; font-size: 0.85rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .tab-btn.active {
            background: rgba(124,106,247,0.15);
            color: #c4b5fd;
            box-shadow: 0 2px 8px rgba(124,106,247,0.15);
        }
        .tab-btn:hover:not(.active) { color: #a99ef5; background: rgba(255,255,255,0.03); }
        .tab-btn svg { width: 16px; height: 16px; }

        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeUp 0.3s ease; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container { padding: 24px; }
            nav { padding: 12px 20px; }
            .form-row { grid-template-columns: 1fr; }
            .tab-btn span { display: none; }
        }
    </style>
</head>
<body>
    <div class="bg-grid"></div>
    <div class="orb1"></div>
    <div class="orb2"></div>

    <!-- Navbar -->
    <nav>
        <a href="{{ auth()->user()?->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="nav-brand">
            <div class="nav-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
            </div>
            <div class="nav-brand-name">Bookify</div>
        </a>
        <a href="{{ $backUrl }}" class="back-btn" id="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span id="back-button-text">{{ $backLabel }}</span>
        </a>
    </nav>

    <div class="container">
        <!-- Profile Header -->
        <div class="profile-avatar-section">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="profile-name">{{ Auth::user()->name }}</div>
            <div class="profile-email">{{ Auth::user()->email }}</div>
            <div class="profile-member-since">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Bergabung sejak {{ Auth::user()->created_at->format('d M Y') }}
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('status') === 'profile-updated')
            <div class="alert alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                Profil berhasil diperbarui!
            </div>
        @endif

        @if(session('status') === 'password-updated')
            <div class="alert alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                Kata sandi berhasil diubah!
            </div>
        @endif

        <!-- Tab Navigation -->
        <div class="tab-nav">
            <button class="tab-btn active" onclick="switchTab('profile')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <span>Informasi Profil</span>
            </button>
            <button class="tab-btn" onclick="switchTab('password')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <span>Ubah Kata Sandi</span>
            </button>
            <button class="tab-btn" onclick="switchTab('delete')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                <span>Hapus Akun</span>
            </button>
        </div>

        <!-- TAB 1: Profile Information -->
        <div id="tab-profile" class="tab-content active">
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <div class="section-title-text">Informasi Profil</div>
                        <div class="section-desc">Perbarui nama dan alamat email akun Anda</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label class="form-label" for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $user->name) }}" required autofocus placeholder="Masukkan nama lengkap">
                        @error('name')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required placeholder="Masukkan email">
                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TAB 2: Update Password -->
        <div id="tab-password" class="tab-content">
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <div>
                        <div class="section-title-text">Ubah Kata Sandi</div>
                        <div class="section-desc">Pastikan akun Anda menggunakan kata sandi yang kuat dan aman</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label class="form-label" for="current_password">Kata Sandi Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" class="form-input" placeholder="Masukkan kata sandi saat ini">
                        @error('current_password', 'updatePassword')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="password">Kata Sandi Baru</label>
                            <input type="password" id="password" name="password" class="form-input" placeholder="Minimal 8 karakter">
                            @error('password', 'updatePassword')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi baru">
                            @error('password_confirmation', 'updatePassword')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TAB 3: Delete Account -->
        <div id="tab-delete" class="tab-content">
            <div class="section-card" style="border-color: rgba(239,68,68,0.15);">
                <div class="section-header">
                    <div class="section-icon red">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </div>
                    <div>
                        <div class="section-title-text">Hapus Akun</div>
                        <div class="section-desc">Tindakan ini bersifat permanen dan tidak dapat dibatalkan</div>
                    </div>
                </div>

                <div style="background: rgba(239,68,68,0.06); border: 1px solid rgba(239,68,68,0.15); border-radius: 10px; padding: 16px; margin-bottom: 20px;">
                    <div style="display: flex; gap: 12px; align-items: flex-start;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fca5a5" stroke-width="2" style="flex-shrink:0; margin-top:2px;"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        <div>
                            <div style="font-weight: 600; color: #fca5a5; font-size: 0.9rem; margin-bottom: 4px;">Peringatan</div>
                            <div style="color: #8880c0; font-size: 0.8rem; line-height: 1.6;">Setelah akun Anda dihapus, semua data dan informasi terkait akan dihapus secara permanen. Pastikan Anda telah mengunduh data yang ingin disimpan sebelum melanjutkan.</div>
                        </div>
                    </div>
                </div>

                <button class="btn-danger" onclick="openDeleteModal()">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    Hapus Akun Saya
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <div class="section-icon red">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
                <div class="modal-title">Konfirmasi Hapus Akun</div>
            </div>
            <div class="modal-desc">
                Apakah Anda yakin ingin menghapus akun? Semua data, riwayat pembelian, dan wishlist Anda akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengkonfirmasi.
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label class="form-label" for="delete_password">Kata Sandi</label>
                    <input type="password" id="delete_password" name="password" class="form-input" placeholder="Masukkan kata sandi untuk konfirmasi" required>
                    @error('password', 'userDeletion')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="btn-danger">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        Ya, Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

            // Show selected tab
            document.getElementById('tab-' + tab).classList.add('active');
            
            // Find active tab button by its onclick attribute parameter
            const tabBtn = Array.from(document.querySelectorAll('.tab-btn')).find(btn => {
                const onclickAttr = btn.getAttribute('onclick') || '';
                return onclickAttr.includes("'" + tab + "'") || onclickAttr.includes('"' + tab + '"');
            });
            if (tabBtn) {
                tabBtn.classList.add('active');
            }
        }

        function openDeleteModal() {
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
        }

        // Close modal on outside click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Auto-dismiss alerts
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }, 3000);
        });

        // Switch tab based on URL query parameter
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab && ['profile', 'password', 'delete'].includes(tab)) {
                switchTab(tab);
            }
        });
    </script>
</body>
</html>

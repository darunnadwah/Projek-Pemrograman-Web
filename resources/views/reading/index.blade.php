<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sedang Dibaca – Bookify</title>
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

        .container { max-width: 1000px; margin: 0 auto; padding: 40px; }
        .header { margin-bottom: 40px; }
        .header-title {
            font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 900;
            background: linear-gradient(135deg, #f0f0ff, #a99ef5);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; margin-bottom: 8px;
        }
        .header-sub { color: #8880c0; font-size: 14px; }

        /* Alert */
        .alert {
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
        }

        .reading-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .reading-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            gap: 24px;
            align-items: center;
            transition: all 0.25s;
        }
        .reading-card:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(124,106,247,0.3);
        }

        .reading-cover {
            width: 100px;
            height: 140px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            background: rgba(255,255,255,0.05);
        }
        .reading-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .reading-info {
            flex: 1;
            min-width: 0;
        }

        .book-title {
            font-size: 18px;
            font-weight: 700;
            color: #f0f0ff;
            margin-bottom: 6px;
        }
        .book-author {
            font-size: 13px;
            color: #8880c0;
            margin-bottom: 16px;
        }

        .progress-section {
            margin-bottom: 16px;
        }
        .progress-label-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #b8b8c7;
            margin-bottom: 8px;
        }
        .progress-pct {
            font-weight: 700;
            color: #a99ef5;
        }

        .progress-bar-wrap {
            height: 8px;
            background: rgba(255,255,255,0.06);
            border-radius: 4px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #7c6af7, #a99ef5);
            border-radius: 4px;
            transition: width 0.4s ease;
        }

        .progress-update-form {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .input-group {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 6px;
            padding: 4px 8px;
        }
        .page-input {
            width: 50px;
            background: none;
            border: none;
            color: #f0f0ff;
            text-align: center;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
        }
        .page-input:focus {
            outline: none;
        }
        .page-divider {
            color: #8880c0;
            font-size: 12px;
        }
        .btn-update {
            background: rgba(124,106,247,0.15);
            border: 1px solid rgba(124,106,247,0.3);
            color: #a99ef5;
            border-radius: 6px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-update:hover {
            background: #7c6af7;
            color: white;
            border-color: #7c6af7;
        }

        .empty-state {
            text-align: center; padding: 80px 20px;
            background: rgba(255,255,255,0.02);
            border: 1px dashed rgba(255,255,255,0.06);
            border-radius: 20px;
        }
        .empty-icon svg { width: 64px; height: 64px; color: #5a5680; margin: 0 auto 20px; }
        .empty-title { font-size: 22px; font-weight: 600; margin-bottom: 8px; }
        .empty-desc { color: #8880c0; font-size: 14px; margin-bottom: 24px; }
        .btn-shop {
            background: linear-gradient(135deg, #7c6af7, #5b4fe0);
            color: white; text-decoration: none;
            padding: 12px 28px; border-radius: 8px;
            font-weight: 600; transition: all 0.2s;
            display: inline-block;
        }
        .btn-shop:hover { box-shadow: 0 8px 25px rgba(124,106,247,0.4); transform: translateY(-2px); }
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
        <a href="{{ route('dashboard') }}" class="back-btn" id="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle; margin-right:4px;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span id="back-button-text">Kembali ke Dashboard</span>
        </a>
    </nav>

    <div class="container">
        <div class="header">
            <h1 class="header-title">Sedang Dibaca</h1>
            <p class="header-sub">Lacak dan perbarui kemajuan membaca buku digital Anda</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($books->count() > 0)
            <div class="reading-grid">
                @foreach($books as $book)
                    <div class="reading-card">
                        <div class="reading-cover">
                            @if($book->image)
                                <img src="{{ $book->image }}" alt="{{ $book->title }}">
                            @else
                                <div style="background:#7c6af7;width:100%;height:100%;"></div>
                            @endif
                        </div>
                        <div class="reading-info">
                            <h2 class="book-title">{{ $book->title }}</h2>
                            <p class="book-author">Oleh {{ $book->author->name ?? 'Penulis' }}</p>
                            
                            <div class="progress-section">
                                <div class="progress-label-row">
                                    <span>Kemajuan Membaca</span>
                                    <span class="progress-pct">{{ $book->progress }}%</span>
                                </div>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar-fill" style="width: {{ $book->progress }}%"></div>
                                </div>
                            </div>

                            <form action="{{ route('reading.update', $book->id) }}" method="POST" class="progress-update-form">
                                @csrf
                                <div class="input-group">
                                    <input type="number" name="current_page" class="page-input" value="{{ $book->current_page }}" min="0" max="{{ $book->total_pages }}" title="Halaman Saat Ini">
                                    <span class="page-divider">/</span>
                                    <input type="number" name="total_pages" class="page-input" value="{{ $book->total_pages }}" min="1" title="Total Halaman">
                                </div>
                                <button type="submit" class="btn-update">Perbarui Progres</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h2 class="empty-title">Tidak Ada Buku Aktif</h2>
                <p class="empty-desc">Beli e-book atau tambahkan buku ke daftar baca untuk melacak progres Anda.</p>
                <a href="{{ route('books.index') }}" class="btn-shop">Jelajahi Katalog Buku</a>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const backBtn = document.getElementById('back-button');
            const backBtnText = document.getElementById('back-button-text');
            if (backBtn && backBtnText) {
                const referrer = document.referrer;
                const urlParams = new URLSearchParams(window.location.search);
                if (referrer && referrer.includes('/settings')) {
                    backBtn.href = '/settings';
                    backBtnText.textContent = 'Kembali ke Pengaturan';
                } else if (urlParams.get('back') === 'settings') {
                    backBtn.href = '/settings';
                    backBtnText.textContent = 'Kembali ke Pengaturan';
                }
            }
        });
    </script>
</body>
</html>

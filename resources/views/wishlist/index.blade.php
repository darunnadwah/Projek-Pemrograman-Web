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
    <title>Wishlist Saya – Bookify</title>
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

        .container { max-width: 1200px; margin: 0 auto; padding: 40px; }
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

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }

        .book-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .book-card:hover {
            transform: translateY(-6px);
            border-color: rgba(124,106,247,0.5);
            background: rgba(255,255,255,0.07);
        }
        .book-cover {
            width: 100%;
            aspect-ratio: 3/4;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: rgba(255,255,255,0.05);
        }
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .book-content {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .book-title {
            font-size: 14px;
            font-weight: 600;
            color: #f0f0ff;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .book-author {
            font-size: 12px;
            color: #8880c0;
        }
        .book-price {
            font-size: 16px;
            font-weight: 700;
            color: #7c6af7;
            margin-top: auto;
        }
        
        .book-actions {
            display: flex;
            gap: 8px;
            padding-top: 10px;
            border-top: 1px solid rgba(255,255,255,0.06);
            margin-top: 10px;
        }
        .btn-cart {
            flex: 1;
            background: linear-gradient(135deg, #7c6af7, #5b4fe0);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-cart:hover {
            box-shadow: 0 6px 20px rgba(124,106,247,0.4);
            transform: translateY(-1px);
        }
        .btn-remove {
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.3);
            color: #fca5a5;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-remove:hover {
            background: rgba(248, 113, 113, 0.2);
            border-color: rgba(248, 113, 113, 0.5);
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
        <a href="{{ auth()->user()?->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="nav-brand">
            <div class="nav-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
            </div>
            <div class="nav-brand-name">Bookify</div>
        </a>
        <a href="{{ $backUrl }}" class="back-btn" id="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle; margin-right:4px;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span id="back-button-text">{{ $backLabel }}</span>
        </a>
    </nav>

    <div class="container">
        <div class="header">
            <h1 class="header-title">Wishlist Saya</h1>
            <p class="header-sub">Buku-buku incaran yang Anda simpan untuk dibeli nanti</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($books->count() > 0)
            <div class="books-grid">
                @foreach($books as $book)
                    <div class="book-card">
                        <div class="book-cover">
                            @if($book->image)
                                <img src="{{ $book->image }}" alt="{{ $book->title }}">
                            @else
                                <div style="background:#7c6af7;width:100%;height:100%;"></div>
                            @endif
                        </div>
                        <div class="book-content">
                            <h3 class="book-title">{{ $book->title }}</h3>
                            <p class="book-author">{{ $book->author->name ?? 'Penulis' }}</p>
                            <div class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</div>
                            
                            <div class="book-actions">
                                <form action="{{ route('cart.add', $book->id) }}" method="POST" style="flex: 1; margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-cart">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                        Beli
                                    </button>
                                </form>
                                <form action="{{ route('wishlist.remove', $book->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove" title="Hapus dari Wishlist">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h2 class="empty-title">Wishlist Kosong</h2>
                <p class="empty-desc">Simpan buku favorit Anda di sini agar tidak lupa.</p>
                <a href="{{ route('books.index') }}" class="btn-shop">Jelajahi Katalog Buku</a>
            </div>
        @endif
    </div>


</body>
</html>

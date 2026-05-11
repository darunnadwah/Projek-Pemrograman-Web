<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku – Bookify</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #070711;
            color: #f0f0ff;
            min-height: 100vh;
            position: relative;
        }

        /* Background */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
            z-index: -2;
            pointer-events: none;
        }

        .orb1 { position: fixed; top: -150px; left: -120px; width: 500px; height: 500px; background: rgba(124,106,247,0.15); border-radius: 50%; filter: blur(80px); z-index: -1; pointer-events: none; }
        .orb2 { position: fixed; bottom: -100px; right: -100px; width: 300px; height: 300px; background: rgba(255,107,107,0.1); border-radius: 50%; filter: blur(80px); z-index: -1; pointer-events: none; }

        /* Navbar */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(7,7,17,0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 14px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #f0f0ff;
        }

        .nav-logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #7c6af7, #4f46e5);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .nav-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            line-height: 1;
        }

        .nav-brand-sub {
            font-size: 8px;
            color: #6660a0;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #a99ef5;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .back-btn:hover {
            background: rgba(124,106,247,0.1);
            color: #c4baf9;
        }

        .cart-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #a99ef5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .cart-link:hover {
            color: #c4baf9;
        }

        .cart-badge {
            background: #7c6af7;
            color: white;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 50px;
            font-weight: 700;
        }

        /* Alert */
        .alert {
            margin: 20px 40px 0;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
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

        .alert-error {
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.3);
            color: #fca5a5;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px;
        }

        /* Header */
        .header {
            margin-bottom: 40px;
        }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 24px;
            background: linear-gradient(135deg, #f0f0ff, #a99ef5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Search Bar */
        .search-box {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
        }

        .search-input {
            flex: 1;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            padding: 12px 18px;
            color: #f0f0ff;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: all 0.2s;
        }

        .search-input::placeholder {
            color: #5a5680;
        }

        .search-input:focus {
            outline: none;
            background: rgba(255,255,255,0.12);
            border-color: rgba(124,106,247,0.5);
            box-shadow: 0 0 0 3px rgba(124,106,247,0.18);
        }

        /* Filter Section */
        .filter-section {
            margin-bottom: 30px;
        }

        .filter-label {
            font-size: 13px;
            font-weight: 600;
            color: #8880c0;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 18px;
            border: 1px solid rgba(124,106,247,0.3);
            border-radius: 50px;
            background: rgba(124,106,247,0.08);
            color: #a99ef5;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .filter-btn:hover {
            background: rgba(124,106,247,0.15);
            border-color: rgba(124,106,247,0.5);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #7c6af7, #5b4fe0);
            border-color: #7c6af7;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(124,106,247,0.3);
        }

        /* Grid */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }

        /* Book Card */
        .book-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .book-card:hover {
            transform: translateY(-8px);
            border-color: rgba(124,106,247,0.5);
            background: rgba(255,255,255,0.08);
            box-shadow: 0 20px 50px rgba(124,106,247,0.2);
        }

        .book-cover {
            width: 100%;
            aspect-ratio: 3/4;
            background: linear-gradient(135deg, rgba(124,106,247,0.2), rgba(79,70,229,0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: rgba(124,106,247,0.5);
            overflow: hidden;
            position: relative;
        }

        .book-cover::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(124,106,247,0.1), transparent);
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
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            font-size: 11px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 500;
            white-space: nowrap;
        }

        .badge-category {
            background: rgba(124,106,247,0.15);
            color: #a99ef5;
            border: 1px solid rgba(124,106,247,0.3);
        }

        .badge-physical {
            background: rgba(34, 197, 94, 0.15);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .badge-ebook {
            background: rgba(59, 130, 246, 0.15);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .book-price {
            font-size: 16px;
            font-weight: 700;
            color: #7c6af7;
            margin-top: auto;
        }

        .book-stock {
            font-size: 12px;
            color: #8880c0;
        }

        .book-actions {
            display: flex;
            gap: 8px;
            padding-top: 10px;
            border-top: 1px solid rgba(255,255,255,0.06);
            margin-top: 10px;
        }

        .btn-add-cart {
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

        .btn-add-cart:hover {
            box-shadow: 0 6px 20px rgba(124,106,247,0.4);
            transform: translateY(-2px);
        }

        .btn-add-cart:active {
            transform: translateY(0);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 600;
            color: #f0f0ff;
            margin-bottom: 8px;
        }

        .empty-desc {
            color: #8880c0;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 24px;
            }

            .header-title {
                font-size: 28px;
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 16px;
            }

            nav {
                padding: 12px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Background -->
    <div class="bg-grid"></div>
    <div class="orb1"></div>
    <div class="orb2"></div>

    <!-- Navbar -->
    <nav>
        <a href="{{ route('welcome') }}" class="nav-brand">
            <div class="nav-logo">📚</div>
            <div>
                <div class="nav-brand-name">Bookify</div>
                <div class="nav-brand-sub">DIGITAL LIBRARY</div>
            </div>
        </a>
        <div class="nav-right">
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="ti ti-arrow-left"></i>
                Kembali
            </a>
            <a href="{{ route('cart.index') }}" class="cart-link">
                <i class="ti ti-shopping-cart"></i>
                Keranjang
                <span class="cart-badge">{{ count((array) session('cart', [])) }}</span>
            </a>
        </div>
    </nav>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="ti ti-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="ti ti-alert-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Container -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="header-title">Jelajahi Koleksi Buku Kami</h1>
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('books.index') }}" class="search-box">
            <input 
                type="text" 
                name="search" 
                class="search-input" 
                placeholder="Cari buku, penulis, atau kategori..."
                value="{{ request('search') }}"
            >
        </form>

        <!-- Filters -->
        <div class="filter-section">
            <label class="filter-label">Kategori</label>
            <div class="filter-buttons">
                <a href="{{ route('books.index') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">
                    Semua Kategori
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('books.index', ['category' => [$category->id], 'search' => request('search')]) }}" 
                       class="filter-btn {{ in_array($category->id, (array)request('category', [])) ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="books-grid">
                @foreach($books as $book)
                    <div class="book-card">
                        <div class="book-cover">
                            📖
                        </div>
                        <div class="book-content">
                            <h3 class="book-title">{{ $book->title }}</h3>
                            <p class="book-author">{{ $book->author->name ?? 'Penulis Tidak Diketahui' }}</p>
                            
                            <div class="book-meta">
                                <span class="badge badge-category">{{ $book->category->name }}</span>
                                @if($book->type == 'physical')
                                    <span class="badge badge-physical">Fisik</span>
                                @elseif($book->type == 'ebook')
                                    <span class="badge badge-ebook">E-book</span>
                                @else
                                    <span class="badge badge-physical">Fisik</span>
                                    <span class="badge badge-ebook">E-book</span>
                                @endif
                            </div>

                            <div class="book-stock">
                                📦 Stok: <strong>{{ $book->stock }}</strong> pcs
                            </div>

                            <div class="book-price">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </div>

                            <div class="book-actions">
                                <form action="{{ route('cart.add', $book->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn-add-cart">
                                        <i class="ti ti-shopping-cart"></i>
                                        Tambah
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">📚</div>
                <h3 class="empty-title">Buku Tidak Ditemukan</h3>
                <p class="empty-desc">Coba sesuaikan filter atau cari dengan kata kunci yang berbeda</p>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.3s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }, 3000);
            });
        });
    </script>
</body>
</html>
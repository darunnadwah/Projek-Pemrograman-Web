<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja – Bookify</title>
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
            padding: 6px 12px;
            border-radius: 6px;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
        }

        /* Header */
        .header {
            margin-bottom: 30px;
        }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #f0f0ff, #a99ef5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-sub {
            color: #8880c0;
            font-size: 14px;
        }

        /* Wrapper */
        .cart-wrapper {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
        }

        /* Cart Items */
        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .cart-item {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
            transition: all 0.2s;
        }

        .cart-item:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(124,106,247,0.3);
        }

        .cart-item-cover {
            width: 100px;
            height: 140px;
            background: linear-gradient(135deg, rgba(124,106,247,0.2), rgba(79,70,229,0.1));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: rgba(124,106,247,0.5);
            flex-shrink: 0;
        }

        .cart-item-content {
            flex: 1;
        }

        .cart-item-title {
            font-size: 15px;
            font-weight: 600;
            color: #f0f0ff;
            margin-bottom: 6px;
        }

        .cart-item-author {
            font-size: 12px;
            color: #8880c0;
            margin-bottom: 10px;
        }

        .cart-item-price {
            font-size: 14px;
            font-weight: 600;
            color: #7c6af7;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-right: 20px;
        }

        .qty-control {
            display: flex;
            align-items: center;
            background: rgba(124,106,247,0.1);
            border-radius: 6px;
            padding: 4px 8px;
            gap: 8px;
        }

        .qty-btn {
            background: none;
            border: none;
            color: #7c6af7;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            padding: 0 4px;
            transition: color 0.2s;
        }

        .qty-btn:hover {
            color: #a99ef5;
        }

        .qty-display {
            min-width: 30px;
            text-align: center;
            font-weight: 600;
            color: #f0f0ff;
        }

        .subtotal {
            font-size: 14px;
            font-weight: 600;
            color: #a99ef5;
            min-width: 100px;
            text-align: right;
        }

        .btn-remove {
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.3);
            color: #fca5a5;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-remove:hover {
            background: rgba(248, 113, 113, 0.2);
            border-color: rgba(248, 113, 113, 0.5);
        }

        /* Summary */
        .cart-summary {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 24px;
            height: fit-content;
            position: sticky;
            top: 80px;
        }

        .summary-title {
            font-size: 14px;
            font-weight: 600;
            color: #8880c0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 16px;
            display: block;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            font-size: 13px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            color: #b8b8c7;
        }

        .summary-row:last-child {
            border-bottom: none;
            padding-top: 16px;
            padding-bottom: 0;
            font-size: 16px;
            font-weight: 700;
            color: #f0f0ff;
        }

        .summary-value {
            font-weight: 600;
            color: #7c6af7;
        }

        .summary-total {
            color: #7c6af7;
            font-size: 18px;
        }

        .btn-checkout {
            width: 100%;
            background: linear-gradient(135deg, #7c6af7, #5b4fe0);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-checkout:hover {
            box-shadow: 0 8px 25px rgba(124,106,247,0.4);
            transform: translateY(-2px);
        }

        .btn-checkout:active {
            transform: translateY(0);
        }

        .btn-clear-cart {
            width: 100%;
            background: rgba(248, 113, 113, 0.1);
            color: #fca5a5;
            border: 1px solid rgba(248, 113, 113, 0.3);
            border-radius: 8px;
            padding: 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            transition: all 0.2s;
        }

        .btn-clear-cart:hover {
            background: rgba(248, 113, 113, 0.2);
            border-color: rgba(248, 113, 113, 0.5);
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-title {
            font-size: 22px;
            font-weight: 600;
            color: #f0f0ff;
            margin-bottom: 8px;
        }

        .empty-desc {
            color: #8880c0;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .btn-continue-shopping {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #7c6af7, #5b4fe0);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-continue-shopping:hover {
            box-shadow: 0 8px 25px rgba(124,106,247,0.4);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .header-title {
                font-size: 24px;
            }

            .cart-wrapper {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }

            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item-controls {
                width: 100%;
                margin-right: 0;
                justify-content: space-between;
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
            <div class="nav-logo">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: white;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
            </div>
            <div>
                <div class="nav-brand-name">Bookify</div>
                <div class="nav-brand-sub">DIGITAL LIBRARY</div>
            </div>
        </a>
        <a href="{{ route('books.index') }}" class="back-btn">
            <i class="ti ti-arrow-left"></i>
            Kembali ke Katalog
        </a>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="header-title" style="display: flex; align-items: center; gap: 8px;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #a99ef5;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                Keranjang Belanja
            </h1>
            <p class="header-sub">Periksa pesanan Anda sebelum checkout</p>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            <!-- Cart Content -->
            <div class="cart-wrapper">
                <!-- Items -->
                <div class="cart-items">
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $subtotal = $details['price'] * $details['quantity']; $total += $subtotal; @endphp
                        <div class="cart-item">
                            <div class="cart-item-cover">
                                @if(isset($details['image']) && $details['image'])
                                    <img src="{{ $details['image'] }}" alt="{{ $details['title'] }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: rgba(124,106,247,0.5);"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
                                @endif
                            </div>
                            <div class="cart-item-content">
                                <div class="cart-item-title">{{ $details['title'] }}</div>
                                <div class="cart-item-author">Penulis: {{ $details['author'] ?? 'Tidak Diketahui' }}</div>
                                <div class="cart-item-price">Rp {{ number_format($details['price'], 0, ',', '.') }}</div>
                            </div>
                            <div class="cart-item-controls">
                                <div class="qty-control">
                                    <button class="qty-btn">−</button>
                                    <div class="qty-display">{{ $details['quantity'] }}</div>
                                    <button class="qty-btn">+</button>
                                </div>
                                <div class="subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                        <i class="ti ti-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <div class="cart-summary">
                    <label class="summary-title">Ringkasan Pesanan</label>
                    
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span class="summary-value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Pajak (10%)</span>
                        <span class="summary-value">Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Bayar</span>
                        <span class="summary-total">Rp {{ number_format($total * 1.1, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-checkout">
                            <i class="ti ti-lock"></i>
                            Lanjut ke Checkout
                        </button>
                    </form>

                    <a href="{{ route('cart.clear') }}" 
                    class="btn-clear-cart" 
                    onclick="return confirm('Kosongkan semua item dalam keranjang?')"
                    style="
                        text-decoration: none; 
                        display: flex; 
                        align-items: center; 
                        justify-content: center; 
                        gap: 8px;
                        width: 100%;
                        padding: 10px;
                    ">
                        <i class="ti ti-trash"></i>
                        <span>Kosongkan Keranjang</span>
                    </a>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="cart-wrapper">
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto; color: #5a5680;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg>
                    </div>
                    <h2 class="empty-title">Keranjang Anda Kosong</h2>
                    <p class="empty-desc">Mulai belanja buku favorit Anda sekarang</p>
                    <a href="{{ route('books.index') }}" class="btn-continue-shopping">
                        <i class="ti ti-shopping-cart"></i>
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        @endif
    </div>

</body>
</html>
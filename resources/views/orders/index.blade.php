@php
    $referer = request()->headers->get('referer');
    $currentPath = request()->path();
    if ($referer && !str_contains($referer, $currentPath)) {
        session(['back_url_' . $currentPath => $referer]);
    }
    $backUrl = session('back_url_' . $currentPath, route('dashboard'));
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
    <title>Pesanan Saya – Bookify</title>
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

        .order-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 24px; margin-bottom: 20px;
            transition: all 0.3s;
        }
        .order-card:hover {
            border-color: rgba(124,106,247,0.4);
            background: rgba(255,255,255,0.06);
            transform: translateY(-2px);
        }
        .order-header {
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding-bottom: 16px; margin-bottom: 16px;
        }
        .order-id { font-weight: 700; color: #a99ef5; font-size: 16px; }
        .order-date { font-size: 12px; color: #8880c0; }
        
        .order-status {
            font-size: 12px; font-weight: 700;
            padding: 4px 12px; border-radius: 50px;
        }
        .status-pending { background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3); }
        .status-delivered { background: rgba(34,197,94,0.15); color: #86efac; border: 1px solid rgba(34,197,94,0.3); }
        
        .order-body { display: flex; justify-content: space-between; align-items: center; }
        .order-details { font-size: 14px; color: #b8b8c7; }
        .order-details strong { color: #f0f0ff; }
        .order-total { text-align: right; }
        .total-label { font-size: 11px; color: #8880c0; text-transform: uppercase; }
        .total-amount { font-size: 20px; font-weight: 700; color: #7c6af7; margin-top: 4px; }

        .empty-state {
            text-align: center; padding: 80px 20px;
            background: rgba(255,255,255,0.02);
            border: 1px dashed rgba(255,255,255,0.06);
            border-radius: 20px;
        }
        .empty-icon { font-size: 48px; margin-bottom: 20px; color: #5a5680; }
        .empty-icon svg { width: 64px; height: 64px; color: #5a5680; margin: 0 auto; }
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
        <a href="{{ $backUrl }}" class="back-btn" id="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle; margin-right:4px;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span id="back-button-text">{{ $backLabel }}</span>
        </a>
    </nav>

    <div class="container">
        <div class="header">
            <h1 class="header-title">Pesanan Saya</h1>
            <p class="header-sub">Daftar riwayat transaksi belanja buku Anda di Bookify</p>
        </div>

        @if($orders->count() > 0)
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <span class="order-id">#BKF-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span class="order-date" style="margin-left: 12px;">Dipesan pada: {{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <span class="order-status {{ $order->status == 'pending' ? 'status-pending' : 'status-delivered' }}">
                            {{ $order->status == 'pending' ? 'Diproses' : 'Diterima' }}
                        </span>
                    </div>
                    <div class="order-body">
                        <div class="order-details">
                            Transaksi pembelian buku selesai. Silakan cek file e-book di menu <strong>Sedang Dibaca</strong>.
                        </div>
                        <div class="order-total">
                            <div class="total-label">Total Pembayaran</div>
                            <div class="total-amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h2 class="empty-title">Belum Ada Transaksi</h2>
                <p class="empty-desc">Anda belum melakukan pemesanan buku apa pun.</p>
                <a href="{{ route('books.index') }}" class="btn-shop">Mulai Jelajahi Katalog</a>
            </div>
        @endif
    </div>


</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #080810;
            color: #f0f0ff;
            min-height: 100vh;
            padding: 24px;
        }

        .page-shell {
            max-width: 980px;
            margin: 0 auto;
            position: relative;
        }

        .panel {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            padding: 32px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(0,0,0,0.18);
        }

        .panel::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(124,106,247,0.12) 0%, transparent 68%);
            pointer-events: none;
        }

        .panel::after {
            content: '';
            position: absolute;
            bottom: -90px;
            left: 10%;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(79,70,229,0.08) 0%, transparent 66%);
            pointer-events: none;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 18px;
            align-items: flex-start;
        }

        .meta-row h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.25rem;
            margin-bottom: 8px;
            color: #f8f8ff;
        }

        .meta-row p {
            max-width: 640px;
            color: rgba(240,240,255,0.76);
            line-height: 1.75;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 999px;
            color: #d8d8ff;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-back:hover {
            background: rgba(255,255,255,0.1);
        }

        .alert {
            margin-bottom: 22px;
            padding: 16px 18px;
            border-radius: 14px;
            font-weight: 600;
            text-align: center;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            color: #a7f3d0;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .alert-error {
            background: rgba(248, 113, 113, 0.12);
            color: #fecaca;
            border: 1px solid rgba(248, 113, 113, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
            background: rgba(255,255,255,0.04);
            border-radius: 18px;
            overflow: hidden;
        }

        th, td {
            padding: 16px 18px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        th {
            background: rgba(255,255,255,0.08);
            color: #e9e7ff;
            font-weight: 700;
        }

        tbody tr:last-child td { border-bottom: none; }

        td {
            color: rgba(240,240,255,0.84);
        }

        .summary {
            margin-top: 28px;
            display: grid;
            gap: 16px;
        }

        .summary-box {
            padding: 20px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .summary-box strong {
            display: block;
            margin-bottom: 10px;
            color: #f8f8ff;
        }

        .summary-box span {
            color: #c7c5ff;
            font-size: 1rem;
        }

        .checkout-form {
            margin-top: 32px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .checkout-btn {
            width: fit-content;
            background: linear-gradient(135deg, #7c6af7 0%, #4f46e5 100%);
            color: #ffffff;
            padding: 14px 26px;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 700;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .checkout-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 40px rgba(124,106,247,0.22);
        }

        .notice {
            color: rgba(240,240,255,0.74);
            font-size: 0.96rem;
            line-height: 1.6;
            max-width: 760px;
        }

        @media (max-width: 720px) {
            .meta-row { flex-direction: column; }
            .panel { padding: 24px; }
            th, td { padding: 12px 14px; }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        <div class="panel">
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif

            <div class="meta-row">
                <div>
                    <a href="{{ route('cart.index') }}" class="btn-back">← Kembali ke Keranjang</a>
                    <h1>Checkout Pesanan</h1>
                    <p>Periksa kembali semua buku sebelum menyelesaikan pembayaran, lalu konfirmasi untuk menyelesaikan pesanan.</p>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                        <tr>
                            <td>{{ $details['title'] }}</td>
                            <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="summary">
                <div class="summary-box">
                    <strong>Total Pembayaran</strong>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="summary-box">
                    <strong>Catatan</strong>
                    <span>Setelah checkout, pesanan akan disimpan dan stok buku akan diperbarui secara otomatis.</span>
                </div>
            </div>

            <div class="checkout-form">
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-btn">Konfirmasi Checkout</button>
                </form>
                <p class="notice">Pastikan Anda sudah login dan data keranjang sudah benar sebelum melanjutkan.</p>
            </div>
        </div>
    </div>
</body>
</html>

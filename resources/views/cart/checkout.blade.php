<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
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

        /* Center align columns */
        th:nth-child(2), td:nth-child(2),
        th:nth-child(3), td:nth-child(3),
        th:nth-child(4), td:nth-child(4) {
            text-align: center;
        }

        .qty-actions {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .qty-actions form {
            display: inline-block;
            margin: 0;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 999px;
            color: #f0f0ff;
            cursor: pointer;
            font-size: 1rem;
            line-height: 1;
        }

        .qty-display {
            min-width: 38px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .remove-btn,
        .btn-clear-cart {
            background: linear-gradient(135deg, #7c6af7 0%, #4f46e5 100%);
            color: #ffffff;
            border: none;
            border-radius: 999px;
            padding: 12px 20px;
            cursor: pointer;
            font-weight: 700;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .remove-btn:hover,
        .btn-clear-cart:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 40px rgba(124,106,247,0.22);
        }

        .checkout-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            margin-top: 28px;
        }

        .checkout-actions a {
            text-decoration: none;
        }

        .notice {
            margin-top: 18px;
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
            padding: 12px 20px;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 700;
            transition: transform 0.2s, box-shadow 0.2s;
            font-size: 0.95rem;
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

        /* Modal styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: rgba(8, 8, 16, 0.98);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 32px;
            max-width: 420px;
            width: 90%;
            text-align: center;
        }

        .modal-content h2 {
            font-size: 1.4rem;
            margin-bottom: 12px;
            color: #f0f0ff;
        }

        .modal-content p {
            font-size: 1rem;
            color: rgba(240, 240, 255, 0.7);
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            justify-content: center;
        }

        .modal-btn {
            padding: 14px 26px !important;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, #7c6af7 0%, #4f46e5 100%);
            color: #ffffff !important;
            cursor: pointer;
            font-weight: 700;
            transition: transform 0.2s, box-shadow 0.2s;
            font-size: 1rem !important;
            width: 100% !important;
            display: block !important;
        }

        .modal-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 40px rgba(124,106,247,0.22);
        }

        .modal-btn.danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border-color: none;
            color: #ffffff !important;
        }

        .modal-btn.danger:hover {
            box-shadow: 0 18px 40px rgba(239,68,68,0.22);
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
                    <a href="{{ route('books.index') }}" class="btn-back">← Kembali ke Katalog</a>
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                        <tr>
                            <td>
                                <div>{{ $details['title'] }}</div>
                                @if(isset($details['author']))
                                    <div style="font-size: 0.95rem; color: rgba(240,240,255,0.64); margin-top: 4px;">Penulis: {{ $details['author'] }}</div>
                                @endif
                            </td>
                            <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                            <td>
                                <div class="qty-actions">
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="decrement">
                                        <button type="submit" class="qty-btn">−</button>
                                    </form>
                                    <span class="qty-display">{{ $details['quantity'] }}</span>
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="increment">
                                        <button type="submit" class="qty-btn">+</button>
                                    </form>
                                </div>
                            </td>
                            <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" style="margin: 0; display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                        <i class="ti ti-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
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

            <div class="checkout-actions">
                <form action="{{ route('checkout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="checkout-btn">Konfirmasi Checkout</button>
                </form>
                <button type="button" class="btn-clear-cart" id="clear-cart-btn">
                    <i class="ti ti-trash"></i>
                    Kosongkan Keranjang
                </button>
            </div>
            <p class="notice">Pastikan Anda sudah login dan data keranjang sudah benar sebelum melanjutkan.</p>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal-overlay" id="clearCartModal">
        <div class="modal-content">
            <h2>Kosongkan Keranjang?</h2>
            <p>Semua item dalam keranjang akan dihapus. Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-actions">
                <button type="button" class="modal-btn" id="cancelBtn">Batal</button>
                <button type="button" class="modal-btn danger" id="confirmBtn">Kosongkan</button>
            </div>
        </div>
    </div>

    <script>
        const clearCartBtn = document.getElementById('clear-cart-btn');
        const modal = document.getElementById('clearCartModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');

        clearCartBtn.addEventListener('click', () => {
            modal.classList.add('active');
        });

        cancelBtn.addEventListener('click', () => {
            modal.classList.remove('active');
        });

        confirmBtn.addEventListener('click', () => {
            window.location.href = '{{ route("cart.clear") }}';
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    </script>
</body>
</html>

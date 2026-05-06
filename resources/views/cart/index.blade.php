<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f4f4; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #333; color: white; }
        .btn-back { text-decoration: none; color: #007bff; font-weight: bold; }
        .total-section { margin-top: 20px; text-align: right; font-size: 1.2em; font-weight: bold; }
        .checkout-btn { background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>

    <a href="{{ route('books.index') }}" class="btn-back">← Kembali ke Katalog</a>
    <h1>🛒 Keranjang Belanja Anda</h1>
    <a href="{{ route('cart.clear') }}" style="color: red; font-size: 0.9em;" onclick="return confirm('Kosongkan semua?')">Kosongkan Keranjang</a>
    @if(session('cart'))
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
                @php $total = 0 @endphp
                @foreach($cart as $id => $details)
                    @php $subtotal = $details['price'] * $details['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $details['title'] }}</td>
                        <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            Total Bayar: Rp {{ number_format($total, 0, ',', '.') }}
            <br><br>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="checkout-btn">Proses Checkout Sekarang →</button>
            </form>
        </div>
    @else
        <p>Keranjang Anda masih kosong. Yuk belanja dulu!</p>
    @endif

</body>
</html>
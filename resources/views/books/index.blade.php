<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku Perpustakaan</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f4f4; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #333; color: white; }
        tr:nth-child(even) { background-color: #f2 f2 f2; }
        .badge { padding: 5px 10px; border-radius: 5px; font-size: 12px; color: white; }
        .badge-phys { background-color: #28a745; }
        .badge-ebook { background-color: #007bff; }
    </style>
</head>
<body>

    @if(session('success'))
        <div id="success-alert" style="background-color: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px; font-weight: bold; text-align: center;">
                ✅ {{ session('success') }}
            </div>
    @endif

    @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 20px; font-weight: bold; text-align: center;">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div style="text-align: right;">
        <a href="{{ route('cart.index') }}" style="text-decoration: none; font-weight: bold; color: #333;">
            🛒 Keranjang ({{ count((array) session('cart')) }})
        </a>
    </div>
    <h1>📚 Katalog Buku Kami</h1>
    <div style="margin-bottom: 20px;">
            <h3 style="margin-bottom: 10px;">Filter Kategori:</h3>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('books.index') }}" 
                    style="text-decoration: none; padding: 8px 15px; background: {{ !request('category') ? '#333' : '#e0e0e0' }}; color: {{ !request('category') ? 'white' : '#333' }}; border-radius: 5px; font-size: 14px;">
                    Semua
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('books.index', ['category' => $category->id]) }}" 
                        style="text-decoration: none; padding: 8px 15px; background: {{ request('category') == $category->id ? '#333' : '#e0e0e0' }}; color: {{ request('category') == $category->id ? 'white' : '#333' }}; border-radius: 5px; font-size: 14px;">
                        {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tipe</th>
                <th>Stok Fisik  </th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td><strong>{{ $book->title }}</strong></td>
                <td>{{ $book->year }}</td>
                <td>{{ $book->category->name }}</td>
                <td>{{ $book->author->name }}</td>
                <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                <td>
                    @if($book->type == 'physical')
                        <span class="badge badge-phys">Fisik</span>
                    @elseif($book->type == 'ebook')
                        <span class="badge badge-ebook">E-book</span>
                    @else
                        <span class="badge badge-phys">Fisik</span> & <span class="badge badge-ebook">E-book</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                            <!-- Angka Stok di Kiri -->
                            <span style="font-weight: bold; min-width: 50px;">{{ $book->stock }} pcs</span>
                            <!-- Grup Tombol di Kanan -->
                            <div style="display: flex; gap: 5px;">
                                <!-- Tombol Tambah (+) -->
                            <form action="{{ route('books.add-stock', $book->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" title="Tambah Stok" style="background: #28a745; color: white; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer; font-weight: bold; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                 +
                                </button>
                            </form>

                            <!-- Tombol Kurang (-) -->
                            <form action="{{ route('books.reduce-stock', $book->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" title="Kurangi Stok" {{ $book->stock <= 0 ? 'disabled' : '' }} style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: {{ $book->stock <= 0 ? 'not-allowed' : 'pointer' }}; font-weight: bold; display: flex; align-items: center; justify-content: center; font-size: 14px; opacity: {{ $book->stock <= 0 ? '0.5' : '1' }};">
                                -
                                 </button>
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="{{ route('cart.add', $book->id) }}" method="POST">
                @csrf
                        <button type="submit" style="background: #ffc107; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-weight: bold;">
                    🛒 Tambah
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<script>
    // Tunggu sampai halaman selesai loading
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            // Set timer 5000 milidetik (5 detik)
            setTimeout(function() {
                // Tambahkan efek transisi biar nggak langsung hilang kaget
                alert.style.transition = "opacity 1s ease";
                alert.style.opacity = "0";
                
                // Hapus elemen dari layar setelah transisi selesai
                setTimeout(function() {
                    alert.remove();
                }, 1000);
            }, 2000); 
        }
    });
</script>
</body>
</html>
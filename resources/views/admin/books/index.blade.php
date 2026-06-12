@extends('admin.layout')

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="greeting">Kelola Buku</h1>
            <p class="subtext">Tambah, hapus, dan perbarui stok buku.</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="button button-primary">Tambah Buku baru</a>
    </div>

    <div class="card">
        <div class="card-title">Daftar Buku</div>
        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->name ?? 'N/A' }}</td>
                            <td>{{ $book->publisher->name ?? 'N/A' }}</td>
                            <td>{{ $book->category->name ?? 'N/A' }}</td>
                            <td>{{ $book->stock }}</td>
                            <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($book->type) }}</td>
                            <td>
                                <div class="form-actions">
                                    <form action="{{ route('admin.books.updateStock', $book) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="operation" value="increase">
                                        <button type="submit" class="button button-secondary">+ Stok</button>
                                    </form>
                                    <form action="{{ route('admin.books.updateStock', $book) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="operation" value="decrease">
                                        <button type="submit" class="button button-secondary">- Stok</button>
                                    </form>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button button-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding: 24px; text-align: center; color: #8b88b6;">Belum ada buku tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

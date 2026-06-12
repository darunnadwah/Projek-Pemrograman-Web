@extends('admin.layout')

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="greeting">Tambah Buku</h1>
            <p class="subtext">Isi data buku baru untuk ditambahkan ke koleksi.</p>
        </div>
        <a href="{{ route('admin.books.index') }}" class="button button-secondary">Kembali ke daftar</a>
    </div>

    <div class="card">
        <div class="card-title">Form Tambah Buku</div>
        <form action="{{ route('admin.books.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="title">Judul Buku</label>
                <input id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="input-group">
                <label for="author_id">Penulis</label>
                <select id="author_id" name="author_id" required>
                    <option value="">Pilih Penulis</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
                <label for="publisher_id">Penerbit</label>
                <select id="publisher_id" name="publisher_id" required>
                    <option value="">Pilih Penerbit</option>
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
                <label for="category_id">Kategori</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
                <label for="year">Tahun Terbit</label>
                <input id="year" name="year" type="number" value="{{ old('year') }}" required>
            </div>
            <div class="input-group">
                <label for="price">Harga</label>
                <input id="price" name="price" type="number" step="0.01" value="{{ old('price') }}" required>
            </div>
            <div class="input-group">
                <label for="stock">Stok</label>
                <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', 1) }}" required>
            </div>
            <div class="input-group">
                <label for="type">Tipe Buku</label>
                <select id="type" name="type" required>
                    <option value="physical" {{ old('type') == 'physical' ? 'selected' : '' }}>Physical</option>
                    <option value="ebook" {{ old('type') == 'ebook' ? 'selected' : '' }}>Ebook</option>
                    <option value="both" {{ old('type') == 'both' ? 'selected' : '' }}>Both</option>
                </select>
            </div>
            <div class="input-group">
                <label for="image">URL Gambar (opsional)</label>
                <input id="image" name="image" value="{{ old('image') }}">
            </div>
            <div class="input-group">
                <label for="file_path">File Path Ebook (opsional)</label>
                <input id="file_path" name="file_path" value="{{ old('file_path') }}">
            </div>
            <div class="form-actions">
                <button type="submit" class="button button-primary">Simpan Buku</button>
            </div>
        </form>
    </div>
@endsection

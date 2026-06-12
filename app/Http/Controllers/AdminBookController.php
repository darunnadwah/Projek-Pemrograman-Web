<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    private function ensureAdmin()
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index()
    {
        $this->ensureAdmin();

        $books = Book::with(['category', 'author', 'publisher'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $this->ensureAdmin();

        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();

        return view('admin.books.create', compact('categories', 'authors', 'publishers'));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $attributes = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'type' => 'required|in:physical,ebook,both',
            'image' => 'nullable|string|max:1024',
            'file_path' => 'nullable|string|max:1024',
        ]);

        Book::create($attributes);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function destroy(Book $book)
    {
        $this->ensureAdmin();

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function updateStock(Request $request, Book $book)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'operation' => 'required|in:increase,decrease',
        ]);

        if ($data['operation'] === 'increase') {
            $book->increment('stock');
        } elseif ($data['operation'] === 'decrease' && $book->stock > 0) {
            $book->decrement('stock');
        }

        return back()->with('success', 'Stok buku berhasil diperbarui.');
    }
}

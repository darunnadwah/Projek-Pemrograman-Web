<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Fungsi untuk Halaman Utama (Welcome Page)
    public function welcome()
    {
        $categories = Category::all();
        // Kita ambil beberapa buku untuk dipajang di rak
        $featuredBooks = Book::take(10)->get(); 

        return view('welcome', compact('categories', 'featuredBooks'));
    }

    // Fungsi untuk Halaman Katalog (Katalog Buku)
    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $categoryIds = $request->input('category', []);

        $books = Book::with(['category', 'author', 'publisher'])
            // Filter Search (Judul atau Nama Author)
            ->when($keyword, function ($query, $keyword) {
                return $query->where('title', 'like', '%' . $keyword . '%')
                             ->orWhereHas('author', function($q) use ($keyword) {
                                 $q->where('name', 'like', '%' . $keyword . '%');
                             });
            })
            // Filter Tombol Kategori
            ->when(!empty($categoryIds), function ($query) use ($categoryIds) {
                        return $query->whereIn('category_id', $categoryIds);
                    })
            ->get();

        $categories = Category::all();

        return view('books.index', compact('books', 'categories', 'categoryIds'));
    }
}
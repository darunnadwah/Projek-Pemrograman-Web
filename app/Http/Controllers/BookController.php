<?php

namespace App\Http\Controllers;

use App\Models\Book; // Memanggil model Book agar bisa mengambil data
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        // Mengambil semua data buku beserta relasinya (category, author, dsb)
        $books = Book::with(['category', 'author', 'publisher'])->get();

        $categories = Category::all();

        // Mengarahkan ke file resources/views/books/index.blade.php
        return view('books.index', compact('books', 'categories'));
    }
}
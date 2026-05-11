<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil Data Statistik
        $stats = [
            'total_books'      => Book::count(),
            'total_categories' => Category::count(),
            'total_users'      => User::count(),
            // Contoh: menghitung buku yang stoknya > 0
            'available_books'  => Book::where('stock', '>', 0)->count(), 
        ];

        // 2. Mengambil 5 Buku Terbaru yang baru ditambahkan
        $recentBooks = Book::with('category')->latest()->take(5)->get();

        // 3. Mengambil Kategori dan jumlah buku di dalamnya
        // Pastikan di Model Category sudah ada relasi: public function books() { return $this->hasMany(Book::class); }
        $categories = Category::withCount('books')->get();

        // 4. Kirim data ke view dashboard.blade.php
        return view('dashboard', compact('stats', 'recentBooks', 'categories'));
    }
}
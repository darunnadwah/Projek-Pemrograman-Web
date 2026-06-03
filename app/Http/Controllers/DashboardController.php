<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Seed dummy session data for reading list & wishlist if empty, to look realistic
        $reading = session()->get('reading', []);
        if (empty($reading)) {
            $book1 = Book::where('title', 'Laskar Pelangi')->first();
            $book2 = Book::where('title', 'Belajar Laravel untuk Pemula')->first();
            $book3 = Book::where('title', 'Filosofi Teras')->first();
            
            if ($book1) {
                $reading[$book1->id] = ['progress' => 68, 'current_page' => 272, 'total_pages' => 400];
            }
            if ($book2) {
                $reading[$book2->id] = ['progress' => 33, 'current_page' => 88, 'total_pages' => 265];
            }
            if ($book3) {
                $reading[$book3->id] = ['progress' => 12, 'current_page' => 25, 'total_pages' => 209];
            }
            session()->put('reading', $reading);
        }

        $wishlist = session()->get('wishlist', []);
        if (empty($wishlist)) {
            $wBook1 = Book::where('title', 'Metodologi Penelitian Sosial')->first();
            $wBook2 = Book::where('title', 'Biografi Steve Jobs')->first();
            $wBook3 = Book::where('title', 'Kaya Itu Mudah')->first();
            
            if ($wBook1) $wishlist[$wBook1->id] = true;
            if ($wBook2) $wishlist[$wBook2->id] = true;
            if ($wBook3) $wishlist[$wBook3->id] = true;
            session()->put('wishlist', $wishlist);
        }

        // 2. Fetch Books for Reading and Wishlist
        $readingIds = array_keys(session()->get('reading', []));
        $readingBooks = Book::with(['category', 'author'])->whereIn('id', $readingIds)->get()->map(function($book) {
            $progressData = session()->get('reading')[$book->id] ?? ['progress' => 0, 'current_page' => 0, 'total_pages' => 100];
            $book->progress = $progressData['progress'];
            $book->current_page = $progressData['current_page'];
            $book->total_pages = $progressData['total_pages'];
            return $book;
        });

        $wishlistIds = array_keys(session()->get('wishlist', []));
        $wishlistBooks = Book::with(['category', 'author'])->whereIn('id', $wishlistIds)->take(4)->get();

        // 3. User stats
        $purchasedCount = Order::where('user_id', $userId)->count();
        $readingCount = count($readingBooks);
        $finishedCount = collect(session()->get('reading', []))->where('progress', 100)->count();
        $wishlistCount = count(session()->get('wishlist', []));

        $stats = [
            'purchased_count' => $purchasedCount,
            'reading_count'   => $readingCount,
            'finished_count'  => $finishedCount,
            'wishlist_count'  => $wishlistCount,
        ];

        // 4. User's orders
        $recentOrders = Order::where('user_id', $userId)->latest()->take(4)->get();

        // 5. Recommendations (random books)
        $recommendations = Book::with(['category', 'author'])->inRandomOrder()->take(5)->get();

        // 6. Categories count
        $categories = Category::withCount('books')->get();

        return view('dashboard', compact('stats', 'readingBooks', 'wishlistBooks', 'recentOrders', 'recommendations', 'categories'));
    }
}
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
        return view('welcome');
    });

Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
// Route sementara untuk tambah stok buku
Route::post('/books/{id}/add-stock', function ($id) {
        $book = \App\Models\Book::findOrFail($id);
        $book->increment('stock'); // Tambah 1
        return back();
    })->name('books.add-stock');
Route::post('/books/{id}/add-stock', function ($id) {
        $book = \App\Models\Book::findOrFail($id);
        
        // 1. Tambahkan stok fisiknya
        $book->increment('stock');

        // 2. Cek Logika Tipe Buku
        // Jika awalnya ebook, sekarang ada stok fisik -> jadi 'both' (Fisik & E-book)
        if ($book->type == 'ebook') {
            $book->type = 'both';
        } 
        // Jika awalnya kosong/tidak terdefinisi dan stok jadi ada -> jadi 'physical'
        elseif (empty($book->type) || $book->type == '') {
            $book->type = 'physical';
        }
        $book->save();
        return back();
    })->name('books.add-stock');
// Route untuk kurangi stok fisik
Route::post('/books/{id}/reduce-stock', function ($id) {
    $book = \App\Models\Book::findOrFail($id);
    
    if ($book->stock > 0) {
        $book->decrement('stock');
        
        // Logika Tipe: Jika stok jadi 0 dan tipenya 'both', balikkan ke 'ebook'
        if ($book->stock == 0 && $book->type == 'both') {
            $book->type = 'ebook';
        } 
        // Jika stok jadi 0 dan tipenya 'physical', biarkan tetap physical (atau sesuai keinginanmu)
        $book->save();
    }

    return back();
})->name('books.reduce-stock');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Keranjang
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

require __DIR__.'/auth.php';

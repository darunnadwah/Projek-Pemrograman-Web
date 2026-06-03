<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;

Route::get('/admin/dashboard', function () {
    return view('admin-dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Route untuk halaman katalog buku
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/katalog', [BookController::class, 'index'])->name('books.index');
Route::get('/', [BookController::class, 'welcome'])->name('welcome');

// Route sementara untuk tambah stok buku
Route::post('/books/{id}/add-stock', function ($id) {
    $book = \App\Models\Book::findOrFail($id);
    $book->increment('stock');

    if ($book->type == 'ebook') {
        $book->type = 'both';
    } elseif (empty($book->type) || $book->type == '') {
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

        if ($book->stock == 0 && $book->type == 'both') {
            $book->type = 'ebook';
        }
        $book->save();
    }

    return back();
})->name('books.reduce-stock');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/checkout', [CartController::class, 'checkoutPage'])->name('checkout.page');
});

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

// Keranjang
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Password reset code routes
Route::get('/forgot-password-code', [PasswordResetController::class, 'showRequestForm'])->name('password.request-code');
Route::post('/forgot-password-code', [PasswordResetController::class, 'sendResetCode'])->name('password.send-code');
Route::get('/reset-password-code', [PasswordResetController::class, 'showResetForm'])->name('password.show-reset-form');
Route::post('/reset-password-code', [PasswordResetController::class, 'resetPassword'])->name('password.reset-with-code');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminUserController;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/books', [AdminBookController::class, 'index'])->name('admin.books.index');
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [AdminBookController::class, 'store'])->name('admin.books.store');
    Route::patch('/books/{book}/stock', [AdminBookController::class, 'updateStock'])->name('admin.books.updateStock');
    Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

// Route untuk halaman katalog buku
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/katalog', [BookController::class, 'index'])->name('books.index');
Route::get('/', [BookController::class, 'welcome'])->name('welcome');

// Route untuk halaman tentang kami
Route::get('/tentang', function () {
    return view('about');
})->name('about');

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

    // Checkout page
    Route::get('/checkout', [CartController::class, 'checkoutPage'])->name('checkout.page');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Wishlist routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Reading routes
    Route::get('/reading', [ReadingController::class, 'index'])->name('reading.index');
    Route::post('/reading/start/{id}', [ReadingController::class, 'start'])->name('reading.start');
    Route::post('/reading/update/{id}', [ReadingController::class, 'updateProgress'])->name('reading.update');

    // Settings route
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
});

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

// Keranjang
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
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

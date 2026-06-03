<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        $books = Book::with(['category', 'author'])->whereIn('id', array_keys($wishlist))->get();
        return view('wishlist.index', compact('books'));
    }

    public function add($id)
    {
        $book = Book::findOrFail($id);
        $wishlist = session()->get('wishlist', []);

        if (!isset($wishlist[$id])) {
            $wishlist[$id] = true;
            session()->put('wishlist', $wishlist);
            return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke Wishlist!');
        }

        return redirect()->back()->with('success', 'Buku sudah ada di Wishlist Anda.');
    }

    public function remove($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
            return redirect()->back()->with('success', 'Buku berhasil dihapus dari Wishlist!');
        }

        return redirect()->back()->with('error', 'Buku tidak ditemukan di Wishlist Anda.');
    }
}

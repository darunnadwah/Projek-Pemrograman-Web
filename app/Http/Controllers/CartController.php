<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('cart.checkout', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $quantity = (int) $request->input('quantity', 1);
        if ($quantity < 1) {
            $quantity = 1;
        }

        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Stok buku tidak tersedia.');
        }

        $cart = session()->get('cart', []);
        $currentQuantity = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;

        if ($quantity > $book->stock || $currentQuantity + $quantity > $book->stock) {
            return redirect()->back()->with('error', 'Stok tidak cukup. Sisa stok hanya '.$book->stock.' buah.');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "title" => $book->title,
                "quantity" => $quantity,
                "price" => $book->price,
                "image" => $book->image // pastikan kolom image ada di tabel books
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang. Jumlah: '.$cart[$id]['quantity']);
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]); // Menghapus item berdasarkan ID
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari keranjang!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang telah dikosongkan!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
        }

        $action = $request->input('action');

        if ($action === 'increment') {
            $cart[$id]['quantity']++;
        } elseif ($action === 'decrement') {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Jumlah item keranjang berhasil diperbarui.');
    }

    public function checkoutPage()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk checkout.');
        }

        $cart = session()->get('cart', []);

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('cart.checkout', compact('cart', 'total'));
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        // 2. Simpan ke tabel orders
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart)),
            'status' => 'pending'
        ]);

        // 3. LOGIKA KURANGI STOK (Fitur Tambahan agar stok berkurang otomatis)
        foreach ($cart as $id => $details) {
            $book = \App\Models\Book::find($id);
            if ($book) {
                $book->decrement('stock', $details['quantity']);
                if ($book->stock <= 0 && $book->type == 'both') {
                    $book->type = 'ebook';
                    $book->save();
                }
            }
            
        }

        // 4. Kosongkan keranjang
        session()->forget('cart');

        return redirect()->route('books.index')->with('success', 'Pesanan berhasil dibuat dan stok telah diperbarui!');
    }
}
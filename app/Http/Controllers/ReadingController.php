<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ReadingController extends Controller
{
    public function index()
    {
        $reading = session()->get('reading', []);
        $books = Book::with(['category', 'author'])->whereIn('id', array_keys($reading))->get()->map(function($book) use ($reading) {
            $progressData = $reading[$book->id] ?? ['progress' => 0, 'current_page' => 0, 'total_pages' => 200];
            $book->progress = $progressData['progress'];
            $book->current_page = $progressData['current_page'];
            $book->total_pages = $progressData['total_pages'];
            return $book;
        });

        return view('reading.index', compact('books'));
    }

    public function start($id)
    {
        $book = Book::findOrFail($id);
        $reading = session()->get('reading', []);

        if (!isset($reading[$id])) {
            // Default 250 pages for books
            $reading[$id] = [
                'progress' => 0,
                'current_page' => 0,
                'total_pages' => 250
            ];
            session()->put('reading', $reading);
            return redirect()->route('reading.index')->with('success', 'Selamat membaca buku baru Anda!');
        }

        return redirect()->route('reading.index');
    }

    public function updateProgress(Request $request, $id)
    {
        $request->validate([
            'current_page' => 'required|integer|min:0',
            'total_pages' => 'required|integer|min:1'
        ]);

        $reading = session()->get('reading', []);

        if (isset($reading[$id])) {
            $currentPage = min($request->current_page, $request->total_pages);
            $totalPages = $request->total_pages;
            $progress = round(($currentPage / $totalPages) * 100);

            $reading[$id] = [
                'progress' => $progress,
                'current_page' => $currentPage,
                'total_pages' => $totalPages
            ];

            session()->put('reading', $reading);
            return redirect()->back()->with('success', 'Progres membaca berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Buku tidak ditemukan di daftar baca Anda.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    private function ensureAdmin()
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    public function index()
    {
        $this->ensureAdmin();

        return view('admin.dashboard', [
            'bookCount' => Book::count(),
            'userCount' => User::count(),
            'orderCount' => Order::count(),
        ]);
    }
}

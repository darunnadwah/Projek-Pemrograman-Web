@extends('admin.layout')

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="greeting">Halo, <em>{{ Auth::user()->name }}</em></h1>
            <p class="subtext">Dashboard admin Bookify</p>
        </div>
        <div class="admin-badge">Administrator</div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15z"/></svg>
            </div>
            <div class="stat-label">Total Buku</div>
            <div class="stat-value">{{ number_format($bookCount) }}</div>
            <div class="stat-sub">Koleksi aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg>
            </div>
            <div class="stat-label">Total User</div>
            <div class="stat-value">{{ number_format($userCount) }}</div>
            <div class="stat-sub">Pengguna terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div class="stat-label">Pesanan</div>
            <div class="stat-value">{{ number_format($orderCount) }}</div>
            <div class="stat-sub">Order yang tersimpan</div>
        </div>
    </div>

    <div class="card">
        <div class="card-title">Aksi Cepat</div>
        <div class="quick-actions">
            <a href="{{ route('admin.books.create') }}" class="action-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Buku
            </a>
            <a href="{{ route('admin.books.index') }}" class="action-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15z"/></svg>
                Kelola Buku
            </a>
            <a href="{{ route('admin.users.index') }}" class="action-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                Kelola User
            </a>
        </div>
    </div>
@endsection

@extends('admin.layout')

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="greeting">Kelola User</h1>
            <p class="subtext">Lihat daftar pengguna dan perbarui peran jika diperlukan.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-title">Daftar Pengguna</div>
        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td>
                                <div class="form-actions">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" style="display:flex; gap:10px; align-items:center;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="select-dark">
                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            <button type="submit" class="button button-secondary">Simpan</button>
                                        </form>
                                        @if($user->role !== 'admin')
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button button-danger">Hapus</button>
                                            </form>
                                        @endif
                                    @else
                                        <span style="color: #8b88b6; font-size: 13px;">Akun Anda</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 24px; text-align: center; color: #8b88b6;">Tidak ada pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Staff')

@section('content')
<div class="container">
    <h1>Edit Staff: {{ $user->name }}</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 8px;">
            @error('name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 8px;">
            @error('email') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="role">Role</label>
            <select name="role" id="role" required style="width: 100%; padding: 8px;">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ old('role', $user->role) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="koki" {{ old('role', $user->role) == 'koki' ? 'selected' : '' }}>Koki</option>
            </select>
            @error('role') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <hr style="margin: 20px 0;">
        <p><strong>Ubah Password (kosongkan jika tidak ingin ganti)</strong></p>

        <div style="margin-bottom: 15px;">
            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password" style="width: 100%; padding: 8px;">
            @error('password') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" style="width: 100%; padding: 8px;">
        </div>

        <button type="submit">Update Staff</button>
        <a href="{{ route('admin.users.index') }}">Batal</a>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Tambah Staff Baru')

@section('content')
<div class="container">
    <h1>Tambah Staff Baru</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 8px;">
            @error('name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 8px;">
            @error('email') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 8px;">
            @error('password') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="role">Role</label>
            <select name="role" id="role" required style="width: 100%; padding: 8px;">
                <option value="">Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="koki" {{ old('role') == 'koki' ? 'selected' : '' }}>Koki</option>
            </select>
            @error('role') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Simpan Staff</button>
        <a href="{{ route('admin.users.index') }}">Batal</a>
    </form>
</div>
@endsection

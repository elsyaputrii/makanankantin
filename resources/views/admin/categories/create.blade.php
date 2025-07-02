@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')

@section('content')
<div class="container">
    <h1>Tambah Kategori Baru</h1>

    {{-- Menampilkan error validasi umum jika ada --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form ini akan mengirim data ke route 'admin.categories.store' menggunakan method POST --}}
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf  {{-- Token keamanan Cross-Site Request Forgery, wajib ada di setiap form Laravel --}}

        <div>
            <label for="name">Nama Kategori</label>
            <br>
            {{-- Fungsi old('name') akan menjaga input pengguna jika validasi gagal dan halaman di-reload --}}
            <input type="text" id="name" name="name" value="{{ old('name') }}" style="width: 100%; padding: 8px; margin-top: 5px;">

            {{-- Menampilkan error spesifik untuk field 'name' --}}
            @error('name')
                <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-top: 15px;">Simpan</button>
        <a href="{{ route('admin.categories.index') }}" style="margin-left: 10px;">Batal</a>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Kategori Baru</h1>

    <!-- Pesan Success dan Error -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <!-- Input Nama Kategori -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 mt-2" placeholder="Nama kategori" required>
            @error('name') <div class="text-red-500 text-sm mt-2">{{ $message }}</div> @enderror
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500">Simpan</button>

        <!-- Tombol Batal -->
        <a href="{{ route('admin.categories.index') }}" class="ml-4 text-gray-600 hover:text-orange-500">Batal</a>
    </form>
</div>
@endsection

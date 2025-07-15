@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="text-center">
  <h1 class="text-4xl sm:text-5xl font-extrabold text-orange-600 mb-4">
    Selamat Datang di Dashboard Admin 🍽️
  </h1>
  <p class="text-lg sm:text-xl text-gray-600 mb-10">
    Kelola kategori, produk, dan staff dengan mudah melalui menu di atas.
  </p>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Kategori -->
    <a href="{{ route('admin.categories.index') }}" class="block hover:scale-[1.01] transition">
      <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg border-t-4 border-orange-500 text-left">
        <div class="flex items-center gap-3 mb-2">
          <i data-lucide="list" class="text-orange-500 w-5 h-5"></i>
          <h2 class="text-lg font-semibold text-orange-700">Kategori</h2>
        </div>
        <p class="text-sm text-gray-600 mt-1">Kelola jenis makanan dan minuman yang tersedia.</p>
      </div>
    </a>

    <!-- Produk -->
    <a href="{{ route('admin.products.index') }}" class="block hover:scale-[1.01] transition">
      <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg border-t-4 border-orange-500 text-left">
        <div class="flex items-center gap-3 mb-2">
          <i data-lucide="pizza" class="text-orange-500 w-5 h-5"></i>
          <h2 class="text-lg font-semibold text-orange-700">Produk</h2>
        </div>
        <p class="text-sm text-gray-600 mt-1">Tambah, edit, dan hapus menu makanan kantin.</p>
      </div>
    </a>

    <!-- Staff -->
    <a href="{{ route('admin.users.index') }}" class="block hover:scale-[1.01] transition">
  <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg border-t-4 border-orange-500 text-left">
    <div class="flex items-center gap-3 mb-2">
      <i data-lucide="users" class="text-orange-500 w-5 h-5"></i>
      <h2 class="text-lg font-semibold text-orange-700">Staff</h2>
    </div>
    <p class="text-sm text-gray-600 mt-1">Kelola akun dan peran staff kantin.</p>
  </div>
</a>
  </div>
</div>
@endsection

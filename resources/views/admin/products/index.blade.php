@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

  <!-- Header Judul & Tombol -->
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-orange-600">@yield('title')</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md shadow text-sm font-semibold">
  + Tambah Produk Baru
</a>
  </div>

  <!-- Notifikasi Sukses -->
  @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md shadow-sm">
      {{ session('success') }}
    </div>
  @endif

  <!-- Tabel Produk -->
  <div class="overflow-x-auto bg-white rounded-lg shadow-md ring-1 ring-orange-100">
    <table class="min-w-full divide-y divide-orange-100 text-sm text-gray-800">
      <thead class="bg-orange-500 text-white text-sm uppercase tracking-wide">
        <tr>
          <th class="px-6 py-3 text-left">No</th>
          <th class="px-6 py-3 text-left">Gambar</th>
          <th class="px-6 py-3 text-left">Nama Produk</th>
          <th class="px-6 py-3 text-left">Kategori</th>
          <th class="px-6 py-3 text-left">Harga</th>
          <th class="px-6 py-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-cream-100 divide-y divide-orange-100">
        @forelse ($products as $index => $product)
        <tr class="hover:bg-cream-200 transition duration-150">
          <td class="px-6 py-4">{{ $index + 1 }}</td>
          <td class="px-6 py-3">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-14 h-14 object-cover rounded-md border">
          </td>
          <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
          <td class="px-6 py-4">{{ $product->category->name ?? '-' }}</td>
          <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
          <td class="px-6 py-4 flex gap-3">
            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline font-semibold">Edit</a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline font-semibold">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center text-gray-500 px-6 py-6">Belum ada produk tersedia.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

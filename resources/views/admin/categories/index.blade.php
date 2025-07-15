@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-orange-600">@yield('title')</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-md shadow text-sm font-semibold">
      + Tambah Kategori
    </a>
  </div>

  @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
      {{ session('success') }}
    </div>
  @endif

  <div class="overflow-x-auto bg-white rounded-lg shadow-md ring-1 ring-orange-100">
    <table class="min-w-full divide-y divide-orange-100">
      <thead class="bg-orange-500 text-white text-sm">
        <tr>
          <th class="px-6 py-3 text-left font-semibold tracking-wide">No</th>
          <th class="px-6 py-3 text-left font-semibold">Nama Kategori</th>
          <th class="px-6 py-3 text-left font-semibold">Deskripsi</th>
          <th class="px-6 py-3 text-left font-semibold">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-cream-100 divide-y divide-orange-100 text-sm text-gray-700">
        @forelse ($categories as $index => $category)
        <tr class="hover:bg-cream-200 transition duration-150">
          <td class="px-6 py-4">{{ $index + 1 }}</td>
          <td class="px-6 py-4 font-medium">{{ $category->name}}</td>
          <td class="px-6 py-4">{{ $category->deskripsi ?? '-' }}</td>
          <td class="px-6 py-4 flex gap-3">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:underline font-semibold">Edit</a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline font-semibold">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="px-6 py-6 text-center text-gray-500">Belum ada kategori tersedia.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
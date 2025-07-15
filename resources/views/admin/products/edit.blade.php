@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8 bg-white rounded-xl shadow-md">

    <h1 class="text-2xl font-bold text-orange-600 mb-6">Edit Produk: {{ $product->name }}</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama Produk --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                   class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="category_id" id="category_id" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Harga --}}
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required
                   class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            @error('price')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk (Kosongkan jika tidak ingin ganti)</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-28 h-28 object-cover rounded-md">
                </div>
            @endif
            <input type="file" name="image" id="image"
                   class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex gap-4">
            <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-md font-medium shadow">
                Update Produk
            </button>
            <a href="{{ route('admin.products.index') }}"
               class="text-sm text-gray-600 hover:underline self-center">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

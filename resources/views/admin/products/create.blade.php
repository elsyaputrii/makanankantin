@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div style="max-width: 700px; margin: 0 auto; padding: 2rem; background-color: #fefdfb; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
  <h1 style="font-size: 24px; font-weight: bold; color: #e57300; margin-bottom: 1.5rem;">
    Tambah Produk Baru
  </h1>

  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Nama Produk -->
    <div style="margin-bottom: 15px;">
      <label for="name" style="display:block; margin-bottom:5px; font-weight:500;">Nama Produk</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}" required
             style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
      @error('name') <div style="color:red; font-size:13px;">{{ $message }}</div> @enderror
    </div>

    <!-- Kategori -->
    <div style="margin-bottom: 15px;">
      <label for="category_id" style="display:block; margin-bottom:5px; font-weight:500;">Kategori</label>
      <select name="category_id" id="category_id" required
              style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
        <option value="">Pilih Kategori</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      @error('category_id') <div style="color:red; font-size:13px;">{{ $message }}</div> @enderror
    </div>

    <!-- Harga -->
    <div style="margin-bottom: 15px;">
      <label for="price" style="display:block; margin-bottom:5px; font-weight:500;">Harga</label>
      <input type="number" name="price" id="price" value="{{ old('price') }}" required
             style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
      @error('price') <div style="color:red; font-size:13px;">{{ $message }}</div> @enderror
    </div>

    <!-- Deskripsi -->
    <div style="margin-bottom: 15px;">
      <label for="description" style="display:block; margin-bottom:5px; font-weight:500;">Deskripsi</label>
      <textarea name="description" id="description" rows="4"
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">{{ old('description') }}</textarea>
      @error('description') <div style="color:red; font-size:13px;">{{ $message }}</div> @enderror
    </div>

    <!-- Gambar -->
    <div style="margin-bottom: 15px;">
      <label for="image" style="display:block; margin-bottom:5px; font-weight:500;">Gambar Produk</label>
      <input type="file" name="image" id="image"
             style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
      @error('image') <div style="color:red; font-size:13px;">{{ $message }}</div> @enderror
    </div>

    <!-- Tombol -->
    <div style="margin-top: 20px;">
      <button type="submit"
              style="background-color:#f57c00; color:white; padding:10px 20px; border:none; border-radius:6px; font-weight:bold;">
        Simpan Produk
      </button>
      <a href="{{ route('admin.products.index') }}"
         style="margin-left:15px; color:#555; text-decoration:underline;">Batal</a>
    </div>
  </form>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container">
    <h1>Tambah Produk Baru</h1>

    {{-- Form ini butuh enctype="multipart/form-data" untuk handle upload file --}}
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 8px;">
            @error('name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" required style="width: 100%; padding: 8px;">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" required style="width: 100%; padding: 8px;">
            @error('price') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4" style="width: 100%; padding: 8px;">{{ old('description') }}</textarea>
            @error('description') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" id="image" style="width: 100%;">
            @error('image') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Simpan Produk</button>
        <a href="{{ route('admin.products.index') }}">Batal</a>
    </form>
</div>
@endsection

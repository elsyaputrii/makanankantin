@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="container">
    <h1>Edit Produk: {{ $product->name }}</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required style="width: 100%; padding: 8px;">
            @error('name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" required style="width: 100%; padding: 8px;">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required style="width: 100%; padding: 8px;">
            @error('price') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4" style="width: 100%; padding: 8px;">{{ old('description', $product->description) }}</textarea>
            @error('description') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="image">Gambar Produk (Kosongkan jika tidak ingin ganti)</label>
            @if($product->image)
            <div style="margin-top: 10px; margin-bottom: 10px;">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            @endif
            <input type="file" name="image" id="image" style="width: 100%;">
            @error('image') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Update Produk</button>
        <a href="{{ route('admin.products.index') }}">Batal</a>
    </form>
</div>
@endsection

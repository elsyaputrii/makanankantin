@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Method spoofing, karena HTML form tidak mendukung PUT --}}

        <div>
            <label for="name">Nama Kategori</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}">
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-top: 10px;">Update</button>
        <a href="{{ route('admin.categories.index') }}">Batal</a>
    </form>
</div>
@endsection

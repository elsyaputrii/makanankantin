@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8 bg-white rounded-xl shadow-md">

  <h1 class="text-xl font-bold text-orange-600 mb-6">@yield('title')</h1>

  @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
      <ul class="list-disc pl-5 space-y-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT') {{-- karena HTML tidak support PUT langsung --}}

    <!-- Nama Kategori -->
    <div>
      <label for="name" class="block text-lg font-semibold text-gray-700 mb-1">Nama Kategori</label>
      <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
             class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
      @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <!-- Tombol Aksi -->
    <div class="flex gap-4 pt-2">
      <button type="submit"
              class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-md font-medium shadow">
        Update
      </button>
      <a href="{{ route('admin.categories.index') }}"
         class="text-sm text-gray-600 hover:underline self-center">
        Batal
      </a>
    </div>
  </form>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tambah Produk Baru')</title>
    <!-- Memasukkan Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cream-100">

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Produk Baru</h1>

        {{-- Form ini butuh enctype="multipart/form-data" untuk handle upload file --}}
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 mt-2">
                @error('name') <div class="text-red-500 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" id="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 mt-2">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-red-500 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 mt-2">
                @error('price') <div class="text-red-500 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 mt-2">{{ old('description') }}</textarea>
                @error('description') <div class="text-red-500 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 mt-2">
                @error('image') <div class="text-red-500 text-sm mt-2">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500">Simpan Produk</button>
            <a href="{{ route('admin.products.index') }}" class="ml-4 text-gray-600 hover:text-orange-500">Batal</a>
        </form>
    </div>

</body>
</html>

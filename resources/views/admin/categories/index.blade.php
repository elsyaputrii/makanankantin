<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    <!-- Memasukkan Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Manajemen Kategori</h1>

        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                Logout
            </button>
        </form>

        <a href="{{ route('admin.categories.create') }}" class="inline-block mb-4 bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500">Tambah Kategori Baru</a>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border-collapse border border-gray-300">
            <thead class="bg-orange-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nama Kategori</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="border-b hover:bg-orange-50">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $category->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-orange-600 hover:text-orange-800">Edit</a>
                        <span class="mx-2">|</span>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>

</body>
</html>

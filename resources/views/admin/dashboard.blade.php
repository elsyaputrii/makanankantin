<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Makanan Kantin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 font-sans text-gray-900">

    <!-- Header -->
    <header class="bg-orange-600 p-4">
        <nav class="flex justify-between items-center max-w-6xl mx-auto">
            <div class="text-white font-semibold text-xl">
                Admin 
            </div>
            <div class="space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-orange-300">Dashboard</a>
                <a href="{{ route('admin.categories.index') }}" class="text-white hover:text-orange-300">Kategori</a>
                <a href="{{ route('admin.products.index') }}" class="text-white hover:text-orange-300">Produk</a>
                <a href="{{ route('admin.users.index') }}" class="text-white hover:text-orange-300">Staff</a>
                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="bg-orange-700 text-white px-4 py-2 rounded hover:bg-orange-800">
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-8 px-4">
        @yield('content')
    </main>

    <!-- Add larger text for the Dashboard -->
    @section('content')
        <div class="text-center mt-20">
            <h1 class="text-5xl font-bold text-orange-700">
                Selamat Datang di Dashboard Admin
            </h1>
            <p class="mt-4 text-xl text-gray-600">
                Kelola kategori, produk, dan staff dengan mudah melalui menu di atas.
            </p>
        </div>
    @show

</body>
</html>

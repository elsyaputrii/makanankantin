<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dapur Panel') - Kantin App</title>
    <!-- Memasukkan Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cream-100">

    <!-- Header dan Navbar -->
    <header class="bg-cream-200 py-4">
        <nav class="container mx-auto flex justify-between items-center">
            <!-- Tautan Dashboard Dapur -->
            <a href="{{ route('koki.dashboard') }}" class="text-lg font-semibold text-gray-800 hover:text-orange-600">Dashboard Dapur</a>

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Logout
                </button>
            </form>
        </nav>
    </header>

    <!-- Konten Halaman -->
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

</body>
</html>

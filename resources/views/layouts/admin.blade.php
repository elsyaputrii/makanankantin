<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Kantin App</title>
    {{-- Kita bisa tambahkan link ke file CSS Bootstrap di sini nanti --}}
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.categories.index') }}">Kategori</a>
            <a href="{{ route('admin.products.index') }}">Produk</a>
            <a href="{{ route('admin.users.index') }}">Users</a>
            {{-- Nanti link ke menu lain kita tambah di sini --}}
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>

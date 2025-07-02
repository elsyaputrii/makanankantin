<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Kantin App</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('admin.dashboard') }}" style="margin-right: 15px;">Dashboard</a>
            <a href="{{ route('admin.categories.index') }}" style="margin-right: 15px;">Kategori</a>
            <a href="{{ route('admin.products.index') }}" style="margin-right: 15px;">Produk</a>
            <a href="{{ route('admin.users.index') }}" style="margin-right: 15px;">Staff</a> <!-- Tambahkan ini -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </nav>
    </header>

    <main style="padding-top: 20px;">
        @yield('content')
    </main>
</body>
</html>

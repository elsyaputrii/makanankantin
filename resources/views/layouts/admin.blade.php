<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Admin Panel') - Kantin App</title>

  <!-- Tailwind Config + Custom Colors -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            cream: {
              100: '#FFF7ED',
              200: '#FFEBD2',
            },
            orange: {
              500: '#F97316',
              700: '#C2410C',
              800: '#9A3412',
            }
          }
        }
      }
    }
  </script>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-cream-100 font-sans text-gray-800">

  <!-- Header -->
  <header class="bg-orange-500 shadow-md sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <!-- Kiri: Logo -->
      <div class="text-white text-2xl font-bold">Admin Panel</div>

      <!-- Kanan: Menu Navigasi -->
      <div class="flex flex-wrap items-center gap-4 text-white text-sm font-medium">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-100 flex items-center gap-1">
          <i data-lucide="home" class="w-4 h-4"></i> Dashboard
        </a>
        <a href="{{ route('admin.categories.index') }}" class="hover:text-orange-100 flex items-center gap-1">
          <i data-lucide="list" class="w-4 h-4"></i> Kategori
        </a>
        <a href="{{ route('admin.products.index') }}" class="hover:text-orange-100 flex items-center gap-1">
          <i data-lucide="pizza" class="w-4 h-4"></i> Produk
        </a>
        <a href="{{ route('admin.users.index') }}" class="hover:text-orange-100 flex items-center gap-1">
          <i data-lucide="users" class="w-4 h-4"></i> Staff
        </a>
        
        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md flex items-center gap-1 text-sm font-semibold shadow-sm">
            <i data-lucide="log-out" class="w-4 h-4"></i> Logout
          </button>
        </form>
      </div>
    </nav>
  </header>

  <!-- Konten Utama -->
  <main class="max-w-7xl mx-auto px-4 py-10">
    @yield('content')
  </main>

  <!-- Lucide Init -->
  <script>
    lucide.createIcons();
  </script>
</body>
</html>

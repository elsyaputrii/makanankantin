<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kantin Kampus')</title>

    {{-- Import Font Poppins dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Import Font Awesome untuk Ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- CSS Kustom untuk Tampilan Baru --}}
    <style>
        :root {
            --primary-color: #FF7A00;
            --text-color: #333333;
            --background-color: #F9F9F9;
            --success-color: #28a745;
            --light-gray: #dddddd;
            --border-radius: 12px;
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .header {
            background-color: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .header .logo-icon {
            margin-right: 10px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

    </style>
</head>
<body>
    <header class="header">
        <i class="fa-solid fa-utensils logo-icon"></i>
        <span>Kantin Kampus</span>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>

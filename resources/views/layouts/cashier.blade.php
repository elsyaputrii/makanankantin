<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff Panel') - Kantin App</title>

    {{-- Import Font Poppins & Font Awesome --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- CSS Kustom untuk Tampilan Dashboard --}}
    <style>
        :root {
            --primary-color: #FF7A00;
            --text-color: #333333;
            --background-color: #F9F9F9;
            --success-color: #28a745;
            --light-gray: #e9ecef;
            --border-color: #dee2e6;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }
        .header-logo .fa-utensils {
            margin-right: 10px;
        }
        .logout-form button {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 8px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }
        .logout-form button:hover {
            background-color: var(--primary-color);
            color: white;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        .card {
            background-color: #fff;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }
        .card h2 {
            margin-top: 0;
            font-size: 1.5rem;
            font-weight: 600;
            border-bottom: 1px solid var(--light-gray);
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }
        thead th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        tbody tr:nth-of-type(even) {
            background-color: #f8f9fa;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        .btn-success {
            background-color: var(--success-color);
            color: white;
        }
        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="#" class="header-logo">
            <i class="fa-solid fa-utensils"></i>
            <span>Panel Staff Kantin</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </form>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>

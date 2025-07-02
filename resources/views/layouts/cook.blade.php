        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>@yield('title', 'Dapur Panel') - Kantin App</title>
        </head>
        <body>
            <header>
                <nav>
                    <a href="{{ route('koki.dashboard') }}" style="margin-right: 15px;">Dashboard Dapur</a>
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

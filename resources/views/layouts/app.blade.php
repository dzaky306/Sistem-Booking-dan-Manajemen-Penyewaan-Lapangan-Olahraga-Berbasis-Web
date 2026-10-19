
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FieldBook')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F7F5] text-[#1F2937] antialiased">

<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}"
           class="text-2xl font-bold text-green-800">
            FieldBook
        </a>

        <div class="flex items-center gap-5">
            <a href="{{ route('home') }}"
               class="text-gray-700 hover:text-green-700">
                Home
            </a>

            <a href="{{ route('fields.index') }}"
               class="text-gray-700 hover:text-green-700">
                Cari Lapangan
            </a>

            @auth
                <span class="text-gray-700">
                    Halo, {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="text-green-700 font-medium">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>


    <main>
        @yield('content')
    </main>

    <footer class="mt-16 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-8 text-sm text-gray-500">
            © {{ date('Y') }} FieldBook. Booking lapangan jadi lebih mudah.
        </div>
    </footer>
</body>
</html>

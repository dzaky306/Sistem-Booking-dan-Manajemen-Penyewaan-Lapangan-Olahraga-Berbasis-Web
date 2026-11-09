
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FieldBook')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F7F5] text-[#1F2937] antialiased">

<nav class="bg-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex flex-wrap items-center justify-between gap-4">

        <a href="{{ route('home') }}"
           class="text-2xl font-bold text-[#176B4D]">
            FieldBook
        </a>

        <div class="flex flex-wrap items-center gap-6 text-sm font-medium">
            <a href="{{ route('home') }}"
               class="text-[#176B4D] hover:text-green-800">
                Beranda
            </a>

            <a href="{{ route('fields.index') }}"
               class="text-gray-600 hover:text-[#176B4D]">
                Jelajahi Lapangan
            </a>

            <a href="{{ route('home') }}#cara-kerja"
               class="text-gray-600 hover:text-[#176B4D]">
                Cara Booking
            </a>

            <a href="{{ route('home') }}#bantuan"
               class="text-gray-600 hover:text-[#176B4D]">
                Bantuan
            </a>
        </div>

        <div class="flex items-center gap-3">
            @auth
                <span class="hidden sm:block text-sm text-gray-700">
                    Halo, {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="text-[#176B4D] font-semibold text-sm hover:text-green-800">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                   class="bg-[#176B4D] text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-green-800 transition">
                    Daftar
                </a>
            @endauth
        </div>

    </div>
</nav>
<main>
    @yield('content')
</main>

<footer id="bantuan" class="mt-16 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="flex flex-col md:flex-row justify-between gap-6">
            <div>
                <h2 class="text-xl font-bold text-[#176B4D]">FieldBook</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Booking lapangan jadi lebih mudah.
                </p>
            </div>

            <div class="flex flex-wrap gap-6 text-sm text-gray-500">
                
                <a href="mailto:fieldbook@example.com" class="hover:text-[#176B4D]">Hubungi Kami</a>
            </div>
        </div>

        <div class="border-t border-gray-100 mt-7 pt-5 text-xs text-gray-400">
            © {{ date('Y') }} FieldBook. Semua hak dilindungi.
        </div>

    </div>
</footer>

</body>
</html>

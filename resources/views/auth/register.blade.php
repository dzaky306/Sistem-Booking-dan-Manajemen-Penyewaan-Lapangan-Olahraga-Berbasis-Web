
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - FieldBook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F4F7F5] text-[#1F2937]">

    <nav class="flex items-center justify-between bg-white px-6 py-5 shadow-sm md:px-16">
        <a href="/" class="text-2xl font-extrabold text-[#176B4D]">
            FieldBook<span class="text-gray-800">.</span>
        </a>
        <p class="text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-[#176B4D]">
                Masuk
            </a>
        </p>
    </nav>

    <main class="mx-auto grid min-h-[calc(100vh-76px)] max-w-7xl items-center gap-10 px-6 py-10 md:grid-cols-2 md:px-12">

        <section class="mx-auto w-full max-w-md">
            <a href="/" class="text-sm text-gray-500 hover:text-[#176B4D]">
                ← Kembali ke Beranda
            </a>

            <p class="mt-7 text-sm font-bold uppercase tracking-[0.2em] text-[#176B4D]">
                Bergabung Bersama Kami
            </p>
            <h1 class="mt-3 text-4xl font-extrabold tracking-tight">
                Buat Akun Baru
            </h1>
            <p class="mt-3 text-gray-500">
                Daftar sekarang dan booking lapangan favoritmu.
            </p>

            @if ($errors->any())
                <div class="mt-5 rounded-xl bg-red-50 p-3 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="mt-7 space-y-4">
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold">
                        Nama Lengkap
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        autocomplete="name"
                        required
                        autofocus
                        placeholder="Masukkan nama lengkap"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 outline-none focus:border-[#176B4D] focus:ring-2 focus:ring-green-100"
                    >
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                        placeholder="nama@email.com"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 outline-none focus:border-[#176B4D] focus:ring-2 focus:ring-green-100"
                    >
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        required
                        placeholder="Minimal 8 karakter"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 outline-none focus:border-[#176B4D] focus:ring-2 focus:ring-green-100"
                    >
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold">
                        Konfirmasi Password
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        required
                        placeholder="Ulangi password"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 outline-none focus:border-[#176B4D] focus:ring-2 focus:ring-green-100"
                    >
                </div>

                <label class="flex items-start gap-2 text-sm leading-relaxed text-gray-600">
                    <input type="checkbox" name="terms" value="1" required
                           class="mt-1 rounded border-gray-300 text-[#176B4D] focus:ring-[#176B4D]">
                    <span>
                        Saya menyetujui
                        <a href="#" class="font-semibold text-[#176B4D]">Syarat & Ketentuan</a>
                        dan
                        <a href="#" class="font-semibold text-[#176B4D]">Kebijakan Privasi</a>.
                    </span>
                </label>

                <button type="submit"
                        class="w-full rounded-xl bg-[#176B4D] px-5 py-3.5 font-bold text-white transition hover:bg-[#12543C]">
                    Buat Akun
                </button>
            </form>

            <div class="my-5 flex items-center gap-4">
                <div class="h-px flex-1 bg-gray-200"></div>
                <span class="text-xs text-gray-400">ATAU</span>
                <div class="h-px flex-1 bg-gray-200"></div>
            </div>

            <button type="button" disabled
                    title="Pendaftaran Google belum dikonfigurasi"
                    class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-white px-5 py-3 font-semibold text-gray-500 opacity-70">
                <span class="mr-2">G</span> Daftar dengan Google
                <span class="block text-xs font-normal">Segera hadir</span>
            </button>

            <p class="mt-5 text-center text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-[#176B4D] hover:underline">
                    Masuk sekarang
                </a>
            </p>
        </section>

        <section class="relative hidden min-h-[650px] overflow-hidden rounded-3xl bg-[#176B4D] md:block">
            <img
                src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=1200&q=85"
                alt="Lapangan olahraga"
                class="absolute inset-0 h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-[#073D2B]/95 via-[#176B4D]/45 to-transparent"></div>

            <div class="absolute bottom-0 p-10 text-white">
                <span class="rounded-full border border-white/40 bg-white/15 px-4 py-2 text-sm backdrop-blur">
                    #WaktunyaBergerak
                </span>
                <h2 class="mt-6 text-4xl font-extrabold leading-tight">
                    Mulai Perjalanan<br>Olahragamu.
                </h2>
                <p class="mt-4 max-w-md leading-relaxed text-white/85">
                    Satu akun untuk menemukan lapangan, mengatur jadwal,
                    dan menikmati olahraga bersama teman-temanmu.
                </p>
            </div>
        </section>

    </main>
</body>
</html>

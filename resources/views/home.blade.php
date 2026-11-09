
@extends('layouts.app')

@section('title', 'FieldBook - Booking Lapangan Olahraga')

@section('content')

{{-- HERO SECTION --}}
<section class="max-w-7xl mx-auto px-6 pt-10 pb-8">
    <div class="grid lg:grid-cols-2 gap-8 items-center">

        <div>
            <p class="text-xs font-bold text-[#176B4D] uppercase tracking-wider">
                Lebih mudah booking, lebih banyak main.
            </p>

            <h1 class="mt-4 text-4xl md:text-5xl font-bold leading-tight">
                Lapangan pilihanmu.
                <span class="block text-[#176B4D]">
                    Waktunya main bareng.
                </span>
            </h1>

            <p class="mt-4 text-gray-500 leading-7">
                Temukan dan booking lapangan terbaik di dekatmu,
                dalam hitungan menit.
            </p>

            {{-- FORM PENCARIAN --}}
            <form action="{{ route('fields.index') }}" method="GET"
                  class="mt-6 bg-white border border-gray-200 rounded-2xl p-3 shadow-sm">

                <div class="grid sm:grid-cols-2 gap-3">

                    <input
                        type="text"
                        name="lokasi"
                        placeholder="Masukkan lokasi lapangan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#176B4D]"
                    >

                    <select
                        name="kategori"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#176B4D]">

                        <option value="">Semua olahraga</option>
                        @foreach (['Futsal', 'Badminton', 'Basket', 'Tenis'] as $sport)
                            <option value="{{ $sport }}">{{ $sport }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="w-full mt-3 bg-[#176B4D] text-white rounded-xl py-3 font-semibold hover:bg-green-800 transition">
                    Cari Lapangan
                </button>
            </form>
        </div>

        {{-- HERO IMAGE --}}
        <div class="relative">
            <img
                src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1200&q=85"
                alt="Lapangan sepak bola"
                class="w-full h-64 md:h-80 object-cover rounded-3xl shadow-md"
            >

            <div class="absolute bottom-4 left-4 bg-white rounded-xl px-4 py-3 shadow-md">
                <p class="text-xs font-semibold text-[#176B4D]">
                    ✓ Booking lebih mudah
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Temukan lapangan favoritmu
                </p>
            </div>
        </div>

    </div>
</section>

{{-- KATEGORI OLAHRAGA --}}


{{-- KATEGORI OLAHRAGA --}}
<section class="max-w-7xl mx-auto px-6 py-5">

    <div class="flex flex-col lg:flex-row lg:items-center gap-4">

        <h2 class="font-bold text-sm whitespace-nowrap lg:w-[120px]">
            Mau main apa?
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-3 flex-1">

            @foreach ([
                'Futsal' => '⚽',
                'Badminton' => '🏸',
                'Basket' => '🏀',
                'Tenis' => '🎾',
                'Sepak Bola' => '⚽'
            ] as $sport => $icon)

                <a href="{{ route('fields.index', ['kategori' => $sport]) }}"
                   class="bg-white border border-gray-200 rounded-xl px-3 py-3 flex items-center justify-center gap-2 text-sm font-medium whitespace-nowrap hover:border-[#176B4D] hover:text-[#176B4D] transition">

                    <span>{{ $icon }}</span>
                    <span>{{ $sport }}</span>

                </a>

            @endforeach

        </div>
    </div>

</section>



{{-- FAVORIT PARA PEMAIN --}}
<section class="max-w-7xl mx-auto px-6 py-10">

    <div class="flex items-center justify-between gap-3">
        <div>
            <h2 class="text-2xl font-bold">Favorit para pemain</h2>
            <p class="text-sm text-gray-500 mt-2">
                Temukan lapangan yang cocok untuk permainanmu.
            </p>
        </div>

        <a href="{{ route('fields.index') }}"
           class="hidden sm:block text-sm font-semibold text-[#176B4D] hover:underline">
            Jelajahi semua lapangan →
        </a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-6">

        @forelse ($fields as $field)
            <article class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition">

                <img
                    src="{{ $field->image ?: 'https://placehold.co/900x500?text=FieldBook' }}"
                    alt="{{ $field->name }}"
                    class="w-full h-48 object-cover"
                >

                <div class="p-4">

                    <span class="text-xs font-semibold text-[#176B4D]">
                        {{ $field->category }}
                    </span>

                    <h3 class="font-bold text-lg mt-2">
                        {{ $field->name }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $field->location }}
                    </p>

                    <div class="flex items-center justify-between mt-4 gap-3">
                        <p class="font-bold text-[#176B4D]">
                            Rp{{ number_format((float) $field->price_per_hour, 0, ',', '.') }}
                            <span class="text-xs font-normal text-gray-500">/ jam</span>
                        </p>

                        <a href="{{ route('fields.show', $field) }}"
                           class="text-sm font-semibold text-[#176B4D] hover:underline">
                            Lihat Detail →
                        </a>
                    </div>

                </div>
            </article>

        @empty
            <p class="text-gray-500 col-span-full">
                Belum ada lapangan yang tersedia.
            </p>
        @endforelse

    </div>
</section>

{{-- KEUNGGULAN DAN CARA BOOKING --}}
<section class="max-w-7xl mx-auto px-6 py-8">

    <div class="grid md:grid-cols-2 gap-8">

        <div>
            <h2 class="text-xl font-bold">Main tenang, booking tanpa ribet.</h2>

            <div class="grid grid-cols-3 gap-3 mt-6">

                <div>
                    <div class="text-[#176B4D] text-xl">✓</div>
                    <h3 class="text-sm font-bold mt-2">Lapangan Aktif</h3>
                    <p class="text-xs text-gray-500 mt-1">Pilihan lapangan tersedia.</p>
                </div>

                <div>
                    <div class="text-[#176B4D] text-xl">◷</div>
                    <h3 class="text-sm font-bold mt-2">Pilih Jadwal</h3>
                    <p class="text-xs text-gray-500 mt-1">Cari waktu bermainmu.</p>
                </div>

                <div>
                    <div class="text-[#176B4D] text-xl">Rp</div>
                    <h3 class="text-sm font-bold mt-2">Harga Jelas</h3>
                    <p class="text-xs text-gray-500 mt-1">Informasi harga per jam.</p>
                </div>

            </div>
        </div>

        <div id="cara-kerja" class="border-l-0 md:border-l border-gray-200 md:pl-8">
            <h2 class="text-xl font-bold">Dari cari ke main, cukup 3 langkah.</h2>

            <div class="grid grid-cols-3 gap-3 mt-6">

                <div>
                    <p class="text-[#176B4D] font-bold">01</p>
                    <h3 class="text-sm font-bold mt-2">Pilih Lapangan</h3>
                    <p class="text-xs text-gray-500 mt-1">Cari tempat bermain.</p>
                </div>

                <div>
                    <p class="text-[#176B4D] font-bold">02</p>
                    <h3 class="text-sm font-bold mt-2">Tentukan Jadwal</h3>
                    <p class="text-xs text-gray-500 mt-1">Pilih waktu bermain.</p>
                </div>

                <div>
                    <p class="text-[#176B4D] font-bold">03</p>
                    <h3 class="text-sm font-bold mt-2">Booking</h3>
                    <p class="text-xs text-gray-500 mt-1">Konfirmasi pemesanan.</p>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="max-w-7xl mx-auto px-6 py-6">
    <div class="bg-[#104B3A] rounded-2xl px-6 py-7 md:px-9 flex flex-col md:flex-row items-center justify-between gap-5">

        <div>
            <h2 class="text-white text-xl font-bold">
                Tim sudah siap? Lapangannya juga.
            </h2>
            <p class="text-green-100 text-sm mt-2">
                Jadwalkan permainan berikutnya bersama FieldBook.
            </p>
        </div>

        <a href="{{ route('fields.index') }}"
           class="bg-white text-[#176B4D] rounded-xl px-5 py-3 text-sm font-bold hover:bg-green-50 transition">
            Temukan Lapangan →
        </a>

    </div>
</section>

@endsection

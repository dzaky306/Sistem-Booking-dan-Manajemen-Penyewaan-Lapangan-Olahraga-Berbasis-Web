
@extends('layouts.app')

@section('title', 'FieldBook - Booking Lapangan Olahraga')

@section('content')
<section class="max-w-7xl mx-auto px-6 pt-14 pb-10">
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <div>
            <span class="inline-block bg-green-100 text-[#176B4D] px-4 py-2 rounded-full text-sm font-semibold">
                Booking Lapangan Online
            </span>

            <h1 class="mt-6 text-4xl md:text-5xl font-bold leading-tight">
                Lapangan pilihanmu.<br>
                <span class="text-[#176B4D]">Waktunya main bareng.</span>
            </h1>

            <p class="mt-5 text-gray-600 leading-7">
                Temukan lapangan olahraga terbaik, pilih jadwal yang tersedia,
                dan booking dengan mudah melalui FieldBook.
            </p>

            <a href="{{ route('fields.index') }}"
               class="inline-block mt-7 bg-[#176B4D] text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-800">
                Cari Lapangan
            </a>
        </div>

        <div class="rounded-3xl overflow-hidden shadow-lg">
            <img
                src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1200&q=85"
                alt="Lapangan olahraga"
                class="w-full h-72 md:h-96 object-cover"
            >
        </div>
    </div>
</section>

<section id="lapangan" class="max-w-7xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold">Pilih olahraga favoritmu</h2>
    <p class="mt-2 text-gray-600">Temukan lapangan sesuai aktivitasmu.</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
        @foreach (['Futsal', 'Badminton', 'Basket', 'Tenis'] as $sport)
            <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-md transition">
                <div class="text-3xl mb-3">🏟️</div>
                <h3 class="font-bold">{{ $sport }}</h3>
                <p class="text-sm text-gray-500 mt-1">Cari lapangan {{ strtolower($sport) }}</p>
            </div>
        @endforeach
    </div>
</section>

<section id="cara-kerja" class="max-w-7xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold">Booking tanpa ribet</h2>

    <div class="grid md:grid-cols-3 gap-5 mt-6">
        <div class="bg-white p-6 rounded-2xl">
            <p class="text-[#176B4D] font-bold text-lg">01</p>
            <h3 class="font-bold mt-3">Pilih Lapangan</h3>
            <p class="text-gray-600 text-sm mt-2">Cari lapangan berdasarkan jenis olahraga dan lokasi.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl">
            <p class="text-[#176B4D] font-bold text-lg">02</p>
            <h3 class="font-bold mt-3">Tentukan Jadwal</h3>
            <p class="text-gray-600 text-sm mt-2">Pilih tanggal dan waktu yang tersedia.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl">
            <p class="text-[#176B4D] font-bold text-lg">03</p>
            <h3 class="font-bold mt-3">Konfirmasi Booking</h3>
            <p class="text-gray-600 text-sm mt-2">Lanjutkan pemesanan dan konfirmasi detail booking.</p>
        </div>
    </div>
</section>
@endsection

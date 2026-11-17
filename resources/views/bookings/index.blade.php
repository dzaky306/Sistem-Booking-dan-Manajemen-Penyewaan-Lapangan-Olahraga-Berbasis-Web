
@extends('layouts.app')

@section('title', 'Riwayat Booking - FieldBook')

@section('content')
<section class="max-w-7xl mx-auto px-6 pt-16 pb-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Riwayat Booking
        </h1>
        <p class="text-gray-500 mt-2">
            Lihat dan pantau semua jadwal lapangan yang sudah kamu pesan.
        </p>
    </div>

    
{{-- DAFTAR BOOKING --}}
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
    @forelse ($bookings as $booking)
        <article class="bg-white rounded-2xl overflow-hidden border border-gray-200">

            {{-- GAMBAR LAPANGAN --}}
            <img
                src="{{ $booking->field->image ?: 'https://placehold.co/900x500?text=FieldBook' }}"
                alt="{{ $booking->field->name }}"
                class="w-full h-48 object-cover"
            >

            <div class="p-5">

                {{-- KATEGORI --}}
                <span class="text-xs font-semibold text-[#176B4D] bg-green-50 px-3 py-1 rounded-full">
                    {{ $booking->field->category }}
                </span>

                {{-- NAMA LAPANGAN --}}
                <h3 class="font-bold text-lg mt-3">
                    {{ $booking->field->name }}
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    📍 {{ $booking->field->location }}
                </p>

                <p class="text-xs text-gray-500 mt-3">
                    Kode Booking #{{ $booking->id }}
                </p>

                {{-- JADWAL --}}
                <div class="bg-gray-50 rounded-xl p-3 mt-4 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Tanggal</span>
                        <span class="font-semibold">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Jam</span>
                        <span class="font-semibold">
                            {{ substr($booking->start_time, 0, 5) }} -
                            {{ substr($booking->end_time, 0, 5) }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Durasi</span>
                        <span class="font-semibold">
                            {{ $booking->duration }} jam
                        </span>
                    </div>
                </div>

                {{-- HARGA DAN STATUS --}}
                <div class="flex items-center justify-between gap-2 mt-5">
                    <p class="font-bold text-[#176B4D]">
                        Rp{{ number_format((float) $booking->total_price, 0, ',', '.') }}
                    </p>

                    @if ($booking->status === 'confirmed')
                        <span class="text-xs font-semibold text-green-700 bg-green-100 px-3 py-2 rounded-full">
                            Dikonfirmasi
                        </span>
                    @elseif ($booking->status === 'cancelled')
                        <span class="text-xs font-semibold text-red-700 bg-red-100 px-3 py-2 rounded-full">
                            Dibatalkan
                        </span>
                    @else
                        <span class="text-xs font-semibold text-yellow-700 bg-yellow-100 px-3 py-2 rounded-full">
                            Menunggu
                        </span>
                    @endif
                </div>

            </div>
        </article>
    @empty
        <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center col-span-full">
            <div class="text-5xl mb-4">📅</div>

            <h2 class="text-xl font-bold text-gray-800">
                Belum Ada Booking
            </h2>

            <p class="text-gray-500 mt-2">
                Kamu belum memiliki riwayat pemesanan lapangan.
            </p>

            <a href="{{ route('fields.index') }}"
               class="inline-block mt-6 bg-[#176B4D] text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-800">
                Cari Lapangan
            </a>
        </div>
    @endforelse
</div>


    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $bookings->links() }}
    </div>

</section>
@endsection


@extends('layouts.app')

@section('title', $field->name . ' - FieldBook')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-10">
    <a href="{{ route('fields.index') }}"
       class="text-sm font-semibold text-[#176B4D] hover:underline">
        ← Kembali ke daftar lapangan
    </a>

    <div class="grid lg:grid-cols-3 gap-8 mt-6">
        <div class="lg:col-span-2">
            <img
                src="{{ $field->image ?: 'https://placehold.co/1200x600?text=FieldBook' }}"
                alt="{{ $field->name }}"
                class="w-full h-72 md:h-[420px] object-cover rounded-3xl"
            >

            <span class="inline-block mt-6 bg-green-100 text-[#176B4D] text-sm font-semibold px-3 py-2 rounded-full">
                {{ $field->category }}
            </span>

            <h1 class="text-3xl font-bold mt-4">{{ $field->name }}</h1>
            <p class="text-gray-500 mt-2">📍 {{ $field->location }}</p>

            <p class="mt-5 text-gray-600 leading-7">
                {{ $field->description ?: 'Informasi lapangan akan segera diperbarui.' }}
            </p>

            <h2 class="text-xl font-bold mt-8">Fasilitas lapangan</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4">
                @forelse ($field->facilities ?? [] as $facility)
                    <div class="bg-white border border-gray-200 p-4 rounded-xl text-sm">
                        ✓ {{ $facility }}
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Informasi fasilitas belum tersedia.</p>
                @endforelse
            </div>
        </div>

        <aside class="h-fit bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <p class="text-sm text-gray-500">Harga sewa</p>
            <p class="text-2xl font-bold text-[#176B4D] mt-2">
                Rp{{ number_format((float) $field->price_per_hour, 0, ',', '.') }}
                <span class="text-sm font-normal text-gray-500">/ jam</span>
            </p>

            <hr class="my-6 border-gray-200">

            <h2 class="font-bold text-lg">Pilih jadwal bermain</h2>
            <p class="text-sm text-gray-500 mt-2">
                Fitur ketersediaan jadwal akan dibuat pada tahap sistem booking.
            </p>

            <div class="mt-5">
                <label for="tanggal" class="block text-sm font-medium mb-2">Tanggal bermain</label>
                <input id="tanggal" type="date" min="{{ date('Y-m-d') }}"
                       class="w-full border border-gray-200 rounded-xl px-3 py-3">
            </div>

            <div class="mt-4">
                <label for="jam" class="block text-sm font-medium mb-2">Jam bermain</label>
                <select id="jam" class="w-full border border-gray-200 rounded-xl px-3 py-3">
                    <option value="">Pilih jam</option>
                    @foreach (['08:00', '10:00', '13:00', '15:00', '18:00', '20:00'] as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="durasi" class="block text-sm font-medium mb-2">Durasi</label>
                <select id="durasi" class="w-full border border-gray-200 rounded-xl px-3 py-3">
                    @foreach ([1, 2, 3] as $duration)
                        <option value="{{ $duration }}">{{ $duration }} jam</option>
                    @endforeach
                </select>
            </div>

            <div class="bg-green-50 rounded-xl p-4 mt-4">
                <p class="text-sm text-gray-600">Estimasi total</p>
                <p id="total-harga" class="text-xl font-bold text-[#176B4D] mt-1">
                    Rp{{ number_format((float) $field->price_per_hour, 0, ',', '.') }}
                </p>
            </div>

            <button type="button"
                    onclick="alert('Fitur booking akan diaktifkan setelah sistem jadwal dibuat.')"
                    class="w-full mt-5 bg-[#176B4D] text-white py-3 rounded-xl font-semibold hover:bg-green-800">
                Booking Sekarang
            </button>
        </aside>
    </div>
</section>

<script>
    const hargaPerJam = {{ (float) $field->price_per_hour }};
    const durasi = document.getElementById('durasi');
    const totalHarga = document.getElementById('total-harga');

    durasi.addEventListener('change', function () {
        totalHarga.textContent = 'Rp' +
            new Intl.NumberFormat('id-ID').format(hargaPerJam * Number(this.value));
    });
</script>
@endsection


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
                Pilih tanggal, jam, dan durasi bermain.
            </p>

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded-xl mt-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl mt-4 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @auth
                <form action="{{ route('bookings.store', $field->id) }}"
                      method="POST">
                    @csrf

                    <div class="mt-5">
                        <label for="booking_date" class="block text-sm font-medium mb-2">
                            Tanggal bermain
                        </label>
                        <input
                            id="booking_date"
                            name="booking_date"
                            type="date"
                            min="{{ date('Y-m-d') }}"
                            value="{{ old('booking_date') }}"
                            required
                            class="w-full border border-gray-200 rounded-xl px-3 py-3"
                        >
                    </div>

                    <div class="mt-4">
                        <label for="start_time" class="block text-sm font-medium mb-2">
                            Jam bermain
                        </label>
                        <select
                            id="start_time"
                            name="start_time"
                            required
                            class="w-full border border-gray-200 rounded-xl px-3 py-3"
                        >
                            <option value="">Pilih jam</option>
                            @foreach (['08:00', '10:00', '13:00', '15:00', '18:00', '20:00'] as $time)
                                <option value="{{ $time }}" @selected(old('start_time') === $time)>
                                    {{ $time }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <label for="duration" class="block text-sm font-medium mb-2">
                            Durasi
                        </label>
                        <select
                            id="duration"
                            name="duration"
                            required
                            class="w-full border border-gray-200 rounded-xl px-3 py-3"
                        >
                            @foreach ([1, 2, 3] as $duration)
                                <option value="{{ $duration }}" @selected(old('duration', 1) == $duration)>
                                    {{ $duration }} jam
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="bg-green-50 rounded-xl p-4 mt-4">
                        <p class="text-sm text-gray-600">Estimasi total</p>
                        <p id="total-harga" class="text-xl font-bold text-[#176B4D] mt-1">
                            Rp{{ number_format((float) $field->price_per_hour, 0, ',', '.') }}
                        </p>
                    </div>

                    <button
                        type="submit"
                        class="w-full mt-5 bg-[#176B4D] text-white py-3 rounded-xl font-semibold hover:bg-green-800 transition"
                    >
                        Booking Sekarang
                    </button>
                </form>
            @else
                <div class="bg-gray-50 rounded-xl p-4 mt-5">
                    <p class="text-sm text-gray-600">
                        Silakan login terlebih dahulu untuk melakukan booking lapangan.
                    </p>
                    <a href="{{ route('login') }}"
                       class="block text-center mt-4 bg-[#176B4D] text-white py-3 rounded-xl font-semibold hover:bg-green-800">
                        Login untuk Booking
                    </a>
                </div>
            @endauth
        </aside>
    </div>
</section>

<script>
    const hargaPerJam = {{ (float) $field->price_per_hour }};
    const durasi = document.getElementById('duration');
    const totalHarga = document.getElementById('total-harga');

    if (durasi && totalHarga) {
        function updateTotalHarga() {
            const total = hargaPerJam * Number(durasi.value);

            totalHarga.textContent = 'Rp' +
                new Intl.NumberFormat('id-ID').format(total);
        }

        durasi.addEventListener('change', updateTotalHarga);
        updateTotalHarga();
    }
</script>
@endsection


@extends('layouts.app')

@section('title', 'Cari Lapangan - FieldBook')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-8">
        <p class="text-sm font-semibold text-[#176B4D]">FIELDBOOK / LAPANGAN</p>
        <h1 class="text-3xl font-bold mt-3">Temukan lapangan favoritmu</h1>
        <p class="text-gray-600 mt-2">
            Pilih lapangan dan jadwal yang cocok untuk permainanmu.
        </p>
    </div>

    <form action="{{ route('fields.index') }}" method="GET"
          class="bg-white rounded-2xl p-4 border border-gray-200 grid md:grid-cols-4 gap-4">
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Cari nama lapangan..."
            class="border border-gray-200 rounded-xl px-4 py-3 w-full"
        >

        <select name="kategori" class="border border-gray-200 rounded-xl px-4 py-3 w-full">
            <option value="">Semua olahraga</option>
            @foreach (['Futsal', 'Badminton', 'Basket', 'Tenis'] as $sport)
                <option value="{{ $sport }}" @selected(request('kategori') === $sport)>
                    {{ $sport }}
                </option>
            @endforeach
        </select>

        <select name="lokasi" class="border border-gray-200 rounded-xl px-4 py-3 w-full">
            <option value="">Semua lokasi</option>
            <option value="Pekanbaru" @selected(request('lokasi') === 'Pekanbaru')>
                Pekanbaru
            </option>
        </select>

        <button class="bg-[#176B4D] text-white rounded-xl px-5 py-3 font-semibold hover:bg-green-800">
            Cari Lapangan
        </button>
    </form>

    <div class="mt-8 flex items-center justify-between">
        <h2 class="text-xl font-bold">Lapangan pilihan</h2>
        <span class="text-sm text-gray-500">Contoh tampilan</span>
    </div>


<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
    @forelse ($fields as $field)
        <article class="bg-white rounded-2xl overflow-hidden border border-gray-200">
            <img
                src="{{ $field->image ?: 'https://placehold.co/900x500?text=FieldBook' }}"
                alt="{{ $field->name }}"
                class="w-full h-48 object-cover"
            >

            <div class="p-5">
                <span class="text-xs font-semibold text-[#176B4D] bg-green-50 px-3 py-1 rounded-full">
                    {{ $field->category }}
                </span>

                <h3 class="font-bold text-lg mt-3">{{ $field->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $field->location }}</p>

                <div class="flex items-center justify-between gap-3 mt-5">
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

<div class="mt-8">
    {{ $fields->links() }}
</div>

    </div>
</section>
@endsection

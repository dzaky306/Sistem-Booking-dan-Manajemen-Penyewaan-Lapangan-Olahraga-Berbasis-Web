
@extends('layouts.app')

@section('title', 'Profil Saya - FieldBook')

@section('content')
<section class="max-w-4xl mx-auto px-6 py-12">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
        <p class="text-gray-500 mt-2">
            Kelola informasi akun FieldBook kamu.
        </p>
    </div>

    {{-- INFORMASI AKUN --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-5">
            Informasi Akun
        </h2>

        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-500">Nama Lengkap</p>
                <p class="font-medium text-gray-900">{{ $user->name }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium text-gray-900">{{ $user->email }}</p>
            </div>
        </div>
    </div>

    {{-- EDIT PROFIL --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-5">
            Edit Profil
        </h2>

@if (session('status') === 'profile-information-updated')
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-5">
        Profil berhasil diperbarui!
    </div>
@endif

        <form method="POST" action="{{ route('user-profile-information.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                <input type="text" name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-[#176B4D] text-white px-6 py-3 rounded-xl hover:bg-green-800">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- GANTI PASSWORD --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-5">
            Ganti Password
        </h2>

        @if (session('status') === 'password-updated')
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-5">
        Password berhasil diperbarui!
    </div>
@endif

        <form method="POST" action="{{ route('user-password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Password Lama</label>
                <input type="password" name="current_password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                    required>
                @error('current_password', 'updatePassword')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Password Baru</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                    required>
                @error('password', 'updatePassword')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                    required>
            </div>

            <button type="submit"
                class="bg-[#176B4D] text-white px-6 py-3 rounded-xl hover:bg-green-800">
                Perbarui Password
            </button>
        </form>
    </div>

</section>
@endsection

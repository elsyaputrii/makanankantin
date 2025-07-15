@extends('layouts.admin')

@section('title', 'Edit Staff')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-10 bg-white rounded-xl shadow-md">

    <h1 class="text-2xl font-bold text-orange-600 mb-6">@yield('title'): {{ $user->name }}</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select id="role" name="role" required
                class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ old('role', $user->role) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="koki" {{ old('role', $user->role) == 'koki' ? 'selected' : '' }}>Koki</option>
            </select>
            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <hr class="my-6 border-orange-200">

        <p class="text-sm text-orange-700 font-semibold">Ubah Password (kosongkan jika tidak ingin diganti):</p>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
            <input type="password" id="password" name="password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>

        {{-- Tombol --}}
        <div class="flex gap-4 pt-4">
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-md font-medium shadow">
                Update Staff
            </button>
            <a href="{{ route('admin.users.index') }}"
                class="text-sm text-gray-600 hover:underline self-center">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

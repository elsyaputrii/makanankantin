@extends('layouts.cook')

@section('title', 'Dashboard Dapur')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8 bg-[#fefdfb] rounded-xl shadow-md">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-orange-600 leading-tight">
            🍽️ Selamat Datang di <span class="border-red-100">Dashboard Dapur</span>
        </h1>
        <p class="text-gray-600 mt-3 text-sm">Kelola dan selesaikan antrian pesanan dengan cepat dan rapi.</p>
    </div>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan Error --}}
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    {{-- Daftar Pesanan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($orders as $order)
            <div class="bg-white p-5 rounded-lg shadow border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Pesanan #{{ $order->order_number }}</h3>
                <p class="text-sm text-gray-500 mb-2">Waktu Bayar: {{ $order->paid_at->format('H:i:s') }}</p>
                <hr class="mb-3">

                <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700">
                    @foreach ($order->details as $detail)
                        <li><strong>{{ $detail->quantity }}x</strong> {{ $detail->product->name }}</li>
                    @endforeach
                </ul>

                <form action="{{ route('koki.orders.complete', $order->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit"
                        class="w-full py-2 px-4 bg-green-500 text-white font-semibold rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        ✅ Selesaikan Pesanan
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-500 col-span-full text-center">Tidak ada pesanan dalam antrian saat ini.</p>
        @endforelse
    </div>
</div>
@endsection

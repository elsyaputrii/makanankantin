@extends('layouts.cook')

@section('title', 'Dashboard Dapur')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Antrian Pesanan</h1>

    <!-- Menampilkan Pesan Sukses -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan Pesan Error -->
    @if (session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Daftar Pesanan -->
    <div class="order-queue grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($orders as $order)
            <div class="order-card bg-white p-4 rounded-lg shadow-lg border border-gray-300">
                <h3 class="text-xl font-semibold text-gray-800">Pesanan #{{ $order->order_number }}</h3>
                <p class="text-sm text-gray-500">Waktu Bayar: {{ $order->paid_at->format('H:i:s') }}</p>
                <hr class="my-2">

                <ul class="list-disc pl-5 space-y-2">
                    @foreach ($order->details as $detail)
                        <li class="text-sm text-gray-700">
                            <strong>{{ $detail->quantity }}x</strong> {{ $detail->product->name }}
                        </li>
                    @endforeach
                </ul>

                <hr class="my-2">

                {{-- Tombol Selesaikan Pesanan --}}
                <form action="{{ route('koki.orders.complete', $order->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Selesaikan Pesanan
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">Tidak ada pesanan dalam antrian.</p>
        @endforelse
    </div>
</div>
@endsection

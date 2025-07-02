@extends('layouts.cook')

@section('title', 'Dashboard Dapur')

@section('content')
<div class="container">
    <h1>Antrian Pesanan</h1>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="order-queue" style="display: flex; flex-wrap: wrap; gap: 20px;">
        @forelse ($orders as $order)
            <div class="order-card" style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 300px;">
                <h3>Pesanan #{{ $order->order_number }}</h3>
                <p>Waktu Bayar: {{ $order->paid_at->format('H:i:s') }}</p>
                <hr>
                <ul>
                    @foreach ($order->details as $detail)
                        <li>
                            <strong>{{ $detail->quantity }}x</strong> {{ $detail->product->name }}
                        </li>
                    @endforeach
                </ul>
                <hr>

                {{-- ▼▼▼ PERBAIKAN ADA DI SINI ▼▼▼ --}}
                {{-- Tombol dibungkus dalam form yang benar --}}
                <form action="{{ route('koki.orders.complete', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Selesaikan Pesanan
                    </button>
                </form>
                {{-- ▲▲▲ SAMPAI SINI ▲▲▲ --}}

            </div>
        @empty
            <p>Tidak ada pesanan dalam antrian.</p>
        @endforelse
    </div>
</div>
@endsection

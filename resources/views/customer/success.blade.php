@extends('layouts.customer')

@section('title', 'Pesanan Berhasil!')

@section('content')
{{-- Meta tag ini akan mengarahkan pengguna kembali ke halaman pemesanan setelah 10 detik --}}
<head>
    <meta http-equiv="refresh" content="10;url={{ route('order.index') }}">
</head>

<div style="text-align: center; padding: 3rem 1rem; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 70vh;">

    {{-- Ikon Ceklis Sukses --}}
    <i class="fa-solid fa-circle-check" style="font-size: 5rem; color: var(--success-color); margin-bottom: 1.5rem;"></i>

    {{-- Judul Utama --}}
    <h1 style="font-weight: 700; font-size: 2.5rem; margin-bottom: 1rem;">Pemesanan Berhasil!</h1>

    {{-- Kotak Nomor Pesanan --}}
    <div style="margin-bottom: 2rem;">
        <p style="font-size: 1.2rem; margin-bottom: 0.5rem;">Nomor Pesanan Anda:</p>
        <div style="font-size: 2.5rem; font-weight: bold; color: var(--primary-color); border: 2px dashed var(--primary-color); padding: 1rem 2rem; border-radius: var(--border-radius);">
            {{ $order->order_number }}
        </div>
    </div>

    {{-- Instruksi berdasarkan metode pembayaran --}}
    @if($order->payment_method == 'cash')
        <p style="font-size: 1.2em; max-width: 500px;">Silakan lakukan pembayaran di kasir dengan menunjukkan nomor pesanan Anda.</p>
    @else
        <p style="font-size: 1.2em; max-width: 500px;">Pembayaran Anda telah lunas. Pesanan sedang disiapkan, mohon tunggu nomor Anda dipanggil.</p>
    @endif

    {{-- Pesan Redirect Otomatis --}}
    <p style="margin-top: 3rem; color: #888;">
        Halaman ini akan kembali ke menu utama secara otomatis...
    </p>

    {{-- Tombol untuk kembali manual --}}
    <a href="{{ route('order.index') }}" class="btn" style="margin-top: 1rem; background-color: #6c757d; color: white;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Menu
    </a>
</div>
@endsection

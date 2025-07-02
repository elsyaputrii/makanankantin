@extends('layouts.customer')

@section('title', 'Selesaikan Pembayaran')

@section('content')
<div style="text-align: center; padding: 3rem 1rem; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 70vh;">

    {{-- Ikon Pembayaran Aman --}}
    <i class="fa-solid fa-shield-halved" style="font-size: 5rem; color: var(--primary-color); margin-bottom: 1.5rem;"></i>

    {{-- Judul Utama --}}
    <h1 style="font-weight: 700; font-size: 2.5rem; margin-bottom: 1rem;">Selesaikan Pembayaran</h1>

    {{-- Detail Pesanan --}}
    <div style="margin-bottom: 2rem; font-size: 1.2rem; line-height: 1.6;">
        <p style="margin: 0;">Nomor Pesanan: <strong style="color: var(--text-color);">{{ $order->order_number }}</strong></p>
        <p style="margin-top: 0.5rem;">Total Tagihan: <strong style="color: var(--text-color); font-size: 1.5rem;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
    </div>

    {{-- Tombol Bayar --}}
    <button id="pay-button" class="btn btn-primary" style="padding: 15px 40px; font-size: 1.3em;">
        <i class="fa-solid fa-qrcode"></i> Bayar dengan QRIS
    </button>

    {{-- Pesan Tambahan --}}
    <p style="margin-top: 2rem; color: #888;">
        Anda akan diarahkan ke halaman pembayaran aman Midtrans.
    </p>
</div>

{{-- Script untuk Midtrans Snap --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken adalah token yang kita dapat dari backend
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                // Arahkan ke halaman sukses jika pembayaran berhasil
                window.location.href = '{{ route("order.success", $order->id) }}'
            },
            onPending: function(result){
                alert("Pembayaran Anda sedang diproses.");
            },
            onError: function(result){
                alert("Pembayaran Gagal!");
            },
            onClose: function(){
                /* Info jika pelanggan menutup popup tanpa membayar */
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    };
</script>
@endsection

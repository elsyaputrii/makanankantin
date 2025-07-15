@extends('layouts.customer')

@section('title', 'Selesaikan Pembayaran')

@section('content')
<div class="container">
    <h2>Bayar Pesanan #{{ $order->order_number }}</h2>
    <p>Total Tagihan: <strong>Rp{{ number_format($order->total_price) }}</strong></p>

    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
</div>

{{-- Script Snap Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>

<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran berhasil!");
                window.location.href = "/pesanan/sukses/{{ $order->id }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran...");
            },
            onError: function(result){
                alert("Terjadi kesalahan pembayaran.");
            },
            onClose: function(){
                alert("Kamu menutup popup pembayaran.");
            }
        });
    });
</script>
@endsection

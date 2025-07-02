@extends('layouts.cashier')

@section('title', 'Dashboard Kasir')

@section('content')
<style>
    .dashboard-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .full-width-card { grid-column: 1 / -1; margin-top: 2rem; }
    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8em;
        font-weight: 600;
        text-transform: capitalize;
    }
    .status-paid { background-color: #d4edda; color: #155724; }
    .status-unpaid { background-color: #fff3cd; color: #856404; }
    .status-cancelled { background-color: #f8d7da; color: #721c24; }
</style>

<div>
    <h1 style="font-weight: 700; margin-bottom: 2rem;">Selamat Datang, {{ Auth::user()->name }}!</h1>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 1.5rem; border-radius: var(--border-radius);">
            {{ session('success') }}
        </div>
    @endif

    <div class="dashboard-grid">
        {{-- BAGIAN 1: PESANAN SIAP DIPANGGIL --}}
        <div class="card">
            <h2><i class="fa-solid fa-bell" style="color: var(--primary-color);"></i> Pesanan Siap Dipanggil</h2>
            <table>
                <tbody>
                    @forelse ($ready_orders as $order)
                        <tr>
                            <td><strong>#{{ $order->order_number }}</strong></td>
                            <td style="text-align: right;">
                                <form action="{{ route('kasir.orders.finish', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Selesaikan</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2" style="text-align: center; padding: 2rem;">Tidak ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- BAGIAN 2: MENUNGGU PEMBAYARAN TUNAI --}}
        <div class="card">
            <h2><i class="fa-solid fa-money-bill-wave" style="color: var(--primary-color);"></i> Menunggu Pembayaran Tunai</h2>
            <table>
                <tbody>
                    @forelse ($unpaid_cash_orders as $order)
                        <tr>
                            <td><strong>#{{ $order->order_number }}</strong> <br> <small>Rp {{ number_format($order->total_price) }}</small></td>
                            <td style="text-align: right;">
                                <form action="{{ route('kasir.orders.confirm', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cash-register"></i> Konfirmasi</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2" style="text-align: center; padding: 2rem;">Tidak ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- BAGIAN 3: RIWAYAT PEMBAYARAN --}}
        <div class="card full-width-card">
            <h2><i class="fa-solid fa-receipt" style="color: var(--primary-color);"></i> Riwayat Pembayaran</h2>
            <table>
                <thead>
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Metode</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payment_history as $order)
                        <tr>
                            <td><strong>#{{ $order->order_number }}</strong></td>
                            <td style="text-transform: uppercase;">{{ $order->payment_method }}</td>
                            <td>Rp {{ number_format($order->total_price) }}</td>
                            <td><span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span></td>
                            <td>{{ $order->paid_at ? $order->paid_at->format('d M, H:i') : '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align: center; padding: 2rem;">Tidak ada riwayat.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-top: 15px;">{{ $payment_history->links() }}</div>
        </div>
    </div>
</div>
@endsection

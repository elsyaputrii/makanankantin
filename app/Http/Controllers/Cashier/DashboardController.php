<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request; // <-- Penting untuk di-import

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard kasir dengan fitur pencarian.
     */
    public function index(Request $request) // <-- Tambahkan Request $request
    {
        // Bagian ini tetap sama, tidak memerlukan pencarian atau paginasi
        $ready_orders = Order::where('status', 'ready')->latest()->get();
        $unpaid_cash_orders = Order::where('status', 'unpaid')
                                   ->where('payment_method', 'cash')
                                   ->latest()
                                   ->get();

        // BAGIAN 3: Riwayat pembayaran dengan fitur pencarian dan paginasi
        $query = Order::whereIn('status', ['paid', 'unpaid', 'cancelled']);

        // Cek jika ada input pencarian
        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $payment_history = $query->latest()->paginate(10);

        return view('cashier.dashboard', compact(
            'ready_orders',
            'unpaid_cash_orders',
            'payment_history'
        ));
    }

    /**
     * Mengkonfirmasi pembayaran untuk sebuah pesanan.
     */
    public function confirmPayment(Order $order)
    {
        $order->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->route('kasir.dashboard')->with('success', 'Pembayaran untuk pesanan ' . $order->order_number . ' berhasil dikonfirmasi.');
    }

    /**
     * Menandai pesanan sebagai 'completed' (selesai).
     */
    public function finishOrder(Order $order)
    {
        if ($order->status === 'ready') {
            $order->update([
                'status' => 'completed',
            ]);

            return redirect()->route('kasir.dashboard')->with('success', 'Pesanan #' . $order->order_number . ' telah diselesaikan.');
        }

        return redirect()->route('kasir.dashboard')->with('error', 'Pesanan ini tidak bisa diselesaikan.');
    }
}

<?php

namespace App\Http\Controllers\Cook;

use App\Http\Controllers\Controller;
use App\Models\Order; // <-- Pastikan ini ada
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ... (method index biarkan seperti sebelumnya) ...
        $orders = Order::with('details.product')
                       ->where('status', 'paid')
                       ->latest('paid_at')
                       ->get();

        return view('cook.dashboard', compact('orders'));
    }

    // ▼▼▼ TAMBAHKAN METHOD BARU INI ▼▼▼
    /**
     * Menandai pesanan sebagai 'ready' (siap diambil).
     */
    public function completeOrder(Order $order)
    {
        // Pastikan hanya pesanan yang statusnya 'paid' yang bisa diubah
        if ($order->status === 'paid') {
            $order->update([
                'status' => 'ready',
            ]);

            return redirect()->route('koki.dashboard')->with('success', 'Pesanan #' . $order->order_number . ' telah selesai dimasak.');
        }

        // Redirect kembali dengan pesan error jika status tidak sesuai
        return redirect()->route('koki.dashboard')->with('error', 'Pesanan ini tidak bisa diselesaikan.');
    }
}

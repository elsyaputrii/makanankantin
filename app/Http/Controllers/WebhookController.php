<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        // Buat instance notifikasi
        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Notification error.'], 500);
        }

        // Ambil order_id dan status transaksi dari notifikasi
        $order_id_from_midtrans = $notification->order_id;
        $transaction_status = $notification->transaction_status;
        $fraud_status = $notification->fraud_status;

        // Cari pesanan di database Anda
        $order = Order::where('order_number', $order_id_from_midtrans)->first();

        if ($order) {
            // Cek status transaksi
            if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
                if ($fraud_status == 'accept') {
                    // Jika pembayaran berhasil dan aman
                    $order->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                    ]);
                }
            } else if ($transaction_status == 'expire' || $transaction_status == 'cancel' || $transaction_status == 'deny') {
                // Jika pembayaran gagal atau kadaluarsa
                $order->update(['status' => 'cancelled']);
            }
        }

        return response()->json(['message' => 'Notification Handled.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class OrderPageController extends Controller
{
    /**
     * Menampilkan halaman pemesanan utama dengan produk dan keranjang.
     */
    public function index()
    {
        $categories = Category::with('products')->get();
        $cart = session()->get('cart', []);
        return view('customer.order', compact('categories', 'cart'));
    }

    /**
     * Menambahkan item ke keranjang belanja di session.
     */
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Mengupdate kuantitas item di keranjang.
     */
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Memproses pesanan saat tombol "Pesan Sekarang" ditekan.
     */
    public function placeOrder(Request $request)
    {
        $request->validate(['payment_method' => 'required|in:cash,qris']);
        $cart = session()->get('cart');

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung total harga
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Buat pesanan baru dengan status 'pending' (menunggu)
        $order = Order::create([
            'order_number' => 'KANTIN-' . time(),
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'status' => 'unpaid', // Status awal untuk semua pesanan
        ]);

        // Simpan detail pesanan
        foreach ($cart as $id => $details) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // Kosongkan keranjang belanja
        session()->forget('cart');

        // ==== LOGIKA UNTUK PEMBAYARAN ====
        if ($request->payment_method == 'qris') {
            // Set konfigurasi Midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => ['first_name' => "Pelanggan"],
            ];

            try {
                // Dapatkan Snap Token dari Midtrans
                $snapToken = Snap::getSnapToken($params);
                // Simpan token ke pesanan dan arahkan ke halaman pembayaran
                $order->payment_token = $snapToken;
                $order->save();
                return redirect()->route('order.payment', $order->id);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        // Jika metode pembayaran 'cash', langsung update status
        $order->update(['status' => 'unpaid']);
        return redirect()->route('order.success', $order->id);
    }

    /**
     * Menampilkan halaman pembayaran Midtrans.
     */
    public function paymentPage(Order $order)
    {
        return view('customer.payment', [
            'order' => $order,
            'snapToken' => $order->payment_token,
            'clientKey' => config('midtrans.client_key')
        ]);
    }

    /**
     * Menampilkan halaman sukses setelah memesan.
     */
    public function orderSuccess(Order $order)
    {
        return view('customer.success', compact('order'));
    }
}

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import semua controller yang kita butuhkan
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboardController;
use App\Http\Controllers\Cook\DashboardController as CookDashboardController;
use App\Http\Controllers\OrderPageController;
use App\Http\Controllers\WebhookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ... (Route root '/' dan route pembeli biarkan saja)
Route::get('/pesan', [OrderPageController::class, 'index'])->name('order.index');
Route::post('/keranjang/tambah/{product}', [OrderPageController::class, 'addToCart'])->name('cart.add');
Route::post('/keranjang/update/{id}', [OrderPageController::class, 'updateCart'])->name('cart.update');
Route::get('/keranjang/hapus/{id}', [OrderPageController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/pesanan/buat', [OrderPageController::class, 'placeOrder'])->name('order.place');
Route::get('/pesanan/sukses/{order}', [OrderPageController::class, 'orderSuccess'])->name('order.success');
Route::get('/pesanan/bayar/{order}', [OrderPageController::class, 'paymentPage'])->name('order.payment');

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        $url = match ($role) {
            'admin' => '/admin/dashboard',
            'kasir' => '/kasir/dashboard',
            'koki'  => '/koki/dashboard',
            default => '/dashboard',
        };
        return redirect($url);
    }
    return redirect()->route('order.index');
});

// Grup untuk semua route Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
});

// Grup untuk semua route Kasir
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [CashierDashboardController::class, 'index'])->name('dashboard');
    Route::post('/orders/{order}/confirm', [CashierDashboardController::class, 'confirmPayment'])->name('orders.confirm');
    Route::post('/orders/{order}/finish', [CashierDashboardController::class, 'finishOrder'])->name('orders.finish');
});

// ▼▼▼ PASTIKAN GRUP ROUTE KOKI ANDA PERSIS SEPERTI INI ▼▼▼
Route::middleware(['auth', 'role:koki'])->prefix('koki')->name('koki.')->group(function () {
    Route::get('/dashboard', [CookDashboardController::class, 'index'])->name('dashboard');
    // Pastikan baris ini ada, menggunakan 'POST', dan menunjuk ke 'completeOrder'
    Route::post('/orders/{order}/complete', [CookDashboardController::class, 'completeOrder'])->name('orders.complete');
});
// ▲▲▲ SAMPAI SINI ▲▲▲
Route::post('/midtrans-webhook', [WebhookController::class, 'handle']);

require __DIR__.'/auth.php';


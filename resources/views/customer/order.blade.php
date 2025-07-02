@extends('layouts.customer')

@section('title', 'Pilih Menu Favoritmu!')

@section('content')
<style>
    .order-layout {
        display: flex;
        align-items: flex-start; /* Penting untuk sticky cart */
        gap: 2.5rem;
    }
    .menu-list {
        flex: 3;
    }
    .cart-container {
        flex: 1;
        position: sticky; /* Membuat keranjang melayang */
        top: 2rem; /* Jarak dari atas */
    }
    .cart-box {
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 1.5rem;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1.5rem;
    }
    .product-card {
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .product-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }
    .product-card-content {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .product-card-content h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1.1rem;
        font-weight: 600;
    }
    .product-card-content .description {
        font-size: 0.85rem;
        color: #666;
        flex-grow: 1;
        margin-bottom: 1rem;
    }
    .product-card-content .price {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 1rem;
    }
    .cart-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f0f0;
    }
    .cart-item img {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
    }
    .cart-item-details {
        flex-grow: 1;
    }
    .cart-item-details h4 {
        margin: 0 0 5px 0;
        font-size: 1rem;
    }
    .quantity-form {
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>

<div class="order-layout">
    {{-- Kolom Kiri: Daftar Menu --}}
    <div class="menu-list">
        @foreach($categories as $category)
            <h2 style="font-weight: 600; margin-bottom: 1.5rem;">{{ $category->name }}</h2>
            <div class="product-grid">
                @foreach($category->products as $product)
                    <div class="product-card">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/600x400/orange/white?text=Gambar' }}" alt="{{ $product->name }}">
                        <div class="product-card-content">
                            <h3>{{ $product->name }}</h3>
                            <p class="description">{{ $product->description ?? 'Deskripsi tidak tersedia.' }}</p>
                            <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fa-solid fa-plus"></i> Tambah</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr style="margin: 3rem 0; border: 1px solid #eee;">
        @endforeach
    </div>

    {{-- Kolom Kanan: Keranjang Belanja --}}
    <div class="cart-container">
        <div class="cart-box">
            <h2 style="font-weight: 600;">Keranjang Anda</h2>
            <hr style="margin-bottom: 1.5rem; border-color: #eee;">
            @if(empty($cart))
                <div style="text-align: center; padding: 2rem 0;">
                    <i class="fa-solid fa-cart-shopping" style="font-size: 3rem; color: var(--light-gray);"></i>
                    <p style="color: #888; margin-top: 1rem;">Keranjang masih kosong</p>
                </div>
            @else
                @php $total = 0; @endphp
                @foreach($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <div class="cart-item">
                        <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://placehold.co/100x100/orange/white?text=Img' }}" alt="{{ $details['name'] }}">
                        <div class="cart-item-details">
                            <h4>{{ $details['name'] }}</h4>
                            <p style="margin: 5px 0; font-weight: 600;">Rp {{ number_format($details['price']) }}</p>
                            <div class="quantity-form">
                                <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline-flex; align-items: center; gap: 5px;">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" style="width: 50px; padding: 5px; border-radius: 8px; border: 1px solid var(--light-gray);">
                                    <button type="submit" class="btn" style="padding: 5px 8px; font-size: 0.8em; background-color: #eee;">Update</button>
                                </form>
                                <a href="{{ route('cart.remove', $id) }}" style="color: #dc3545; font-size: 0.9em; margin-left: auto; text-decoration: none;" title="Hapus item"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr style="margin: 1.5rem 0; border-color: #eee;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: 600; font-size: 1.1rem;">Total:</span>
                    <span style="font-weight: 700; font-size: 1.3rem;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('order.place') }}" method="POST" style="margin-top: 1.5rem;">
                    @csrf
                    <label for="payment_method" style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Metode Pembayaran:</label>
                    <select name="payment_method" required style="width: 100%; padding: 10px; margin-bottom: 1.5rem; border-radius: 8px; border: 1px solid var(--light-gray);">
                        <option value="cash">Bayar di Kasir (Cash)</option>
                        <option value="qris">QRIS (Langsung Lunas)</option>
                    </select>
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.2em;"><i class="fa-solid fa-paper-plane"></i> Pesan Sekarang</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection

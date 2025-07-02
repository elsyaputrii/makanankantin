@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container">
    <h1>Manajemen Produk</h1>
    <a href="{{ route('admin.products.create') }}" style="display: inline-block; padding: 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">Tambah Produk Baru</a>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-top: 20px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th style="padding: 10px;">No</th>
                <th style="padding: 10px;">Gambar</th>
                <th style="padding: 10px;">Nama Produk</th>
                <th style="padding: 10px;">Kategori</th>
                <th style="padding: 10px;">Harga</th>
                <th style="padding: 10px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $index => $product)
                <tr>
                    <td style="padding: 10px; text-align: center;">{{ $index + $products->firstItem() }}</td>
                    <td style="padding: 10px; text-align: center;">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <span>[Tidak ada gambar]</span>
                        @endif
                    </td>
                    <td style="padding: 10px;">{{ $product->name }}</td>
                    <td style="padding: 10px;">{{ $product->category->name ?? 'Tidak ada kategori' }}</td>
                    <td style="padding: 10px;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td style="padding: 10px; text-align: center;">
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="margin-right: 10px; color: #007bff; text-decoration: none;">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" style="background:none; border:none; color:red; cursor:pointer; padding:0; font-size: 1em;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 10px; text-align: center;">Tidak ada data produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
</div>
@endsection

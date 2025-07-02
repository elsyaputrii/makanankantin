@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="container">
    <h1>Manajemen Kategori</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn-add">Tambah Kategori Baru</a>

    {{-- Blok ini untuk menampilkan pesan sukses setelah menambah/mengedit/menghapus --}}
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-top: 20px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th style="padding: 10px;">No</th>
                <th style="padding: 10px;">Nama Kategori</th>
                <th style="padding: 10px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop untuk menampilkan setiap kategori. @forelse digunakan agar ada pesan jika data kosong --}}
            @forelse ($categories as $index => $category)
                <tr>
                    <td style="padding: 10px; text-align: center;">{{ $index + $categories->firstItem() }}</td>
                    <td style="padding: 10px;">{{ $category->name }}</td>
                    <td style="padding: 10px; text-align: center;">
                        <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" style="background:none; border:none; color:red; cursor:pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                {{-- Ini akan ditampilkan jika variabel $categories kosong --}}
                <tr>
                    <td colspan="3" style="padding: 10px; text-align: center;">Tidak ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Menampilkan link untuk paginasi (halaman 1, 2, 3, dst.) --}}
    <div style="margin-top: 20px;">
        {{ $categories->links() }}
    </div>
</div>
@endsection

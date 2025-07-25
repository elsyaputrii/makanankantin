<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category; // <-- Pastikan ini ada untuk menggunakan model Category
use Illuminate\Http\Request; // <-- Pastikan ini ada untuk menerima data dari form

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * Method untuk menampilkan semua kategori (READ)
     */
    public function index()
    {
        // Ambil semua data kategori, urutkan dari yang terbaru, 10 data per halaman
        $categories = Category::latest()->paginate(10);

        // Kirim data categories ke view
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * Method untuk menampilkan form tambah data (CREATE part 1)
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * Method untuk menyimpan data baru ke database (CREATE part 2)
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // 2. Jika validasi berhasil, simpan data ke database
        Category::create([
            'name' => $request->name,
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     * Method untuk menampilkan form edit kategori (EDIT)
     */
    public function edit(Category $category)
    {
        // Kirim data kategori yang ingin diedit ke view
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * Method ini untuk memperbarui data kategori (UPDATE)
     */
    public function update(Request $request, Category $category)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        // 2. Jika validasi berhasil, update data kategori
        $category->update([
            'name' => $request->name,
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Method ini untuk menghapus kategori (DELETE)
     */
    public function destroy(Category $category)
    {
        // Hapus data kategori
        $category->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

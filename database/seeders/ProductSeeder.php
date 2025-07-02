<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari setiap kategori
        $makananUtama = Category::where('name', 'Makanan Utama')->first();
        $minumanDingin = Category::where('name', 'Minuman Dingin')->first();
        $minumanPanas = Category::where('name', 'Minuman Panas')->first();
        $camilan = Category::where('name', 'Camilan')->first();

        // Data Produk
        $products = [
            // Makanan Utama
            ['name' => 'Nasi Goreng Spesial', 'price' => 25000, 'description' => 'Nasi goreng dengan telur, ayam, dan bakso.', 'category_id' => $makananUtama->id, 'image' => 'products/nasi-goreng.jpg'],
            ['name' => 'Ayam Bakar Madu', 'price' => 28000, 'description' => 'Ayam bakar dengan bumbu madu manis gurih.', 'category_id' => $makananUtama->id, 'image' => 'products/ayam-bakar.jpg'],
            ['name' => 'Soto Ayam Lamongan', 'price' => 18000, 'description' => 'Soto ayam khas Lamongan dengan koya.', 'category_id' => $makananUtama->id, 'image' => 'products/soto-ayam.jpg'],

            // Minuman Dingin
            ['name' => 'Es Teh Manis', 'price' => 5000, 'description' => 'Teh manis dingin yang menyegarkan.', 'category_id' => $minumanDingin->id, 'image' => 'products/es-teh.jpg'],
            ['name' => 'Es Jeruk', 'price' => 8000, 'description' => 'Es jeruk peras asli.', 'category_id' => $minumanDingin->id, 'image' => 'products/es-jeruk.jpg'],
            ['name' => 'Jus Alpukat', 'price' => 12000, 'description' => 'Jus alpukat kental dengan susu coklat.', 'category_id' => $minumanDingin->id, 'image' => 'products/jus-alpukat.jpg'],

            // Minuman Panas
            ['name' => 'Kopi Hitam', 'price' => 6000, 'description' => 'Kopi hitam tubruk panas.', 'category_id' => $minumanPanas->id, 'image' => 'products/kopi-hitam.jpg'],
            ['name' => 'Teh Tarik', 'price' => 8000, 'description' => 'Teh susu khas yang ditarik.', 'category_id' => $minumanPanas->id, 'image' => 'products/teh-tarik.jpg'],

            // Camilan
            ['name' => 'Kentang Goreng', 'price' => 15000, 'description' => 'Kentang goreng renyah dengan saus.', 'category_id' => $camilan->id, 'image' => 'products/kentang-goreng.jpg'],
            ['name' => 'Roti Bakar Coklat Keju', 'price' => 18000, 'description' => 'Roti bakar dengan topping melimpah.', 'category_id' => $camilan->id, 'image' => 'products/roti-bakar.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

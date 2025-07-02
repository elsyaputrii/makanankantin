<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Makanan Utama']);
        Category::create(['name' => 'Minuman Dingin']);
        Category::create(['name' => 'Minuman Panas']);
        Category::create(['name' => 'Camilan']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Penting untuk di-import
use Illuminate\Support\Facades\Hash; // <-- Penting untuk enkripsi password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kantin.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // User Kasir
        User::create([
            'name' => 'Kasir 01',
            'email' => 'kasir@kantin.test',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        // User Koki
        User::create([
            'name' => 'Koki 01',
            'email' => 'koki@kantin.test',
            'password' => Hash::make('password'),
            'role' => 'koki',
        ]);
    }
}

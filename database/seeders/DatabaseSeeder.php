<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat User Admin
        \App\Models\User::create([
            'name' => 'Admin Perpus',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Buat User Biasa 1
        \App\Models\User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        // Buat User Biasa 2
        \App\Models\User::create([
            'name' => 'Nabila Alya Chalisa',
            'email' => 'nabila@example.com',
            'password' => bcrypt('nabila'),
            'role' => 'user',
        ]);

        // Buat User Biasa 3
        \App\Models\User::create([
            'name' => 'Ahmad Wijaya',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        // Panggil seeder lainnya sesuai urutan relasi
        $this->call([
            CategorySeeder::class,
            PublisherSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class, // Book harus terakhir karena butuh ID dari yang atas
        ]);
    }
}

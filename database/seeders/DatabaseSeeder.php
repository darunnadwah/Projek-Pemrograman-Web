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

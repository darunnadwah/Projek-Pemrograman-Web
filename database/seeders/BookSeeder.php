<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Book::create([
        'title' => 'Belajar Laravel',
        'year' => 2024,
        'category_id' => 1,
        'publisher_id' => 1,
        'author_id' => 1,
        'price' => 50000,
        'stock' => 10,
        'type' => 'physical'
    ]);

    \App\Models\Book::create([
        'title' => 'Mastering Tailwind CSS',
        'year' => 2023,
        'category_id' => 1,
        'publisher_id' => 1,
        'author_id' => 1,
        'price' => 35000,
        'stock' => 0, // E-book tidak butuh stok fisik
        'type' => 'ebook',
        'file_path' => 'ebooks/mastering-tailwind.pdf'
    ]);

    \App\Models\Book::create([
        'title' => 'Filosofi Teras',
        'year' => 2019,
        'category_id' => 1, 
        'publisher_id' => 1,
        'author_id' => 1,
        'price' => 85000,
        'stock' => 5,
        'type' => 'both',
        'file_path' => 'ebooks/filosofi-teras.pdf'
    ]); 
    }
}

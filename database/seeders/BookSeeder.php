<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Book::truncate();

        \App\Models\Book::create([
            'title' => 'Belajar Laravel',
            'year' => 2024,
            'author_id' => 1, 
            'publisher_id' => 1, 
            'category_id' => 5, // 5 adalah Teknologi 2024
            'price' => 50000,
            'stock' => 2,
            'type' => 'physical'
        ]);

        \App\Models\Book::create([
            'title' => 'Mastering Tailwind CSS',
            'year' => 2023,
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 5, // 5 adalah Teknologi 2024
            'price' => 35000,
            'stock' => 0,
            'type' => 'ebook'
        ]);

        \App\Models\Book::create([
            'title' => 'Filosofi Teras',
            'year' => 2019,
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 10, // 10 adalah Psikologi
            'price' => 85000,
            'stock' => 7,
            'type' => 'both'
        ]);
    }
}

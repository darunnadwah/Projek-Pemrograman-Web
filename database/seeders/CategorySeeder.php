<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Matikan pengecekan relasi agar bisa truncate
        Schema::disableForeignKeyConstraints();
        \App\Models\Category::truncate();
        Schema::enableForeignKeyConstraints();

        $categories = [
            ['name' => 'Fiksi & Novel'],        // ID 1
            ['name' => 'Sains & Teknologi'],    // ID 2
            ['name' => 'Sejarah'],              // ID 3
            ['name' => 'Bisnis & Ekonomi'],    // ID 4
            ['name' => 'Agama & Spiritual'],    // ID 5
            ['name' => 'Buku Anak'],            // ID 6
            ['name' => 'Jurnal & Riset'],       // ID 7
            ['name' => 'Puisi Indonesia'],      // ID 8
            ['name' => 'Filsafat Timur'],       // ID 9
            ['name' => 'Hukum & HAM'],          // ID 10
            ['name' => 'Psikologi'],            // ID 11
            ['name' => 'Biografi Tokoh'],       // ID 12
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}

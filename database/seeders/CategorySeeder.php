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
            ['name' => 'Sejarah Nusantara'], // ID 1
            ['name' => 'Fiksi Sains'],       // ID 2
            ['name' => 'Puisi Indonesia'],   // ID 3
            ['name' => 'Filsafat Timur'],    // ID 4
            ['name' => 'Teknologi 2024'],    // ID 5
            ['name' => 'Ekonomi Global'],    // ID 6
            ['name' => 'Novel Klasik'],      // ID 7
            ['name' => 'Sains & Alam'],      // ID 8
            ['name' => 'Hukum & HAM'],       // ID 9
            ['name' => 'Psikologi'],         // ID 10
            ['name' => 'Biografi Tokoh'],    // ID 11
            ['name' => 'Kuliner Nusantara'], // ID 12
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    \App\Models\Category::create(['name'=>'Fiksi']);
    \App\Models\Category::create(['name'=>'Non Fiksi']);
    \App\Models\Category::create(['name'=>'Pendidikan']);
    \App\Models\Category::create(['name'=>'Pemrograman']);
    }
}

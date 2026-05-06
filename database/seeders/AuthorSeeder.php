<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
    \App\Models\Author::create(['name'=>'Andrea Hirata', 'email' => 'andrea@example.com']);
    \App\Models\Author::create(['name'=>'Tere Liye', 'email' => 'tere@example.com']);
    }
}

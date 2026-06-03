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
    \App\Models\Author::create(['name'=>'Seno Gumira Ajidarma', 'email' => 'seno@example.com']);
    \App\Models\Author::create(['name'=>'Pramoedya Ananta Toer', 'email' => 'pramoe@example.com']);
    \App\Models\Author::create(['name'=>'Sapardi Djoko Damono', 'email' => 'sapardi@example.com']);
    \App\Models\Author::create(['name'=>'Agus Taufik', 'email' => 'agus@example.com']);
    \App\Models\Author::create(['name'=>'Muhammad Abduh Tuasikal', 'email' => 'abduh@example.com']);
    \App\Models\Author::create(['name'=>'Enid Blyton', 'email' => 'enid@example.com']);
    \App\Models\Author::create(['name'=>'Yuval Noah Harari', 'email' => 'yuval@example.com']);
    \App\Models\Author::create(['name'=>'Carl Sagan', 'email' => 'carl@example.com']);
    }
}

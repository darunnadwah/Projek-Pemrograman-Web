<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Agar kolom ini bisa diisi secara massal (mass assignment)
    protected $fillable = [
        'title', 'year', 'category_id', 'publisher_id', 
        'author_id', 'price', 'stock', 'type', 'file_path', 'image'
    ];

    // Relasi ke tabel Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke tabel Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relasi ke tabel Publisher
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
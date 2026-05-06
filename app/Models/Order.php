<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk memberi izin pengisian data
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
     protected $fillable = [
        'judul', 
        'slug', 
        'konten', 
        'excerpt', 
        'kategori', 
        'gambar', 
        'dilihat', 
        'is_published', 
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean'
    ];
}

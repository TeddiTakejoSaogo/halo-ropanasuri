<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
     protected $fillable = ['question', 'answer', 'category', 'hit_count', 'is_active'];

    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

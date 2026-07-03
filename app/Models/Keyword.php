<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['faq_id', 'keyword', 'weight'];

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}

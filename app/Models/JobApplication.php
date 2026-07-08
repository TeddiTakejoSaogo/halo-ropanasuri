<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id', 'first_name', 'last_name', 'email', 'phone', 
        'resume_path', 'portfolio_url', 'status'
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HomecarePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'preparation',
        'procedure',
        'price',
        'duration',
        'image',
        'features',
        'whatsapp_message',
        'order',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($package) {
            if (empty($package->slug)) {
                $package->slug = Str::slug($package->name);
            }
            
            if (empty($package->whatsapp_message)) {
                $package->whatsapp_message = "Halo, saya ingin informasi lebih lanjut tentang paket {$package->name}";
            }
        });

        static::updating(function ($package) {
            if ($package->isDirty('name')) {
                $package->slug = Str::slug($package->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }

    public function getFormattedPriceAttribute()
    {
        if ($this->price) {
            return 'Rp ' . number_format($this->price, 0, ',', '.');
        }
        return 'Hubungi Kami';
    }

    public function getFeaturesArrayAttribute()
    {
        if (is_array($this->features)) {
            return $this->features;
        }
        
        return array_filter(explode("\n", $this->features ?? ''));
    }
}
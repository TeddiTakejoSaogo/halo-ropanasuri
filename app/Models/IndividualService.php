<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IndividualService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'benefits',
        'features',
        'price',
        'discount_price',
        'duration_days',
        'icon',
        'image',
        'status',
        'is_featured',
        'sort_order',
        'whatsapp_message'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('name')) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedDiscountPriceAttribute()
    {
        if ($this->discount_price) {
            return 'Rp ' . number_format($this->discount_price, 0, ',', '.');
        }
        return null;
    }

    public function getPriceAfterDiscountAttribute()
    {
        if ($this->discount_price) {
            return $this->discount_price;
        }
        return $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->discount_price && $this->price > 0) {
            $discount = (($this->price - $this->discount_price) / $this->price) * 100;
            return round($discount, 0);
        }
        return 0;
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://via.placeholder.com/600x400?text=Paket+Layanan';
    }

    public function getIconClassAttribute()
    {
        $icons = [
            'stethoscope' => 'fas fa-stethoscope',
            'heart' => 'fas fa-heart',
            'brain' => 'fas fa-brain',
            'baby' => 'fas fa-baby',
            'user-md' => 'fas fa-user-md',
            'star' => 'fas fa-star',
            'crown' => 'fas fa-crown',
            'shield-alt' => 'fas fa-shield-alt',
        ];

        return $icons[$this->icon] ?? 'fas fa-medkit';
    }

    public function getFeaturesArrayAttribute()
    {
        if (empty($this->features)) {
            return [];
        }
        return array_filter(explode("\n", $this->features));
    }

    public function getBenefitsArrayAttribute()
    {
        if (empty($this->benefits)) {
            return [];
        }
        return array_filter(explode("\n", $this->benefits));
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'description',
        'operational_hours',
        'status'
    ];

    public function getIconClassAttribute()
    {
        $icons = [
            'ear' => 'fas fa-ear-deaf',
            'bone' => 'fas fa-bone',
            'ribbon' => 'fas fa-ribbon',
            'droplet' => 'fas fa-droplet',
            'syringe' => 'fas fa-syringe',
            'stethoscope' => 'fas fa-stethoscope',
            'heart' => 'fas fa-heart-pulse',
            'pills' => 'fas fa-pills',
            'microscope' => 'fas fa-microscope',
            'x-ray' => 'fas fa-x-ray',
            'ambulance' => 'fas fa-ambulance',
            'band-aid' => 'fas fa-band-aid',
            'bed' => 'fas fa-bed',
        ];

        return $icons[$this->icon] ?? 'fas fa-medkit';
    }

    public function getModernIconAttribute()
    {
        $modernIcons = [
            'ear' => '👂',
            'bone' => '🦴',
            'ribbon' => '🎗️',
            'droplet' => '💧',
            'syringe' => '💉',
            'stethoscope' => '🩺',
            'heart' => '❤️',
            'pills' => '💊',
            'microscope' => '🔬',
            'x-ray' => '🩻',
            'ambulance' => '🚑',
            'band-aid' => '🩹',
            'bed' => '🛏️',
        ];

        return $modernIcons[$this->icon] ?? '🏥';
    }
}
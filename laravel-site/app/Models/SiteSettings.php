<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $fillable = [
        'name',
        'tagline',
        'phone',
        'email',
        'address',
        'hours',
        'facebook_url',
        'currency',
        'logo_path',
    ];

    /**
     * Get the singleton instance of site settings
     */
    public static function getSettings(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'name' => config('site.name', 'Car Parts Shop'),
                'tagline' => config('site.tagline', 'Quality car parts. Fast sourcing. Honest pricing.'),
                'phone' => config('site.phone', ''),
                'email' => config('site.email', ''),
                'address' => config('site.address', ''),
                'hours' => config('site.hours', ''),
                'facebook_url' => config('site.facebook_url', ''),
                'currency' => config('site.currency', 'MUR'),
            ]
        );
    }
}

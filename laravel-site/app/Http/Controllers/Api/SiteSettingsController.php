<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use Illuminate\Http\JsonResponse;

class SiteSettingsController extends Controller
{
    public function show(): JsonResponse
    {
        $settings = SiteSettings::getSettings();
        
        // Generate full URL for logo if it exists
        $logoUrl = null;
        if ($settings->logo_path) {
            $logoUrl = asset('storage/' . $settings->logo_path);
        }

        // Get favicon modification time for cache-busting
        $faviconTimestamp = time();
        $faviconPath = public_path('favicon.png');
        if (file_exists($faviconPath)) {
            $faviconTimestamp = filemtime($faviconPath);
        }

        return response()->json([
            'name' => $settings->name,
            'tagline' => $settings->tagline,
            'phone' => $settings->phone ?? '',
            'email' => $settings->email ?? '',
            'address' => $settings->address ?? '',
            'hours' => $settings->hours ?? '',
            'facebookUrl' => $settings->facebook_url ?? '',
            'logoUrl' => $logoUrl,
            'accentColorHex' => '#ef4444', // Can be added to settings later
            'faviconVersion' => $faviconTimestamp,
        ]);
    }
}


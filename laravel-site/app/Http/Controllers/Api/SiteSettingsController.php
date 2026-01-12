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

        return response()->json([
            'name' => $settings->name,
            'tagline' => $settings->tagline,
            'phone' => $settings->phone ?? '',
            'email' => $settings->email ?? '',
            'address' => $settings->address ?? '',
            'hours' => $settings->hours ?? '',
            'facebookUrl' => $settings->facebook_url ?? '',
            'accentColorHex' => '#ef4444', // Can be added to settings later
        ]);
    }
}


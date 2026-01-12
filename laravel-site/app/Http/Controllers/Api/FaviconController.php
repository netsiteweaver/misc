<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FaviconController extends Controller
{
    public function show(): Response
    {
        $settings = SiteSettings::getSettings();
        
        // Check if favicon exists in public directory
        $faviconPath = public_path('favicon.png');
        
        if (file_exists($faviconPath)) {
            return response()->file($faviconPath, [
                'Content-Type' => 'image/png',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
        }
        
        // Fallback: return 404 or default favicon
        abort(404);
    }
}


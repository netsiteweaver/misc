<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiteSettingsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logoPath = $this->copyImageIfExists('logo', 'settings');

        SiteSettings::query()->updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Klaxon Autoparts',
                'tagline' => 'Your partner in Japanese and European car parts.',
                'phone' => '675 7470',
                'whatsapp_number' => '52577279',
                'email' => 'abd.klaxon@gmail.com',
                'address' => 'Corner Botanical Garden & St Clement Street , Curepipe, Mauritius',
                'hours' => '09:00 - 17:00',
                'facebook_url' => 'https://www.facebook.com/profile.php?id=100068333531889',
                'instagram_url' => 'https://www.instagram.com/klaxonautoparts/',
                'youtube_url' => 'https://www.youtube.com/@klaxonautoparts',
                'linkedin_url' => 'https://www.linkedin.com/company/klaxonautoparts/',
                'twitter_url' => 'https://x.com/klaxonautoparts',
                'tiktok_url' => 'https://www.tiktok.com/@klaxonautoparts',
                'currency' => 'MUR',
                'logo_path' => $logoPath,
            ]
        );
    }

    /**
     * Copy an image from seeders/images/{subdirectory}/{name}.* to storage/{subdirectory}/{name}.*
     * 
     * @param string $imageName The name of the image file (without extension)
     * @param string $subdirectory The subdirectory in both seeders/images and storage
     * @return string|null The storage path if copied, null otherwise
     */
    private function copyImageIfExists(string $imageName, string $subdirectory): ?string
    {
        $seedImagesPath = database_path("seeders/images/{$subdirectory}");
        $publicDisk = Storage::disk('public');

        // Look for common image extensions
        $extensions = ['png', 'jpg', 'jpeg', 'gif', 'webp', 'svg'];
        
        foreach ($extensions as $ext) {
            $sourceFile = "{$seedImagesPath}/{$imageName}.{$ext}";
            
            if (File::exists($sourceFile)) {
                $destinationPath = "{$subdirectory}/{$imageName}.{$ext}";
                
                // Ensure the directory exists in storage
                $publicDisk->makeDirectory($subdirectory);
                
                // Copy the file
                $contents = File::get($sourceFile);
                $publicDisk->put($destinationPath, $contents);
                
                return $destinationPath;
            }
        }

        return null;
    }
}


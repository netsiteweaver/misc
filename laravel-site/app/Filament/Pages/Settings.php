<?php

namespace App\Filament\Pages;

use App\Models\SiteSettings;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 100;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSettings::getSettings();
        $this->form->fill([
            'name' => $settings->name,
            'tagline' => $settings->tagline,
            'phone' => $settings->phone,
            'email' => $settings->email,
            'address' => $settings->address,
            'hours' => $settings->hours,
            'facebook_url' => $settings->facebook_url,
            'currency' => $settings->currency,
            'logo_path' => $settings->logo_path,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Company Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Company Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tagline')
                            ->label('Tagline')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->label('Address')
                            ->rows(3),
                        Forms\Components\TextInput::make('hours')
                            ->label('Business Hours')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Social Media & Currency')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\Select::make('currency')
                            ->label('Currency')
                            ->options([
                                'MUR' => 'MUR - Mauritian Rupee',
                                'USD' => 'USD - US Dollar',
                                'EUR' => 'EUR - Euro',
                                'GBP' => 'GBP - British Pound',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Company Logo')
                    ->description('Upload a company logo. It will be automatically converted to a favicon.')
                    ->schema([
                        Forms\Components\FileUpload::make('logo_path')
                            ->label('Logo')
                            ->disk('public')
                            ->directory('settings')
                            ->image()
                            ->imageEditor()
                            ->maxSize(5120) // 5MB
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/webp'])
                            ->helperText('Recommended size: 512x512 pixels or higher. Will be converted to favicon automatically.')
                            ->imagePreviewHeight('200')
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('save')
                ->label('Save Settings')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = SiteSettings::getSettings();

        // Store old logo path before updating
        $oldLogoPath = $settings->logo_path ?? null;
        $newLogoPath = $data['logo_path'] ?? null;

        // Handle logo upload and favicon conversion
        // Convert if a new logo was uploaded (path changed)
        if ($newLogoPath && $newLogoPath !== $oldLogoPath) {
            $this->convertLogoToFavicon($newLogoPath);
        }

        $settings->update($data);

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();

        // Reload the form with updated data
        $this->mount();
    }

    protected function convertLogoToFavicon(string $logoPath): void
    {
        try {
            $fullPath = Storage::disk('public')->path($logoPath);

            if (!file_exists($fullPath)) {
                \Log::warning("Favicon conversion failed: Logo file not found at {$fullPath}");
                return;
            }

            // Get image info
            $imageInfo = getimagesize($fullPath);
            if (!$imageInfo) {
                return;
            }

            $mimeType = $imageInfo['mime'];
            $sourceWidth = $imageInfo[0];
            $sourceHeight = $imageInfo[1];

            // Create source image resource based on mime type
            $sourceImage = match ($mimeType) {
                'image/jpeg', 'image/jpg' => imagecreatefromjpeg($fullPath),
                'image/png' => imagecreatefrompng($fullPath),
                'image/gif' => imagecreatefromgif($fullPath),
                'image/webp' => imagecreatefromwebp($fullPath),
                default => null,
            };

            if (!$sourceImage) {
                return;
            }

            // Create favicon sizes (multiple sizes for better compatibility)
            $faviconSizes = [32, 16];

            foreach ($faviconSizes as $size) {
                // Create new image
                $favicon = imagecreatetruecolor($size, $size);
                
                // Enable alpha blending for transparency
                imagealphablending($favicon, false);
                imagesavealpha($favicon, true);

                // Fill with transparent background
                $transparent = imagecolorallocatealpha($favicon, 0, 0, 0, 127);
                imagefill($favicon, 0, 0, $transparent);

                // Resize and copy source image
                imagecopyresampled(
                    $favicon,
                    $sourceImage,
                    0, 0, 0, 0,
                    $size, $size,
                    $sourceWidth, $sourceHeight
                );

                // Save as PNG (works as favicon in modern browsers)
                $faviconPath = public_path("favicon-{$size}x{$size}.png");
                imagepng($favicon, $faviconPath, 9);
                imagedestroy($favicon);
            }

            // Also create a standard favicon.ico (32x32 PNG saved as .ico for compatibility)
            $favicon32 = imagecreatetruecolor(32, 32);
            imagealphablending($favicon32, false);
            imagesavealpha($favicon32, true);
            $transparent = imagecolorallocatealpha($favicon32, 0, 0, 0, 127);
            imagefill($favicon32, 0, 0, $transparent);
            imagecopyresampled(
                $favicon32,
                $sourceImage,
                0, 0, 0, 0,
                32, 32,
                $sourceWidth, $sourceHeight
            );
            
            // Save as PNG in public directory (modern browsers will use PNG as favicon)
            imagepng($favicon32, public_path('favicon.png'), 9);
            
            // Also copy to favicon.ico for better browser compatibility
            copy(public_path('favicon.png'), public_path('favicon.ico'));
            
            imagedestroy($favicon32);

            imagedestroy($sourceImage);
            
            \Log::info("Favicon conversion completed successfully for {$logoPath}");
        } catch (\Exception $e) {
            \Log::error("Favicon conversion failed: " . $e->getMessage());
        }
    }
}


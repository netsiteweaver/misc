<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DemoCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedImages();
        $currency = (string) config('site.currency', 'MUR');

        $categories = collect([
            ['name' => 'Brakes', 'description' => 'Pads, rotors, calipers, sensors, brake fluid.', 'image' => 'sample/categories/brakes.svg'],
            ['name' => 'Engine', 'description' => 'Filters, belts, plugs, mounts, service parts.', 'image' => 'sample/categories/engine.svg'],
            ['name' => 'Suspension & Steering', 'description' => 'Shocks, struts, bushings, joints, tie rods.', 'image' => 'sample/categories/suspension.svg'],
            ['name' => 'Electrical', 'description' => 'Batteries, alternators, starters, sensors, bulbs.', 'image' => 'sample/categories/electrical.svg'],
            ['name' => 'Body & Lighting', 'description' => 'Mirrors, headlights, bumpers, fenders.', 'image' => 'sample/categories/body.svg'],
            ['name' => 'Fluids & Service', 'description' => 'Oils, coolants, ATF, wipers, consumables.', 'image' => 'sample/categories/service.svg'],
        ])->map(function (array $c, int $i) {
            return Category::query()->updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name' => $c['name'],
                    'description' => $c['description'],
                    'image_path' => $c['image'],
                    'sort_order' => $i,
                    'is_active' => true,
                ],
            );
        });

        $brands = collect([
            ['name' => 'Bosch', 'image' => 'sample/brands/bosch.svg'],
            ['name' => 'NGK', 'image' => 'sample/brands/ngk.svg'],
            ['name' => 'Denso', 'image' => 'sample/brands/denso.svg'],
            ['name' => 'Brembo', 'image' => 'sample/brands/brembo.svg'],
            ['name' => 'KYB', 'image' => 'sample/brands/kyb.svg'],
            ['name' => 'Valeo', 'image' => 'sample/brands/valeo.svg'],
            ['name' => 'MANN-FILTER', 'image' => 'sample/brands/mann.svg'],
            ['name' => 'Febi', 'image' => 'sample/brands/febi.svg'],
        ])->map(function (array $b) {
            return Brand::query()->updateOrCreate(
                ['slug' => Str::slug($b['name'])],
                [
                    'name' => $b['name'],
                    'image_path' => $b['image'],
                    'is_active' => true,
                ],
            );
        });

        $byCategory = fn (string $name) => $categories->firstWhere('slug', Str::slug($name));
        $byBrand = fn (string $name) => $brands->firstWhere('slug', Str::slug($name));

        $products = [
            [
                'name' => 'Brake pads (front set)',
                'category' => 'Brakes',
                'brand' => 'Brembo',
                'sku' => 'BRK-PAD-FRONT',
                'image' => 'sample/products/brake-pads.svg',
                'description' => 'Front pads set. OEM and aftermarket options available.',
            ],
            [
                'name' => 'Brake rotors (pair)',
                'category' => 'Brakes',
                'brand' => 'Brembo',
                'sku' => 'BRK-ROTOR-PAIR',
                'image' => 'sample/products/rotors.svg',
                'description' => 'Pair of discs/rotors. Verify size with VIN or photo.',
            ],
            [
                'name' => 'Oil filter',
                'category' => 'Engine',
                'brand' => 'MANN-FILTER',
                'sku' => 'ENG-OIL-FLT',
                'image' => 'sample/products/oil-filter.svg',
                'description' => 'Engine oil filter for multiple models.',
            ],
            [
                'name' => 'Spark plugs (set)',
                'category' => 'Engine',
                'brand' => 'NGK',
                'sku' => 'ENG-PLUG-SET',
                'image' => 'sample/products/spark-plug.svg',
                'description' => 'Correct heat range matched to your engine.',
            ],
            [
                'name' => 'Shock absorber',
                'category' => 'Suspension & Steering',
                'brand' => 'KYB',
                'sku' => 'SUS-SHOCK',
                'image' => 'sample/products/shock.svg',
                'description' => 'Front/rear options; left/right depending on model.',
            ],
            [
                'name' => 'Ball joint',
                'category' => 'Suspension & Steering',
                'brand' => 'Febi',
                'sku' => 'SUS-BALL-JOINT',
                'image' => 'sample/products/ball-joint.svg',
                'description' => 'Suspension ball joint replacement.',
            ],
            [
                'name' => 'Car battery',
                'category' => 'Electrical',
                'brand' => 'Bosch',
                'sku' => 'ELEC-BATT',
                'image' => 'sample/products/battery.svg',
                'description' => 'CCA and size matched to vehicle.',
            ],
            [
                'name' => 'Alternator',
                'category' => 'Electrical',
                'brand' => 'Denso',
                'sku' => 'ELEC-ALT',
                'image' => 'sample/products/alternator.svg',
                'description' => 'Charging system alternator (new or reman options).',
            ],
            [
                'name' => 'Headlight assembly',
                'category' => 'Body & Lighting',
                'brand' => 'Valeo',
                'sku' => 'BODY-HL-ASM',
                'image' => 'sample/products/headlight.svg',
                'description' => 'Left/right available. Confirm model/year.',
            ],
            [
                'name' => 'Side mirror',
                'category' => 'Body & Lighting',
                'brand' => 'Valeo',
                'sku' => 'BODY-MIRROR',
                'image' => 'sample/products/mirror.svg',
                'description' => 'Manual/electric variants depending on vehicle.',
            ],
            [
                'name' => 'Engine oil (5W-30)',
                'category' => 'Fluids & Service',
                'brand' => 'Bosch',
                'sku' => 'SRV-OIL-5W30',
                'image' => 'sample/products/oil.svg',
                'description' => 'Ask for recommended grade for your car.',
            ],
            [
                'name' => 'Wiper blades (pair)',
                'category' => 'Fluids & Service',
                'brand' => 'Bosch',
                'sku' => 'SRV-WIPER-PAIR',
                'image' => 'sample/products/wipers.svg',
                'description' => 'Size matched to your windshield.',
            ],
        ];

        foreach ($products as $i => $p) {
            $category = $byCategory($p['category']);
            $brand = $byBrand($p['brand']);

            if (! $category) {
                continue;
            }

            Product::query()->updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'category_id' => $category->id,
                    'brand_id' => $brand?->id,
                    'name' => $p['name'],
                    'sku' => $p['sku'],
                    'description' => $p['description'],
                    'image_path' => $p['image'],
                    'is_active' => true,
                    'is_quote_only' => true,
                    'price_cents' => null,
                    'currency' => $currency,
                    'sort_order' => $i,
                ],
            );
        }
    }

    private function seedImages(): void
    {
        $disk = Storage::disk('public');

        $files = [
            // Categories
            'sample/categories/brakes.svg' => $this->svgCard('Brakes', '#dc2626'),
            'sample/categories/engine.svg' => $this->svgCard('Engine', '#0f172a'),
            'sample/categories/suspension.svg' => $this->svgCard('Suspension', '#0ea5e9'),
            'sample/categories/electrical.svg' => $this->svgCard('Electrical', '#f59e0b'),
            'sample/categories/body.svg' => $this->svgCard('Body & Lighting', '#8b5cf6'),
            'sample/categories/service.svg' => $this->svgCard('Service', '#10b981'),

            // Brands (logo-ish)
            'sample/brands/bosch.svg' => $this->svgLogo('BOSCH', '#dc2626'),
            'sample/brands/ngk.svg' => $this->svgLogo('NGK', '#0f172a'),
            'sample/brands/denso.svg' => $this->svgLogo('DENSO', '#2563eb'),
            'sample/brands/brembo.svg' => $this->svgLogo('BREMBO', '#dc2626'),
            'sample/brands/kyb.svg' => $this->svgLogo('KYB', '#111827'),
            'sample/brands/valeo.svg' => $this->svgLogo('VALEO', '#10b981'),
            'sample/brands/mann.svg' => $this->svgLogo('MANN', '#f59e0b'),
            'sample/brands/febi.svg' => $this->svgLogo('FEBI', '#8b5cf6'),

            // Products
            'sample/products/brake-pads.svg' => $this->svgCard('Brake Pads', '#dc2626', 'Product'),
            'sample/products/rotors.svg' => $this->svgCard('Rotors', '#dc2626', 'Product'),
            'sample/products/oil-filter.svg' => $this->svgCard('Oil Filter', '#0f172a', 'Product'),
            'sample/products/spark-plug.svg' => $this->svgCard('Spark Plug', '#0f172a', 'Product'),
            'sample/products/shock.svg' => $this->svgCard('Shock', '#0ea5e9', 'Product'),
            'sample/products/ball-joint.svg' => $this->svgCard('Ball Joint', '#0ea5e9', 'Product'),
            'sample/products/battery.svg' => $this->svgCard('Battery', '#f59e0b', 'Product'),
            'sample/products/alternator.svg' => $this->svgCard('Alternator', '#f59e0b', 'Product'),
            'sample/products/headlight.svg' => $this->svgCard('Headlight', '#8b5cf6', 'Product'),
            'sample/products/mirror.svg' => $this->svgCard('Mirror', '#8b5cf6', 'Product'),
            'sample/products/oil.svg' => $this->svgCard('Engine Oil', '#10b981', 'Product'),
            'sample/products/wipers.svg' => $this->svgCard('Wipers', '#10b981', 'Product'),
        ];

        foreach ($files as $path => $contents) {
            if (! $disk->exists($path)) {
                $disk->put($path, $contents);
            }
        }
    }

    private function svgCard(string $title, string $accentHex, string $subtitle = 'Category'): string
    {
        $titleEsc = e($title);
        $subtitleEsc = e($subtitle);

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="800" viewBox="0 0 1200 800">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="{$accentHex}" stop-opacity="0.20"/>
      <stop offset="1" stop-color="#0b0b0c" stop-opacity="0.06"/>
    </linearGradient>
  </defs>
  <rect width="1200" height="800" rx="64" fill="white"/>
  <rect x="32" y="32" width="1136" height="736" rx="56" fill="url(#g)"/>
  <rect x="72" y="92" width="180" height="14" rx="7" fill="{$accentHex}" opacity="0.9"/>
  <text x="72" y="220" font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial" font-size="34" fill="#111827" opacity="0.75">{$subtitleEsc}</text>
  <text x="72" y="320" font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial" font-size="84" font-weight="700" fill="#111827">{$titleEsc}</text>
  <text x="72" y="392" font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial" font-size="28" fill="#374151">Sample image (replace later)</text>
  <circle cx="1040" cy="600" r="140" fill="{$accentHex}" opacity="0.12"/>
  <circle cx="1040" cy="600" r="90" fill="{$accentHex}" opacity="0.20"/>
</svg>
SVG;
    }

    private function svgLogo(string $text, string $accentHex): string
    {
        $textEsc = e($text);

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="320" viewBox="0 0 800 320">
  <rect width="800" height="320" rx="48" fill="#0b0b0c"/>
  <rect x="24" y="24" width="752" height="272" rx="40" fill="{$accentHex}" opacity="0.16"/>
  <text x="64" y="205" font-family="ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial" font-size="96" font-weight="800" fill="white">{$textEsc}</text>
</svg>
SVG;
    }
}

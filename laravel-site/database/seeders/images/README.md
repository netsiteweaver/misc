# Seed Images Directory

This directory contains images that will be automatically copied to storage when running database seeders.

## Directory Structure

```
database/seeders/images/
├── settings/
│   └── logo.png (or .jpg, .jpeg, .gif, .webp, .svg)
├── categories/
│   ├── brakes.png
│   ├── engine.png
│   ├── suspension.png
│   ├── electrical.png
│   ├── body.png
│   └── service.png
├── brands/
│   ├── bosch.png
│   ├── ngk.png
│   ├── denso.png
│   ├── brembo.png
│   ├── kyb.png
│   ├── valeo.png
│   ├── mann.png
│   └── febi.png
└── products/
    ├── brake-pads.png
    ├── rotors.png
    ├── oil-filter.png
    ├── spark-plug.png
    ├── shock.png
    ├── ball-joint.png
    ├── battery.png
    ├── alternator.png
    ├── headlight.png
    ├── mirror.png
    ├── oil.png
    └── wipers.png
```

## How It Works

1. Place your images in the appropriate subdirectory (e.g., `settings/logo.png`)
2. The seeder will automatically detect and copy images to the public storage disk
3. Supported formats: PNG, JPG, JPEG, GIF, WEBP, SVG
4. If a seed image exists, it will be used; otherwise, the seeder will generate a placeholder SVG

## Adding Images

### Site Settings Logo
- Place your logo file in: `database/seeders/images/settings/logo.png`
- The seeder will automatically copy it to `storage/app/public/settings/logo.png`
- Supported filenames: `logo.png`, `logo.jpg`, `logo.jpeg`, `logo.gif`, `logo.webp`, `logo.svg`

### Category Images
- Place category images in: `database/seeders/images/categories/`
- Filenames should match the category slug (lowercase, hyphenated):
  - `brakes.png` for "Brakes"
  - `engine.png` for "Engine"
  - `suspension.png` for "Suspension & Steering"
  - `electrical.png` for "Electrical"
  - `body.png` for "Body & Lighting"
  - `service.png` for "Fluids & Service"
- If no image is found, a placeholder SVG will be generated automatically

### Brand Images
- Place brand images in: `database/seeders/images/brands/`
- Filenames should match the brand name (lowercase):
  - `bosch.png` for "Bosch"
  - `ngk.png` for "NGK"
  - `denso.png` for "Denso"
  - `brembo.png` for "Brembo"
  - `kyb.png` for "KYB"
  - `valeo.png` for "Valeo"
  - `mann.png` for "MANN-FILTER"
  - `febi.png` for "Febi"
- If no image is found, a placeholder SVG will be generated automatically

### Product Images
- Place product images in: `database/seeders/images/products/`
- Filenames should match the product slug (lowercase, hyphenated):
  - `brake-pads.png` for "Brake pads (front set)"
  - `rotors.png` for "Brake rotors (pair)"
  - `oil-filter.png` for "Oil filter"
  - `spark-plug.png` for "Spark plugs (set)"
  - `shock.png` for "Shock absorber"
  - `ball-joint.png` for "Ball joint"
  - `battery.png` for "Car battery"
  - `alternator.png` for "Alternator"
  - `headlight.png` for "Headlight assembly"
  - `mirror.png` for "Side mirror"
  - `oil.png` for "Engine oil (5W-30)"
  - `wipers.png` for "Wiper blades (pair)"
- If no image is found, a placeholder SVG will be generated automatically

## Examples

### To seed a logo:
1. Add `logo.png` to `database/seeders/images/settings/`
2. Run `php artisan migrate:fresh --seed`
3. The logo will be automatically copied to storage and referenced in the database

### To seed category images:
1. Add `brakes.png`, `engine.png`, etc. to `database/seeders/images/categories/`
2. Run `php artisan migrate:fresh --seed`
3. The images will be automatically copied to `storage/app/public/categories/` and referenced in the database

### To seed brand images:
1. Add `bosch.png`, `ngk.png`, etc. to `database/seeders/images/brands/`
2. Run `php artisan migrate:fresh --seed`
3. The images will be automatically copied to `storage/app/public/brands/` and referenced in the database

### To seed product images:
1. Add `brake-pads.png`, `rotors.png`, etc. to `database/seeders/images/products/`
2. Run `php artisan migrate:fresh --seed`
3. The images will be automatically copied to `storage/app/public/products/` and referenced in the database

## Notes

- Images are only copied if they exist in the seeders directory
- If an image doesn't exist, the seeder will generate a placeholder SVG automatically
- You can mix and match - use real images for some items and let others use generated placeholders
- All images are copied to the `public` storage disk, making them accessible via `/storage/{subdirectory}/{filename}`


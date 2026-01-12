<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
                'description' => 'Full system access with all permissions',
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Can manage catalog, orders, and users (except administrators)',
            ],
            [
                'name' => 'Sales',
                'slug' => 'sales',
                'description' => 'Can manage products, quotes, and customer inquiries',
            ],
            [
                'name' => 'Customer Service',
                'slug' => 'customer-service',
                'description' => 'Can view and manage quote requests and customer communications',
            ],
            [
                'name' => 'Viewer',
                'slug' => 'viewer',
                'description' => 'Read-only access to view reports and data',
            ],
        ];

        foreach ($roles as $role) {
            Role::query()->updateOrCreate(
                ['slug' => $role['slug']],
                $role
            );
        }
    }
}

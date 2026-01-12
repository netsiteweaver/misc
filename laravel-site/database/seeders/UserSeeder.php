<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $adminRole = Role::where('slug', 'administrator')->first();
        $managerRole = Role::where('slug', 'manager')->first();
        $salesRole = Role::where('slug', 'sales')->first();
        $customerServiceRole = Role::where('slug', 'customer-service')->first();
        $viewerRole = Role::where('slug', 'viewer')->first();

        // Update existing admin user with administrator role
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser && $adminRole) {
            $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);
        }

        // Create manager user
        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'John Manager',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
        if ($managerRole) {
            $manager->roles()->sync([$managerRole->id]);
        }

        // Create sales user
        $sales = User::query()->updateOrCreate(
            ['email' => 'sales@example.com'],
            [
                'name' => 'Sarah Sales',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
        if ($salesRole) {
            $sales->roles()->sync([$salesRole->id]);
        }

        // Create customer service user
        $cs = User::query()->updateOrCreate(
            ['email' => 'service@example.com'],
            [
                'name' => 'Mike Customer Service',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
        if ($customerServiceRole) {
            $cs->roles()->sync([$customerServiceRole->id]);
        }

        // Create viewer user
        $viewer = User::query()->updateOrCreate(
            ['email' => 'viewer@example.com'],
            [
                'name' => 'Lisa Viewer',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
        if ($viewerRole) {
            $viewer->roles()->sync([$viewerRole->id]);
        }

        // Create a user with multiple roles (sales + customer service)
        $multiRole = User::query()->updateOrCreate(
            ['email' => 'multirole@example.com'],
            [
                'name' => 'Tom Multi Role',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
        if ($salesRole && $customerServiceRole) {
            $multiRole->roles()->sync([$salesRole->id, $customerServiceRole->id]);
        }
    }
}

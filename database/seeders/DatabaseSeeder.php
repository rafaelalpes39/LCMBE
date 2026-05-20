<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first
        $this->call(RoleSeeder::class);

        // Get roles once
        $roles = Role::pluck('name')->toArray();

        // Create users and assign random role
        User::factory(20)->create()->each(function ($user) use ($roles) {
            $user->assignRole(
                fake()->randomElement($roles)
            );
        });

        // Other seeders
        $this->call([
            AnnouncementSeeder::class,
        ]);
    }
}
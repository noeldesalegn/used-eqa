<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@usedeqa.com',
            'is_admin' => true,
        ]);

        // Create regular test users
        $user1 = User::factory()->create([
            'name' => 'Abebe Kebede',
            'email' => 'abebe@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Sara Mohammed',
            'email' => 'sara@example.com',
        ]);

        $user3 = User::factory()->create([
            'name' => 'Yonas Tesfaye',
            'email' => 'yonas@example.com',
        ]);

        $sellers = [$user1, $user2, $user3, $admin];

        // Create approved listings (visible on homepage)
        foreach ($sellers as $seller) {
            Listing::factory()
                ->count(5)
                ->for($seller)
                ->create();
        }

        // Create a few pending listings
        Listing::factory()
            ->count(3)
            ->pending()
            ->for($user1)
            ->create();

        // Create a couple of sold listings
        Listing::factory()
            ->count(2)
            ->sold()
            ->for($user2)
            ->create();

        // Create a rejected listing
        Listing::factory()
            ->count(1)
            ->rejected()
            ->for($user3)
            ->create();
    }
}

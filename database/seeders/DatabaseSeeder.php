<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->callOnce([
            SiteConfigSeeder::class,
            EmailTemplateSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class
        ]);
        if (User::count() <= 20) {
            \App\Models\User::factory(20)->create();
        }
    }
}

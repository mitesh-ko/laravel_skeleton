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
        if(User::count() < 20) {
            \App\Models\User::factory(20)->create();
        }
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SiteConfigSeeder::class);
    }
}

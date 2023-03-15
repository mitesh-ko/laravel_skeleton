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
        $this->call(SiteConfigSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        if(User::count() <= 20) {
            \App\Models\User::factory(20)->create();
        }
    }
}

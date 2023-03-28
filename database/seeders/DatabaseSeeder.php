<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

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
        if (App::environment() == 'local') {
            if (User::count() <= 20)
                \App\Models\User::factory(20)->create();
            if (Transaction::class <= 20)
                Transaction::factory(20)->create();
        }
    }
}

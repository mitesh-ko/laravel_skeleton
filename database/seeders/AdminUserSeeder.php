<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'              => 'Admin',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => \Hash::make('admin@12345'),
        ]);
        $role = Role::where('name', 'superUser')->first();
        $user->assignRole($role);
    }
}

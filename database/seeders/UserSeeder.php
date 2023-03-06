<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::where('email', 'admin@example.com')->first()) {
            $user = User::create([
                'name'              => 'Admin',
                'email'             => 'admin@example.com',
                'email_verified_at' => now(),
                'password'          => \Hash::make('admin@12345'),
            ]);
            $role = Role::where('name', 'Super User')->first();
            $user->assignRole($role);
        }
        if(!User::where('email', 'user@example.com')->first()) {
            User::create([
                'name'              => 'Jon',
                'email'             => 'user@example.com',
                'email_verified_at' => now(),
                'password'          => \Hash::make('user@12345'),
            ]);
            $role = Role::where('name', 'Public User')->first();
            $user->assignRole($role);
        }
    }
}

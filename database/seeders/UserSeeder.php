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
        if (!User::where('email', 'admin@example.com')->first()) {
            $user = User::create([
                'username'          => 'admin',
                'name'              => 'Admin',
                'email'             => 'admin@example.com',
                'phone'             => '1234567890',
                'email_verified_at' => now(),
                'password'          => \Hash::make('admin@12345'),
            ]);
            $role = Role::where('name', 'Super User')->first();
            $user->assignRole($role);
        }
        if (!User::where('email', 'user@example.com')->first()) {
            User::create([
                'username'          => 'user',
                'name'              => 'Jon',
                'email'             => 'user@example.com',
                'phone'             => '0123456789',
                'email_verified_at' => now(),
                'password'          => \Hash::make('user@12345'),
            ]);
            $role = Role::where('name', 'Public User')->first();
            $user->assignRole($role);
        }
    }
}

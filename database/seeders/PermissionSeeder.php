<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::updateOrCreate(['name' => 'Super User'], ['name' => 'Super User']);
        Role::updateOrCreate(['name' => 'Public User'], ['name' => 'Public User']);
        foreach (config('constants.permissions') as $key => $value) {
            foreach (config('constants.permissions.' . $key) as $value2) {
                Permission::updateOrCreate(['name' => $value2['name']], [
                    'name'       => $value2['name'],
                    'guard_name' => $value2['guard_name']
                ]);
            }
        }
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
    }
}

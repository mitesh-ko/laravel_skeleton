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
        $role = Role::create(['name' => 'superUser']);
        foreach (config('constants.permissions') as $key => $value) {
            Permission::updateOrCreate(['name' => $value], [
                'name'       => $value,
                'guard_name' => 'web'
            ]);
        }
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
    }
}

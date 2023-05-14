<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin', 'user'
        ];

        foreach ($roles as $role) {
            Role::query()->updateOrCreate(['name' => Str::title($role)]);
        }

        Permission::updateOrCreate(['name' => 'edit employee','guard_name' =>  'api']);
        Permission::updateOrCreate(['name' => 'edit employee','guard_name' =>  'web']);

        $role = Role::where('name', 'User')->first();

        $role->syncPermissions(['edit employee']);
    }
}

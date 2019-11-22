<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles  = [
            'administrator', 'accountant'
        ];

        foreach ($roles as $role) :
            Role::create(
                [
                    'name'          => $role,
                    'guard_name'    => 'api'
                ]
            );
        endforeach;

        $permissions        = [
            'view users', 'add users', 'edit users', 'delete users'
        ];

        foreach ($permissions as $permission) :
            Permission::create(
                [
                    'name'          => $permission,
                    'guard_name'    => 'api'
                ]
            );
        endforeach;

        $administrator      = Role::where('name', 'administrator')->first();
        $administrator->syncPermissions([
            'view users', 'add users', 'edit users', 'delete users'
        ]);

        $accountant         = Role::where('name', 'Accountant')->first();
        $accountant->syncPermissions(['view users']);

        $admin              = User::where('name', 'administrator')->first();
        $admin->assignRole('administrator');

        $account            = User::where('name', 'accountant')->first();
        $account->assignRole('accountant');
    }
}

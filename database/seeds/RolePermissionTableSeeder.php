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
            'administrator', 'accountant', 'saleManager', 'saleman', 'webAdmin'
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
            'view users', 'add users', 'edit users', 'delete users', 'view sales', 'add sales',
            'edit sales', 'delete sales',
            'view website', 'add website', 'edit website',
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
            'view users', 'add users', 'edit users', 'delete users', 'view sales', 'add sales', 'edit sales', 'delete sales', 'view website', 'add website', 'edit website',
        ]);

        $accountant         = Role::where('name', 'Accountant')->first();
        $accountant->syncPermissions(['view users', 'edit users']);

        $admin              = User::where('name', 'administrator')->first();
        $admin->assignRole('administrator');

        $account            = User::where('name', 'accountant')->first();
        $account->assignRole('accountant');

        

        // Product 
        $saleManager = Role::where('name', 'saleManager')->first();
        $saleManager->syncPermissions(['view sales']);

        $saleman = Role::where('name', 'saleman')->first();
        $saleman->syncPermissions(['view sales', 'add sales', 'edit sales', 'delete sales']);

        $sale_Manager = User::where('name', 'saleManager')->first();
        $sale_Manager->assignRole('saleManager');

        $sale_man = User::where('name', 'saleman')->first();
        $sale_man->assignRole('saleman');

        // WebController
        $webAdmin = Role::where('name', 'webAdmin')->first();
        $webAdmin->syncPermissions(['view website', 'add website', 'edit website']);

        $web = User::where('name', 'webAdmin')->first();
        $web->assignRole('webAdmin');
    }
}

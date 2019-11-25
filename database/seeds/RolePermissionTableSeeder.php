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
            'view users', 'add users', 'edit users', 'delete users', 
            'view sales', 'add sales', 'import sales', 'edit sales', 'delete sales',
            'view website', 'add website', 'edit website', 'delete website',
            'view product', 'add product', 'edit product', 'delete product', 'import product',
            'view purchase', 'add purchase', 'edit purchase', 'delete purchase', 'import purchase',
            'view expense', 'add expense', 'edit expense', 'import expense', 'delete expense',
            'view quotation', 'add quotation', 'edit quotation',
            'view transfer', 'add transfer', 'edit transfer',
            'view employee', 'add employee', 'edit employee', 'delete employee',
            'view account', 'add account', 'edit account', 'delete account', 'import account',
            'view customer', 'add customer', 'edit customer', 'delete customer', 'import customer',
            'view biller', 'add biller', 'edit biller', 'delete biller', 'import biller',
            'view supplier', 'add supplier', 'edit supplier', 'delete supplier', 'import supplier',
            'summary report', 'product report', 'daily sale report', 'monthly sale report',
            'daily purchase report', 'monthly purchase report', 'sale report', 'payment report',
            'purchase report', 'warehouse report', 'product qty alert', 'user report', 
            'customer report', 'supplier report', 'due report',
            'support', 'payment log',
            'add withdraw method', 'view withdraw method', 'edit withdraw method', 
            'delete withdraw method', 
            'charge commission',
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
            'view users', 'add users', 'edit users', 'delete users', 
            'view sales', 'add sales', 'import sales', 'edit sales', 'delete sales',
            'view website', 'add website', 'edit website', 'delete website',
            'view product', 'add product', 'edit product', 'delete product', 'import product',
            'view purchase', 'add purchase', 'edit purchase', 'delete purchase', 'import purchase',
            'view expense', 'add expense', 'edit expense', 'delete expense', 'import expense',
            'view quotation', 'add quotation', 'edit quotation',
            'view transfer', 'add transfer', 'edit transfer',
            'view employee', 'add employee', 'edit employee', 'delete employee',
            'view account', 'add account', 'edit account', 'delete account', 'import account',
            'view customer', 'add customer', 'edit customer', 'delete customer', 'import customer',
            'view biller', 'add biller', 'edit biller', 'delete biller', 'import biller',
            'view supplier', 'add supplier', 'edit supplier', 'delete supplier', 'import supplier',
            'summary report', 'product report', 'daily sale report', 'monthly sale report',
            'daily purchase report', 'monthly purchase report', 'sale report', 'payment report',
            'purchase report', 'warehouse report', 'product qty alert', 'user report', 
            'customer report', 'supplier report', 'due report',
            'support', 'payment log',
            'add withdraw method', 'view withdraw method', 'edit withdraw method', 
            'delete withdraw method', 
            'charge commission',
        ]);

        $accountant         = Role::where('name', 'Accountant')->first();
        $accountant->syncPermissions([
            'view account', 'add account', 'edit account', 'delete account', 'import account',
            'view expense', 'add expense', 'edit expense', 'delete expense', 'import expense',
        ]);

        $admin              = User::where('name', 'administrator')->first();
        $admin->assignRole('administrator');

        $account            = User::where('name', 'accountant')->first();
        $account->assignRole('accountant');

        

        // Sales
        $saleManager = Role::where('name', 'saleManager')->first();
        $saleManager->syncPermissions([
            'view sales', 'import sales', 'view product', 'payment log', 'add withdraw method',
            'view expense',
        ]);

        $saleman = Role::where('name', 'saleman')->first();
        $saleman->syncPermissions([
            'view sales', 'add sales', 'edit sales', 'delete sales', 'import sales'
        ]);

        $sale_Manager = User::where('name', 'saleManager')->first();
        $sale_Manager->assignRole('saleManager');

        $sale_man = User::where('name', 'saleman')->first();
        $sale_man->assignRole('saleman');

        // WebController
        $webAdmin = Role::where('name', 'webAdmin')->first();
        $webAdmin->syncPermissions([
            'view website', 'add website', 'edit website', 'delete website',
        ]);

        $web = User::where('name', 'webAdmin')->first();
        $web->assignRole('webAdmin');
    }
}

<?php

use Illuminate\Http\Request;



Route::group(['middleware' => 'auth:api', 'prefix' => 'v1', 'namespace' => 'V1'], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('login', 'LoginController@passport')->name('auth.login');
        Route::get('user', 'UserController@index');
        Route::get('me', 'AuthController@me');
        Route::get('permissions', 'PermissionController')->name('permission');
        Route::get('roles', 'RoleController')->name('roles');
    });

    Route::apiResources([
        'user'  => 'UserController',
        'product'  => 'ProductController',
        'expense'  => 'ExpenseController',
        'purchase'  => 'PurchaseController',
        'sale'  => 'SaleController',
        'expense-category'  => 'ExpenseCategoryController',
        'hr-department'  => 'DepartmentController',
        'employee'  => 'EmployeeController',
        'attendance'  => 'AttendanceController',
        'account'  => 'AccountController',
        'payroll'  => 'PayrollController',
        'holiday'  => 'HolidayController',
        'transaction'  => 'TransactionController',
        'deposit-account'  => 'DepositController',
        'member' => 'MemberController',
        'biller' => 'BillerController',
        'supplier' => 'SupplierController',
        'transfer' => 'TransferController',
        'location' => 'LocationController',
    ]);
});

Route::get('transaction/export/', 'ExportController@export');

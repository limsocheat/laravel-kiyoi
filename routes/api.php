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
        // 'sale'  => 'SaleController',
        // 'expense-category'  => 'ExpenseCategoryController',
        'hr-department'  => 'DepartmentController',
        'employee'  => 'EmployeeController',
        'attendance'  => 'AttendanceController',
        'account'  => 'AccountController',
        'payroll'  => 'PayrollController',
        'holiday'  => 'HolidayController',
        // 'transaction'  => 'TransactionController',
        'deposit-account'  => 'DepositController',
        'member' => 'MemberController',
        'biller' => 'BillerController',
        'supplier' => 'SupplierController',
        'transfer' => 'TransferController',
        'location' => 'LocationController',
        'brand' => 'BrandController',
        'quotation'     => 'QuotationController',
        'return-sale'    => 'ReturnSaleController',
        'return-purchase'=> 'ReturnPurchaseController',

        'calendar' => 'CalendarController'
    ]);

    Route::get('activity', 'ActivityController@index');
});


Route::group(['middleware' => ['auth:api', 'role:saleman|administrator'], 'prefix' => 'v1', 'namespace' => 'V1'], function () {

    Route::apiResource('sale', 'SaleController');
});

Route::group(['middleware' => ['auth:api', 'role:accountant|administrator'], 'prefix' => 'v1', 'namespace' => 'V1'], function () {

    Route::apiResource('transaction', 'SaleController');
    Route::apiResource('expense-category', 'ExpenseCategoryController');
});

// Route::get('purchase/export', 'V1\PurchaseController@export');


Route::post('purchase/upload', 'V1\PurchaseController@import');
Route::get('purchase/export', 'V1\PurchaseController@export');
Route::get('purchase/export-pdf', 'V1\PurchaseController@export_pdf');


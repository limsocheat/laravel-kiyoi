<?php

use Illuminate\Http\Request;


// Register Route
Route::post('register', 'V1\Auth\LoginController@register');

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
        'category' => 'ProductCategoryController',
        'calendar' => 'CalendarController',
    ]);

    Route::get('activity', 'ActivityController@index');

    Route::get('dashboard', 'Dashboard\DashboardController@index');
});


Route::group(['middleware' => ['auth:api'], 'prefix' => 'v1', 'namespace' => 'V1'], function () {

    Route::apiResource('sale', 'SaleController');
});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'v1', 'namespace' => 'V1'], function () {

    Route::apiResource('transaction', 'SaleController');
    Route::apiResource('expense-category', 'ExpenseCategoryController');
});


// Purchase Report
Route::post('purchase/upload', 'V1\PurchaseController@import');
Route::get('purchase/export', 'V1\PurchaseController@export');
Route::get('purchase/export-pdf', 'V1\PurchaseController@export_pdf');

// Product Report
Route::get('product/export_pdf', 'V1\ProductController@export_pdf');
Route::get('product/export', 'V1\ProductController@export');

// Sale Report
Route::get('sale/export_pdf', 'V1\SaleController@export_pdf');
Route::get('sale/export', 'V1\SaleController@export');

// Get User Role
Route::get('data/roles', 'V1\Common\DataController@roles');



// ExpenseCategory Export
Route::get('expense-category/export', 'V1\ExpenseCategoryController@export');
Route::get('expense-category/export_pdf', 'V1\ExpenseCategoryController@export_pdf');
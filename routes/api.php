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
        'sale-group' => 'SaleGroupController',
    ]);

    Route::get('activity', 'ActivityController@index');
        
    //User Profile
    Route::get('/profile/', 'ProfileController@index');
    Route::post('/profile/', 'ProfileController@store');
    Route::patch('/profile/{id}', 'ProfileController@update');

    // Dashboard Report
    Route::get('dashboard', 'Dashboard\DashboardController@index');

    // SaleReport
    Route::get('sale-report', 'Dashboard\DashboardController@saleReport');
    Route::get('expense-report', 'Dashboard\DashboardController@expenseReport');
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

// Expense Report
Route::get('expense/export_pdf', 'V1\ExpenseController@export_pdf');
Route::get('expense/export', 'V1\ExpenseController@export');


// Quotation
Route::get('quotation/export', 'V1\QuotationController@export');
Route::get('quotation/export_pdf', 'V1\QuotationController@export_pdf');

// Transfer Export
Route::get('transfer/export_pdf', 'V1\TransferController@export_pdf');
Route::get('transfer/export', 'V1\TransferController@export');

// ReturnSale Export
Route::get('return-sale/export_pdf', 'V1\ReturnSaleController@export_pdf');
Route::get('return-sale/export', 'V1\ReturnSaleController@export');

// ReturnPurchase Export
Route::get('return-purchase/export_pdf', 'V1\ReturnPurchaseController@export_pdf');
Route::get('return-purchase/export', 'V1\ReturnPurchaseController@export');

// Department Export
Route::get('department/export_pdf', 'V1\DepartmentController@export_pdf');
Route::get('department/export', 'V1\DepartmentController@export');

// Employee Export
Route::get('employee/export_pdf', 'V1\EmployeeController@export_pdf');
Route::get('employee/export', 'V1\EmployeeController@export');

// Attendance Export
Route::get('attendance/export_pdf', 'V1\AttendanceController@export_pdf');
Route::get('attendance/export', 'V1\AttendanceController@export');

// Payroll Export
Route::get('payroll/export_pdf', 'V1\PayrollController@export_pdf');
Route::get('payroll/export', 'V1\PayrollController@export');

// Payroll Export
Route::get('holiday/export_pdf', 'V1\HolidayController@export_pdf');
Route::get('holiday/export', 'V1\HolidayController@export');
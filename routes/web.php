<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* artisan command */
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'cache clear';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'config:cache';
});
Route::get('/view-cache', function() {
    $exitCode = Artisan::call('view:cache');
    return 'view:cache';
});
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'view:clear';
});
/* artisan command */





Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::get('change-password/{id}','UserController@headerChangedPassword')->name('password.change_password');

    Route::get('change-password/{id}','UserController@changedPassword')->name('password.change_password');
    Route::post ('change-password-update','UserController@changedPasswordUpdated')->name('password.change_password_update');
//    Route::resource('stores','StoreController');
    Route::resource('serviceSubCategory','ServiceSubCategoryController');
    Route::resource('serviceCategory','ServiceCategoryController');
    Route::resource('serviceUnit','ServiceUnitController');
    Route::resource('service','ServiceController');
    Route::resource('serviceProvider','ServiceProviderController');
    Route::resource('customer','CustomerController');
    Route::resource('expenseCategory','ExpenseCategoryController');
    Route::resource('expenses','ExpenseController');
    Route::resource('serviceSale','ServiceSaleController');

    Route::get('dueList','ServiceSaleController@dueList')->name('dueList');

    Route::resource('serviceSaleDetails','ServiceSaleDetailController');

    Route::resource('employee','EmployeeController');
    Route::resource('employee-salary','EmployeeSalaryController');


    Route::resource('voucherType','VoucherTypeController');
    Route::resource('transaction','TransactionController');

    Route::post('pay-due','ServiceSaleController@payDue')->name('pay.due');

    Route::get('account/coa_print','AccountController@coa_print')->name('account.coa_print');
    Route::get('account/cashbook','AccountController@cash_book_form');
    Route::post('account/cashbook','AccountController@cash_book_form')->name('account.cashbook');
    Route::get('account/cashbook-print/{date_from}/{date_to}','AccountController@cash_book_print');

    Route::get('account/voucher-invoice/{voucher_no}/{transaction_date}','TransactionController@voucher_invoice');
    Route::get('account/generalledger','TransactionController@general_ledger_form')->name('account.generalledger');
    Route::get('/get-transaction-head/{id}','AccountController@transaction_head');
    Route::post('account/general-ledger','TransactionController@view_general_ledger')->name('account.general_ledger');
    Route::get('account/general-ledger-print/{headcode}/{date_from}/{date_to}','TransactionController@general_ledger_print');
    Route::get('account/trial-balance','TransactionController@trial_balance_form');
    Route::get('account/trial-balance-print/{date_from}/{date_to}','AccountController@trial_balance_print');
    Route::post('account/trial-balance','TransactionController@view_trial_balance')->name('account.trial_balance');
    Route::get('account/balance-sheet','TransactionController@balance_sheet');
    Route::get('account/balance-sheet-print','TransactionController@balance_sheet_print');

    Route::get('account/debit-voucher','AccountController@debit_voucher_form')->name('account.debit.voucher');
    Route::post('account/debit-voucher','AccountController@view_debit_voucher')->name('account.debit_voucher');
    Route::get('account/debit-voucher-print/{headcode}/{date_from}/{date_to}','AccountController@debit_voucher_print');


    Route::get('account/credit-voucher','AccountController@credit_voucher_form')->name('account.credit.voucher');
    Route::post('account/credit-voucher','AccountController@view_credit_voucher')->name('account.credit_voucher');
    Route::get('account/credit-voucher-print/{headcode}/{date_from}/{date_to}','AccountController@credit_voucher_print');


//relation-data

    Route::get('service-relation-data','ServiceSaleController@serviceRelationData');

    Route::get('employeeSalary-relation-data','EmployeeSalaryController@employeeSalaryRelationData');

    Route::get('get-voucher-no','TransactionController@getVoucherNo');

//
//    Route::get('productPosSales/list','ProductPosSaleController@index')->name('productPosSales.index');
//    Route::get('productPosSales','ProductPosSaleController@create')->name('productPosSales.create');
//    Route::get('sale/{id}/data', 'ProductPosSaleController@listData')->name('sale.data');
//    Route::get('sale/loadform/{discount}/{total}/{paid}', 'ProductPosSaleController@loadForm');


//    Route::get('selectedform/{product_code}','ProductPosSaleController@selectedform');
//    Route::get('add-to-cart','CartController@addToCart');
//    Route::get('delete-cart-product/{rowId}','CartController@deleteCartProduct');
//    Route::get('delete-all-cart-product','CartController@deleteAllCartProduct');
//    Route::post('pos_insert', 'ProductPosSaleController@postInsert');




//    //excel
//    Route::get('export', 'UserController@export')->name('export');
//    Route::get('importExportView', 'ExportExcelController@importExportView');
//    Route::post('import', 'ExportExcelController@import')->name('import');
//
//    Route::get('transaction/export/', 'TransactionController@export')->name('transaction.export');
//    Route::get('delivery/export/', 'TransactionController@deliveryExport')->name('delivery.export');
//    Route::get('loss-profit/export/', 'TransactionController@lossProfitExport')->name('loss.profit.export');
//    Route::get('loss-profit-filter-export/{start_date}/{end_date}','TransactionController@lossProfitExportFilter')->name('loss.profit.filter.export');
//    Route::get('stock/export/', 'StockController@export')->name('stock.export');
//
//    // custom start
    Route::post('/roles/permission','RoleController@create_permission');
    Route::post('/user/active','UserController@activeDeactive')->name('user.active');
});

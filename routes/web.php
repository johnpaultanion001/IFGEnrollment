<?php
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\BranchLocatorController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CalculatorController;
use App\Mail\EmailNotification;


Route::redirect('/', '/admin/home');


// Tracker
Route::get('/tracker', [TransactionController::class, 'tracker'])->name('tracker.tracker');
Route::post('/gettracker', [TransactionController::class, 'tracker_show'])->name('tracker.gettracker');

// Branch Locator
Route::get('/branch_locator/{status}', [BranchLocatorController::class, 'branch_locator'])->name('branch_locator.branch_locator');
Route::get('/branch_locator/province/province', [BranchLocatorController::class, 'province'])->name('branch_locator.province');
Route::get('/branch_locator/city/city', [BranchLocatorController::class, 'city'])->name('branch_locator.city');
Route::get('/branch_locator/address/address', [BranchLocatorController::class, 'address'])->name('branch_locator.address');

// Contact us 
Route::get('/contactus', [ContactUsController::class, 'index'])->name('contactus.contactus');
Route::post('/contactus', [ContactUsController::class, 'store'])->name('contactus.store');

// Calculator
Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.calculator');
Route::get('/calculator/delivery', [CalculatorController::class, 'delivery'])->name('calculator.delivery');
Route::get('/calculator/country', [CalculatorController::class, 'country'])->name('calculator.country');
Route::get('/calculator/amount', [CalculatorController::class, 'amount'])->name('calculator.amount');

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/fullregistration', 'HomeController@fullregistration')->name('fullregistration');
    Route::get('/fullregistration/personalinfo/{user}/show', 'HomeController@getpersonalinfo')->name('getpersonalinfo');
    Route::put('/fullregistration/personalinfo/{user}', 'HomeController@updatepersonalinfo')->name('updatepersonalinfo');
    Route::post('/fullregistration/ids/{user}', 'HomeController@ids')->name('ids');
    Route::resource('beneficiaries', 'BeneficiaryController');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'verified', 'checkregistered']], function () {
    
    //Email Notif Test
    // Route::get('/email/notif', function () {
    //     return new EmailNotification();
    // });

    //home
    Route::get('/home', 'HomeController@index')->name('home');  
    Route::get('/listbeneficiaries', 'HomeController@listbeneficiaries')->name('listbeneficiaries');  
    Route::post('exchangerate', 'HomeController@exchangerate')->name('home.exchangerate');


    // Transactions 
    Route::get('history', 'TransactionController@index')->name('transactions.history');
    Route::get('history/load', 'TransactionController@loadhistory')->name('transactions.loadhistory');
    Route::post('reviewpayment', 'TransactionController@reviewpayment')->name('reviewpayment');
    Route::post('servicecharge', 'TransactionController@servicecharge')->name('servicecharge');  
    
    Route::put('transactions/{transaction}', 'TransactionController@update')->name('transactions.update');
    Route::put('transactions/{transaction}/confirmtransaction', 'TransactionController@confirmtransaction')->name('transactions.confirmtransaction');
    Route::post('transactions/show', 'TransactionController@show')->name('transactions.show');    
    Route::get('transactions/compute', 'TransactionController@compute')->name('transactions.compute');
    Route::get('transactions/confirm', 'TransactionController@confirm')->name('transactions.confirm');
    Route::post('transactions', 'TransactionController@store')->name('transactions.store');
    

    // Transactions For Staff
    Route::get('transaction', 'TransactionStaffController@index')->name('transaction_staff.index');
    Route::get('transaction/sender', 'TransactionStaffController@sender')->name('transaction_staff.sender');
    Route::get('transaction/beneficiary', 'TransactionStaffController@beneficiary')->name('transaction_staff.beneficiary');
    Route::get('transaction/reviewpayment', 'TransactionStaffController@reviewpayment')->name('transaction_staff.reviewpayment');
    Route::get('transaction/compute', 'TransactionStaffController@compute')->name('transaction_staff.compute');
    Route::post('transaction/transaction_store', 'TransactionStaffController@transaction_store')->name('transaction_staff.transaction_store');
    Route::get('transaction/beneficiary_dd', 'TransactionStaffController@beneficiary_dd')->name('transaction_staff.beneficiary_dd');
    Route::get('transaction/transaction_details', 'TransactionStaffController@transaction_details')->name('transaction_staff.transaction_details');
    Route::delete('transaction/transaction_cancel/{transaction}', 'TransactionStaffController@transaction_cancel')->name('transaction_staff.transaction_cancel');


    // Customer Staff
    Route::get('customer', 'CustomerStaffController@index')->name('customer_staff.index');
    Route::get('customer/customer_detail', 'CustomerStaffController@customer_detail')->name('customer_staff.customer_detail');
    Route::get('customer/beneficiaries', 'CustomerStaffController@beneficiaries')->name('customer_staff.beneficiaries');
    Route::get('customer/transactions', 'CustomerStaffController@transactions')->name('customer_staff.transactions');

    // Find Transaction
    Route::get('find_transaction', 'FindTransactionStaffController@index')->name('find_transaction_staff.index');
    Route::get('find_transaction/transaction', 'FindTransactionStaffController@find_transaction')->name('find_transaction_staff.find_transaction');
    
    // Transaction Report
    Route::get('transaction_summary_report', 'TransactionSummaryReportController@transaction_summary_report')->name('transaction_report_staff.transaction_summary_report');
    Route::get('transaction_summary_report/load', 'TransactionSummaryReportController@transaction_summary_report_load')->name('transaction_report_staff.transaction_summary_report_load');
    Route::get('transaction_summary_report/filter', 'TransactionSummaryReportController@transaction_summary_report_filter')->name('transaction_report_staff.transaction_summary_report_filter');

    // Exchange Rate
    Route::resource('exchange_rate', 'CountryExchangeController');
    Route::get('exchange_rate/exchange_rate_records/exchange_rate_records', 'CountryExchangeController@exchange_rate_records')->name('exchange_rate.exchange_rate_records');



    //ledger
    Route::get('ledger', 'TransactionController@ledger')->name('transactions.ledger');
    Route::get('ledger/load', 'TransactionController@loadledger')->name('transactions.loadledger');

    //recipient
    Route::get('recipient', 'BeneficiaryController@recipient')->name('recipient.recipient');
    Route::get('recipient/load', 'BeneficiaryController@loadrecipient')->name('recipient.loadrecipient');
    
    //Admin
    Route::get('/accounts', 'UsersController@index')->name('accounts.index');
    Route::get('/accounts/{account}/edit', 'UsersController@edit')->name('accounts.edit');
    Route::post('/accounts', 'UsersController@store')->name('accounts.store');
    Route::put('/accounts/{account}', 'UsersController@update')->name('accounts.update');
    Route::delete('/accounts/{account}', 'UsersController@destroy')->name('accounts.destroy');

    //Change Password
    Route::get('/change_password', 'UsersController@changepassword')->name('accounts.changepassword');
    Route::put('/change_password/{user}', 'UsersController@passwordupdate')->name('accounts.passwordupdate');


    Route::get('/0/home', 'AdminController@index')->name('admin.index');
    Route::put('/0/home/trasaction/status', 'AdminController@status')->name('transation.status');
    Route::put('/0/home/trasaction/payment', 'AdminController@payment')->name('transation.payment');
    
    //Country Receipt
    //Route::resource('countries', 'CountryExchangeController');
    Route::get('/branch_bank_setting', 'BankController@index')->name('branch_bank_setting.branch_bank_setting');
    Route::post('/branch_bank_setting', 'BankController@store')->name('branch_bank_setting.store');
    Route::get('/branch_bank_setting/{bank}/edit', 'BankController@edit')->name('branch_bank_setting.edit');
    Route::put('/branch_bank_setting/{bank}', 'BankController@update')->name('branch_bank_setting.update');
    Route::delete('/branch_bank_setting/{bank}', 'BankController@destroy')->name('branch_bank_setting.destroy');



    
});




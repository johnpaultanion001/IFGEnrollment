<?php
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\BranchLocatorController;
use App\Http\Controllers\Admin\ContactUsController;

// Route::get('/', function () {
//     if (session('status')) {
//         return redirect()->route('admin.shops.index')->with('status', session('status'));
//     }

//     return redirect()->route('admin.shops.index');
// });

Route::redirect('/', '/admin/home');

// Tracker
Route::get('/tracker', [TransactionController::class, 'tracker'])->name('tracker.tracker');
Route::post('/gettracker', [TransactionController::class, 'tracker_show'])->name('tracker.gettracker');

// Branch Locator
Route::get('/branch_locator', [BranchLocatorController::class, 'branch_locator'])->name('branch_locator.branch_locator');
Route::post('/branch_locator/cities_province', [BranchLocatorController::class, 'cities_province'])->name('branch_locator.cities_province');
Route::post('/branch_locator/cities_province_banks', [BranchLocatorController::class, 'cities_province_banks'])->name('branch_locator.cities_province_banks');

// Contact us 
Route::get('/contactus', [ContactUsController::class, 'index'])->name('contactus.contactus');
Route::post('/contactus', [ContactUsController::class, 'store'])->name('contactus.store');

Route::get('/', 'HomeController@index')->name('home');
Route::get('shop/{shop}', 'HomeController@show')->name('shop');

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/fullregistration', 'HomeController@fullregistration')->name('fullregistration');
    Route::get('/fullregistration/personalinfo/{user}/show', 'HomeController@getpersonalinfo')->name('getpersonalinfo');
    Route::put('/fullregistration/personalinfo/{user}', 'HomeController@updatepersonalinfo')->name('updatepersonalinfo');
    Route::post('/fullregistration/ids/{user}', 'HomeController@ids')->name('ids');
    Route::resource('beneficiaries', 'BeneficiaryController');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'verified', 'checkregistered']], function () {
     
    //home
    Route::get('/home', 'HomeController@index')->name('home');  
    Route::get('/listbeneficiaries', 'HomeController@listbeneficiaries')->name('listbeneficiaries');  
    Route::post('exchangerate', 'HomeController@exchangerate')->name('home.exchangerate');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Transactions 
    Route::get('history', 'TransactionController@index')->name('transactions.history');
    Route::get('history/load', 'TransactionController@loadhistory')->name('transactions.loadhistory');
    Route::post('reviewpayment', 'TransactionController@reviewpayment')->name('reviewpayment');
    Route::post('sendamount', 'TransactionController@sendamount')->name('sendamount');  
    Route::post('servicecharge', 'TransactionController@servicecharge')->name('servicecharge');  
    Route::post('transactions', 'TransactionController@store')->name('transactions.store');
    Route::put('transactions/{transaction}', 'TransactionController@update')->name('transactions.update');
    Route::put('transactions/{transaction}/confirmtransaction', 'TransactionController@confirmtransaction')->name('transactions.confirmtransaction');
    Route::post('transactions/show', 'TransactionController@show')->name('transactions.show');    


    //ledger
    Route::get('ledger', 'TransactionController@ledger')->name('transactions.ledger');
    Route::get('ledger/load', 'TransactionController@loadledger')->name('transactions.loadledger');

    //recipient
    Route::get('recipient', 'BeneficiaryController@recipient')->name('recipient.recipient');
    Route::get('recipient/load', 'BeneficiaryController@loadrecipient')->name('recipient.loadrecipient');
    
    
    
});




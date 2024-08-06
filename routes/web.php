<?php
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\BranchLocatorController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CalculatorController;
use App\Mail\EmailNotification;


Route::redirect('/', '/admin/home');

Auth::routes(['verify' => true]);


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'verified', 'checkregistered']], function () {
    
    //ADMIN SALES
    Route::get('/admin_sales', 'AdminSalesController@index')->name('admin_sales.index');
    Route::post('/admin_sales/notify/{member}', 'AdminSalesController@notifyMember')->name('admin_sales.notifyMember');
    Route::post('/admin_sales/notify_payment/{member}', 'AdminSalesController@notifyMemberPayment')->name('admin_sales.notifyMemberPayment');
    Route::get('/ifgForm/{member}', 'AdminSalesController@viewIFGForm')->name('admin_billing.viewIFGForm');
    Route::post('/ifgForm/{member}', 'AdminSalesController@storeIFGForm')->name('admin_billing.storeIFGForm');
    
    Route::get('/activities/{member}', 'AdminSalesController@viewActivities')->name('admin_sales.viewActivities');

    //Endorse to
    Route::put('/endorse_to/{memberDetail}/{endorseTo}', 'AdminSalesController@endorseTo')->name('admin_sales.endorseTo');
    
    //ADMIN BILLING
    Route::get('/admin_billing', 'AdminBillingController@index')->name('admin_billing.index');
    Route::get('/quatation/{member}', 'AdminBillingController@viewQuatation')->name('admin_billing.viewQuatation');
    Route::post('/quatation/{member}', 'AdminBillingController@storeQuatation')->name('admin_billing.storeQuatation');

    //ADMIN ACCOUNTING
    Route::get('/admin_accounting', 'AdminAccountingController@index')->name('admin_accounting.index');
    Route::put('/payment_confirmation/{member}', 'AdminAccountingController@confirmPayment')->name('admin_billing.confirmPayment');
   

    //Email Notif Test
    // Route::get('/email/notif', function () {
    //     return new EmailNotification();
    // });
    // FOR MEMBER
    Route::get('/membership/{type}/{referral_code}/json', 'MemberDetailController@getMemberData')->name('membership.memberData');
    // APPLICATION FOR DEPENDENT 
    Route::get('/membership/{typeOfAccount}/{referral_code}', 'MemberDetailController@index')->name('membership');
    
    Route::post('/membership/upload/{memberDetail}', 'MemberDetailController@uploadFile')->name('membership.uploadFile');
    Route::put('/member/{referral_code}/{step}', 'MemberDetailController@store')->name('member.store');
    Route::put('/saveByUser/{memberDetail}', 'MemberDetailController@saveByUser')->name('member.saveByUser');
    Route::get('/memberships/plancodes', 'MemberDetailController@plancodesForIFG')->name('membership.plancodesForIFG');
 

    //admin
    //member details
    Route::get('members', 'MemberDetailAdminController@index')->name('admin.member');
    Route::get('member/member_detail', 'MemberDetailAdminController@member_detail')->name('admin.member_detail');
    
    Route::resource('referral_code','ReferralCodeController');

    //home
    Route::get('/home', 'HomeController@index')->name('home');  
    Route::get('/listbeneficiaries', 'HomeController@listbeneficiaries')->name('listbeneficiaries');  
    Route::post('exchangerate', 'HomeController@exchangerate')->name('home.exchangerate');


   
    //Admin
    Route::get('/accounts', 'UsersController@index')->name('accounts.index');
    Route::get('/accounts/{account}/edit', 'UsersController@edit')->name('accounts.edit');
    Route::post('/accounts', 'UsersController@store')->name('accounts.store');
    Route::put('/accounts/{account}', 'UsersController@update')->name('accounts.update');
    Route::delete('/accounts/{account}', 'UsersController@destroy')->name('accounts.destroy');

    //Change Password
    Route::get('/change_password', 'UsersController@changepassword')->name('accounts.changepassword');
    Route::put('/change_password/{user}', 'UsersController@passwordupdate')->name('accounts.passwordupdate');

    //PDF FORM
    Route::get('/membership-pdf', 'PDFController@index')->name('pdf.index');
    Route::get('/get-membership-pdf/{type}/{referral_code}', 'PDFController@getMemberDataPDF')->name('pdf.getMemberDataPDF');
    
    

    
});




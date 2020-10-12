<?php
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/', function () {
	return view('welcome');
});
Route::get('/contact', function () {
	return view('contact');
});
Route::group(['middleware' => 'prevent_back_history'],function(){
	Route::get('/application/view/applicant/{appNumber}', 'ApplicationController@viewApplication')->middleware('applicant');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/applied-applications', 'ApplicantController@showAppliedForms')->middleware('applicant');
	Route::get('/alocated-stickers', function () {
		return view('layouts.alocated-sticker');
	})->middleware('applicant');
	Route::get('/about/customer', function () {
		return view('layouts.about-customer');
	})->middleware('applicant');
	Route::get('/customer/home', 'ApplicantController@applyForm')->middleware('applicant');
	Route::post('/application-details/store','ApplicantDetailController@storeApplicationDetails')->middleware('applicant');
	Route::post('/applicant-details/store','ApplicantDetailController@storeApplicantDetails')->middleware('applicant');
	Route::post('/vehicle-detail/store','VehicleInfoController@storeVehicleDetails')->middleware('applicant');
	Route::post('/driver-details/store','DriverInfoController@storeDriverDetails')->middleware('applicant');
	Route::post('/helper-detail/store','DriverInfoController@storeHelperDetails')->middleware('applicant');
	Route::post('/applicant-detail/update/{app_id}','ApplicantDetailController@updateApplicantDetail')->middleware('anyauth');
	Route::post('/application-detail/update/{app_id}','ApplicantDetailController@updateFormBApplication')->middleware('anyauth');
	Route::post('/vehicle-detail/update/{app_id}','VehicleInfoController@vehicleInfoUpdate')->middleware('anyauth');
	Route::post('/driver-detail/update/{app_id}','DriverInfoController@driverInfoUpdate')->middleware('anyauth');
	Route::post('/helper-detail/update/{app_id}','DriverInfoController@updateHelperInfo')->middleware('anyauth');
	Route::get('/remove/driver/{driverId}','DriverInfoController@removeDriver')->middleware('anyauth');
	Route::get('/remove/helper/{helperId}','DriverInfoController@removeHelper')->middleware('anyauth');
	Route::get('/status-application/pending', 'HomeController@pendingApp');
	Route::get('/status-application/approved', 'HomeController@approvedApp');
	Route::get('/status-application/delivered', 'HomeController@deliveredApp');
	Route::get('/status-application/rejected', 'HomeController@rejectedApp');
	Route::get('/application-review/{app_number}', 'HomeController@applicationReview');
	Route::get('/application/approve', 'HomeController@applicationApprove');
	Route::get('/application/reject', 'HomeController@applicationReject');
	Route::get('/application/edit/{appNumber}', 'HomeController@applicationEdit');
	Route::get('/application/delete', 'HomeController@applicationDelete');
	Route::post('/admin-search', 'HomeController@adminSearch');
	Route::post('/sticker/issue', 'HomeController@issueSticker');
	Route::get('/sticker/expired', 'HomeController@expiredSticker');
	Route::post('applicationForm/store','ApplicationController@applicationFormStore')->middleware('applicant');
	Route::post('/send-submission-renew-sms/success/{id}','ApplicationController@submissionSmsSendRenew')->middleware('applicant');
	Route::post('/send-submission-sms/success/{id}','ApplicationController@submissionSmsSend')->middleware('applicant');
	Route::get('/invoice/{id}','InvoiceController@printInvoice');
	Route::get('/invoice-list','InvoiceController@allInvoice');
	Route::get('/invoice-report','InvoiceController@invoiceReport');
	Route::post('/search/invoice','InvoiceController@searchInvoice');
	Route::post('/search/invoice/report','InvoiceController@searchInvoiceReport');
	Route::get('/temporary-pass','TemporaryPassController@temporaryPassPending');
	Route::get('/temporary-pass/approved','TemporaryPassController@temporaryPassApproved');
	Route::get('/temporary-pass/rejected','TemporaryPassController@temporaryPassRejected');
	Route::get('/temporary-pass/expired','TemporaryPassController@temporaryPassExpired');
	Route::get('/renew/sticker/{stickerID}','VehicleStickerController@renewRequest')->middleware('applicant');
//  Route::get('/markAsRead' ,function(){
//  return auth()->user()->unreadNotifications->markAsRead();
// });
	Route::post('/applicationForm/update/{id}','ApplicationController@applicationFormEdit')->middleware('anyauth');
	Route::get('/application-review-from-notfication/{app_number}/{not_id}',
		'HomeController@applicationRevewFromNotification');
	Route::post('/send/sms','HomeController@sendSms');
	Route::get('/application/undo','HomeController@undoApplication');
	Route::get('/sms-panel','SmsController@smsPanel');
	Route::post('/add/sms','SmsController@smsAdd');
	Route::post('/update/sms/{id}','SmsController@smsUpdate');
	Route::post('/delete/sms','SmsController@smsDelete');
	Route::post('/send-submission-sms/success/{id}','ApplicationController@submissionSmsSend')->middleware('applicant');
	Route::get('/application/edit/applicant/{appNumber}', 'ApplicationController@applicationEditApplicant')->middleware('anyauth');
	Route::post('/change/password','UserController@changePassword')->middleware('auth');

	Route::get('/admin-list','HomeController@adminsList')->middleware('super-admin');
	Route::get('/delete/invoice/{invId}','InvoiceController@deleteInvoice')->middleware('super-admin');
	Route::post('/add/admin','HomeController@addAdmin')->middleware('super-admin');
	Route::post('update/admin/{id}','HomeController@updateAdmin')->middleware('super-admin');
	Route::post('/delete/admin','HomeController@deleteAdmin')->middleware('super-admin');
});
Auth::routes();
Route::group(['prefix'=>'customer'],function (){

	Route::get('login', 'CustomerAuth\LoginController@showLoginForm')->name('customer.login')->middleware('not-auth');
	Route::post('login', 'CustomerAuth\LoginController@login')->middleware('not-auth');
// Registration Routes...
	Route::get('register', 'CustomerAuth\RegisterController@showRegistrationForm')->name('customer.register')->middleware('not-auth');
	Route::post('register', 'CustomerAuth\RegisterController@register')->middleware('not-auth');

	Route::post('logout', 'CustomerAuth\LoginController@logout')->name('customer.logout');
// Password Reset Routes...
	Route::get('password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request')->middleware('not-auth');
	Route::post('password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email')->middleware('not-auth');
	Route::get('password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm')->name('customer.password.reset')->middleware('not-auth');
	Route::post('password/reset', 'CustomerAuth\ResetPasswordController@reset')->middleware('not-auth');
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

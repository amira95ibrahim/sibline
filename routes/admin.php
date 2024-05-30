<?php



Route::group(['prefix'=>'admin','middleware'=>['auth:admin','permission'],'as'=>'admin.'],function(){

	Route::resource('email-template', App\Http\Controllers\Admin\EmailTemplateController::class)->except('destroy');
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::resource('form1', App\Http\Controllers\Admin\Form1Controller::class);
    Route::resource('form2', App\Http\Controllers\Admin\Form2Controller::class);
    Route::resource('form3', App\Http\Controllers\Admin\Form3Controller::class);
    Route::resource('form4', App\Http\Controllers\Admin\Form4Controller::class);
    Route::resource('form5', App\Http\Controllers\Admin\Form5Controller::class);
    Route::resource('form6', App\Http\Controllers\Admin\Form6Controller::class);
    Route::resource('form7', App\Http\Controllers\Admin\Form7Controller::class);
    Route::resource('form8', App\Http\Controllers\Admin\Form8Controller::class);
    Route::resource('form9', App\Http\Controllers\Admin\Form9Controller::class);
    Route::resource('form10', App\Http\Controllers\Admin\Form10Controller::class);
    Route::post('form1/{id}', [ App\Http\Controllers\Admin\Form1Controller::class, 'Destroy']);
    Route::post('form2/{id}', [ App\Http\Controllers\Admin\Form2Controller::class, 'Destroy']);
    Route::post('form3/{id}', [ App\Http\Controllers\Admin\Form3Controller::class, 'Destroy']);
    Route::post('form4/{id}', [ App\Http\Controllers\Admin\Form4Controller::class, 'Destroy']);
    Route::post('form5/{id}', [ App\Http\Controllers\Admin\Form5Controller::class, 'Destroy']);
    Route::post('form6/{id}', [ App\Http\Controllers\Admin\Form6Controller::class, 'Destroy']);
    Route::post('form7/{id}', [ App\Http\Controllers\Admin\Form7Controller::class, 'Destroy']);
    Route::post('form8/{id}', [ App\Http\Controllers\Admin\Form8Controller::class, 'Destroy']);
    Route::post('form9/{id}', [ App\Http\Controllers\Admin\Form9Controller::class, 'Destroy']);
    Route::post('form10/{id}', [ App\Http\Controllers\Admin\Form10Controller::class, 'Destroy']);

    Route::resource('role', App\Http\Controllers\Admin\RoleController::class);

	Route::resource('customer', App\Http\Controllers\Admin\CustomerController::class);

	Route::resource('project', App\Http\Controllers\Admin\ProjectController::class);
	Route::post('/getData', [App\Http\Controllers\Admin\ProjectController::class , 'dataExel']);
	Route::post('/sendRequestsCustomer', [App\Http\Controllers\Admin\ProjectController::class , 'sendRequestsCustomer'])->name('sendRequestsCustomer');
	Route::post('/sendConfirmationCustomer', [App\Http\Controllers\Admin\ProjectController::class , 'sendConfirmationCustomer'])->name('sendConfirmationCustomer');
	Route::delete('multi-delete',[ App\Http\Controllers\Admin\ProjectController::class , 'multi_delete'])->name('multi-delete');

	Route::get('/engagment-Letter/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'engagmentLetter'])->name('engagment-Letter');
    Route::get('/representationLetter/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'representationLetter'])->name('representationLetter');
    Route::get('/authorizationLetter/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'authorizationLetter'])->name('authorizationLetter');
    Route::get('/approvalRequest/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'approvalRequest'])->name('approvalRequest');

    Route::post('/sendEmailLetter', [App\Http\Controllers\Admin\ProjectController::class , 'sendEmailLetter'])->name('sendEmailLetter');

    Route::get('/suppliers/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'suppliers'])->name('suppliers');
    Route::get('/clients/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'clients'])->name('clients');
    Route::get('/bankconfirmation/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'bankconfirmation'])->name('bankconfirmation');



	Route::get('get_accounts',[App\Http\Controllers\Admin\ProjectController::class , 'ajax'])->name('get_accounts');

	Route::get('get_data_accounts_ajax/{id}',[App\Http\Controllers\Admin\ProjectController::class , 'get_data_accounts_ajax'])->name('get_data_accounts_ajax');

	Route::resource('country', App\Http\Controllers\Admin\CountryController::class);

	Route::resource('dashboard', App\Http\Controllers\Admin\DashboardController::class);

	Route::resource('page', App\Http\Controllers\Admin\PageController::class);

	Route::resource('email', App\Http\Controllers\Admin\EmailController::class)->only('index','update');
	Route::resource('systemRemember', App\Http\Controllers\Admin\SystemRememberController::class);

	Route::resource('system', App\Http\Controllers\Admin\SystemSettingController::class)->only('index','update');
	Route::resource('systemAccount', App\Http\Controllers\Admin\SystemAccountSettingController::class);
	Route::resource('mails', App\Http\Controllers\Admin\SystemMailContentController::class);

	Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);


	Route::resource('notification', App\Http\Controllers\Admin\NotificationController::class)->only('index','update','destroy');

    Route::get('acconts/export/{id}', [ App\Http\Controllers\Admin\ProjectController::class  , 'export'])->name('acconts.export');





	Route::get('role/get-permissions/{id}',[
		'as'=>'role.getPermissions',
		'uses'=>'App\Http\Controllers\Admin\RoleController@getPermissions'
	]);

	Route::get('profile', [
		'as'=>'profile',
		'uses'=>'App\Http\Controllers\Admin\UserController@profile'
	]);




});

################### start download links ##############################
Route::group(['prefix'=>'download'],function(){

    Route::get('/clients/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'download_clients'])->name('download_clients');
    Route::get('/banks/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'download_banks'])->name('download_banks');
    Route::get('/suppliers/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'download_suppliers'])->name('download_suppliers');

    Route::get('/engagmentLetter/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'download_engagmentLetter'])->name('download_engagmentLetter');
    Route::get('/representationLetter/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'download_representationLetter'])->name('download_representationLetter');
    Route::get('/authorizationLetter/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'download_authorizationLetter'])->name('download_authorizationLetter');
    Route::get('/approvalRequest/{project}', [App\Http\Controllers\Admin\ProjectController::class , 'download_approvalRequest'])->name('download_approvalRequest');
});



################### end download links ##############################
Route::get('admin/country/get-childs/{id}',[
	'as'=>'admin.country.getChilds',
	'uses'=>'App\Http\Controllers\Admin\CountryController@getChilds'
]);

//Route::resource('user', App\Http\Controllers\UserController::class)->except('edit', 'update', 'destroy');

/*

Route::get('admin/login',[
	'as'=>'admin.login',
	'uses'=>'App\Http\Controllers\Auth\AuthController@showLoginForm'
]);

Route::post('admin/login', [
	'as'=>'admin.login.submit',
	'uses'=>'App\Http\Controllers\Auth\AuthController@login'
]);

Route::get('admin/reset',[
	'as'=>'admin.reset',
	'uses'=>'App\Http\Controllers\Auth\AuthController@showResetForm'
]);

Route::get('admin/logout', [
	'as'=>'admin.logout',
	'uses'=>'App\Http\Controllers\Auth\AuthController@logout'
]);

*/
Route::group(['prefix'=>'admin','as'=>'admin.'],function(){



	Route::get('login',[
		'as'=>'login',
		'uses'=>'App\Http\Controllers\Auth\AuthController@showLoginForm'
	]);


	Route::post('login', [
		'as'=>'login.submit',
		'uses'=>'App\Http\Controllers\Auth\AuthController@login'
	]);



	Route::get('reset',[
		'as'=>'reset',
		'uses'=>'App\Http\Controllers\Auth\AuthController@showResetForm'
	]);

	Route::get('reset/{token}',[
		'as'=>'reset.change',
		'uses'=>'App\Http\Controllers\Auth\AuthController@showChangePasswordForm'
	]);


	Route::post('send-reset-mail', [
		'as'=>'reset.sendMail',
		'uses'=>'App\Http\Controllers\Auth\AuthController@sendmail'
	]);

	Route::post('reset', [
		'as'=>'reset.submit',
		'uses'=>'App\Http\Controllers\Auth\AuthController@storeNewPassword'
	]);


	Route::get('logout', [
		'as'=>'logout',
		'uses'=>'App\Http\Controllers\Auth\AuthController@logout'
	]);
});


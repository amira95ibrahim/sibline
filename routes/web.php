<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return  redirect()->route('admin.dashboard.index');
});
Route::get('lang', [
    'as'   => 'lang',
    'uses' => 'App\Http\Controllers\LangController@change',
]);

Route::get('/form-data/{customer_hash}/{account_hash}/{system_info_hash}',
    [App\Http\Controllers\Admin\ProjectController::class, 'project_data'])->name('data_project');
Route::post('/form-data/{account_hash}',
    [App\Http\Controllers\Admin\ProjectController::class, 'project_data_store'])
     ->name('project_data_store');
Route::group(['prefix' => 'customer', 'middleware' => ['auth:customer'], 'as' => 'customer.'],
    function () {

        Route::resource('dashboard', App\Http\Controllers\Customer\DashboardController::class);

        Route::resource('customer', App\Http\Controllers\Admin\CustomerController::class)
             ->only('update');

        Route::resource('accounts', App\Http\Controllers\Customer\AccountController::class);

        Route::post('update_accounts',
            [App\Http\Controllers\Customer\AccountController::class, 'update_accounts'])
             ->name('updateAccounts');
        Route::post('updateApproveMissingAccounts', [
            App\Http\Controllers\Customer\AccountController::class,
            'update_approve_missing_accounts',
        ])->name('updateApproveMissingAccounts');
        Route::get('approve-accounts',
            [App\Http\Controllers\Customer\AccountController::class, 'approve_accounts'])
             ->name('approve-accounts');
        Route::get('approve-missing-accounts',
            [App\Http\Controllers\Customer\AccountController::class, 'approve_missing_accounts'])
             ->name('approve-missing-accounts');
        Route::get('refuse-accounts',
            [App\Http\Controllers\Customer\AccountController::class, 'refuse_accounts'])
             ->name('refuse-accounts');
        Route::get('pending-accounts',
            [App\Http\Controllers\Customer\AccountController::class, 'pending_accounts'])
             ->name('pending-accounts');
        Route::resource('notification', App\Http\Controllers\Admin\NotificationController::class)
             ->only('index', 'update', 'destroy');

        Route::get('profile', [
            'as'   => 'profile',
            'uses' => 'App\Http\Controllers\Admin\CustomerController@profile',
        ]);
    });
// Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {


//     Route::get('/', function () {
//         dd('sdsd');
//     });
//     Route::get('register', [
//         'as'   => 'register',
//         'uses' => 'App\Http\Controllers\Auth\CustomerLoginController@showRegisterForm',
//     ]);

//     Route::get('login', [
//         'as'   => 'login',
//         'uses' => 'App\Http\Controllers\Auth\AuthController@showLoginForm',
//     ]);

//     Route::post('login', [
//         'as'   => 'login.submit',
//         'uses' => 'App\Http\Controllers\Auth\AuthController@login',
//     ]);

//     Route::get('reset', [
//         'as'   => 'reset',
//         'uses' => 'App\Http\Controllers\Auth\AuthController@showResetForm',
//     ]);

//     Route::get('reset/{token}', [
//         'as'   => 'reset.change',
//         'uses' => 'App\Http\Controllers\Auth\AuthController@showChangePasswordForm',
//     ]);

//     Route::get('activate/{token}', [
//         'as'   => 'activate.done',
//         'uses' => 'App\Http\Controllers\Auth\CustomerLoginController@Activate',
//     ]);

//     Route::post('send-reset-mail', [
//         'as'   => 'reset.sendMail',
//         'uses' => 'App\Http\Controllers\Auth\AuthController@sendmail',
//     ]);

//     Route::post('reset', [
//         'as'   => 'reset.submit',
//         'uses' => 'App\Http\Controllers\Auth\AuthController@storeNewPassword',
//     ]);

//     Route::post('register', [
//         'as'   => 'register.submit',
//         'uses' => 'App\Http\Controllers\Auth\CustomerLoginController@register',
//     ]);

//     Route::get('logout', [
//         'as'   => 'logout',
//         'uses' => 'App\Http\Controllers\Auth\AuthController@logout',
//     ]);
// });










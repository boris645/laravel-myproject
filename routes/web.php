<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;

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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('app_home');
    
    Route::get('/about', 'about')->name('app_about');

    Route::match(['get', 'post'], '/dashboard',  'dashboard')->middleware('auth')->name('app_dashboard');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->name('app_logout');

    Route::post('/exist_email', 'existEmail')->name('app_exist_email');

    Route::match(['get', 'post'], '/activation_code/{token}', 'activationcode')->name('app_activation_code');

    Route::get('/user_chercher', 'userChecker')->name('app_user_chercher');

    Route::get('/resend_activation_code/{token}', 'resendActivationCode')->name('app_resend_activation_code');

    Route::get('/activation_account_link/{token}', 'activationAccountLink')->name('app_activation_account_link');

    Route::match(['get', 'post'], '/activation_account_change_email/{token}', 'ActivationAccountChangeEmail')->name('app_activation_account_change_email');
    Route::match(['get', 'post'], '/forgot_password', 'forgotpassword')->name('app_forgotpassword');
    Route::match(['get', 'post'], '/change_password{token}', 'changePassword')->name('app_changepassword');
});



//match est utiliser l'orsqu'on veut envoiyer et recevoir des donées



// étape2 on créer sa route vidéo11







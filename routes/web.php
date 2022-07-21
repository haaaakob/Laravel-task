<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\MainController;
use \App\Http\Controllers\ForgotPasswordController;
use \App\Mail\ResetPasswordMail;
use \Illuminate\Support\Facades\Mail;

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
    return view('welcome');
});

//Route::get('register', [MainController::class, 'register'])->name('register');
//Route::get('/login', [MainController::class, 'login'])->name('login');
//Route::get('/private', [MainController::class, 'private']);
//Route::get('/admin', [MainController::class, 'admin']);

Route::post('login', [MainController::class, 'login_check'])->name('check');
Route::post('register', [MainController::class, 'regProcess'])->name('regProcess');
Route::post('post', [MainController::class, 'pots'])->name('create_post');
Route::post('create_post', [MainController::class, 'add_comment'])->name('add_comment');
Route::get('logout', [MainController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('register', [MainController::class, 'register'])->name('register');
    Route::get('/login', [MainController::class, 'login'])->name('login');

    Route::get('/private', [MainController::class, 'private']);
    Route::get('/admin', [MainController::class, 'admin']);
});

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forgetPassword');
//Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password');
//Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('updatePassword');

Route::get('/email', function (){
//    Mail::to('developerdevel206@gmail.com')->send(new ResetPasswordMail());
    return new ResetPasswordMail();
});

Route::get('changePassword/{token}', [ForgotPasswordController::class, 'change'])->name('change');
Route::post('changePassword', [ForgotPasswordController::class, 'updatePassword'])->name('updatePassword');



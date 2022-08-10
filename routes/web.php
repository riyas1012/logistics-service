<?php

use App\Http\Controllers\HomeController;
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
Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('create-account',[HomeController::class,'createAccount'])->name('create-account');
Route::post('register',[HomeController::class,'register'])->name('register');
Route::post('login',[HomeController::class,'login'])->name('login');
Route::get('forgot-password',[HomeController::class,'forgotPassword'])->name('forgot.password');
Route::get('reset-password/{reset_token}',[HomeController::class,'resetPassword'])->name('reset.password');
Route::post('reset-password/update/{reset_token}',[HomeController::class,'resetPasswordUpdate'])->name('reset.password.update');
Route::post('forgot-password-link',[HomeController::class,'forgotPasswordLink'])->name('forgot.password.link');
Route::middleware(['auth_user'])->group(function () {
    Route::get('otp',[HomeController::class,'getOtpPage'])->name('otp');
    Route::get('otp-resend',[HomeController::class,'otpResend'])->name('otp.resend');
    Route::post('otp-verification',[HomeController::class,'otpVerification'])->name('otp.verification');
    Route::get('request-form', [HomeController::class,'requestForm'])->name('request.form');
    Route::get('logout',[HomeController::class,'logout'])->name('logout');
});

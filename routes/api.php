<?php

use App\Http\Controllers\v1\Admin\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1/admin')->group(function () {
    Route::prefix('auth')->controller(AdminAuthController::class)->group(function () {
        Route::post('login', 'login')->middleware('throttle:5,1');
        Route::post('verify-login-otp', 'verifyOtp')->middleware('throttle:5,1');
        Route::post('reset-password', 'resetPassword')->middleware('throttle:5,1');
        Route::post('resend-mail', 'resendPasswordResetLink')->middleware('throttle:5,1');
        Route::post('finish-reset-password', 'finishResetPassword')->middleware('throttle:5,1');
    });
});

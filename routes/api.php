<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Admin\RoleController;
use App\Http\Controllers\v1\Admin\AdminController;
use App\Http\Controllers\v1\Admin\ActivitiesController;
use App\Http\Controllers\v1\User\UserPassportController;
use App\Http\Controllers\v1\User\Auth\UserAuthController;
use App\Http\Controllers\v1\Admin\StaffPassportController;
use App\Http\Controllers\v1\Admin\Auth\AdminAuthController;
use App\Http\Controllers\v1\Admin\UserManagementController;
use App\Http\Controllers\v1\Admin\StaffPermissionController;

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('auth/login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1');
        Route::post('auth/verify-otp', [AdminAuthController::class, 'verifyOtp'])->middleware('throttle:5,1');
        Route::post('auth/reset-password', [AdminAuthController::class, 'sendPasswordResetLink'])->middleware('throttle:5,1');
        Route::post('auth/finish-reset-password', [AdminAuthController::class, 'finishResetPassword'])->middleware('throttle:5,1');
        Route::post('auth/resend-password-reset-link', [AdminAuthController::class, 'resendPasswordResetLink'])->middleware('throttle:5,1');
        Route::middleware(['auth:admin', 'trust.device'])->group(function () {
            Route::post('auth/logout', [AdminAuthController::class, 'logout']);
            Route::get('auth/profile', [AdminAuthController::class, 'fetchStaffProfile']);
            Route::post('auth/change-password', [AdminAuthController::class, 'changePassword']);
            Route::apiResource('role', RoleController::class)->middleware('permission:manage role');
            Route::apiResource('activities', ActivitiesController::class)->only(['index', 'show'])->middleware('permission:view activities');
            Route::apiResource('staff', AdminController::class)->middleware('permission:manage staff');
            Route::apiResource('users', UserManagementController::class)->middleware('permission:manage users');
            Route::post('staff-passport/{id}', [StaffPassportController::class, 'update']);

            Route::post('{staffId}/direct-permissions',[StaffPermissionController::class, 'assignDirectPermissions'])
            ->middleware('permission:manage roles');
            Route::delete('{staffId}/direct-permissions',[StaffPermissionController::class, 'revokeDirectPermissions']
            )->middleware('permission:manage roles');
        });


      
    });

    Route::prefix('user')->group(function () {
        Route::post('auth/login', [UserAuthController::class, 'login'])->middleware('throttle:5,1');
        Route::post('auth/reset-password', [UserAuthController::class, 'resetPassword'])->middleware('throttle:5,1');
        Route::post('auth/finish-reset-password', [UserAuthController::class, 'finishPasswordReset'])->middleware('throttle:5,1');
        Route::post('auth/resend-otp', [UserAuthController::class, 'resendOtp'])->middleware('throttle:5,1');

        Route::middleware('auth:user')->group(function () {
            Route::post('auth/logout', [UserAuthController::class, 'logout']);
            Route::get('auth/profile', [UserAuthController::class, 'fetchUserProfile']);
            Route::post('auth/change-password', [UserAuthController::class, 'changePassword']);
            Route::apiResource('update', UserManagementController::class)->only('update');
            Route::post('user-passport/{id}', [UserPassportController::class, 'update']);
        });
    });

   

});

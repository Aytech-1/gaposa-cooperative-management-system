<?php

use App\Http\Controllers\v1\Admin\ActivitiesController;
use App\Http\Controllers\v1\Admin\AdminController;
use App\Http\Controllers\v1\Admin\Auth\AdminAuthController;
use App\Http\Controllers\v1\Admin\RoleController;
use App\Http\Controllers\v1\Admin\StaffPassportController;
use App\Http\Controllers\v1\Admin\StaffPermissionController;
use App\Http\Controllers\v1\Admin\UserManagementController;
use App\Http\Controllers\v1\Setup\CountryController;
use App\Http\Controllers\v1\Setup\EmployementTypeController;
use App\Http\Controllers\v1\Setup\GenderController;
use App\Http\Controllers\v1\Setup\LedgerTypeController;
use App\Http\Controllers\v1\Setup\LgaController;
use App\Http\Controllers\v1\Setup\LoanInterestTypeController;
use App\Http\Controllers\v1\Setup\MemberContributionTypeController;
use App\Http\Controllers\v1\Setup\PaymentChannelTypeController;
use App\Http\Controllers\v1\Setup\StateController;
use App\Http\Controllers\v1\Setup\StatusController;
use App\Http\Controllers\v1\Setup\TitleController;
use App\Http\Controllers\v1\User\Auth\UserAuthController;
use App\Http\Controllers\v1\User\UserPassportController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {
        
        Route::middleware(['auth:admin', 'trust.device'])->group(function () {
            Route::apiResource('role', RoleController::class)->middleware('permission:manage role');
            Route::apiResource('activities', ActivitiesController::class)->only(['index', 'show'])->middleware('permission:view activities');
            Route::apiResource('staff', AdminController::class)->middleware('permission:manage staff');
            Route::apiResource('users', UserManagementController::class)->middleware('permission:manage users');
            Route::post('staff-passport/{id}', [StaffPassportController::class, 'update']);

            
        });

        // Route::apiResource('role', RoleController::class);
        // Route::apiResource('staff', AdminController::class);
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
            Route::apiResource('update', UserManagementController::class)->only(['update','store']);
            Route::post('user-passport/{id}', [UserPassportController::class, 'update']);
        });
    });


    Route::prefix('setup')->group(function () {
        Route::get('country', [CountryController::class, 'index']);
        Route::get('state', [StateController::class, 'index']);
        Route::get('lga', [LgaController::class, 'index']);
        Route::get('gender', [GenderController::class, 'index']);
        Route::get('title', [TitleController::class, 'index']);
        Route::get('status', [StatusController::class, 'index']);
        Route::get('loan-interest-types', [LoanInterestTypeController::class, 'index']);
        Route::get('payment-channel-types', [PaymentChannelTypeController::class, 'index']);
        Route::get('ledger-types', [LedgerTypeController::class, 'index']);
        Route::get('employment-types', [EmployementTypeController::class, 'index']);
        Route::get('member-contribution-types', [MemberContributionTypeController::class, 'index']);
    });
});

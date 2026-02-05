<?php

namespace App\Http\Controllers\v1\User\Auth;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\User\UserResource;

class UserAuthController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'emailAddress' => 'required|email',
        ]);

        $user = User::where('email_address', $request->emailAddress)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        DB::table('reset_password_tokens')->updateOrInsert(
            [
                'resetable_type' => User::class,
                'resetable_id'   => $user->user_id,
            ],
            [
                'token'      => $otp,
                'expires_at' => $expiresAt,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Password reset OTP sent successfully.',
            'expires_at' => $expiresAt,
        ], 200);
    }

    public function finishPasswordReset(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'otp' => 'required|integer',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('user_id', $request->user_id)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $resetToken = DB::table('reset_password_tokens')
            ->where('resetable_type', User::class)
            ->where('resetable_id', $user->user_id)
            ->where('token', $request->otp)
            ->first();

        if (!$resetToken) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 400);
        }

        if ($resetToken->expires_at < now()) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired.',
            ], 400);
        }

        $user->update(['password' => Hash::make($request->newPassword)]);

        DB::table('reset_password_tokens')
            ->where('resetable_type', User::class)
            ->where('resetable_id', $user->user_id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully.',
        ], 200);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'userId' => 'required|string',
        ]);
        $user = User::where('user_id', $request->userId)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        DB::table('reset_password_tokens')->updateOrInsert(
            [
                'resetable_type' => User::class,
                'resetable_id'   => $user->user_id,
            ],
            [
                'token'      => $otp,
                'expires_at' => $expiresAt,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'OTP resent successfully.',
            'expires_at' => $expiresAt,
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'emailAddress' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email_address', $request->emailAddress)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        if ($user->status_id <> 1) {
            return response()->json([
                'success' => false,
                'message' => 'Account suspended. Please contact support.',
            ], 403);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }
        $expiresAt = now()->addMinutes(20);
        $user->tokens()->delete();
        $token = $user->createToken('user_token')->plainTextToken;
        $user->tokens()->latest()->first()->update(['expires_at' => $expiresAt]);
        $user->update(['last_login_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->user();
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
        ], 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);
        $user = $request->user();
        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.',
            ], 400);
        }

        $user->update(['password' => Hash::make($request->newPassword)]);
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.',
        ], 200);
    }
  
    public function fetchUserProfile(Request $request)
    {
        $user = Auth::guard('user')->user();
        $userData = Cache::remember("user_profile_{$user->user_id}", now()->addMonth(), function () use ($user) {
            return new UserResource(User::with([
                'title:title_id,title_name',
                'gender:gender_id,gender_name',
                'status:status_id,status_name'
            ])->findOrFail($user->user_id));
        });

        return response()->json([
            'success' => true,
            'data' => $userData,        
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\v1\Admin\Auth;

use Carbon\Carbon;
use App\Models\Admin\Staff;
use Illuminate\Http\Request;
use App\Models\Setup\UserDevice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;
use App\Http\Resources\Admin\AdminResource;

class AdminAuthController extends Controller
{
    public function sendPasswordResetLink(Request $request)
    {

        $request->validate([
            'emailAddress' => 'required|string|email'
        ]);

        $staff = Staff::where('email', $request->emailAddress)->first();

        if (!$staff) {
            return response()->json([
                'success' => false,
                'message' => 'No staff account found with this email address.'
            ], 404);
        }

        if ($staff->status_id !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is not active. Please contact support.'
            ], 403);
        }

        $status = Password::broker('admins')->sendResetLink([
            'email' => $staff->email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Password reset link sent to your email address.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to send password reset link. Please try again later.'
            ], 500);
        }
    }

    public function resendPasswordResetLink(Request $request)
    {
        $request->validate([
            'emailAddress' => 'required|string|email'
        ]);

        $staff = Staff::where('email', $request->emailAddress)->first();

        if (!$staff) {
            return response()->json([
                'success' => false,
                'message' => 'No staff account found with this email address.'
            ], 404);
        }

        if ($staff->status_id !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is not active. Please contact support.'
            ], 403);
        }

        $status = Password::broker('admins')->sendResetLink([
            'email' => $staff->email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Password reset link resent to your email address.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to resend password reset link. Please try again later.'
            ], 500);
        }
    }

    public function finishResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'emailAddress' => 'required|string|email|exists:staff,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::broker('admins')->reset(
            [
                'email' => $request->emailAddress,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'token' => $request->token,
            ],
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
                $user->tokens()->delete();
                userDevice ::where('user_id', $user->staff_id)->delete();          }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'message' => 'Password has been reset successfully.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset password. Please try again.'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'emailAddress' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = Staff::where('email', $request->emailAddress)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email address or password.'
            ], 401);
        }

        if ($user->status_id !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is not active. Please contact support.'
            ], 403);
        }

        $deviceId = $request->header('X-Device-ID');

        if (!$deviceId) {
            return response()->json([
                'success' => false,
                'message' => 'Device ID is required.'
            ], 403);
        }

        $device = UserDevice::where('user_id', $user->staff_id)
            ->where('device_id', $deviceId)
            ->whereNotNull('verified_at')
            ->first();

        if ($device) {
            $user->last_login_at = now();
            $user->save();
            $user->tokens()->delete();
            $tokenResult = $user->createToken('admin');
            $tokenResult->accessToken->device_id = $deviceId;
            $tokenResult->accessToken->save();
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'otpRequired' => false,
                'accessToken' => $token,
                'tokenType' => 'Bearer'
            ], 200);
        }

        $otp = rand(100000, 999999);
        DB::table('otps')->updateOrInsert(
            ['user_id' => $user->staff_id,],
            [
                'otp_code' => Hash::make($otp),
                'expires_at' => Carbon::now()->addMinutes(10),
                'created_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your registered email address. Please verify to complete login.',
            'otpRequired' => true,
            'otp' => $otp
        ], 200);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'emailAddress' => 'required|email',
            'otpCode' => 'required|string|digits:6',
        ]);

        $deviceId = $request->header('X-Device-ID');

        if (!$deviceId) {
            return response()->json([
                'success' => false,
                'message' => 'Device ID is required.'
            ], 403);
        }

        $user = Staff::where('email', $request->emailAddress)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email address.'
            ], 401);
        }

        $userId = $user->staff_id;

        $otpRecord = DB::table('otps')
            ->where('user_id', $userId)
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.'
            ], 401);
        }

        if (Carbon::now()->gt($otpRecord->expires_at)) {
            DB::table('otps')->where('user_id', $userId)->delete();

            return response()->json([
                'success' => false,
                'message' => 'OTP has expired.'
            ], 401);
        }

        if (!Hash::check((string) $request->otpCode, $otpRecord->otp_code)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code.'
            ], 401);
        }

        UserDevice::updateOrCreate(
            [
                'user_id' => $userId,
                'device_id' => $deviceId,
            ],
            [
                'verified_at' => now(),
            ]
        );

        DB::table('otps')->where('user_id', $userId)->delete();

        $user->last_login_at = now();
        $user->save();

        $user->tokens()->delete();
        $tokenResult = $user->createToken('central_staff_token');
        $tokenResult->accessToken->device_id = $deviceId;
        $tokenResult->accessToken->save();
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'OTP verified. Login successful.',
            'lastLogin' => $user?->last_login_at?->diffForHumans(),
            'accessToken' => $token,
            'tokenType' => 'Bearer',
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->user();
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        $staff = $request->user();

        if (!Hash::check($request->currentPassword, $staff->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.',
            ], 400);
        }

        $staff->update(['password' => $request->newPassword,]);
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.',
        ]);
    }

    public function fetchStaffProfile(Request $request)
    {
        $staff = Auth::guard('admin')->user();
        $staffData = Cache::remember("staff_profile_{$staff->staff_id}", now()->addMonth(), function () use ($staff) {
            return new AdminResource(Staff::with([
                'title:title_id,title_name',
                'gender:gender_id,gender_name',
                'status:status_id,status_name'
            ])->findOrFail($staff->staff_id));
        });

        return response()->json([
            'success' => true,
            'data' => $staffData,
        ], 200);
    }
}

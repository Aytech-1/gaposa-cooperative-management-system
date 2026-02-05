<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\User\User;

class UserPassportController extends Controller
{
    public function update(Request $request, string $id)
    {
        $request->validate([
            'passport' => 'required|image|dimensions:min_width=200,min_height=200|max:2048',
        ]);

        try {
            $user = User::findOrFail($id);

            if (
                $user->passport && $user->passport !== User::DEFAULT_PASSPORT &&
                Storage::disk('public')->exists("passports/userPictures/{$user->passport}")
            ) {
                Storage::disk('public')->delete("passports/userPictures/{$user->passport}");
            }

            $file = $request->file('passport');
            $fileName = $user->user_id . Str::uuid() . '.' . $file->extension();

            $file->storeAs('passports/userPictures', $fileName, 'public');

            $user->passport = $fileName;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Passport updated successfully',
                'passportUrl' => Storage::url('passports/userPictures/' . $fileName),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update passport',
                'error' => $e->getMessage(),
            ], 500);
        } 

    }
}

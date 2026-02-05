<?php

namespace App\Http\Controllers\v1\Admin;

use App\Models\Admin\Staff;
use Illuminate\Http\Request;
use App\Jobs\StaffRegistrationJob;
use App\Models\Setup\SetupCounter;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Services\LogActivitiesService;
use App\Services\Cache\ClearCacheService;
use App\Http\Resources\Admin\AdminResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $cursor = $request->get('cursor', 'first_page');
        $cacheKey = "staff_list_{$cursor}";
        $staffData = Cache::tags('staff_list')->flexible($cacheKey, [now()->addMonth(), null], function () use ($admin) {
            return Staff::with([
                'title:title_id,title_name',
                'gender:gender_id,gender_name',
                'status:status_id,status_name'
            ])
                ->where('staff_id', '!=', $admin->staff_id)
                ->orderBy('last_name', 'asc')
                ->cursorPaginate(30);
        });

        if ($staffData->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No staff records found.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Staff records fetched successfully.',
            'data' => AdminResource::collection($staffData),
            'pagination' => [
                'nextCursor' => $staffData->nextCursor()?->encode(),
                'previousCursor' => $staffData->previousCursor()?->encode(),
            ],
        ], 200);
    }


    // Store a newly created resource in storage.
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titleId' => 'required|int|exists:setup_titles,title_id',
            'firstName'     => ['required', 'string', 'regex:/^[A-Za-z\s\'-]+$/', 'min:2', 'max:50'],
            'middleName'    => ['nullable', 'string', 'regex:/^[A-Za-z\s\'-]+$/', 'min:2', 'max:50'],
            'lastName'      => ['required', 'string', 'regex:/^[A-Za-z\s\'-]+$/', 'min:2', 'max:50'],
            'genderId' => 'required|int|exists:setup_genders,gender_id',
            'emailAddress' => 'required|string|email|unique:staff,email',
            'mobileNumber' => ['required', 'string', 'unique:staff,mobile_number', 'regex:/^\+?[1-9]\d{1,14}$/',],
            'homeAddress' => 'required|string',
            'roleId' => 'required|integer|exists:roles,id',    
        ]);

        $admin = Auth::guard('admin')->user();

        StaffRegistrationJob::dispatch($admin->staff_id, $validated);
        return response()->json(
            [
                'success'  => true,
                'message' => 'Staff Registration successfully'
            ],
            201
        );
    }

    // Display the specified resource.
    public function show(string $id)
    {
        $staffData = Cache::remember("staff_profile_{$id}", now()->addMonth(), function () use ($id) {
            return new AdminResource(Staff::with([
                'title:title_id,title_name',
                'gender:gender_id,gender_name',
                'status:status_id,status_name'
            ])->findOrFail($id));
        });

        return response()->json([
            'success' => true,
            'message' => 'Staff profile fetched successfully.',
            'data' => $staffData
        ], 200);
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $updateStaff = Staff::where('staff_id', $id)->firstOrFail();
        $request->validate([
            'titleId' => 'required|int|exists:setup_titles,title_id',
            'firstName'     => ['required', 'string', 'regex:/^[A-Za-z\s\'-]+$/', 'min:2', 'max:50'],
            'middleName'    => ['nullable', 'string', 'regex:/^[A-Za-z\s\'-]+$/', 'min:2', 'max:50'],
            'lastName'      => ['required', 'string', 'regex:/^[A-Za-z\s\'-]+$/', 'min:2', 'max:50'],
            'genderId' => 'required|int|exists:setup_genders,gender_id',
            'emailAddress' => 'required|string|email|unique:staff,email,' . $id . ',staff_id',
            'mobileNumber' => ['required', 'string', 'unique:staff,mobile_number,' . $id . ',staff_id', 'regex:/^\+?[1-9]\d{1,14}$/',],
            'homeAddress' => 'required|string',
        ]);

        $staff = Auth::guard('admin')->user();
        $updateStaff->update([
            'title_id'     => $request->titleId,
            'first_name'   => strtoupper($request->firstName),
            'middle_name'  => strtoupper($request->middleName),
            'last_name'    => strtoupper($request->lastName),
            'gender_id'    => $request->genderId,
            'email' => strtolower($request->emailAddress),
            'mobile_number' => $request->mobileNumber,
            'home_address' => strtoupper($request->homeAddress),
            'updated_by'   => $staff->staff_id,
        ]);

        ClearCacheService::clearListCache('staff_list');
        Cache::forget("staff_profile_{$id}");
        return response()->json([
            'success' => true,
            'message' => 'Staff updated successfully',
        ], 200);
    }
}

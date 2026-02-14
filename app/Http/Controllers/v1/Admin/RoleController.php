<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;

use App\Http\Resources\Admin\RoleResource;
use App\Services\Cache\ClearCacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        try {

            $user = auth('admin')->user();
            $userRole = $user->roles->first();
            $cacheKey = "admin_roles_with_permissions_role_{$userRole->id}";
            $roles = Cache::remember($cacheKey, now()->addMonth(), function () use ($userRole) {
                return Role::where('guard_name', 'admin')
                    ->where('id', '>', $userRole->id)
                    ->with('permissions:id,name')
                    ->orderBy('name', 'asc')
                    ->get();
            });

            return response()->json([
                'success' => true,
                'message' => 'Roles fetched successfully.',
                'data' => RoleResource::collection($roles)
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve roles.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'roleName'      => 'required|string|min:3|max:50|unique:roles,name,NULL,id,guard_name,admin',
            'permissions'   => 'required|array|min:1',
            'permissions.*' => 'integer|exists:permissions,id'
        ]);

        $role = Role::create([
            'name'       => ucwords($validated['roleName']),
            'guard_name' => 'admin',
        ]);

        $permissions = Permission::whereIn('id', $validated['permissions'])
            ->where('guard_name', 'admin')
            ->get();

        $role->syncPermissions($permissions);

        ClearCacheService::clearListCache('admin_roles_with_permissions');

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully.'
        ], 201);
    }


    // Update the specified resource in storage.
    public function update(Request $request, int $id)
    {
        $role = Role::where('guard_name', 'admin')->findOrFail($id);

        $validated = $request->validate([
            'roleName'      => 'required|string|min:3|max:50|unique:roles,name,' . $id . ',id,guard_name,admin',
            'permissions'   => 'required|array|min:1',
            'permissions.*' => 'integer|exists:permissions,id'
        ]);

        $role->update([
            'name' => ucwords($validated['roleName'])
        ]);

        $permissions = Permission::whereIn('id', $validated['permissions'])
            ->where('guard_name', 'admin')
            ->get();

        $role->syncPermissions($permissions);

        ClearCacheService::clearListCache('admin_roles_with_permissions');
        Cache::forget("admin_role_{$id}");

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully.'
        ], 200);
    }
}

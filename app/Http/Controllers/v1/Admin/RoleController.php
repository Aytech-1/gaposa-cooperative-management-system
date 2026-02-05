<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use App\Services\Cache\ClearCacheService;

class RoleController extends Controller
{

    // Display a listing of the resource.
        public function index()
    {
        $roles = Cache::remember('admin_roles_with_permissions',now()->addMonth(),function () {
            return Role::where('guard_name', 'admin')
                ->with('permissions:id,name')
                ->orderBy('name', 'asc')
                ->get();
            }
        );

        if ($roles->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No roles found.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Roles fetched successfully.',
            'data' => $roles
        ], 200);
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



    //  Display the specified resource.
    public function show(string $id)
    {
        
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

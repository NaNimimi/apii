<?php

// app/Http/Controllers/RolePermissionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{

    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);

        return response()->json(['role' => $role], 201);
    }

    public function createPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        return response()->json(['permission' => $permission], 201);
    }

  
    public function assignRole(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = \App\Models\User::findOrFail($userId);
        $user->assignRole($request->role);

        return response()->json(['message' => 'Role assigned successfully'], 200);
    }

   
    public function givePermission(Request $request, $userId)
    {
        $request->validate([
            'permission' => 'required|string|exists:permissions,name',
        ]);

        $user = \App\Models\User::findOrFail($userId);
        $user->givePermissionTo($request->permission);

        return response()->json(['message' => 'Permission granted successfully'], 200);
    }

  
    public function removeRole(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = \App\Models\User::findOrFail($userId);
        $user->removeRole($request->role);

        return response()->json(['message' => 'Role removed successfully'], 200);
    }

  
    public function revokePermission(Request $request, $userId)
    {
        $request->validate([
            'permission' => 'required|string|exists:permissions,name',
        ]);

        $user = \App\Models\User::findOrFail($userId);
        $user->revokePermissionTo($request->permission);

        return response()->json(['message' => 'Permission revoked successfully'], 200);
    }

    
    
    
    
  
}

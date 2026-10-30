<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('admin.role-permissions.index', compact('roles'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.role-permissions.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $role = Role::findOrFail($request->role_id);
        $permission = Permission::findOrFail($request->permission_id);

        if ($role->guard_name !== $permission->guard_name) {
            return back()->withErrors([
                'permission_id' => 'De rol en permissie moeten dezelfde guard hebben.'
            ])->withInput();
        }

        $role->givePermissionTo($permission);

        return redirect()->route('admin.role-permissions.index')
            ->with('success', 'Permissie gekoppeld!');
    }

    public function destroy($roleId, $permissionId)
    {
        $role = Role::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);

        $role->revokePermissionTo($permission);

        return redirect()->route('admin.role-permissions.index')
            ->with('success', 'Koppeling verwijderd!');
    }
}

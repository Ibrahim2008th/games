<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('admin.user-roles.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::where('guard_name', 'web')->get();

        return view('admin.user-roles.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'role_id' => [
                'required',
                Rule::exists('roles', 'id')->where('guard_name', 'web'),
            ],
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        $user->assignRole($role);

        return redirect()
            ->route('admin.user-roles.index')
            ->with('success', 'Rol gekoppeld!');
    }

    public function edit(User $user)
    {
        $roles = Role::where('guard_name', 'web')->get();

        return view('admin.user-roles.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role_id' => [
                'required',
                Rule::exists('roles', 'id')->where('guard_name', 'web'),
            ],
        ]);

        $role = Role::findOrFail($request->role_id);

        $user->syncRoles([$role]);

        return redirect()
            ->route('admin.user-roles.index')
            ->with('success', 'Rol gewijzigd!');
    }

    public function destroy(User $user, Role $role)
    {
        if ($user->id === auth()->id() && $role->name === 'admin') {
            return back()->withErrors([
                'role' => 'Je kunt je eigen adminrol niet verwijderen.'
            ]);
        }

        $user->removeRole($role);

        return redirect()
            ->route('admin.user-roles.index')
            ->with('success', 'Rol verwijderd!');
    }
}

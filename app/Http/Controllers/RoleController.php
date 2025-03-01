<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:View Role'])->only(['index', 'show']);
        $this->middleware(['permission:Create Role'])->only(['create', 'store']);
        $this->middleware(['permission:Edit Role'])->only(['edit', 'update']);
        $this->middleware(['permission:Delete Role'])->only('destroy');
    }
    public function index()
    {
        $roles = Role::get();
        return view('role-permission.role.index', compact('roles'));
    }

    public function create()
    {
        return view('role-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name']
        ]);

        Role::create([
            'name' => $request->name
        ]);
        return redirect('role')->with('success', 'Role Create Successfully!');
    }

    public function edit(Role $role)
    {
        // dd($permission->id);
        return view('role-permission.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {

        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $role->id]
        ]);

        $role->update([
            'name' => $request->name
        ]);
        return redirect('role')->with('success', 'Role Updated Successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect('role')->with('success', 'Role Delete Successfully!');
    }

    public function addPermissions($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('role-permission.role.add-permission', compact('role', 'permissions', 'rolePermissions'));
    }

    public function givePermissions(Request $request, $roleId)
    {

        // dd("asdf");
        $request->validate([
            'permission' => 'required|array',
        ]);

        $role = Role::findOrFail($roleId);

        $role->syncPermissions(Permission::whereIn('name', $request->permission)->get());

        return redirect()->back()->with('success', "Permissions added to role successfully!");
    }
}

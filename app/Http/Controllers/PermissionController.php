<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('role-permission.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name']
        ]);

        Permission::create([
            'name' => $request->name
        ]);
        return redirect('permission')->with('success', 'Permission Create Successfully!');
    }

    public function edit(Permission $permission)
    {
        // dd($permission->id);
        return view('role-permission.permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {

        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name,' . $permission->id]
        ]);

        $permission->update([
            'name' => $request->name
        ]);
        return redirect('permission')->with('success', 'Permission Updated Successfully!');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect('permission')->with('success', 'Permission Delete Successfully!');
    }
}

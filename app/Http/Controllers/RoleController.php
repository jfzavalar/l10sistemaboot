<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('procesos.admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->chunk(4);
        return view('procesos.admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('procesos.admin.roles.index')->with('success', 'Rol creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->chunk(4);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('procesos.admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'name' => 'required|unique:roles,name,' . $id, // ignora el nombre actual
        'permissions' => 'required|array',
        ]);

        $role = Role::findOrFail($id);

        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect()->route('procesos.admin.roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

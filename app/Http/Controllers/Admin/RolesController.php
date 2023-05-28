<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);;
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.form');
    }

    public function store(Request $request)
    {
        Role::create($request->all());

        return redirect('admin/roles')->with('success', 'Role added successfully.');
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.form', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());

        return redirect('admin/roles')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('admin/roles')->with('success', 'Role deleted successfully.');
    }
}

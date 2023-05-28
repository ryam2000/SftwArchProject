<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);;
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $roles->prepend('---Please select---', 0);
        $roles->all();

        return view('admin.users.form', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->assignRole($request->roles);

        return redirect('admin/users')->with('success', 'User added successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id');
        $roles->prepend('---Please select---', 0);
        $roles->all();

        $selected_roles[] = array();
        foreach ($user->roles as $role) {
            $selected_roles[] = $role->id;
        }

        return view('admin.users.form', compact('user', 'roles', 'selected_roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->syncRoles($request->roles);

        return redirect('admin/users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('admin/users')->with('success', 'User deleted successfully.');
    }
}

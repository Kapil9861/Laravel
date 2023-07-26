<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class AdminRoleController extends Controller
{
    public function index(){
        $roles=Role::whereNotIn('name',['admin','writer'])->get();
        return view('admin/roles/index',compact('roles'));
    }
    public function create(){
        return view('admin.roles.create');
    }
    public function store(Request $request){
        $validated=$request->validate(['name'=>['required','min:3']]);
        Role::create($validated);
        
        return redirect('/admin/roles')->with('success',"Created new role successfully");
        //return to_route('admin.roles.index');
    }public function edit(Role $role){
        $permissions=Permission::all();
        if (!$role->exists) {
            // Role not found in the database, redirect back with an error message
            return redirect()->route('admin.roles.index')->with('error', 'Role not found.');
        }
        return view('admin.roles.edit',compact('role','permissions'));
    }
    public function update(Request $request, Role $role)
{
    $formFields = $request->validate([
        'name' => ['required', 'min:3']
    ]);

    $role->update($formFields);

    return redirect()->route('admin.roles.index')->with("success", "Updated");
}
public function destroy(Role $role){
    $role->delete();

    return back()->with('success',"Role deleted successfully");
}
public function givePermission(Request $request,Role $role){
if($role->hasPermissionTo($request->permission)){
    return back()->with('success',"Role already has the permission");

}else{
    $role->givePermissionTo($request->permission);
    return back()->with('success',"Permission added to the role");
}
}
public function destroyPermission(Role $role,Permission $permission){
    if($role->hasPermissionTo($permission)){
        $role->revokePermissionTo($permission);
        return back()->with('success',"Permission revoked successfully");
    }else{
        return back()->with('success',"Permission is not assigned for the role yet");
    }
}
}

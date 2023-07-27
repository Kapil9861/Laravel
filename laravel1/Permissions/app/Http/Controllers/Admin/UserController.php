<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Session\Session;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return view('/admin/users/index',compact('users'));
    }
    public function show(User $user){
        $roles=Role::all();
        $permissions=Permission::all();
        
        return view('admin.users.role',compact('roles','permissions','user'));
    }
    public function logout(){
        // Session::destroy();
        Auth::logout();
        return redirect("/");
    }
    public function assignRole(Request $request,User $user){
        if($user->hasRole($request->role)){
            return back()->with('success','Role exists');
        }
        else{
            $user->assignRole($request->role);
            return back()->with('success',"Role added successfully");
        }
    }
    public function removeRole(User $user,Role $role){
        if($user->hasRole($role)){
            $user->removeRole($role);
            return back()->with('success','Role removed successfully');

        }else{
            return back()->with('success','Role couldn\'t get deleted');
        }
    }
    public function assignPermission(Request $request,User $user){
        if($user->hasPermissionTo($request->permission)){
            return back()->with('success',"user already has the permission");
        
        }else{
            $user->givePermissionTo($request->permission);
            return back()->with('success',"Permission added to the user");
        }
        }
        public function removePermission(User $user,Permission $permission){
            if($user->hasPermissionTo($permission)){
                $user->revokePermissionTo($permission);
                return back()->with('success',"Permission revoked successfully");
            }else{
                return back()->with('success',"Permission is not assigned for the user yet");
            }
        }
    public function destroy(User $user){
        //except admin all can be deleted
        if($user->hasRole('admin')){
            return back()->with('success',"I am admin you can't delete me!");
        }else{
        $user->delete();
        return back()->with('success','User deleted successfully');
    }
    }
}

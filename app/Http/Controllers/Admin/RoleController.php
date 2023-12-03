<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function AllPermission(){
        // In your UserController or any other controller responsible for user management
        $user = User::find(3); // Find a user by their ID, replace 1 with the actual user ID
        $role = Role::create(['name' => 'company']);
        // Assign the 'company' role to the user
        $user->assignRole('company');
        // Now accessing the permission table
        $permissions=Permission::create(['name'=>'all']);
        return view('Admin.permission.all_permission' ,compact('permissions'));
    }
    
}

public function givePermission(Request $request,User $user){
if($user->hasPermissionTo($request->permission)){
    return back()->with('success',"user already has the permission");

}else{
    $user->givePermissionTo($request->permission);
    return back()->with('success',"Permission added to the user");
}
}
public function destroyPermission(User $user,Permission $permission){
    if($user->hasPermissionTo($permission)){
        $user->revokePermissionTo($permission);
        return back()->with('success',"Permission revoked successfully");
    }else{
        return back()->with('success',"Permission is not assigned for the user yet");
    }
}
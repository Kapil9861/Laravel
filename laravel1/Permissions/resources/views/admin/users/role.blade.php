@extends('layouts.admin')

@section('content')
<div class="py-12 w-full">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden show-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-end p-2">
                    <a href="{{route('admin.users.index')}}" class="px-4 py-2 bg-green-700 hover:bg-green-500 rounded-md">Users Index</a>
    
                    </div>
                    @if(session('success'))
      <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Completed!</p>
        <p class="text-sm">{{session('success')}}</p>
      </div>
      @endif
                    <!-- component -->
                    <div class="mt-6 p-2 bg-slate-100">
                    <div class="flex flex-col">
                      <h2 class="text-2xl font-semibold">User</h2><br>

                      <div class="">Name:  {{$user->name}}</div>
                      <div class="">Email: {{$user->email}}</div>
                    </div></div>

                      <div class="mt-6 p-2 bg-slate-100">
                        @if($user->roles)
                        <h2 class="text-2xl font-semibold">User's roles</h2>
                        <div class="mt-4 p-2 ">
                        
                          @foreach($user->roles as $userRole)
                          <br>
                          <div class="flex space-x-20">
                        
                            <p>{{$userRole->name}}</p>
                        <form class="px-6 py-2 bg-red-400 hover:bg-red-600 justify-evenly"
                        method="POST" action="{{route('admin.users.roles.remove',[$user->id,$userRole->id])}}" onsubmit="return confirm('Are You Sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                        </form>
                      </div>

                    @endforeach
                      @endif
                      <br>
            
                        <p class="text-sm text-blue-400">ROLE</p>
                        <form class="w-full max-w-sm" method="POST" action="{{route('admin.users.roles',$user->id)}}"> 
                          {{-- {{route('admin.users.addroles',$user->id)}} --}}
                          @csrf
                          {{-- @method('PUT')  we are not updating now but creating--}}
                          <div class="flex items-center border-b border-teal-500 py-2 space-x-10">
                          <label for="role" class="vlock text-sm font-medium text-gray-700">
                            <select name="role" id="role" class="mt-1 block w-full py-2 px-3 border-separate">
                            <option value="show" selected disabled>Assign roles</option>
                              @foreach($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                              @endforeach
                            </select>
                          </label>
                          <button class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-5 rounded" type="submit">
                            Add Role
                          </button>
                            
                          </div>
                    
                        </form>
                    </div>
                      </div>
                      <p></p>
                      <div class="mt-6 p-2 bg-slate-100">
                          @if($user->permissions)
                          <h2 class="text-2xl font-semibold">User Permissions</h2>
                          <div class="mt-4 p-2">
                          
                            @foreach($user->permissions as $userp)
                            <br>
                            <div class="flex space-x-20">
                          
                              <p>{{$userp->name}}</p>
                          <form class="px-6 py-2 bg-red-400 hover:bg-red-600 justify-evenly"
                          method="POST" action="{{route('admin.user.permissions.revoke',[$user->id,$userp->id])}}" onsubmit="return confirm('Are You Sure?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit">Delete</button>
                          </form>
                        </div>
                        @endforeach
                        @endif
                          </div>

                        <p class="text-sm text-blue-400">Permission</p>
                        <form class="w-full max-w-sm" method="POST" action="{{route('admin.users.permissions',$user->id)}}"> 
                          {{-- {{route('admin.users.addpermissions',$user->id)}} --}}
                          @csrf
                          {{-- @method('PUT')  we are not updating now but creating--}}
                          <div class="flex items-center border-b border-teal-500 py-2 space-x-10">
                          <label for="permission" class="vlock text-sm font-medium text-gray-700">
                            <select name="permission" id="permission" class="mt-1 block w-full py-2 px-3 border-separate">
                            <option value="show" selected disabled>Assign Permissions</option>
                              @foreach($permissions as $permission)
                            <option value="{{$permission->name}}">{{$permission->name}}</option>
                              @endforeach
                            </select>
                          </label>
                          <button class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-5 rounded" type="submit">
                            Add Permission
                          </button>
                            
                          </div>
                    
                        </form>
                    </div>
                    <div>
                    </div>


                          
    </table>
  </div>        </div>
            </div>
        </div>
    </div>
</div>
@endsection
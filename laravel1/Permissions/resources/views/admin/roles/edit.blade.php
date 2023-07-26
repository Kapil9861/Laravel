@extends('layouts.admin')

@section('content')
<div class="py-12 w-full">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden show-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-end p-2">
                    <a href="{{route('admin.roles.index')}}" class="px-4 py-2 bg-green-700 hover:bg-green-500 rounded-md">roles Index</a>
    
                    </div>
                    <!-- component -->
                    <div class="flex flex-col">
                      <form class="w-full max-w-sm" method="POST" action="{{route('admin.roles.update',$role->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center border-b border-teal-500 py-2">
                          <input name="name"
                          value="{{$role->name}}" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New role" aria-label="Full name">
                          {{-- <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                          Add role                          </button> --}}
                          <button class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" type="submit">
                            Submit
                          </button>
                          
                        </div>
                      </form>
                      <div class="mt-6 p-2">
                          @if($role->permissions)
                          <h2 class="text-2xl font-semibold">Role Permissions</h2>
                          <div class="mt-4 p-2">
                          
                            @foreach($role->permissions as $rp)
                            <br>
                            <div class="flex space-x-20">
                          
                              <p>{{$rp->name}}</p>
                          <form class="px-6 py-2 bg-red-400 hover:bg-red-600 justify-evenly"
                          method="POST" action="{{route('admin.roles.permissions.revoke',[$role->id,$rp->id])}}" onsubmit="return confirm('Are You Sure?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit">Delete</button>
                          </form>
                        </div>
                          
                          
                        </div>
                        @endforeach
                          @endif
                          <p>________________________________________________________</p>
                          <div class="flex flex-col">
                            <p class="text-sm text-blue-400">Assign Permission</p>
                            <form class="w-full max-w-sm" method="POST" action="{{route('admin.roles.addpermissions',$role->id)}}">
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
                    </div> 
            
    </table>
  </div>        </div>
            </div>
        </div>
    </div>
</div>
@endsection
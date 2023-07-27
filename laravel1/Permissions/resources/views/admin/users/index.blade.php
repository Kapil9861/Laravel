@extends('layouts.admin')

@section('content')
<div class="py-12 w-full">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if(session('success'))
      <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Completed!</p>
        <p class="text-sm">{{session('success')}}</p>
      </div>
      @endif
        <div class="bg-white overflow-hidden show-sm sm:rounded-lg p-2">
            <div class="p-6 bg-white border-b border-gray-200">
                
                    <!-- component -->
            @if($users->isNotEmpty())
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Email</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">role</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                        </tr>
                    </thead>
                    @foreach($users as $user)
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100 py-5">
                        <tr class="hover:bg-gray-50">
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="relative h-10 w-10">
                                    <img
                                    class="h-full w-full rounded-full object-cover object-center"
                                    src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt=""
                                    />
                                    <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">{{$user->name}}</div>
                                    <div class="text-gray-400">{{$user->email}}</div>
                                    <div class="text-gray-400">{{$user->role}}</div>
                                </div>
                            </th>
          <td class="px-6 py-4">
              <div class="flex gap-2">
                <span
                  class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600"
                >
                {{$user->email}}
              </span>
              </div>
            <span
              class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
            >
              <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
              Active
            </span>
          </td>
          <td class="px-6 py-4">{{$user->name}}</td>
          <td class="px-6 py-4">
          </td>
          <td><div class="flex items-center">
            <a href="{{route('admin.users.show',$user->id)}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Role</a>
            </div></td>
          
          <td class="px-6 py-4">
            <div class="flex justify-end gap-4">
              <a x-data="{ tooltip: 'Delete' }" href="">
                {{-- {{route('admin.roles.delete')}} --}}
                
              </a>
              <form class="px-4 py-2 bg-red-400 hover:bg-red-600"
              method="POST" action="{{route('admin.users.destroy',$user->id)}}" onsubmit="return confirm('Are You Sure?');">
              @csrf
              @method('DELETE')
              <button type="submit">DELETE</button>
            </form>
              {{-- <a x-data="{ tooltip: 'Edite' }" href="/admin/roles/{{$user->id}}/edit">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-6 w-6"
                  x-tooltip="tooltip"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                  />
                </svg>
              </a> --}}
            </div>
          </td>
        </tr>
      </tbody>
                    @endforeach
                    @else
                    <p>No roles assigned yet!!</p>
                    @endif
    
                    
    </table>
  </div>        </div>
            </div>
        </div>
    </div>
</div>
@endsection
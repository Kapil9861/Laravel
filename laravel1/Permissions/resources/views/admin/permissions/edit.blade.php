@extends('layouts.admin')

@section('content')
<div class="py-12 w-full">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden show-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-end p-2">
                    <a href="{{route('admin.permissions.index')}}" class="px-4 py-2 bg-green-700 hover:bg-green-500 rounded-md">Permissions Index</a>
    
                    </div>
                    @if(session('success'))
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                      <p class="font-bold">Completed!</p>
                      <p class="text-sm">{{session('success')}}</p>
                    </div>
                    @endif
                    <!-- component -->
                    <div class="flex flex-col">
                      <form class="w-full max-w-sm" method="POST" action="{{route('admin.permissions.update',$permission)}}">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center border-b border-teal-500 py-2">
                          <input name='name'
                          value="{{$permission->name}}" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New Permission" aria-label="Full name">
                          {{-- <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                          Add Permission                          </button> --}}
                          <button class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" type="submit">
                            Submit
                          </button>
                          
                        </div>
                        
                        <div>
                          @error('name')
                          <span class="text-red-400 text-sn">{{$message}}</span>@enderror
                        </div>
                      </form>
                    </div> 
            
    </table>
  </div>        </div>
            </div>
        </div>
    </div>
</div>
@endsection
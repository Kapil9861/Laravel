@extends('layout')
@section('content')
{{-- can put or replace the section and extends by the 
    {{x-layout}}
if  you have changed it by moving to the components--}}
<x-card class="p-10 rounded max-w-lg mx-auto mt-24"
>
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
Edit the Gig :{{$listing->title}}        </h2>
        <p class="mb-4">Update the gig to find a developer</p>
    </header>

    {{-- One of the Most forgetting thing enctype = "multipart/form-data" --}}
    <form method="POST" action="/show/{{$listing->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-6">
            <label
                for="company"
                class="inline-block text-lg mb-2"
                >Company Name</label>
                @error('company')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="company" value="{{$listing->company}}"
            />
        </div>
        <div class="mb-6">
            <label for="title" class="inline-block text-lg mb-2"
                >Job Title</label
            >
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="title" value="{{$listing->title}}"
                placeholder="Example: Senior Laravel Developer"
            />
        </div>
        <div class="mb-6">
            <label
                for="location"
                class="inline-block text-lg mb-2"
                >Job Location</label
            >
            @error('location')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="location" value="{{$listing->location}}"
                placeholder="Example: Remote, Boston MA, etc"
            />

        </div>
        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2"
                >Contact Email</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="email" value="{{$listing->email}}"
            />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>
        <div class="mb-6">
            <label
                for="website"
                class="inline-block text-lg mb-2"
            >
                Website/Application URL
            </label>
            @error('website')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="website" value="{{$listing->website}}"
            />
        </div>
        <div class="mb-6">
            <label for="tags" class="inline-block text-lg mb-2">
                Tags (Comma Separated)
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="tags" value="{{$listing->tags}}"
                placeholder="Example: Laravel, Backend, Postgres, etc"
            />
            @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>
        <div class="mb-6">
            <label for="logo" class="inline-block text-lg mb-2">
                Company Logo
            </label>
            <input
                type="file"
                class="border border-gray-200 rounded p-2 w-full"
                name="logo"/>
                <img
                class="w-48 mr-6 mb-6"
                src="{{$listing->logo ? asset('storage/'.$listing->logo) : asset('images/no-image.png')}}"/>
        </div>
        @error('logo')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
        <div class="mb-6">
            <label
                for="description"
                class="inline-block text-lg mb-2"
            >
                Job Description
            </label>
            <textarea
                class="border border-gray-200 rounded p-2 w-full"
                name="description"
                rows="10" 
                {{-- value="{{old('description')}}"  As for the textarea it won't work but should be done as below--}}
                placeholder="Include tasks, requirements, salary, etc"
            > {{$listing->description}}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>
        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
            >
                Submit Edited Gig
            </button>
            <a href="/" class="text-black ml-4"> Back </a>
        </div>
    </form>
</x-card>
@endsection
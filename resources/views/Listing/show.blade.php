@extends('layout')
@section('content')
@include('partials._search')
{{-- The if statement till else is also the part of beginning as mentioned in the end --}}
{{--But shown with component {{session('$message')}} --}}
@if(empty($listing))
<p>Listing is Empty.</p>
@else
<a href="/" class="inline-block text-black ml-4 mb-4"
                ><i class="fa-solid fa-arrow-left"></i> Back
            </a>
<div class="mx-4">
    {{-- Inside the card the if we want to pass the class we have to do it as below
        also if anything to change we can do it to but we have to add
         $attributes->merge([ {{array}}like => : class=>'""Class as the array value""']) 
         <div {{$attributes-> merge(['class'=>'class=" ..."'])}}
             
         --}}
    <x-card class="p-10">
        <div
            class="flex flex-col items-center justify-center text-center"
        >
            <img
                class="w-48 mr-6 mb-6"
                src="{{$listing ->logo ? asset('storage/'.$listing->logo) : asset('images/no-image.png')}}"
                alt=""
            />
            <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <x-listing-tags :tagsCsv="$listing->tags">

            </x-listing-tags>
            <div class="text-lg my-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
                <h3 class="text-3xl font-bold mb-4">
                    {{$listing->description}} <br><br>
                    {{$listing->email}}
                </h3>
                <p>Please Contact through email with your CV attached to Apply! <br><br>

                    Regards,<br>
                    {{$listing->company}}
                </p>
            </div>
        </div>
    </x-card>
   @if(auth()->check())
<x-card class="mt-4 p-2 flex space-x-6">
    <a href="/show/{{$listing->id}}/edit">
    <i class="fa-solid fa-pencil">Edit</i>
</a>
<form method="POST" action="/show/{{$listing->id}}">
@csrf
@method('DELETE')
<button class="text-red-500"> <i class="fa-solid fa-trash">
    DELETE</i></button>
</form>
</x-card>
@else
<x-card class="mt-4 p-2 flex space-x-6">
    <a href="https://mail.google.com/mail/u/0/#inbox">
    <i class="fa-solid fa-envelope"> Email</i>
</a>
</x-card>
@endif
</div>
{{-- Done in the beginning for testing --}}
{{-- <h1>{{$heading}}</h1>
<p>This website is created by: {{$Name}}</p>
<p> {{$Address}}</p>
<p>_____________________________________________________________________________________________________________________________________</p>

<h2>{{$listing['title']}}</h2>
<p>_____________________________________________________________________________________________________________________________________</p>

<p>{{$listing['description']}}</p> --}}
@endif
@endsection
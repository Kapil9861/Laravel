@extends('layout')
@section('content')
@include('partials._hero')
@include('partials._search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@if(count($listings)<1)
 <p>No Listing found</p>
@else
@foreach($listings as $listing)
{{--  The prop can be obtained by: <x-listings-card--}}
{{-- have to change the part of listings to value if wanted to change variable $listing to value --}}
{{-- In case if only variable to be passed in the prop we could just pass it like: <x-listing-card listing|value="Hello World!">--}}
{{-- if thats not the case and want to pass the data we have to pass it as below like passing the prefix ":"--}}
<x-listings-card :listing="$listing"/>
@endforeach
@endif
</div>
<div class="mt-6 p-4">
  {{$listings->links()}}
</div>


{{-- <h1>{{$heading}}</h1>
<p>This website is created by: {{$Name}}</p>
<p> {{$Address}}</p>
<p>_____________________________________________________________________________________________________________________________________</p>

--}}
<?php
// foreach($listings as $listing):?>
<h2><?php 
// echo $listing['Name']; 
?></h2>
<p><?php
//  echo $listing['description'];
  ?></p>
<?php 
// endforeach;
?> 
{{-- if the use of unless is done then it works exactly opposite of the  --}}
@endsection
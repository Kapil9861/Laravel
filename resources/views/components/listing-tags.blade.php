@props(['tagsCsv'])
@php
    $tags=explode(',',$tagsCsv); //The $tagCsv is from the props

@endphp

<ul class="flex">
    @foreach($tags as $tag)
    <li
        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
    >
        <a href="/?jobTag={{$tag}}">{{$tag}}</a>
    </li>
    @endforeach
</ul>
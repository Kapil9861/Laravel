@if(session()->has('message'))
<div x-data="{show:true}" x-init="setTimeout(()=>show = false, 3000)"
    x-show="show" 
    {{-- every 1000 above is equal to 1 second --}}
     class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
<p>
    {{session('message')}}
    {{-- This will persist in the head until refreshed so used the Apline.js to resolve that --}}
</p>
</div>
@endif
{{-- This will connect to the Listing using the prop {@props} --}}
@props(['listing'])

{{-- Here removed the div and pasted in the card line 1 such that the div is made 
    by which inside the div other class can be inserted --}}
<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$listing->logo ? asset('storage/'.$listing->logo) : asset('images/no-image.png')}}"
            alt="" 
        />
        <div>
            <h3 class="text-2xl">
                <a href="/show/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <x-listing-tags :tagsCsv="$listing->tags">

            </x-listing-tags>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i>{{$listing->location}}
            </div>
        </div>
    </div>
</x-card>
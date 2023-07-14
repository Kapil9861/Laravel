@extends('layout')
@section('content')
<x-card class="p-10">
        <header>
        <h1
            class="text-3xl text-center font-bold my-6 uppercase"
        >
            Manage Gigs
        </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @unless($listing->isEmpty())
            @foreach ($listing as $l)
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a href="show.html">
{{$l->title}}                    </a>
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a
                        href="/show/{{$l->id}}/edit"
                        class="text-blue-400 px-6 py-2 rounded-xl"
                        ><i
                            class="fa-solid fa-pen-to-square"
                        ></i>
                        Edit</a
                    >
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                <form method="POST" action="/show/{{$l->id}}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"> <i class="fa-solid fa-trash">
                        DELETE</i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="border-gray-300">
                <td class="px-4 py-8border-t border-b border-grey-300 text-lg">
                    <p>Yet To Make Listings <br>
                        <a href="/Listing/create">
                        <i class="fa-solid fa-pen-fancy">Make Listings</i>
                        </a>
                        </p>
                </td>
            </tr>
            @endunless
        </tbody>
    </table>
</x-card>

@endsection
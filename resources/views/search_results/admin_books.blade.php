
@php($empty = true)

@foreach($books as $book)
    <x-row class="value my-3" title="{{$book->title}}">
        <div class = 'image p-rel'>
            <img src = '/images/cover_images/{{$book->cover_image}}' class = 'obj-fit'>
            {{-- <div class = 'active-circle p-abs'></div> --}}
        </div>
        <div class = 'row-value'>{{$book->title}}</div>

        <div class = 'row-value'>
            {{$book->authors[0]->name ?? $book->user[0]->name}}
        </div>

        <div class = 'row-value'>
            {{$book->views}}
        </div>
        <div class = 'row-value'>
            <button onclick = 'moderate("{{$book->title}}");'>Moderate</button>
        </div>
    </x-row>

    @php($empty = false)
@endforeach

@if(!$empty)
    <div class = 'linkss'>
        {{$books->links()}}
    </div>
@endif
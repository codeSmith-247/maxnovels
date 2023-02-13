@props([
    'books'
])

@foreach($books as $book)
<x-card.card image="/cover_images/{{$book->cover_image}}" title="{{$book->title}}" latest="{{$book->latest_chapter}}"/>
@endforeach
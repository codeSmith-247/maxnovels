
@foreach($books as $book)
<x-card.card image="cover_images/{{$book->cover_image}}" title="{{$book->title}}" latest="{{$book->latest_chapter}}"/>
@endforeach

<div class = 'linkss' style = 'grid-column: 1/-1;'>
{{$books->links()}}
</div>
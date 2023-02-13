
@foreach($books as $book)
    <div class = 'result-item flex-row' onclick="location.href = '/preview/{{$book->title}}';">
        <div class = 'image ov-hidden'>
            <img src = '/images/cover_images/{{$book->cover_image}}' class = 'obj-fit'>
        </div>
        <div class = 'title'>
            {{$book->title}}
        </div>
    </div>
@endforeach
@props([
    'chapters'
])

@foreach($chapters as $chapter)
    <div class = 'chapter flex-row flex-between' order='{{$chapter->order}}' onclick = 'location.href = "/writer/{{$chapter->book[0]->title}}/{{$chapter->title}}"'>

        <div class = 'flex-row'>
            <div class = 'icon flex-center'>
                <i class = 'bi bi-arrows-move'></i>
            </div>

            <div class = 'name'>
                <span>
                    {{$chapter->title}}
                </span>
            </div>
        </div>

        <div class = 'views flex-row'>
            <i class = 'bi bi-eye'></i>
            <span>{{$chapter->views}}</span>
        </div>
    </div>
@endforeach
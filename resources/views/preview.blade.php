
@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/preview.css'>
    @endpush
@endonce


<x-layout>

    <x-nav.navigation />

    <header class = 'flex-row flex-center'>
        <div class = 'container'>
            <div class = 'left full-h'>
                <img src = '/images/cover_images/{{$book->cover_image}}' class = 'obj-fit'>
            </div>
            <div class = 'right'>
                <h1>{{$book->title}}</h1>

                <p>
                    {{Str::limit($book->description, 500)}}
                </p>

                <button onclick = 'location.href = "/read/{{$book->title}}"'>Start Reading</button>

            </div>

            <div class = 'details flex-row flex-wrap'>

                <div class = 'item flex-row'>
                    <div class = 'key'>Category</div>
                    <div class = 'value'>{{$book->categories[0]->name}}</div>
                </div>
    
                <div class = 'item flex-row'>
                    <div class = 'key'>Tag(s)</div>
                    <div class = 'value'>
                        
                        @php($count = 0)
                            
                        @foreach ($book->tags as $tag)
                            @if($count == 0 || $count == 1)
                                {{$tag->name}},
                                @php($count++)
                            @endif
                            
                        @endforeach

                    </div>
                </div>
    
                <div class = 'item flex-row'>
                    <div class = 'key'>Language</div>
                    <div class = 'value'>{{$book->language[0]->name}}</div>
                </div>
    
                <div class = 'item flex-row'>
                    <div class = 'key'>Author</div>
                    <div class = 'value'>

                        @php($count = 0)

                        @foreach ($book->authors as $author)
                            @if($loop->first || $loop->second)
                                {{$author->name}}
                            @endif
                            @php($count += 1)
                        @endforeach

                        @if($count <= 0)
                            {{$book->user[0]->name}}
                        @endif

                    </div>
                </div>
    
                <div class = 'item flex-row'>
                    <div class = 'key'>Rating</div>
                    <div class = 'value'>{{ $book->rating[0]->name}}</div>
                </div>
            </div>

        </div>
    </header>

    <section>
        <h1>Y<span>ou</span> M<span>ay</span> A<span>lso</span> L<span>ike</span></h1>

        <x-scroll>
            <x-page_result.cards :books='$books' />
        </x-scroll>

    </section>



</x-layout>
@once
    @push('header_links')
        <link rel='stylesheet' href='/styles/admin/books.css'>
        <script src = '/scripts/admin/book.js' defer></script>
    @endpush
@endonce

<x-admin>

    <div class = 'book-panel px-5 py-0 full-w'>
        
        @php
            $options = [
                'title',
                'author',
                'tag',
                'category',
                'character',
                'language',
            ]
        @endphp

        <x-search.admin :filters='$options'/>

        <div class = 'shelf'>

            <div class = 'contianer'>
                <x-row class='title'>
                    <div class = 'title-top'>Image</div>
                    <div class = 'title-top'>Title</div>
                    <div class = 'title-top'>Author</div>
                    <div class = 'title-top'>Views</div>
                    <div class = 'title-top'>Action</div>
                </x-row>
        
                <x-loading-box />
        
                <div class = 'row-items'>
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
                    @endforeach

                    <div class = 'linkss'>
                        {{$books->links()}}
                    </div>
                </div>
            </div>

        </div>

    </div>

    <x-alert.alert />

</x-admin>
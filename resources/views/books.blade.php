@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/books.css'>
        <script>
            const category = "{{$my_category->name ?? ''}}";
        </script>
        <script src = '/scripts/books.js' defer></script>
    @endpush
@endonce

<x-layout>

    <x-nav.navigation />

    <div class = 'search-box flex-row flex-end'>
        <select name = 'filter'>
            <option selected value = 'title' >Filter by Title</option>
            <option value = 'author'>Filter by Author</option>
            <option value = 'tag'>Filter by Tag</option>
            <option value = 'character'>Filter by Character</option>
            <option value = 'language'>Filter by Language</option>
        </select>
    </div>

    <x-search.extended />

    <section class = 'hroizontal-box p-rel'>

        <div class = 'container p-rel'>

            <div class = 'box-box flex-row flex-center'>

                <div class = 'space'></div>

                @if($my_category->name != null)
                    <div class = 'box flex-center flex-col active'>

                        <div class = 'image ov-hidden'>
                            <img src = '/images/category_images/{{$my_category->image}}' class = 'obj-fit'>
                        </div>

                        <div class = 'name text-center'>
                            
                            {{Str::limit($my_category->name ?? '', 10)}}
                        </div>
                    </div>
                @endif

                @foreach($categories as $category)
                    @if($category->name != $my_category->name)
                        <div class = 'box flex-center flex-col' onclick = 'location.href = "/books/{{$category->name}}"'>

                            <div class = 'image ov-hidden'>
                                <img src = '/images/category_images/{{$category->image}}' class = 'obj-fit'>
                            </div>

                            <div class = 'name text-center'>
                                {{Str::limit($category->name ?? '', 10)}}
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class = 'space'></div>


            </div>

        </div>

        <div class = 'control left p-abs full-h top-left flex-center' onclick = "scroll_horizontal('.container', true)">
            <i class = 'bi bi-chevron-left'></i>
        </div>

        <div class = 'control right p-abs full-h top-right flex-center' onclick = "scroll_horizontal('.container', false)"">
            <i class = 'bi bi-chevron-right'></i>
        </div>

    </section>

    <x-loading-box />

    <section class = 'books'>

        <x-grid_box>
            @foreach($books as $book)
                <x-card.card image="cover_images/{{$book->cover_image}}" title="{{$book->title}}" latest="{{$book->latest_chapter}}"/>
            @endforeach

            <div class = 'linkss' style = 'grid-column: 1/-1;'>
                {{$books->links()}}
            </div>
        </x-grid_box>

    </section>

</x-layout>
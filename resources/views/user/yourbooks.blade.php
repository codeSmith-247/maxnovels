@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/books.css'>
        <link rel='stylesheet' href = '/styles/yourbooks.css'>
        <script>const user_id = {{auth()->user()->id}}</script>
        <script src = '/scripts/yourbooks.js' defer></script>
    @endpush
@endonce

<x-layout>

    <x-nav.navigation />

    <section class = 'avatar flex-center flex-col full-w p-2'>
        <div class = 'image ov-hidden round p-rel'>
            <img src = '/images/user_images/{{auth()->user()->image}}' class = 'obj-fit p-rel z-1'>
            <div class = 'overlay p-abs top-left full-hw z-2 flex-center' onclick = 'select("input[name = \"image\"]").click();'>
                <i class = 'bi bi-camera'></i>
            </div>
            <input type='file' accept='images/*' name = 'image' style='visibility: hidden;' onchange = 'update_image(event);'>
        </div>

        <div class = 'name'>
            {{auth()->user()->name}}
        </div>

        <button class = 'flex-row' onclick = 'location.href = "/details";'>
            <i class = 'bi bi-plus'></i>
            <span>New Book</span>
        </button>
    </section>

    <x-search.extended />

    <x-loading-box />


    <section class = 'books'>
        <x-grid_box>
            @foreach($books as $book)
                <x-card.user image="cover_images/{{$book->cover_image}}" title="{!!$book->title!!}" latest="{{$book->latest_chapter}}"/>
            @endforeach

            <div class = 'linkss' style = 'grid-column: 1/-1;'>
                {{$books->links()}}
            </div>
        </x-grid_box>
    </section>

    <x-alert.alert />

</x-layout>
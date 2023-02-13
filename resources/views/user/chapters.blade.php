
@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/books.css'>
        <link rel='stylesheet' href = '/styles/chapters.css'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js" defer></script>
        <script src = '/scripts/chapters.js' defer></script>
        <meta name='book_id'       content='{{ $chapters[0]->book[0]->id ?? ''}}'>

    @endpush
@endonce

<x-layout>

    <x-nav.navigation />

    <x-search.extended />

    
    
    <div class = 'buttons flex-row'>

        <button class = 'active' onclick = 'location.href = "/writer/create/new/{{ $book->id }}";'>
            <i class = 'bi bi-plus'></i>
            <span>Add Chapter</span>
        </button>

        <button onclick = 'publish_prompt();'>Publish All</button>
    </div>

    <section class = 'chapters'>
        <x-page_result.chapters :chapters='$chapters' />
    </section>
    
    <x-loading-box />

    <x-alert.alert />

</x-layout>
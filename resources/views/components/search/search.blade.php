@once
    @push('header_links')
        <link rel='stylesheet' href='/styles/search/search.css'>
    @endpush
@endonce

<div class = 'search flex-row ov-hidden'>

    <input type = 'text' name = 'search' placeholder="Search for a book ...">

    <button>
        <i class = 'bi bi-search'></i>
    </button>
    
</div>
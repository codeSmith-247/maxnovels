@props([
    'filters' => []
])


@once
    @push('header_links')
        <link rel='stylesheet' href='/styles/admin/search.css'>
    @endpush
@endonce


<div class = 'admin-search flex-row flex-between'>

    <button class = 'add-new flex-center'>
        <i class = 'bi bi-plus'></i>
    </button>

    <div class = 'search-box flex-row flex-end py-10'>
        <input type = 'text' name = 'search' placeholder="Type your search here...">

        <select name = 'filter'>
            @foreach ($filters as $filter )
                <option value = '{{$filter}}'>{{$filter}}</option>
            @endforeach
        </select>
    </div>

</div>
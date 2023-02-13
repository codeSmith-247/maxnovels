@once
    @push('header_links')
        <link rel='stylesheet' href='/styles/grid-box.css'>
    @endpush
@endonce

<div class = 'grid-box full-w'>
    {{ $slot }}
</div>
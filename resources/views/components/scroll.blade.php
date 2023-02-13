
@once
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/scroll.css'>
    @endpush
@endonce


<div class = 'scroll p-rel flex-center'>
    <div class = 'control left p-abs round flex-center' onclick = "scroll_horizontal('.scroll-box', true)">
        <i class = 'bi bi-chevron-left'></i>
    </div>

    <div class = 'control right p-abs round flex-center' onclick = "scroll_horizontal('.scroll-box', false)">
        <i class = 'bi bi-chevron-right'></i>
    </div>

    <div class = 'scroll-box'>
        <div class = 'content flex-row'>
            {{ $slot }}
        </div>
    </div>
</div>
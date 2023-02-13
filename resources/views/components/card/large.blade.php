@props([
    'image',
    'name',
    'views',
])

@once
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/cards/large.css' >
    @endpush
@endonce


<div class = 'large-card' onclick="location.href = '/books/{{$name}}';">
    <div class = 'image full-hw ov-hidden'>
        <img src = 'images/category_images/{{$image}}' class = 'obj-fit'>

        <div class = 'details p-abs btm-left full-w'>

            <div class = 'flex-row flex-between'>
            
                <div class = 'name'>
                    {{$name}}
                </div>

                <div class = 'views flex-row'>
                    <div class = 'eye'>
                        <i class = 'bi bi-eye'></i>
                    </div>

                    <span>{{$views}}</span>
                </div>

            </div>

            <div class = 'cover p-abs full-hw'></div>
        </div>
    </div>
</div>
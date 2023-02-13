@props([
    'name' => 'Home',
    'link' => '#',
    'icon' => 'bi-house',
    'different' =>  false,
])

@once
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/navigation/nav-item.css' >
    @endpush
@endonce


    <div @class(['different' => $different, 'nav-item p-rel flex-row flex-center'])>
        
        <div class = 'icon'>
            <i class = 'bi {{ $icon }}'></i>
        </div>

        <a href = "{{ $link }}">{{ $name }}</a>


        <div class = 'underline p-abs'></div>

    </div>

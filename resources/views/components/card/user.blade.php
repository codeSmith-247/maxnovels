@props([
    'image' => 'cover.webp',
    'title' => 'The time traveler\'s handbook',
    'latest' => '35',
])


@once
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/cards/card.css' >
        <link rel = 'stylesheet' href = '/styles/cards/user.css' >
    @endpush
@endonce

<div class = 'card flex-col flex-center p-rel' tabindex="card" main_title = "{!!$title!!}">
    <div class = 'image ov-hidden'>
        <img src = '/images/{{$image}}' class = 'obj-fit'>
    </div>
    <div class = 'details text-center'>
        <h6 class = 'text-center flex-center full-w'>{{$title}}</h6>

        <button class = 'flex-row flex-between p-rel ov-hidden'>
            <span class = 'full-w text-center' onclick = 'chapters(this)' title = "{!!$title!!}" >Continue</span>
            <div class = 'del p-abs top-right flex-center' title = "{!!$title!!}" onclick = 'delete_prompt(this);'>
                <i class = 'bi bi-trash'></i>
            </div>
        </button>

    </div>

    <div class = 'latest flex-row p-abs top-right'>
        <div class = 'tag text-center flex-center'>New</div>
        <div class = 'chapter flex-row text-center flex-center'>
            <span>Chapter</span>
            <span>{{$latest}}</span>
        </div>
    </div>
</div>
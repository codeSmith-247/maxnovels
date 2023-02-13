@props([
    'name',
    'displayName',
    'link' => '#',
])

@once 
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/auth/input.css'>
    @endpush

@endonce


<div class = 'input flex-row flex-start'>
    <input type = 'checkbox' name = '{{$name}}' tabindex="{{$name}}" value='terms_and_condition' style = 'width: max-content; margin-right: .5rem;'>
    <label for='{{$name}}'>
        <a href='{{$link}}'>
        {{$displayName}}
        </a>
    </label>
</div>

@error("$name")
    <x-inputs.error :message='$message'/>
@enderror
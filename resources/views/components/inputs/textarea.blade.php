@props([
    'name',
    'placeholder',
    'displayName',
    'type' => 'text',
    'value' => '',
])

@once 
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/auth/input.css'>
    @endpush

@endonce


<div {{$attributes->merge(['class' => 'input flex-col'])}}>
    <label for='{{$name}}'>{{$displayName}}</label>
    <textarea type = '{{$type}}' name = '{{$name}}' placeholder="{{$placeholder}}" tabindex="{{$name}}" value = '{{$value}}'>{{$value}}</textarea>
</div>

@error("$name")
    <x-inputs.error :message='$message'/>
@enderror
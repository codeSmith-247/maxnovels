@props([
    'name',
    'displayName',
    'optionss' => [],
    'value' => '',
])

@once 
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/auth/input.css'>
    @endpush

@endonce


<div {{$attributes->merge(['class' => 'input flex-col'])}}>
    <label for='{{$name}}'>{{$displayName}}</label>
    @if($value != '')
        <select name = '{{$name}}' tabindex="{{$name}}"  value = '{{$value}}' >
            @foreach($optionss as $option)
                <option value = '{{$option}}'>{{$option}}</option>
            @endforeach

            {{ $slot }}
        </select>
    @else 
        <select name = '{{$name}}' tabindex="{{$name}}" >
            @foreach($optionss as $option)
                <option value = '{{$option}}'>{{$option}}</option>
            @endforeach

            {{ $slot }}
        </select>
    @endif
</div>

@error("$name")
    <x-inputs.error :message='$message'/>
@enderror
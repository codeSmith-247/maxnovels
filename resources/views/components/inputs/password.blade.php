@props([
    'name',
    'placeholder',
    'displayName',
    'value' => '',
])


<div {{$attributes->merge(['class' => 'input flex-col'])}}>
    <label for='{{$name}}'>{{$displayName}}</label>
    <div class = 'p-rel'>
        <input type = 'password' name = '{{$name}}' placeholder="**********" tabindex="{{$name}}">
        <div class = 'show-btn {{$name}} top-right flex-center full-h p-abs px-5'>
            <i class = 'bi bi-eye' onclick = 'show_password("{{$name}}", ".show-btn.{{$name}}");'></i>
            <i class = 'bi bi-eye-slash' onclick = 'show_password("{{$name}}", ".show-btn.{{$name}}");'></i>
        </div>
    </div>
</div>

@error("$name")
    <x-inputs.error :message='$message'/>
@enderror
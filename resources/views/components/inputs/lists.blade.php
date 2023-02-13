@props([
    'name',
    'placeholder',
    'displayName',
    'type' => 'text',
    'tag' => '',
    'value' => [],
])

@once 
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/auth/input.css'>
        <script src = '/scripts/insert.js' defer></script>
    @endpush

@endonce


<div {{$attributes->merge(['class' => 'input flex-col '. $name])}}>

    <label for='{{$name}}'>{{$displayName}}</label>
    <div class = 'p-rel'>

        <input type = '{{$type}}' name = '{{$name}}' placeholder="{{$placeholder}}" tabindex="{{$name}}" onkeydown = 'insert_list_enter(event, "{{$name}}", "{{$tag}}");'>

        <div class = 'add-btn p-abs top-right full-h flex-center' onclick = 'insert_list("{{$name}}")'>
            <i class = 'bi bi-plus'></i>
        </div>

    </div>

    <div class = 'lists flex-row flex-wrap'>
        @foreach ($value as $val )
            <div class = 'item flex-row'>
                <span>{{$val->name}}</span>
                <div class = 'icon round flex-center' onclick = 'remove_itm(this);'>
                    <i class = 'bi bi-x-lg'></i>
                </div>
                <input type = 'hidden' name = '{{$name}}' value = '{{$val->name}}'>
            </div>
        @endforeach
    </div>

</div>

@error("$name")
    <x-inputs.error :message='$message'/>
@enderror

@php($empty = true)

@foreach($users as $user)
    <x-row class="value my-3">
        <div class = 'image p-rel'>

            <img src = '/images/user_images/{{$user->image}}' class = 'obj-fit' />

            @if(Cache::has('user-' . $user->id))
                <div class = 'active-circle p-abs'></div>
            @endif
        </div>
        <div class = 'row-value'>{{$user->name}}</div>
        <div class = 'row-value'>{{$user->email}}</div>
        <div class = 'row-value'>{{$user->views->count()}}</div>
        <div class = 'row-value'>
            <button onclick = 'moderate("{{$user->name}}", "{{$user->email}}", {{Carbon\Carbon::parse($user->date_of_birth)->age}}, {{$user->books->count()}}, {{$user->views->count()}}, "{{$user->role}}", {{$user->id}}, "{{$user->image}}", this)'>Moderate</button>
        </div>
    </x-row>
    @php($empty = false)

@endforeach

@if(!$empty)
    <div class = 'linkss'>
        {{$users->links()}}
    </div>
@endif
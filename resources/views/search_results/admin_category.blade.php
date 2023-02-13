
@php($empty = true)

@foreach($categories as $category)
    <x-row class="value my-3">
        <div class = 'image p-rel'>
            <img src = '/images/category_images/{{$category->image}}' class = 'obj-fit'>
            {{-- <div class = 'active-circle p-abs'></div> --}}

        </div>
        <div class = 'row-value name'>{{$category->name}}</div>
        <div class = 'row-value'>{{$category->books}}</div>
        <div class = 'row-value'>{{$views[$category->name]}}</div>
        <div class = 'row-value'>
            <button onclick = 'moderate("{{$category->name}}", "{{$category->image}}", {{$category->id}}, this)'>Moderate</button>
        </div>
    </x-row>

    @php($empty = false)
@endforeach

@if(!$empty)
    <div class = 'linkss'>
        {{$categories->links()}}
    </div>
@endif
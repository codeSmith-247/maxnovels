
@foreach($categories as $category) 
    <x-card.large name="{{$category->name}}" views="{{$categories_to_views[$category->name]}}" image="{{$category->image}}"/>
@endforeach

<div class = 'linkss' style = 'grid-column: 1/-1;'>
    {{$categories->links()}}
</div>
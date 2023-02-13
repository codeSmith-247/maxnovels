@once
    @push('header_links')
        <link rel='stylesheet' href='/styles/admin/books.css'>
        <script src = '/scripts/admin/category.js' defer></script>
    @endpush
@endonce

<x-admin>

    <div class = 'book-panel px-5 py-0 full-w'>
        @php
            $options = [
                'title',
                'book',
            ]
        @endphp
        <x-search.admin :filters='$options'/>

        <div class = 'shelf'>

            <div class = 'contianer'>
                <x-row class='title'>
                    <div class = 'title-top'>Image</div>
                    <div class = 'title-top'>Name</div>
                    <div class = 'title-top'>Books</div>
                    <div class = 'title-top'>Views</div>
                    <div class = 'title-top'>Action</div>
                </x-row>
        
                <x-loading-box />
        
                <div class = 'row-items'>
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
                    @endforeach

                    <div class = 'linkss'>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>

        </div>

    </div>

    <x-alert.edit />
    <x-alert.alert />

</x-admin>
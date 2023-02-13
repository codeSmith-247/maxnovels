


@once 
    @push('header_links')
        <link rel='stylesheet' href='/styles/details.css'>
        @if(session('edit_book'))
            <script>
                let edit = true;

                @php(session()->forget('edit_book'))
            </script>
        @endif

        <script src = '/scripts/edit_details.js' defer></script>
    @endpush
@endonce

<x-layout>
    <section class = 'details'>
        <div class = 'left flex-center'>

            <div class = 'image p-rel ov-hidden'>

                <img src = '/images/cover_images/{{$book->cover_image}}' class = 'obj-fit'>

                <div class = 'overlay p-abs top-left full-hw z-2 flex-center flex-col text-center' onclick = 'select("[name = \"cover-image\"]").click();'>
                    <i class = 'bi bi-camera'></i>
                    <span>Click to upload your book cover</span>
                </div>

            </div>


        </div>
        
        

        <form class = 'right' method='post' action='/edit_book' enctype="multipart/form-data">
            @csrf
            <div class = 'top flex-row flex-end'>
                <div class = 'submit btn text-center flex-row' onclick = 'location.href = "/";'>
                    <i class = 'bi bi-house'></i>
                    <span>Home</span>
                </div>
            </div>

            @error('cover-image')
                <x-inputs.error :message='$message' />
            @enderror

            <x-inputs.text name="title" displayName="Title" placeholder="The Time Traveler's Handbook" value="{!!$book->title!!}"/>
            <x-inputs.textarea name="description" displayName="Description" placeholder="A cool description of your book" value="{!!$book->description!!}"/>

            @php($value = $book->characters)
            <x-inputs.lists name="characters" displayName="Characters" placeholder="Alexander Smith" :value="$value"/>

            @php($value = $book->categories[0]->id)
            <x-inputs.select name="category" displayName="Category" :value="$value">
                @foreach($categories as $category)
                    @if($category->id == $value)
                        <option value = '{{$category->id}}' selected = "selected">{{$category->name}}</option>
                    @else
                        <option value = '{{$category->id}}'>{{$category->name}}</option>
                    @endif

                @endforeach
            </x-inputs.select>

            @php($value = $book->tags)
            <x-inputs.lists name="tags" displayName="Tags" tag='tag' placeholder="comedy" :value="$value"/>

            @php($value = $book->audience[0]->id)
            <x-inputs.select name="audience" displayName="Target Audience" :value="$value">
                @foreach($audience as $an_audience)
                    @if($an_audience->id == $value)
                        <option value = '{{$an_audience->id}}' selected = "selected" >{{$an_audience->audience}}</option>
                    @else
                        <option value = '{{$an_audience->id}}'>{{$an_audience->audience}}</option>
                    @endif
                    
                @endforeach
            </x-inputs.select>

            @php($value = $book->authors)
            <x-inputs.lists name="authors" displayName="Authors" placeholder="Alexander Smith" :value="$value"/>

            @php($value = $book->language[0]->id)
            <x-inputs.select name="language" displayName="Language" :value="$value">
                @foreach($languages as $language)
                    @if($language->id == $value)
                        <option value = '{{$language->id}}' selected = "selected">{{$language->name}}</option>
                    @else
                        <option value = '{{$language->id}}'>{{$language->name}}</option>
                    @endif
                    
                @endforeach
            </x-inputs.select>
            
            @php($value = $book->rating[0]->id)
            <x-inputs.select name="rating" displayName="Rating" :value="$value">
                @foreach($ratings as $rating)
                    @if($rating->id == $value)
                        <option value = '{{$rating->id}}' selected = "selected">{{$rating->name}}</option>
                    @else
                        <option value = '{{$rating->id}}'>{{$rating->name}}</option>
                    @endif
                @endforeach
            </x-inputs.select>

            <input type='file' name='cover-image' accept='image/*' style='visibility: hidden;' onchange = 'update_cover_image(event);'>

            <input type='hidden' name='book_id' value='{{$book->id}}'>

            <script defer>
                function update_cover_image(self) {
                    let images = self.target.files;

                    if(images.length > 0) {
                        let url = URL.createObjectURL(images[0]);
                        select('.left .image img').src = url;
                    }

                }
                
                selectAll('select').forEach( select => {
                  select.value = select.getAttribute('value');
                }) 
            </script>

            <div class = 'flex-row flex-end'>
                <div class = 'submit btn btm text-center' onclick = 'submit();'>
                    <span>Submit</span>
                </div>
            </div>

        </form>
    </section>

    <x-alert.alert />

</x-layout>


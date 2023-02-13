@once 
    @push('header_links')
        <link rel='stylesheet' href='/styles/details.css'>
    @endpush
@endonce

<x-layout>
    <section class = 'details'>
        <div class = 'left flex-center'>

            <div class = 'image p-rel ov-hidden'>

                <img src = '/images/cover.webp' class = 'obj-fit'>

                <div class = 'overlay p-abs top-left full-hw z-2 flex-center flex-col text-center' onclick = 'select("[name = \"cover-image\"]").click();'>
                    <i class = 'bi bi-camera'></i>
                    <span>Click to upload your book cover</span>
                </div>

            </div>


        </div>
        <form class = 'right' method='post' action='/create_book' enctype="multipart/form-data">
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

            <x-inputs.text name="title" displayName="Title" placeholder="The Time Traveler's Handbook"/>
            <x-inputs.textarea name="description" displayName="Description" placeholder="A cool description of your book"/>
            <x-inputs.lists name="characters" displayName="Characters" placeholder="Alexander Smith"/>

            <x-inputs.select name="category" displayName="Category">
                @foreach($categories as $category)
                    <option value = '{{$category->id}}'>{{$category->name}}</option>
                @endforeach
            </x-inputs.select>

            <x-inputs.lists name="tags" displayName="Tags" tag='tag' placeholder="comedy"/>

            <x-inputs.select name="audience" displayName="Target Audience">
                @foreach($audience as $an_audience)
                    <option value = '{{$an_audience->id}}'>{{$an_audience->audience}}</option>
                @endforeach
            </x-inputs.select>

            <x-inputs.lists name="authors" displayName="Authors" placeholder="Alexander Smith"/>

            <x-inputs.select name="language" displayName="Language">
                @foreach($languages as $language)
                    <option value = '{{$language->id}}'>{{$language->name}}</option>
                @endforeach
            </x-inputs.select>

            <x-inputs.select name="rating" displayName="Rating">
                @foreach($ratings as $rating)
                    <option value = '{{$rating->id}}'>{{$rating->name}}</option>
                @endforeach
            </x-inputs.select>

            <input type='file' name='cover-image' accept='image/*' style='visibility: hidden;' onchange = 'update_cover_image(event);'>

            <script>
                function update_cover_image(self) {
                    let images = self.target.files;

                    if(images.length > 0) {
                        let url = URL.createObjectURL(images[0]);
                        select('.left .image img').src = url;
                    }

                }
            </script>

            <div class = 'flex-row flex-end'>
                <div class = 'submit btn btm text-center' onclick = 'submit();'>
                    <span>Submit</span>
                </div>
            </div>

        </form>
    </section>
</x-layout>
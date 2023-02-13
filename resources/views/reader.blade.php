@once
    @push('header_links')

        <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.bubble.css">
        <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>

        <link rel='stylesheet' href = '/styles/reader.css'>

        <meta name = 'book' content = '{{$book->id}}'>
        <meta name = 'book_title' content = '{{$book->title}}'>
        <meta name = 'chapter' content = '{{$chapter->id}}'>
        <meta name = 'chapter_title' content = '{{$chapter->title}}'>
        <meta name = 'content' content = '{{$chapter->published}}'>

        <script src = '/scripts/reader.js' defer></script>
    @endpush
@endonce

<x-layout>

    <x-alert.alert />
    
    <div class = 'banner p-rel full-vw'>
        <img src = '/images/cover_images/{{$book->cover_image}}' class = 'obj-fit p-rel z-1'>

        <div class = 'overlay p-abs top-left full-hw z-2 flex-col flex-center text-center'>
            <h1>{{$book->title}}</h1>

            <div class = 'author flex-row'>
                <div class = 'avatar round ov-hidden'>
                    <img src = '/images/cover.webp' class = 'obj-fit'>
                </div>
    
                <div class = 'name text-center'>
                    @php($count = 0)

                    @foreach ($book->authors as $author)
                        @if($loop->first || $loop->second)
                            {{$author->name}}
                        @endif
                        @php($count += 1)
                    @endforeach

                    @if($count <= 0)
                        {{$book->user[0]->name}}
                    @endif
                </div>
            </div>
        </div> 
    </div>

    <nav class = 'nav flex-row flex-between'>
        <div class = 'flex-row'>
            <div class = 'menu-btn flex-center' onclick='toggle_itm(".menu"); toggle_itm(".reader-area");'>
                <i class = 'bi bi-list'></i>
            </div>
        </div>

        <div class = 'chapter flex-row'>
            <div class = 'control left full-h flex-center round'  onclick='location.href = "/prev/{{$book->title}}/{{$chapter->order}}";'>
                <i class = 'bi bi-chevron-left'></i>
            </div>

            <h4 class = 'text-center'>{{$chapter->title}}</h4>

            <div class = 'control right full-h flex-center round' onclick='location.href = "/next/{{$book->title}}/{{$chapter->order}}";'>
                <i class = 'bi bi-chevron-right'></i>
            </div>
        </div>

        <div class = 'flex-row'>
            <div class = 'menu-btn bookmark flex-center {{ $bookmark ? 'active' : ''}}' onclick = 'bookmark();'>
                <i class = 'bi bi-bookmark'></i>
                <i class = 'bi bi-bookmark-fill'></i>
            </div>
        </div>

    </nav>

    <section class = 'reader-area'>
        <div class = 'menu'>
            <div class = 'close-box flex-row flex-end px-5' onclick="deactivate_itm('.menu')">
                <i class = 'bi bi-x-lg'></i>
            </div>


            <div class = 'tab_select flex-row'>
                <div class = 'chapters p-5  py-3 active' onclick = 'see_chapters();'>Chapters</div>
                <div class = 'bookmarks p-5 py-3' onclick = 'see_bookmarks();'>Bookmarks</div>
            </div>

            <div class = 'chapter-menu'>
            @foreach($book->chapters as $menu_chapter)
                @if($menu_chapter->state == 'published')

                    <div class = 'menu-item flex-row {{$menu_chapter->title == $chapter->title ? 'active' : ''}}' onclick = 'location.href = "/read/{{$book->title}}/{{$menu_chapter->title}}";'>
                        <i class = 'bi bi-box'></i>
                        <span>{{$menu_chapter->title}}</span>
                    </div>

                @endif
            @endforeach
            </div>

            <div class = 'bookmark-menu disabled'>
                @php($empty = true)
                @foreach($bookmarks as $bookmark)
                    {{-- @if($menu_chapter->state == 'published') --}}
                        @php($empty = false)
                        <div class = 'menu-item  flex-row {{$bookmark->chapter->title == $chapter->title ? 'active' : ''}}' onclick = 'location.href = "/read/{{$book->title}}/{{$bookmark->chapter->title}}";'>
                            <i class = 'bi bi-bookmark'></i>
                            <span>{{$bookmark->chapter->title}}</span>
                        </div>
    
                    {{-- @endif --}}
                @endforeach

                @if($empty) 
                        <p class = 'text-center py-5'><small>No bookmarks</small></p>
                @else
                    <p class = 'text-center py-5' style = 'display: none;'><small>No bookmarks</small></p>
                @endif
            </div>

        </div>

        <div class = 'reader-slate'>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit alias repellat similique rerum mollitia tempore, nisi assumenda, veniam error eaque ut vero quae fugit dolor quia magni? Saepe voluptatum magni accusantium blanditiis, ab beatae excepturi nobis! Ea magnam, optio officiis architecto numquam atque vel rerum dolore saepe suscipit sequi fugiat voluptas iure dolor repellendus nihil eligendi maxime debitis illum omnis. Qui nisi animi recusandae cupiditate maxime mollitia vitae praesentium omnis quibusdam nam natus dolore, ex ipsum veritatis nihil! Ut molestias autem aliquid, iure, id dolorum tenetur laborum natus voluptatem, cum nisi aperiam officia sapiente optio doloribus asperiores. Incidunt consectetur, earum delectus, placeat expedita explicabo officia tempore accusantium voluptatem praesentium eaque, porro accusamus omnis ad nesciunt obcaecati et autem! Ut ea in commodi culpa explicabo cupiditate vel voluptatem, repellat voluptates laborum esse, nam perferendis expedita fuga ab hic magni repudiandae maxime tenetur soluta. Consequatur corporis dolore, nostrum deleniti quia sit provident quas itaque aperiam earum ea sunt veritatis cumque iste assumenda nobis maxime quod consequuntur. Deleniti amet veniam doloremque magni, voluptate cum mollitia similique pariatur expedita praesentium animi reprehenderit non! Ipsa sunt inventore iusto reiciendis porro dolor vel maxime non sint rem amet blanditiis nisi soluta quod laudantium assumenda ducimus molestiae minima quasi ea, consequuntur eos nesciunt voluptatibus nulla. Perspiciatis quas fugiat suscipit quo natus, expedita quis consequatur quasi rerum totam officia ad debitis? Dicta amet repudiandae harum molestias beatae atque eligendi porro cupiditate dolorem in. Vero tempora nostrum architecto mollitia saepe rerum repudiandae corrupti alias aliquid quod. Explicabo, dolores a. Possimus magni repudiandae at inventore necessitatibus laudantium consequatur totam minus! Tempore, adipisci cum, earum ab sunt quibusdam est culpa excepturi quisquam magnam voluptatibus? Magnam at quo veritatis tempore, facere, excepturi amet harum in vel adipisci natus suscipit reiciendis inventore dolorum fugit quam? Ab quibusdam inventore odio doloremque ipsam, omnis libero? Pariatur laudantium necessitatibus doloremque neque, sed voluptatibus delectus magni tempore! Optio necessitatibus in, exercitationem blanditiis nulla minima reprehenderit iure odit debitis? Quaerat nobis tenetur tempore, quas aut velit provident suscipit iste minima, labore veniam assumenda? Soluta similique rem eum expedita ea amet cumque voluptate, consequuntur nesciunt error magni consectetur. Mollitia inventore ea officiis iusto ab ullam ex quo illum, corrupti reprehenderit commodi ipsum minus dolor modi, soluta voluptatibus aut? Placeat quos atque sed inventore nihil hic sit consequatur reprehenderit voluptatum aliquid vel ullam illum similique eveniet distinctio debitis repudiandae temporibus error quis mollitia cum maxime, praesentium ut. Commodi ea distinctio beatae. Mollitia delectus et, dignissimos omnis molestias officiis aperiam ipsum expedita soluta ducimus laboriosam temporibus maiores voluptates consequatur voluptatibus commodi, quas asperiores, autem voluptate illum tenetur sunt dolore eum explicabo. Magni repellat debitis nesciunt blanditiis amet asperiores sunt cumque animi nam quibusdam, ipsa, numquam dolores non, at ab velit! Velit distinctio dignissimos perspiciatis ut impedit, provident ipsum sint eveniet magni id doloremque excepturi, iure omnis repellat! Porro sint non eligendi, asperiores autem sunt voluptates voluptatem maiores vel? Doloribus nemo exercitationem distinctio hic itaque perferendis possimus voluptatem id eius dolore numquam tempore beatae vero obcaecati corrupti dicta sed, eum maiores deleniti!
        </div>

        <div class = 'add-area'></div>
    </section>

</x-layout>
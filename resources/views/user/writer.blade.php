


@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/writer.css'>
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

       
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src = '/scripts/writer.js' defer></script>
        <meta name='book_title'       content='{{ $book->title }}'>
        <meta name='book'       content='{{ $book->id }}'>
        <meta name='chapter'    content='{{ $chapter->id }}'>
        <meta name='draft'      content='{{ $chapter->draft }}'>
    @endpush
@endonce


<x-layout>
    <x-alert.alert />

    <nav class = 'flex-row flex-between px-5'>
        <div class = 'book-name pointer' onclick = 'location.href = "/chapters/{{$book->title}}"'>
            {{$book->title}}
        </div>

        <div class = 'buttons flex-row'>
            <button class = 'save' onclick = 'save();'>Save</button>
            <button onclick = 'save(false);'>Publish</button>
        </div>
    </nav>

    <div class = 'chapter-title'>
        <input type = 'text' name = 'title' placeholder="Chapter Title" value = '{{$chapter->title}}'>
    </div>

    <div id='editor' onchange = 'alert("changed");'>

    </div>

    <div class = 'icon-delete flex-center round p-fix' onclick = 'delete_prompt();'>
        <i class = 'bi bi-trash'></i>
    </div>

</x-layout>

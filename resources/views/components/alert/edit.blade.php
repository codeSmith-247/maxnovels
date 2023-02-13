
@props([
    'options' => '',
])


@once
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/alert.css'>
        <script src = '/scripts/alert.js' defer></script>
    @endpush
@endonce

<div class = 'alert-case edit p-fix full-vhw top-left flex-center z-4'>

<div class = 'alert-box'>

    <div class = 'top flex-row flex-between'>

        <h1 class = 'label'></h1>

        <div class = 'icon flex-center' onclick = 'deactivate_itm(".alert-case.edit");'>
            <i class = 'bi bi-x-lg'></i>
        </div>

    </div>

    <div class = 'alert-content edit flex-row p-rel'>

        <div class = 'left half-w '>
            <div class = 'image-box ov-hidden full-w p-rel'>
                <img src = '/images/cover.webp' class = 'obj-fit'>
                <div class = 'overlay full-hw top-left flex-center flex-col p-abs' onclick = 'select("[type = \"file\"]").click();'>
                    <i class = 'bi bi-camera'></i>
                    <span>Click to insert an image</span>
                    <input type='file' accept='images/*' name = 'image' style='visibility: hidden;' onchange = 'insert_alert_image(event);'>
                </div>
            </div>
            {{-- <button class = 'full-w'>Insert Image</button> --}}
        </div>

        <div class = 'right half-w full-h '>

            <x-inputs.text class='text' name="input" displayName="Title" placeholder="The Time Traveler's Handbook"/>
            <x-inputs.select class='select' name="select" displayName="Category" :options='$options' />

            <div class = 'button-case flex-row flex-center p-abs btm-right my-2 full-w half-w'>
                <button class = 'del'>Delete</button>
                <button class = 'second'>Update</button>
            </div>
        </div>

    </div>

</div>

</div>
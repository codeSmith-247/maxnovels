
@once
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/alert.css'>
        <script src = '/scripts/alert.js' defer></script>
    @endpush
@endonce

<div class = 'alert-case alert p-fix full-vhw top-left flex-center z-4'>

    <div class = 'alert-box'>

        <div class = 'top flex-row flex-between'>

            <h1></h1>

            <div class = 'icon flex-center' onclick = 'deactivate_itm(".alert-case.alert");'>
                <i class = 'bi bi-x-lg'></i>
            </div>

        </div>

        <div class = 'alert-content flex-col flex-center'>

            <div class = 'alert-icon round ov-hidden flex-center'>
                <img src = '/images/success.webp' class = 'obj-fit success'>
                <img src = '/images/error.gif' class = 'obj-fit error'>
                <img src = '/images/warning.gif' class = 'obj-fit warning'>
                <img src = '/images/spinner.gif' class = 'obj-fit darkmode loading'>
                <img src = '/images/loading-load.gif' class = 'obj-fit lightmode loading'>
            </div>

            <div class = 'text'>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo, est.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo, est.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo, est.
                </p>
            </div>

            <div class = 'button-case flex-center'>
                <button class = 'first'>Ok</button>
                <button class = 'second'>Cancel</button>
            </div>

        </div>

    </div>

</div>
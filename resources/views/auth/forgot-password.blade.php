@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/auth/login.css'>

        @if(session()->has('password_sent'))
            <script defer>
                const status_message = "Password resent link has been sent to your email";
            </script>
            @php(session()->forget('password_sent'))
        @endif
        
    @endpush
@endonce


<x-layout>
    

    <section class = 'login'>

        <form method = 'POST' class = 'flex-col-center'>
            {{-- <div class = 'logo-box'>
                <x-nav.logo />
            </div> --}}

            @csrf

            <h1>
                P<span>assword</span> R<span>eset</span>
            </h1>

            <x-inputs.text
                name='email'
                type='email'
                displayName='Email'
                placeholder="info@maxnovels.com"
            />


            <div class = 'input button'>
                <button>
                    Reset Password
                </button>
            </div>

        </form>

        

        <div class = 'image-box p-rel z-1'>
            <img src = '/images/login.webp' class = 'obj-fit p-rel z-1'>
            <div class = 'overlay obj-fit p-abs z-2 top-left'></div>
        </div>


    </section>

    <x-alert.alert />
    
    <script src = '/scripts/verify.js' defer></script>


</x-layout>
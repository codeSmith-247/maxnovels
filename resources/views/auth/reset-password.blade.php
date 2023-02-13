@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/auth/login.css'>
        <link rel='stylesheet' href = '/styles/auth/signup.css'>
        <script src = '/scripts/signup.js' defer></script>
    @endpush
@endonce

<x-layout>

    <section class = 'login'>

        <form method = 'POST' action = '/reset-password'>
            {{-- <div class = 'logo-box'>
                <x-nav.logo />
            </div> --}}

            @csrf

            <h1>
                R<span>eset</span> P<span>assword</span>
            </h1>

            <x-inputs.text
                name='email'
                type='email'
                displayName='Email'
                placeholder="info@maxnovels.com"
            />

            <x-inputs.password
                name='password'
                displayName='Password'
            />

            <x-inputs.password
                name='password_confirmation'
                displayName='Repeat Password'
            />

            <input type = 'hidden' name = 'token' value = "{{$token}}" />


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
</x-layout>
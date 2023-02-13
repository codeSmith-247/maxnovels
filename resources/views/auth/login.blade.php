@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/auth/login.css'>
    @endpush
@endonce

<x-layout>

    <section class = 'login'>

        <form method = 'POST'>
            {{-- <div class = 'logo-box'>
                <x-nav.logo />
            </div> --}}

            @csrf

            <h1>
                W<span>elcome</span> B<span>ack</span>
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

            <div class = 'input button'>
                <button>
                    Log In
                </button>
            </div>

            <div class = 'input text-center info'>
                <span> <a href='/forgot-password'>Forgot your password?</a> </span>
            </div>

            <div class = 'input text-center info'>
                <span>Dont have an account? <a href='/signup'>Sign Up</a> </span>
            </div>

            <div class = 'input button'>
                {{-- <button>
                    <i class = 'bi bi-facebook'></i>
                    <span>Log in with Facebook</span>
                </button> --}}

                <button class = 'red' style='margin: .5rem 0' onclick = 'event.preventDefault(); location.href = "/google/redirect";'>
                    <i class = 'bi bi-google'></i>
                    <span>Log in with Google</span>
                </button>
            </div>

        </form>

        

        <div class = 'image-box p-rel z-1'>
            <img src = '/images/login.webp' class = 'obj-fit p-rel z-1'>
            <div class = 'overlay obj-fit p-abs z-2 top-left'></div>
        </div>
    </section>
</x-layout>
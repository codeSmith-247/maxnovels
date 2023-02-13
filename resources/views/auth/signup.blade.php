@once
    @push('header_links')
        <link rel='stylesheet' href = '/styles/auth/login.css'>
        <link rel='stylesheet' href = '/styles/auth/signup.css'>
        <script src = '/scripts/signup.js' defer></script>
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
                S<span>ign</span> U<span>p</span>
            </h1>

            {{-- <p>
                enjoy our collection of books, get inspired, inspire a generation
            </p> --}}

            <x-inputs.text
                name='name'
                displayName='Full Name'
                placeholder="Samuel Jackson"
            />

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

            @php($gender_list = ['male', 'female'])

            <x-inputs.select
                name='gender'
                displayName='Gender'
                :optionss='$gender_list'
            />

            <x-inputs.date />

            
            <div class = 'input text-center info'>
                <span>By Signing up you automatically agree to our <a href='/terms-and-conditions'>Terms and Conditions</a> and <a href='/privacy-policy'>Privacy Policy</a> </span>
            </div>

            <div class = 'input button'>
                <button>
                    Sign Up
                </button>
            </div>

            <div class = 'input text-center info'>
                <span>Already have an account? <a href='/login'>Log in</a> </span>
            </div>

            <div class = 'input button'>

                <button class = 'red' style='margin: .5rem 0' onclick = 'event.preventDefault(); location.href = "/google/redirect";'>
                    <i class = 'bi bi-google'></i>
                    <span>Sign in with Google</span>
                </button>
            </div>

        </form>

        

        <div class = 'image-box p-rel z-1'>
            <img src = '/images/login.webp' class = 'obj-fit p-rel z-1'>
            <div class = 'overlay obj-fit p-abs z-2 top-left'></div>
        </div>
    </section>
</x-layout>
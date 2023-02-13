
@once
@push('header_links')
    <link rel='stylesheet' href = '/styles/verify.css'>

@endpush
@endonce

<x-layout>
    <x-nav.navigation />
    <div class = 'verify-email full-vhw flex-center flex-col'>
        <h1>Email Verification</h1>
        <p>Please check your email for a verification link, click the link to verify your account and <a href = '/login'>Log in</a></p>
        <form method='post' action = '/email/verification-notification'>
            @csrf
            <button> Resend Verification Email</button>
        </form>
    </div>

    <x-alert.alert />

    @if(session()->has('verification'))
    <script defer>
        const verify = true;
    </script>
    @endif
    <script src = '/scripts/verify.js' defer></script>


</x-layout>
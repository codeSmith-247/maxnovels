@once
    @push('header_links')
        <link rel = 'stylesheet' href = '/styles/navigation/navigation.css'>
    @endPush
@endonce

<nav class = 'flex-between flex-row'>

    <x-nav.logo/>

    <div class = 'nav-links flex-row'>

        <div class = 'nav-links-top flex-row flex-end'>
            <i class = 'bi bi-x-lg' onclick = 'deactivate_itm(".nav-links")'></i>
        </div>

        <x-nav.nav_item link='/'/>
        <x-nav.nav_item name="Collections" icon='bi-collection' link='/collections' />
        <x-nav.nav_item name="Books" icon='bi-journal-bookmark' link='/books' />
        <x-nav.nav_item name="Start Writing" icon='bi-pen' link='/yourbooks' />

        @guest
            <x-nav.nav_item name="Log In" icon='bi-box-arrow-in-left' link='/login' />
            @php($diff = true)
            <x-nav.nav_item name="Sign Up" icon='bi-person' link='/signup' :different='$diff'/>
        @endguest

            
        @auth


            <form method = 'POST' action = '/logout' onclick = 'this.submit();'>
                @csrf
                <x-nav.nav_item name="Log out" icon='bi-box-arrow-left' />
            </form>

        @endauth
    </div>

    <div class = 'nav-btn flex-center' onclick = 'activate_itm(".nav-links")'>
        <i class = 'bi bi-list'></i>
    </div>

</nav>

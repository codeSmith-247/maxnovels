
@once
   @push('header_links')
       <link rel='stylesheet' href = '/styles/admin/admin.css'>
   @endpush 
@endonce

<x-layout >

    <section class = 'admin-panel'>

        <div class = 'menu p-rel'>

            <div class = 'menu-close p-abs top-right px-3 py-2' onclick = 'toggle_itm(".admin-panel")'>
                <i class = 'bi bi-x-lg'></i>
            </div>

            <div class = 'menu-top flex-center'>
                <x-nav.logo />
            </div>
            <div class = 'menu-content'>

                <div class = 'menu-item flex-row' onclick = 'location.href = "/admin";'>
                    <i class = 'bi bi-boxes'></i>
                    <span>Dashboard</span>
                </div>

                <div class = 'menu-item flex-row' onclick = 'location.href = "/admin/books";'>
                    <i class = 'bi bi-journals'></i>
                    <span>Books</span>
                </div>

                <div class = 'menu-item flex-row' onclick = 'location.href = "/admin/categories";'>
                    <i class = 'bi bi-collection'></i>
                    <span>Category</span>
                </div>
                
                @if(auth()->user()->role == 'super user')

                <div class = 'menu-item flex-row' onclick = 'location.href = "/admin/users";'>
                    <i class = 'bi bi-people'></i>
                    <span>Users</span>
                </div>
                
                @endif

            </div>
        </div>

        <div class = 'content-area p-rel full-w'>
            <div class = 'nav flex-row flex-between'>
                <div class = 'menu-btn' onclick = 'toggle_itm(".admin-panel")'>
                    <i class = 'bi bi-list'></i>
                </div>

                <div class = 'avatar flex-row'>

                    <div class = 'image round ov-hidden'>
                        <img src = '/images/user_images/{{auth()->user()->image}}' class = 'obj-fit'>
                    </div>

                    <div class = 'name'>
                        {{auth()->user()->name}}
                    </div>

                </div>
            </div>

            <div class = 'content full-w'>
                {{ $slot }}
            </div>
        </div>

    </section>


</x-layout>
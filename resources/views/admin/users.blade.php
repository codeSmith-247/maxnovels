@once
    @push('header_links')
        <link rel='stylesheet' href='/styles/admin/books.css'>
        <link rel='stylesheet' href='/styles/admin/users.css'>

        <script src = '/scripts/admin/user.js' defer></script>
    @endpush
@endonce

<x-admin>

    <div class = 'book-panel px-5 py-0 full-w'>
        @php
            $options = [
                'Name',
                'Email',
                'Age >',
                'Age <',
                'Age =',
                'DOB',
                'Book',
                'Online'
            ]
        @endphp
        <x-search.admin :filters='$options'/>

        <div class = 'shelf'>

            <div class = 'contianer'>
                <x-row class='title'>
                    <div class = 'title-top'>Image</div>
                    <div class = 'title-top'>Name</div>
                    <div class = 'title-top'>Email</div>
                    <div class = 'title-top'>Views</div>
                    <div class = 'title-top'>Action</div>
                </x-row>

                <x-loading-box />
        
                <div class = 'row-items'>
    
                    @foreach($users as $user)
                        <x-row class="value my-3">
                            <div class = 'image p-rel'>

                                <img src = '/images/user_images/{{$user->image}}' class = 'obj-fit' />

                                @if(Cache::has('user-' . $user->id))
                                    <div class = 'active-circle p-abs'></div>
                                @endif
                            </div>
                            <div class = 'row-value'>{{$user->name}}</div>
                            <div class = 'row-value'>{{$user->email}}</div>
                            <div class = 'row-value'>{{$user->views->count()}}</div>
                            <div class = 'row-value'>
                                <button onclick = 'moderate("{{$user->name}}", "{{$user->email}}", {{Carbon\Carbon::parse($user->date_of_birth)->age}}, {{$user->books->count()}}, {{$user->views->count()}}, "{{$user->role}}", {{$user->id}}, "{{$user->image}}", this)'>Moderate</button>
                            </div>
                        </x-row>
                    @endforeach

                </div>
            </div>

        </div>

    </div>

    <div class = 'user_moderate_case p-fix top-left z-3 full-vhw flex-center'>

        <div class = 'moderate_box p-rel'>

            <div class = 'close-btn p-abs round flex-center' onclick = 'deactivate_itm(".user_moderate_case");'>
                <i class = 'bi bi-x-lg'></i>
            </div>

            <div class = 'left p-1 flex-center flex-col'>

                <div class = 'user_image_box ov-hidden'>
                    <img src = '/images/user_images/{{auth()->user()->image}}' class = 'obj-fit'>
                    <input type='file' accept='images/*' name = 'image' style='visibility: hidden;' onchange = 'insert_alert_image_2(event);'>
                </div>

                <button onclick = 'select("[type = \"file\"]").click();'>Change Image</button>
            </div>

            <div class = 'right'>
                <div class = 'content'>
    
                    @php( $options = [
                        'user',
                        'admin',
                        'super user',
                    ])
    
                    <x-inputs.select
                        name='role'
                        displayName='Role'
                        value="20"
                        :optionss="$options"
                    />
    
                    <x-inputs.text
                        name='fullname'
                        type='text'
                        displayName='Full Name'
                        placeholder="Jhon Jackson"
                        value="info@maxnovels.com"
                        properties="disabled"
                    />
    
                    <x-inputs.text
                        name='email'
                        type='email'
                        displayName='Email'
                        placeholder="info@maxnovels.com"
                        value="info@maxnovels.com"
                        properties="disabled"
                    />
    
                    <x-inputs.text
                        name='age'
                        type='age'
                        displayName='Age'
                        placeholder="20"
                        value="20"
                        properties="disabled"
                    />
    
                    <x-inputs.text
                        name='books'
                        type='text'
                        displayName='Books Contributed'
                        placeholder="20"
                        value="20"
                        properties="disabled"
                    />
    
                    <x-inputs.text
                        name='views'
                        type='text'
                        displayName='Chapters Read'
                        placeholder="20"
                        value="20"
                        properties="disabled"
                    />
    
                </div>
                <div class = 'btn-box flex-row px-5 py-1 flex-between'>
                    <button class = 'del'>Delete</button>
                    <button class = 'update'>Update</button>
                </div>
            </div>
        </div>


    </div>

    <x-alert.alert />
</x-admin>
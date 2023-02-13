@once 
    @push('header_links')
        <link rel='stylesheet' href = '/styles/admin/dashboard.css'>
    @endpush
@endonce

<x-admin>
    <div class = 'preview-cards'>
        <div class = 'card flex-col flex-center'>
            <div class = 'value'>
                {{$user_count}}
            </div>
            <div class = 'identity'>
                Users
            </div>
        </div>
        <div class = 'card flex-col flex-center'>
            <div class = 'value'>
                {{$book_count}}
            </div>
            <div class = 'identity'>
                Books
            </div>
        </div>
        <div class = 'card flex-col flex-center'>
            <div class = 'value'>
                {{$visits}}
            </div>
            <div class = 'identity'>
                Visits Today
            </div>
        </div>
        <div class = 'card flex-col flex-center'>
            <div class = 'value'>
                {{$view_count}}
            </div>
            <div class = 'identity'>
                Views
            </div>
        </div>
    </div>

    <div class = 'split flex-row full-w p-1'>
        <div class = 'left half-w'>

            <x-row class='top'>
                <div class = 'heading'>Active Users</div>
                <button>View All</button>
            </x-row>

            @foreach($active_users as $user)
                @if(Cache::has('user-' . $user->id))

                    <x-row class='no-p my-3'>

                        <div class = 'avatar flex-row'>

                            <div class = 'image p-rel'>

                                <img src = '/images/user_images/{{$user->image}}' class = 'obj-fit' />
                              
                                <div class = 'active-circle p-abs'></div>
                            </div>

                            <div class = 'name'>
                                {{ $user->name }}
                            </div>

                        </div>

                    </x-row>

                @endif
            @endforeach
        </div>

        <div class = 'right half-w flex-center'>
            <canvas id = 'pie' class = 'full-hw'></canvas>
        </div>
    </div>
</x-admin>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js" ></script>
<script defer>

    const data = {
        labels: [
            @foreach($categories as $category)
                '{{$category->name}}',
            @endforeach  
        ],
        datasets: [{
            data: [
                @foreach($categories as $category)
                    {{$category->books->count()}},
                @endforeach
            ],
            Color: 'white',
            hoverOffset: 4
        }]
    };

    const ctx = document.getElementById('pie').getContext('2d');
    Chart.defaults.color = '#fff';
    const chart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
    });

    
</script>
@once 
    @push('header_links')
        <link rel='stylesheet' href = '/styles/admin/row.css'>
    @endpush
@endonce

<div {{$attributes->merge(['class' => 'row full-w flex-row flex-between'])}}>
    {{ $slot }}
</div>
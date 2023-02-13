@once 
    @push('header_links')
        <link rel='stylesheet' href = '/styles/loading.css'>
    @endpush
@endonce


<div class = 'loading p-abs top-left full-hw flex-center flex-col'>
    <div class = 'imagee ov-hidden round flex-center'>
        <img src = '/images/spinner.gif' class = 'obj-fit darkmode'>
        <img src = '/images/loading-load.gif' class = 'obj-fit lightmode'>

        <img src = '/images/error2.gif' class = 'obj-fit errorr'>
    </div>

    <div class = 'errorr text-center py-5'>Result not found</div>
</div>
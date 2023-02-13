

<div class = 'input flex-col' style='margin-bottom: 1rem;'>
    <label>Date of Birth</label>
    <div class = 'date-box flex-row flex-between'>

        <div class = 'year'>
        </div>

        <div class = 'month'>

            <select id='month' name='month' value = '{{old('month')}}'>
                <option>Month</option>
                <option value='01'>January</option>
                <option value='02'>February</option>
                <option value='03'>March</option>
                <option value='04'>April</option>
                <option value='05'>May</option>
                <option value='06'>June</option>
                <option value='07'>July</option>
                <option value='08'>August</option>
                <option value='09'>September</option>
                <option value='10'>October</option>
                <option value='11'>November</option>
                <option value='12'>December</option>
            </select>

        </div>

        <div class = 'day'>
        </div>
    </div>
</div>

@php($error = false)

@error("year")
    @php($error = true)
@enderror

@error("month")
    @php($error = true)
@enderror

@error("day")
    @php($error = true)
@enderror

@if($error)
<x-inputs.error message='Please provide your date of birth'/>

@endif
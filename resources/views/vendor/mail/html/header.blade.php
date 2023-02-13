<tr>
<td class="header" style = 'width: 100%;'>
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://maxnovels.com/images/logo.png" class="logo" alt="Maxnovels Logo" style = 'object-fit: contain;'>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

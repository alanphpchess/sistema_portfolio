@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Sistema')
<img src="" class="logo" alt="Sistema" width="200">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

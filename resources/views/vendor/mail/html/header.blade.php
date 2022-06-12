<tr>
<td class="header">
{{-- <a href="{{ $url }}" style="display: inline-block;"> --}}
@if (trim($slot) === 'Laravel')
{{-- <img src="https://ipctpk.co.id/wp-content/uploads/2020/10/logo-fix-color-1.png"> --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel' || trim($slot) === 'Venda Truck Finance')
<img src="https://vendatruck.com.br/wp-content/uploads/2023/01/logo-site-vetor.svg" class="logo" alt="{{ config('app.name') }}" style="height: 80px; width: 280px;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

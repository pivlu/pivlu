<a class="navbar-brand" href="{{ url('/') }}">
    @if ($config->logo_url ?? null)
        <img src="{{ $config->logo_url }}" alt="{{ $config->site_name ?? 'Pivlu' }}" height="40">
    @else
        {{ $config->site_name ?? 'Pivlu' }}
    @endif
</a>

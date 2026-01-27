<a class="navbar-brand no-decoration" href="{{ url('/') }}">
    @if ($config->logo_url ?? null)
        <img src="{{ $config->logo_url }}" alt="{{ $config->site_name ?? 'Pivlu' }}" class="logo-img" />
    @else
        {{ $config->site_name ?? 'Pivlu' }}
    @endif
</a>

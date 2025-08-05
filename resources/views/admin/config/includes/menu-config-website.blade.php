<nav class="nav nav-tabs mb-2" id="myTab" role="tablist">
    <a class="nav-item nav-link @if ($active_tab == 'website') active @endif" href="{{ route('admin.config', ['tab' => 'website']) }}"><i class="bi bi-gear"></i> {{ __('Website settings') }}</a>
    <a class="nav-item nav-link @if ($active_tab == 'langs') active @endif" href="{{ route('admin.languages.index') }}"><i class="bi bi-flag"></i> {{ __('Language and locale') }}</a>
    <a class="nav-item nav-link @if ($active_tab == 'registration') active @endif" href="{{ route('admin.config', ['tab' => 'registration']) }}"><i class="bi bi-person-plus-fill"></i> {{ __('Registration') }}</a>
</nav>

@if ($config->website_disabled ?? null)
    <div class="fw-bold text-danger mb-2 mt-4">
        <i class="bi bi-info-circle"></i> {{ __('Public website is disabled.') }}
    </div>
@endif

@if ($config->website_maintenance_enabled ?? null)
    <div class="fw-bold text-danger mb-2 mt-4">
        <i class="bi bi-info-circle"></i> {{ __('Website is in maintenance mode.') }}
    </div>
@endif

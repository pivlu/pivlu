<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($module ?? null) == 'global') active @endif" href="{{ route('admin.template-builder.index') }}">{{ __('Global') }}</a>
    <a class="nav-item nav-link @if (($module ?? null) == 'posts') active @endif" href="{{ route('admin.template-builder.index', ['module' => 'posts']) }}">{{ __('Posts') }}</a>
    <a class="nav-item nav-link @if (($module ?? null) == 'contact') active @endif" href="{{ route('admin.template-builder.index', ['module' => 'contact']) }}">{{ __('Contact page') }}</a>
</nav>

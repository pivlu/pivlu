<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($module ?? null) == 'global') active @endif" href="{{ route('admin.template') }}">{{ __('Global') }}</a>
    <a class="nav-item nav-link @if (($module ?? null) == 'docs') active @endif" href="{{ route('admin.template', ['module' => 'docs']) }}">{{ __('Knowledge Base') }}</a>
    <a class="nav-item nav-link @if (($module ?? null) == 'posts') active @endif" href="{{ route('admin.template', ['module' => 'posts']) }}">{{ __('Posts') }}</a>
    <a class="nav-item nav-link @if (($module ?? null) == 'forum') active @endif" href="{{ route('admin.template', ['module' => 'forum']) }}">{{ __('Community') }}</a>
    <a class="nav-item nav-link @if (($module ?? null) == 'contact') active @endif" href="{{ route('admin.template', ['module' => 'contact']) }}">{{ __('Contact page') }}</a>
</nav>

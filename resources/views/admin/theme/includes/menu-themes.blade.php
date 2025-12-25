<nav class="nav nav-tabs mb-2" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'themes') active @endif" href="{{ route('admin.themes.index') }}"><i class="bi bi-easel"></i> {{ __('Templates') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'styles') active @endif" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Block styles') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'menus') active @endif" href="{{ route('admin.theme-menus.index') }}"><i class="bi bi-menu-down"></i> {{ __('Menus') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'footers') active @endif" href="{{ route('admin.theme-footers.index') }}"><i class="bi bi-menu-up"></i> {{ __('Footers') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'buttons') active @endif" href="{{ route('admin.theme-buttons.index') }}"><i class="bi bi-check2-square"></i> {{ __('Buttons') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'layouts') active @endif" href="{{ route('admin.theme.layouts') }}"><i class="bi bi-layout-sidebar-inset"></i> {{ __('Layouts') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'custom_code') active @endif" href="{{ route('admin.theme-custom-code') }}"><i class="bi bi-code-square"></i> {{ __('Custom code') }}</a>
</nav>

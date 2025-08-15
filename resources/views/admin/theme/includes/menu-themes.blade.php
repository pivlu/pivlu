<nav class="nav nav-tabs mb-2" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'themes') active @endif" href="{{ route('admin.themes.index') }}"><i class="bi bi-bounding-box"></i> {{ __('Themes') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'menus') active @endif" href="{{ route('admin.theme-menus.index') }}"><i class="bi bi-menu-down"></i> {{ __('Menus') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'footers') active @endif" href="{{ route('admin.theme-footers.index') }}"><i class="bi bi-menu-up"></i> {{ __('Footer') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'styles') active @endif" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Styles') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'buttons') active @endif" href="{{ route('admin.theme-buttons.index') }}"><i class="bi bi-check2-square"></i> {{ __('Buttons') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'logo') active @endif" href="#"><i class="bi bi-image"></i> {{ __('Logo & icons') }}</a>

    <a class="nav-item nav-link @if (($nav_tab ?? null) == 'custom_code') active @endif" href="#"><i class="bi bi-code-square"></i> {{ __('Custom code') }}</a>

</nav>

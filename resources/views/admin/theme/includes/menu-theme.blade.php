<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'homepage') active @endif" href="{{ route('admin.themes.show', ['slug' => $theme->slug, 'theme_tab' => 'homepage']) }}">{{ __('Homepage builder') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'global') active @endif" href="{{ route('admin.themes.show', ['slug' => $theme->slug, 'theme_tab' => 'global']) }}">{{ __('Global') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'nav') active @endif" href="{{ route('admin.themes.show', ['slug' => $theme->slug, 'theme_tab' => 'nav']) }}">{{ __('Navigation menu') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'nav2') active @endif" href="{{ route('admin.themes.show', ['slug' => $theme->slug, 'theme_tab' => 'nav2']) }}">{{ __('Navigation 2') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'footer') active @endif" href="{{ route('admin.themes.show', ['slug' => $theme->slug, 'theme_tab' => 'footer']) }}">{{ __('Footer') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'posts') active @endif" href="{{ route('admin.themes.show', ['slug' => $theme->slug, 'theme_tab' => 'posts']) }}">{{ __('Posts') }}</a>    
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'contact') active @endif" href="{{ route('admin.themes.show', ['slug' => $theme->slug, 'theme_tab' => 'contact']) }}">{{ __('Contact page') }}</a>   
</nav>

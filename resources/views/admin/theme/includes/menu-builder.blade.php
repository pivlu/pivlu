<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'general') active @endif" href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => 'general']) }}">{{ __('General') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'home') active @endif" href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => 'home']) }}">{{ __('Homepage builder') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'style') active @endif" href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => 'style']) }}">{{ __('Global style') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'nav') active @endif" href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => 'nav']) }}">{{ __('Header navigation') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'footer') active @endif" href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => 'footer']) }}">{{ __('Footer') }}</a>
    @foreach ($post_types_tabs as $post_type_tab_key => $post_type_tab_value)
        <a class="nav-item nav-link @if (($tab_post_type ?? null) == $post_type_tab_key) active @endif"
            href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => $post_type_tab_key, 'post_type_type' => $post_type_tab_key]) }}">{{ $post_type_tab_value }}</a>
    @endforeach
</nav>

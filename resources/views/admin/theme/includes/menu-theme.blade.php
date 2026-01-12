
<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'general') active @endif" href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => 'general']) }}">{{ __('General') }}</a>
    <a class="nav-item nav-link @if (($theme_tab ?? null) == 'home') active @endif" href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => 'home']) }}">{{ __('Homepage builder') }}</a>
    @foreach ($theme_settings as $settings_tab => $values)
        <a class="nav-item nav-link @if (('package_'.$settings_tab ?? null) == $theme_tab) active @endif" href="{{ route('admin.themes.show', ['id' => $theme->id, 'theme_tab' => 'package_'.$settings_tab]) }}">{{ $values['label'] ?? $settings_tab }}</a>
    @endforeach
</nav>


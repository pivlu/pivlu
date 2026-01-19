@switch($item->type)
    @case('html')
        <i class="bi bi-textarea-t"></i> {{ __('Text / HTML') }}
    @break

    @case('menu_links')
        <i class="bi bi-link-45deg"></i> {{ __('Menu links') }}
    @break

    @case('logo')
        <i class="bi bi-image"></i> {{ __('Logo') }}
    @break

    @case('custom_code')
        <i class="bi bi-code"></i> {{ __('Custom code') }}
    @break

    @case('search')
        <i class="bi bi-search"></i> {{ __('Search') }}
    @break

    @case('social_buttons')
        <i class="bi bi-share"></i> {{ __('Social buttons') }}
    @break

    @case('language_switcher')
        <i class="bi bi-translate"></i> {{ __('Language switcher') }}
    @break

    @case('login_register')
        <i class="bi bi-person-circle"></i> {{ __('Login / Register') }}
    @break
    
    @default
        {{ $item->type }}
@endswitch

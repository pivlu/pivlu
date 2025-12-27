<div class="style_{{ Pivlu\Models\ThemeConfig::get_template_part_config_for_active_theme('nav', 'nav2_style_id') }}">
    @if (($tpl_theme_config->logo_align ?? null) == 'text-center mx-auto')
        <div class="container-xxl d-flex justify-content-center style_{{ Pivlu\Models\ThemeConfig::get_template_part_config_for_active_theme('nav', 'nav2_style_id') }}">
            <div class="row">
                <div class="logo align-center mt-2 mb-2">
                    @if (!($tpl_theme_config->tpl_navbar_hide_logo ?? null))
                        @php
                            if (get_default_language()->code == get_site_info('lang')) {
                                $logo_url = route('home');
                            } else {
                                $logo_url = route('locale.home', ['locale' => get_site_info('lang')]);
                            }
                        @endphp

                        <a class="" href="{{ $logo_url }}"><img @if (($tpl_theme_config->logo_align ?? null) == 'text-center mx-auto') class="float-start" @endif alt="{{ $config_lang->site_label ?? 'Clevada' }}"
                                src="{{ image($tpl_theme_config->logo_media_id ?? null) }}"></a>
                    @endif

                    @if ($tpl_theme_config->show_custom_text ?? null)
                        <div class="float-end ms-3">
                            {!! nl2br($tpl_theme_config->custom_text) ?? null !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="container-xxl">
            <div class="row">
                <div class="mt-2 mb-2 {{ $tpl_theme_config->logo_align ?? 'text-center' }}" @if (($tpl_theme_config->logo_align ?? null) == 'text-center mx-auto') style="width: auto; max-width:40%;" @endif>
                    @if (!($tpl_theme_config->tpl_navbar_hide_logo ?? null))
                        @php
                            if (get_default_language()->code == get_site_info('lang')) {
                                $logo_url = route('home');
                            } else {
                                $logo_url = route('locale.home', ['locale' => get_site_info('lang')]);
                            }
                        @endphp

                        <a class="{{ $tpl_theme_config->logo_align ?? null }}" href="{{ $logo_url }}"><img alt="{{ $config_lang->site_label ?? 'Pivlu' }}"
                                src="{{ image($tpl_theme_config->logo_media_id ?? null) }}"></a>
                    @endif

                    @if ($tpl_theme_config->show_custom_text ?? null)
                        @if (($tpl_theme_config->logo_align ?? null) == 'text-center mx-auto')
                            <span class="d-flex">
                                <div class="d-block ms-2">
                                    {!! nl2br($tpl_theme_config->tpl_navbar_custom_text) ?? null !!}
                                </div>
                            </span>
                        @endif
                    @endif

                    @if ($tpl_theme_config->tpl_navbar_show_custom_text ?? null)
                        @if (($tpl_theme_config->logo_align ?? null) == 'float-start')
                            <div class="d-block float-end">
                                {!! nl2br($tpl_theme_config->tpl_navbar_custom_text) ?? null !!}
                            </div>
                        @endif

                        @if (($tpl_theme_config->logo_align ?? null) == 'float-end')
                            <div class="d-block float-start">
                                {!! nl2br($tpl_theme_config->tpl_navbar_custom_text) ?? null !!}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>


<nav
    class="navbar navbar-expand-md @if ($tpl_theme_config->tpl_navbar_sticky ?? null) sticky-top @endif {{ $tpl_theme_config->links_align ?? null }} style_{{ App\Models\ThemeConfig::get_template_part_config_for_active_theme('nav', 'nav1_style_id') }}">
    <div class="container-xxl">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="bi bi-list" style="font-size: 2rem;"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav {{ $tpl_theme_config->links_align ?? 'me-auto2' }}">

                @foreach (menu_links() as $navbar_link)
                    @if (!empty($navbar_link->dropdown))
                        <li class="nav-item dropdown {{ $tpl_theme_config->tpl_navbar_links_margin ?? null }}">
                            <a class="nav-link dropdown-toggle @if ($navbar_link->btn_id) btn btn_{{ $navbar_link->btn_id }} @endif" href="#" id="navbarDropdown_{{ $navbar_link->label }}" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $navbar_link->label }} <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end style_nav_dropdown" aria-labelledby="navbarDropdown_{{ $navbar_link->label }}">
                                @foreach ($navbar_link->dropdown as $navbar_dropdown_link)
                                    <li>
                                        <a @if ($navbar_dropdown_link->new_tab == 1) target="_blank" @endif class="dropdown-item" href="{{ $navbar_dropdown_link->url }}">
                                            @if ($navbar_dropdown_link->icon)
                                                <span class="me-2">{!! $navbar_dropdown_link->icon !!}</span>
                                            @endif
                                            {{ $navbar_dropdown_link->label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item {{ $tpl_theme_config->tpl_navbar_links_margin ?? null }}">
                            <a @if ($navbar_link->new_tab == 1) target="_blank" @endif
                                class="nav-link @if ($navbar_link->btn_id) btn btn_{{ $navbar_link->btn_id }} {{ button($navbar_link->btn_id)->font_weight ?? null }} {{ button($navbar_link->btn_id)->rounded ?? null }} {{ button($navbar_link->btn_id)->size ?? null }} {{ button($navbar_link->btn_id)->shadow ?? null }} @endif"
                                href="{{ $navbar_link->url ?? null }}" title="{{ $config_lang->site_label ?? 'Clevada' }}">
                                @if ($navbar_link->icon)
                                    {!! $navbar_link->icon !!}
                                @endif {{ $navbar_link->label }}
                            </a>
                        </li>
                    @endif
                @endforeach


                @if (count(languages()) > 1 && !($tpl_theme_config->tpl_navbar_hide_langs ?? null))
                    @include('web.global.nav-langs')
                @endif

                @if (!($tpl_theme_config->tpl_navbar_hide_auth ?? null))

                    @if (Auth::user() ?? null)
                        <li class="nav-item dropdown {{ $tpl_theme_config->tpl_navbar_links_margin ?? null }}">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdownAuth" role="button">
                                <img class="avatar rounded-circle me-1" alt="{{ Auth::user()->name }}" src="{{ avatar(Auth::user()->avatar_media_id, 'thumb') }}" />
                                {{ strtok(Auth::user()->name, ' ') }} <i class="bi bi-chevron-down"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-lg-end style_nav_dropdown" aria-labelledby="navbarDropdownAuth">

                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'internal')
                                    <li><a href="{{ route('admin') }}" class="dropdown-item"><i class="bi bi-person-workspace me-2"></i> {{ __('Admin area') }}</a></li>
                                @endif

                                @if (Auth::user()->role == 'user')
                                    @if (get_default_language()->code == $locale)
                                        <li><a href="{{ route('user') }}" class="dropdown-item"><i class="bi bi-person-circle me-2"></i> {{ __('My account') }}</a></li>
                                    @else
                                        <li><a href="{{ route('locale.user', ['locale' => $locale]) }}" class="dropdown-item"><i class="bi bi-person-circle me-2"></i> {{ __('My account') }}</a></li>
                                    @endif
                                @endif

                                <li><a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right me-2"></i>
                                        {{ __('Sign out') }}</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('user') }}" class="nav-link"><i class="bi bi-person me-2"></i> <span class="d-none d-md-inline-block"> {{ __('My account') }}</span></a>
                        </li>
                    @endif

                @endif
            </ul>

        </div>
    </div>
</nav>

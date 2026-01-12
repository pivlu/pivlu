<nav class="navbar navbar-expand-lg @if ($config->tpl_navbar_sticky ?? null) sticky-top @endif style_{{ $config->nav_default_style_id ?? null }}">
    <div class="container-xxl">

        @if (!($config->navbar_hide_logo ?? null))
            @php
                if ($config->active_language->code == $config->locale) {
                    $logo_url = route('home');
                } else {
                    $logo_url = route('locale.home', ['lang' => $config->active_language->code]);
                }
            @endphp
            <a class="navbar-brand" href="{{ $logo_url }}">
                @if ($config->logo_url ?? null)
                    <img src="{{ $config->logo_url }}" alt="{{ $config->site_label ?? 'Pivlu' }}">
                @else
                    <img src="{{ asset('assets/img/logo.png') }}" alt="{{ $config->site_label ?? 'Pivlu' }}">
                @endif
            </a>
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="bi bi-list" style="font-size: 2rem;"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav ms-auto">

                @foreach ($config->menu_links as $navbar_link)
                    @if (!empty($navbar_link->dropdown))
                        <li class="nav-item dropdown {{ $config->tpl_navbar_links_margin ?? null }}">
                            <a class="nav-link dropdown-toggle @if ($navbar_link->btn_id) btn btn_{{ $navbar_link->btn_id }} @endif" href="#" id="navbarDropdown_{{ $navbar_link->label }}" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $navbar_link->label }} <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end style_{{ $config->nav_default_style_id ?? null }}" aria-labelledby="navbarDropdown_{{ $navbar_link->label }}">
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
                        <li class="nav-item {{ $config->tpl_navbar_links_margin ?? null }}">
                            @if ($navbar_link->btn_id)
                                <span class="btn_{{ $navbar_link->btn_id }}">
                                    <a @if ($navbar_link->new_tab == 1) target="_blank" @endif class="nav-link btn btn_{{ $navbar_link->btn_id }}" href="{{ $navbar_link->url ?? null }}"
                                        title="{{ $config_lang->site_label ?? config('app.name') }}">
                                        @if ($navbar_link->icon)
                                            {!! $navbar_link->icon !!}
                                        @endif {{ $navbar_link->label }}
                                    </a>
                                </span>
                            @else
                                <span class="style_{{ $config->nav_default_style_id ?? null }}">
                                    <a @if ($navbar_link->new_tab == 1) target="_blank" @endif class="nav-link" href="{{ $navbar_link->url ?? null }}" title="{{ $config_lang->site_label ?? config('app.name') }}">
                                        @if ($navbar_link->icon)
                                            {!! $navbar_link->icon !!}
                                        @endif {{ $navbar_link->label }}
                                    </a>
                                </span>
                            @endif
                        </li>
                    @endif
                @endforeach

                @if (count(languages()) > 1 && !($config->tpl_navbar_hide_langs ?? null))
                    @include('pivlu::web.global.nav-langs')
                @endif

                @if (!($config->tpl_navbar_hide_auth ?? null))
                    @if (Auth::user() ?? null)
                        <li class="nav-item dropdown {{ $config->tpl_navbar_links_margin ?? null }}">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdownAuth" role="button">
                                <img class="avatar rounded-circle me-1" alt="{{ Auth::user()->name }}" src="{{ Auth::user()->getFirstMediaUrl('avatars', 'thumb') }}" />
                                {{ strtok(Auth::user()->name, ' ') }} <i class="bi bi-chevron-down"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-lg-end style_{{ $config->nav_default_style_id ?? null }}" aria-labelledby="navbarDropdownAuth">

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
                            <a href="{{ route('account') }}" class="nav-link"><i class="bi bi-person me-2"></i> <span class="d-none d-md-inline-block"> {{ __('My account') }}</span></a>
                        </li>
                    @endif
                @endif
            </ul>

        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg @if ($config->tpl_navbar_sticky ?? null) sticky-top @endif style_nav">
    <div class="@if ((($is_forum_page ?? null) && ($config->tpl_forum_container_fluid ?? null)) || (($is_page ?? null) && ($page->container_fluid ?? null))) container-fluid @else container-xxl @endif">

        @if (!($config->tpl_navbar_hide_logo ?? null))
            @php
                if (get_default_language()->code == $locale) {
                    $logo_url = route('home');
                } else {
                    $logo_url = route('locale.home', ['locale' => $locale]);
                }
            @endphp
            <a class="navbar-brand" href="{{ $logo_url }}">
                @if ($config->logo ?? null)
                    <img src="{{ asset('uploads/' . $config->logo) }}" alt="{{ $config_lang->site_label ?? 'Clevada' }}">
                @endif
            </a>
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="bi bi-list" style="font-size: 2rem;"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav ms-auto">

                @foreach ($menu_links as $navbar_link)
                    @if (!empty($navbar_link->dropdown))
                        <li class="nav-item dropdown {{ $config->tpl_navbar_links_margin ?? null }}">
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
                        <li class="nav-item {{ $config->tpl_navbar_links_margin ?? null }}">
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

                @if (count($active_languages) > 1 && !($config->tpl_navbar_hide_langs ?? null))
                    @include('web.builder.global.nav-langs')
                @endif

                @if (!($config->tpl_navbar_hide_auth ?? null))
                    @include('web.builder.global.nav-auth')
                @endif
            </ul>

        </div>
    </div>
</nav>

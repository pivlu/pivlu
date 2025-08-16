<nav class="navbar navbar-expand-lg @if ($config->tpl_navbar_sticky ?? null) sticky-top @endif {{ get_style('nav') }}">
    <div class="container-xxl">

        @if (!($config->tpl_navbar_hide_logo ?? null))
            <a class="navbar-brand" href="{{ route('home') }}">
                @if ($config->logo ?? null)
                    <img src="{{ image($config->logo ?? null) }}" alt="{{ site()->label }}">
                @endif
            </a>
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="bi bi-list" style="font-size: 2rem;"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav ms-auto">

                @foreach (menu_links() as $navbar_link)
                    @if (!empty($navbar_link->dropdown))
                        <li class="nav-item dropdown {{ $config->tpl_navbar_links_margin ?? null }}">
                            <a class="nav-link dropdown-toggle @if ($navbar_link->btn_id) btn btn_{{ $navbar_link->btn_id }} @endif" href="#" id="navbarDropdown_{{ $navbar_link->label }}" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $navbar_link->label }} <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end {{ get_style('nav_dropdown') }}" aria-labelledby="navbarDropdown_{{ $navbar_link->label }}">
                                @foreach ($navbar_link->dropdown as $navbar_dropdown_link)
                                    <li><a @if ($navbar_dropdown_link->new_tab == 1) target="_blank" @endif class="dropdown-item" href="{{ $navbar_dropdown_link->url }}">{{ $navbar_dropdown_link->label }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item {{ $config->tpl_navbar_links_margin ?? null }}">
                            <a @if ($navbar_link->new_tab == 1) target="_blank" @endif
                                class="nav-link @if ($navbar_link->btn_id) btn navlink-btn btn_{{ $navbar_link->btn_id }} {{ button($navbar_link->btn_id)->font_weight ?? null }} {{ button($navbar_link->btn_id)->rounded ?? null }} {{ button($navbar_link->btn_id)->shadow ?? null }} {{ button($navbar_link->btn_id)->size ?? null }} @endif"
                                href="{{ $navbar_link->url ?? null }}" title="{{ site()->label }}">
                                @if ($navbar_link->icon)
                                    {!! $navbar_link->icon !!}
                                @endif {{ $navbar_link->label }}
                            </a>
                        </li>
                    @endif
                @endforeach

                @if (count(languages()) > 1)
                    @include("web.global.nav-langs")
                @endif
            </ul>

        </div>
    </div>
</nav>

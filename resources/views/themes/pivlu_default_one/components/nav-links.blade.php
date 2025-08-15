@foreach (theme_menu_links() as $navbar_link)
    @if (!empty($navbar_link->dropdown))
        <li class="nav-item dropdown {{ $config->tpl_navbar_links_margin ?? null }}">
            <a class="nav-link dropdown-toggle @if ($navbar_link->btn_id) btn btn_{{ $navbar_link->btn_id }} @endif" href="#" id="navbarDropdown_{{ $navbar_link->label }}" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
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

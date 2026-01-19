@if (count($item->menu_links ?? []) > 0)
    @foreach ($item->menu_links as $navbar_link)
        @if (!empty($navbar_link->dropdown))
            <li class="nav-item dropdown {{ $config->tpl_navbar_links_margin ?? null }}">
                <a class="nav-link dropdown-toggle @if ($navbar_link->btn_id) btn btn_{{ $navbar_link->btn_id }} @endif" href="#" id="navbarDropdown_{{ $navbar_link->label }}" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $navbar_link->label }} <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end style_{{ $style_id_dropdown ?? null }}" aria-labelledby="navbarDropdown_{{ $navbar_link->label }}">
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
                    <a @if ($navbar_link->new_tab == 1) target="_blank" @endif class="nav-link" href="{{ $navbar_link->url ?? null }}" title="{{ $config_lang->site_label ?? config('app.name') }}">
                        @if ($navbar_link->icon)
                            {!! $navbar_link->icon !!}
                        @endif {{ $navbar_link->label }}
                    </a>
                @endif
            </li>
        @endif
    @endforeach
@endif

<nav
    class="navbar navbar-expand-lg @if (($config->{'nav_size_row_' . $nav_row_id} ?? null) == 'normal') py-2 @elseif (($config->{'nav_size_row_' . $nav_row_id} ?? null) == 'large') py-3 @elseif (($config->{'nav_size_row_' . $nav_row_id} ?? null) == 'extra_large') py-4 @elseif (($config->{'nav_size_row_' . $nav_row_id} ?? null) == 'small') py-1 @endif @if (($config->{'nav_position_row_' . $nav_row_id} ?? null) == 'sticky') sticky-top @endif @if ($style_id) style_{{ $style_id }} @endif @if( ($config->{'nav_shadow_row_' . $nav_row_id} ?? null) == 'small') shadow-sm @elseif (($config->{'nav_shadow_row_' . $nav_row_id} ?? null) == 'regular') shadow @elseif (($config->{'nav_shadow_row_' . $nav_row_id} ?? null) == 'large') shadow-lg @endif">

    <div class="container-xxl">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrimary" aria-controls="navbarPrimary" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPrimary">
            @php
                $nav_items_left = $items ? $items->where('column', 'left') : collect();
                $nav_items_center = $items ? $items->where('column', 'center') : collect();
                $nav_items_right = $items ? $items->where('column', 'right') : collect();
            @endphp

            @if ($nav_items_left->isNotEmpty())
                <ul class="navbar-nav mb-3 mb-lg-0 me-auto">
                    @foreach ($nav_items_left as $item)
                        @include('pivlu::web.navigation.item-types.' . $item->type, ['item' => $item])
                    @endforeach
                </ul>
            @endif

            @if ($nav_items_center->isNotEmpty())
                <ul class="navbar-nav mb-3 mb-lg-0 mx-auto">
                    @foreach ($nav_items_center as $item)
                        @include('pivlu::web.navigation.item-types.' . $item->type, ['item' => $item])
                    @endforeach
                </ul>
            @endif
            @if ($nav_items_right->isNotEmpty())
                <ul class="navbar-nav mb-3 mb-lg-0 ms-auto">
                    @foreach ($nav_items_right as $item)
                        @include('pivlu::web.navigation.item-types.' . $item->type, ['item' => $item])
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
</nav>

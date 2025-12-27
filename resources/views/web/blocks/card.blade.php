@php
    if (($is_layout ?? null) == 1) {
        $block_data = layout_block($block['id']);
    } else {
        $block_data = block($block['id']);
    }
@endphp


@if ($block_content ?? null)
    @php
        if (!($block_settings->cols ?? null)) {
            $cols = 4;
        } else {
            $cols = $block_settings->cols;
        }

        if ($cols == 1) {
            $class = 'row-cols-1';
        }
        if ($cols == 2) {
            $class = 'row-cols-1 row-cols-md-2';
        }
        if ($cols == 3) {
            $class = 'row-cols-1 row-cols-sm-2 row-cols-md-3';
        }
        if ($cols == 4) {
            $class = 'row-cols-1 row-cols-sm-2 row-cols-md-4';
        }
        if ($cols == 6) {
            $class = 'row-cols-1 row-cols-sm-2 row-cols-md-4 col-cols-lg-6';
        }
    @endphp

    <div class="block">

        @include('pivlu::web.includes.block-header')

        @if (count($block_content) > 0)
            <div class="container-xxl">
                <div class="row {{ $class }} g-4">
                    @foreach ($block_content as $item)
                        @if ($block_settings->horizontal ?? null)
                            <div class="col">
                                <div class="card card_{{ $block['id'] }} mb-4 @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->same_height ?? null) h-100 @endif @if (!($block_extra['border_color'] ?? null)) border-0 @endif"
                                    style="@if ($block_settings->card_bg_color ?? null) background-color: {{ $block_settings->card_bg_color }}; @endif @if ($block_settings->border_color ?? null) border-color: {{ $block_settings->border_color }}; @endif @if ($block_settings->no_border_radius ?? null) border-radius: 0; @endif">

                                    <div class="row g-0">

                                        @if ($item->icon ?? null)
                                            <div class="card-body p-0">
                                                <div class="icon px-2 py-1 float-start me-2" style="font-size: {{ $block_settings->icon_size ?? '2em' }}">{!! $item['icon'] !!}</div>

                                                <div class="p-2">
                                                    @if ($item->title)
                                                        <div class="title mb-1">
                                                            @if (($item->url ?? null) && ($block_settings->link_location ?? null) == 'title')
                                                                <a href="https://{{ $item->url }}">{{ $item->title }}</a>
                                                            @else
                                                                {{ $item->title }}
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <p>{{ $item->content }}</p>

                                                    @if (($item->url ?? null) && ($block_settings->link_location ?? null) == 'button')
                                                        <div class="mt-3 @if (($block_settings->link_btn_width ?? null) == 'block') d-grid gap-2 @endif">
                                                            <a class="mt-3 btn btn_{{ $block_settings->link_btn_id ?? 'primary' }} {{ $block_settings->link_btn_size ?? null }}" href="https://{{ $item->url }}"
                                                                title="{{ $item->title }}">{{ $item->title }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif ($item->image ?? null)
                                            <div class="col-md-4">
                                                <img src="{{ image($item->image, 'thumb_square') }}"
                                                    class="img-fluid @if ($block_settings->img_full_width ?? null) w-100 @endif @if (!$block_settings->no_border_radius ?? null) rounded-start @endif" alt="{{ $item->title ?? $item->image }}">
                                            </div>

                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    @if ($item->title)
                                                        <div class="title mb-3">
                                                            @if (($item->url ?? null) && ($block_settings->link_location ?? null) == 'title')
                                                                <a href="https://{{ $item->url }}">{{ $item->title }}</a>
                                                            @else
                                                                {{ $item->title }}
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <p>{!! nl2br($item->content) !!}</p>

                                                    @if (($item->url ?? null) && ($block_settings->link_location ?? null) == 'button')
                                                        <div class="mt-3 @if (($block_settings->link_btn_width ?? null) == 'block') d-grid gap-2 @endif">
                                                            <a class="mt-3 btn btn_{{ $block_settings->link_btn_id ?? 'primary' }} {{ $block_settings->link_btn_size ?? null }}" href="https://{{ $item->url }}"
                                                                title="{{ $item->title }}">{{ $item->title }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="card-body">
                                                @if ($item->title)
                                                    <div class="title mb-3">
                                                        @if (($item->url ?? null) && ($block_settings->link_location ?? null) == 'title')
                                                            <a href="https://{{ $item->url }}">{{ $item->title }}</a>
                                                        @else
                                                            {{ $item->title }}
                                                        @endif
                                                    </div>
                                                @endif
                                                <p>{!! nl2br($item->content) !!}</p>

                                                @if (($item->url ?? null) && ($block_settings->link_location ?? null) == 'button')
                                                    <div class="mt-3 @if (($block_settings->link_btn_width ?? null) == 'block') d-grid gap-2 @endif">
                                                        <a class="mt-3 btn btn_{{ $block_settings->link_btn_id ?? 'primary' }} {{ $block_settings->link_btn_size ?? null }}" href="https://{{ $item->url }}"
                                                            title="{{ $item->title }}">{{ $item->title }}</a>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col">
                                <div class="card card_{{ $block->id }} mb-4 @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->same_height ?? null) h-100 @endif @if (!($block_settings->border_color ?? null)) border-0 @endif"
                                    style="@if ($block_settings->card_bg_color ?? null) background-color: {{ $block_settings->card_bg_color }}; @endif @if ($block_settings->border_color ?? null) border-color: {{ $block_settings->border_color }}; @endif @if ($block_settings->no_border_radius ?? null) border-radius: 0; @endif">

                                    @if ($item->icon ?? null)
                                        <div class="icon px-2 py-1 text-center" style="font-size: {{ $block_settings->icon_size ?? '2em' }}">{!! $item->icon !!}</div>
                                    @elseif ($item->image ?? null)
                                        <img class="card-img-top @if ($block_settings->img_full_width ?? null) w-100 @endif" alt="{{ $item->title ?? $item->image }}" title="{{ $item->title ?? $item->image }}"
                                            src="{{ image($item->image, 'thumb') }}" @if ($block_settings->no_border_radius ?? null) style="border-radius: 0;" @endif>
                                    @endif

                                    <div class="card-body">
                                        @if ($item->title)
                                            <div class="title mb-2">
                                                @if (($item->url ?? null) && ($block_settings->link_location ?? null) == 'title')
                                                    <a href="https://{{ $item->url }}">{{ $item->title }}</a>
                                                @else
                                                    {{ $item->title }}
                                                @endif
                                            </div>
                                        @endif

                                        <p>{!! nl2br($item->content) !!}</p>

                                        @if (($item->url ?? null) && ($block_settings->link_location ?? null) == 'button')
                                            <div class="mt-3 @if (($block_settings->link_btn_width ?? null) == 'block') d-grid gap-2 @endif">
                                                <a class="mt-3 btn btn_{{ $block_settings->link_btn_id ?? 'primary' }} {{ $block_settings->link_btn_size ?? null }}" href="https://{{ $item->url }}"
                                                    title="{{ $item->title }}">{{ $item->title }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
    </div>
@endif

</div>

<div class="clearfix"></div>
@endif


@if ($block_settings->bg_color_hover ?? null)
    <style>
        .card_{{ $block->id }}:hover {
            background-color: {{ $block_settings->bg_color_hover }} !important;
        }
    </style>
@endif

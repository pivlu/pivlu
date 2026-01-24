@if (count($block_items) > 0)
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

        <div class="container-xxl">

            @include('pivlu::web.includes.block-header')

            <div class="row {{ $class }} g-4">
                @foreach ($block_items as $item)
                    @php
                        $block_item_media_id = $item->active_language_content->media_id ?? null;
                        $block_item_data = json_decode($item->active_language_content->data ?? null);
                    @endphp

                    @if ($block_settings->horizontal ?? null)
                        <div class="col">
                            <div class="card @if($block['style_id'] ?? null) style_{{ $block['style_id'] }} @endif card_{{ $block['id'] }} mb-4 @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->same_height ?? null) h-100 @endif @if (!($block_extra['border_color'] ?? null)) border-0 @endif"
                                style="@if ($block_settings->border_color ?? null) border-color: {{ $block_settings->border_color }}; @endif @if ($block_settings->no_border_radius ?? null) border-radius: 0; @endif">

                                <div class="row g-0">

                                    @if ($block_item_data->icon ?? null)
                                        <div class="card-body p-0 d-flex flex-column">
                                            <div class="icon px-2 py-1 float-start me-2" style="font-size: {{ $block_settings->icon_size ?? '2em' }}">{!! $item['icon'] !!}</div>

                                            <div class="p-2">
                                                @if ($block_item_data->title ?? null)
                                                    <div class="title mb-1">
                                                        @if (($block_item_data->url ?? null) && ($block_settings->link_location ?? null) == 'title')
                                                            <a href="https://{{ $block_item_data->url ?? null }}">{{ $block_item_data->title ?? null }}</a>
                                                        @else
                                                            {{ $block_item_data->title ?? null }}
                                                        @endif
                                                    </div>
                                                @endif
                                                <p>{{ $block_item_data->content ?? null }}</p>
                                                @if (($block_item_data->url ?? null) && ($block_settings->link_location ?? null) == 'button')
                                                    <div class="mt-auto @if (($block_settings->link_btn_width ?? null) == 'block') d-grid gap-2 @endif">
                                                        <a class="mt-3 btn btn_{{ $block_settings->btn_id ?? 'primary' }} {{ $block_settings->link_btn_size ?? null }}"
                                                            href="https://{{ $block_item_data->url ?? null }}" title="{{ $block_item_data->title ?? null }}">{{ $block_item_data->button_label ??  $block_item_data->title ?? null }}</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @elseif ($block_item_media_id ?? null)
                                        <div class="col-md-4">
                                            <img src="{{ $item->active_language_content->getFirstMediaUrl('block_item_media', 'small') }}"
                                                class="img-fluid @if ($block_settings->img_full_width ?? null) w-100 @endif @if (!$block_settings->no_border_radius ?? null) rounded-start @endif"
                                                alt="{{ $block_item_data->title ?? ($block_item_media_id ?? null) }}">
                                        </div>

                                        <div class="col-md-8">
                                            <div class="card-body d-flex flex-column">
                                                @if ($block_item_data->title ?? null)
                                                    <div class="title mb-3">
                                                        @if (($block_item_data->url ?? null) && ($block_settings->link_location ?? null) == 'title')
                                                            <a href="https://{{ $block_item_data->url }}">{{ $block_item_data->title ?? null }}</a>
                                                        @else
                                                            {{ $block_item_data->title ?? null }}
                                                        @endif
                                                    </div>
                                                @endif
                                                <p>{!! nl2br($block_item_data->content ?? null) !!}</p>
                                                @if (($block_item_data->url ?? null) && ($block_settings->link_location ?? null) == 'button')
                                                    <div class="mt-auto @if (($block_settings->link_btn_width ?? null) == 'block') d-grid gap-2 @endif">
                                                        <a class="mt-3 btn btn_{{ $block_settings->btn_id ?? 'primary' }} {{ $block_settings->link_btn_size ?? null }}"
                                                            href="https://{{ $block_item_data->url ?? null }}" title="{{ $block_item_data->title ?? null }}">{{ $block_item_data->button_label ??  $block_item_data->title ?? null }}</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-body d-flex flex-column">
                                            @if ($block_item_data->title)
                                                <div class="title mb-3">
                                                    @if (($block_item_data->url ?? null) && ($block_settings->link_location ?? null) == 'title')
                                                        <a href="https://{{ $block_item_data->url }}">{{ $block_item_data->title ?? null }}</a>
                                                    @else
                                                        {{ $block_item_data->title ?? null }}
                                                    @endif
                                                </div>
                                            @endif
                                            <p>{!! nl2br($block_item_data->content ?? null) !!}</p>
                                            @if (($block_item_data->url ?? null) && ($block_settings->link_location ?? null) == 'button')
                                                <div class="mt-auto @if (($block_settings->link_btn_width ?? null) == 'block') d-grid gap-2 @endif">
                                                    <a class="mt-3 btn btn_{{ $block_settings->btn_id ?? 'primary' }} {{ $block_settings->link_btn_size ?? null }}"
                                                        href="https://{{ $block_item_data->url ?? null }}" title="{{ $block_item_data->title ?? null }}">{{ $block_item_data->button_label ??  $block_item_data->title ?? null }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col">
                            <div class="card @if($block['style_id'] ?? null) style_{{ $block['style_id'] }} @endif card_{{ $block->id }} mb-4 @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->same_height ?? null) h-100 @endif @if (!($block_settings->border_color ?? null)) border-0 @endif"
                                style="@if ($block_settings->border_color ?? null) border-color: {{ $block_settings->border_color }}; @endif @if ($block_settings->no_border_radius ?? null) border-radius: 0; @endif">

                                @if ($block_item_data->icon ?? null)
                                    <div class="icon px-2 py-1 text-center" style="font-size: {{ $block_settings->icon_size ?? '2em' }}">{!! $block_item_data->icon !!}</div>
                                @elseif ($block_item_media_id ?? null)
                                    @if (($block_settings->image_position ?? null) == 'top')
                                        <img class="card-img-top @if ($block_settings->img_full_width ?? null) w-100 @endif" alt="{{ $block_item_data->title ?? $block_item_media_id }}"
                                            title="{{ $block_item_data->title ?? $block_item_media_id }}" src="{{ $item->active_language_content->getFirstMediaUrl('block_item_media', 'small') }}"
                                            @if ($block_settings->no_border_radius ?? null) style="border-radius: 0;" @endif>
                                    @endif
                                @endif

                                <div class="card-body d-flex flex-column">
                                    @if ($block_item_data->title ?? null)
                                        <div class="title mb-2">
                                            @if (($block_item_data->url ?? null) && ($block_settings->link_location ?? null) == 'title')
                                                <a href="https://{{ $block_item_data->url }}">{{ $block_item_data->title ?? null }}</a>
                                            @else
                                                {{ $block_item_data->title ?? null }}
                                            @endif
                                        </div>
                                    @endif

                                    <p>{!! nl2br($block_item_data->content ?? null) !!}</p>

                                    @if (($block_item_data->url ?? null) && ($block_settings->link_location ?? null) == 'button')
                                        <div class="mt-auto @if (($block_settings->link_btn_width ?? null) == 'block') d-grid gap-2 @endif">
                                            <a class="mt-3 btn btn_{{ $block_settings->btn_id ?? 'primary' }} {{ $block_settings->link_btn_size ?? null }}" href="https://{{ $block_item_data->url ?? null }}"
                                                title="{{ $block_item_data->title ?? null }}">{{  $block_item_data->button_label ??  $block_item_data->title ?? null }}</a>
                                        </div>
                                    @endif
                                </div>

                                @if (($block_item_media_id ?? null) && ($block_settings->image_position ?? null) == 'bottom')
                                    <img class="card-img-bottom @if ($block_settings->img_full_width ?? null) w-100 @endif" alt="{{ $block_item_data->title ?? $block_item_media_id }}"
                                        title="{{ $block_item_data->title ?? $block_item_media_id }}" src="{{ $item->active_language_content->getFirstMediaUrl('block_item_media', 'small') }}"
                                        @if ($block_settings->no_border_radius ?? null) style="border-radius: 0;" @endif>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif

<div class="clearfix"></div>


@if ($block_settings->bg_color_hover ?? null)
    <style>
        .card_{{ $block->id }}:hover {
            background-color: {{ $block_settings->bg_color_hover }} !important;
        }
    </style>
@endif

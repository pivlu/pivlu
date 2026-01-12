@if (count($block_items) > 0)
    @php
        if (!($block_settings->cols ?? null)) {
            $cols = 4;
        } else {
            $cols = $block_settings->cols;
        }

        if ($cols == 2) {
            $class = 'col-sm-6 col-12';
        }
        if ($cols == 3) {
            $class = 'col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12';
        }
        if ($cols == 4) {
            $class = 'col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12';
        }
        if ($cols == 6) {
            $class = 'col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12';
        }
    @endphp

    <div class="container-xxl">
        <div class="block text-center">
            <div class="row">

                @include('pivlu::web.includes.block-header')

                @if ($block_settings->masonry_layout ?? null)

                    <div class="row g-0">
                        <div id="masonry">
                            <div class="grid-sizer"></div>

                            @foreach ($block_items as $item)
                                <div class="grid-item g-0">
                                    <a data-fancybox="gallery-{{ $block['id'] }}" class="gallery" href="{{ image($item['image']) }}"><img
                                            class="img-fluid @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif" alt="{{ $item['title'] ?? $item['image'] }}"
                                            title="{{ $item['title'] ?? $item['image'] }}" src="{{ image($item['image']) }}"></a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @else
                    @foreach ($block_items as $item)
                        @php
                            $block_item_media_id = $item->active_language_content->media_id ?? null;
                            $block_item_data = json_decode($item->active_language_content->data ?? null);
                        @endphp

                        @if ($block_item_media_id)
                            <div class="{{ $class }} mb-5">
                                <div class="block-gallery-image-box">

                                    @if ($block_item_data->url ?? null)
                                        <a href="{{ $block_item_data->url }}"><img class="img-fluid @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif"
                                                alt="{{ $block_item_data->title ?? $block_item_media_id }}" title="{{ $block_item_data->title ?? $block_item_media_id }}"
                                                src="{{ $item->active_language_content->getFirstMediaUrl('block_item_media', 'large') }}"></a>
                                    @else
                                        <a data-fancybox="gallery-{{ $block->id }}" data-caption="{{ $block_item_data->caption ?? null }}" class="gallery"
                                            href="{{ $item->active_language_content->getFirstMediaUrl('block_item_media', 'large') }}">
                                            <img class="img-fluid @if ($block_settings->rounded ?? null) rounded @endif @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif"
                                                alt="{{ $block_item_data->title ?? $block_item_media_id }}" title="{{ $block_item_data->title ?? ($block_item_data->caption ?? null) }}"
                                                src="{{ $item->active_language_content->getFirstMediaUrl('block_item_media', 'large') }}">
                                        </a>
                                    @endif
                                </div>

                                @if ($block_item_data->caption ?? null)
                                    <div class="caption">{{ $block_item_data->caption }}</div>
                                @endif
                            </div>
                        @endif
                    @endforeach

                @endif

            </div>
        </div>
    </div>

    <div class="clearfix"></div>
@endif


@if ($block_settings->masonry_layout ?? null)
    @php
        if (!($block_settings->masonry_cols ?? null)) {
            $grid_item_width = '25'; // 4 cols (25%)
        } else {
            $grid_item_width = round(100 / $block_settings->masonry_cols, 2);
        }
        $calc = $grid_item_width . '% - ' . ($block_settings->masonry_gutter ?? 0) . 'px';
    @endphp

    <style>
        .grid-sizer,
        .grid-item {
            width: calc({{ $calc }});
        }

        .grid-item {
            margin-bottom: {{ $block_settings->masonry_gutter ?? 0 }}px;
        }

        .grid {
            margin-bottom: 10px
        }
    </style>
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

    <script>
        imagesLoaded(document.querySelector('#masonry'), function(instance) {

            var elem = document.querySelector('#masonry');
            var msnry = new Masonry(elem, {
                // options
                itemSelector: '.grid-item',
                columnWidth: '.grid-sizer',
                percentPosition: true,
                gutter: {{ $block_settings->masonry_gutter ?? 0 }}
            });
        });
    </script>
@endif

@if ($block_content ?? null)
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

    <div class="block text-center">
        <div class="row">

            @include('web.includes.block-header')

            @if (count($block_content) > 0)

                @if ($block_settings->masonry_layout ?? null)

                    <div class="row g-0">
                        <div id="masonry">
                            <div class="grid-sizer"></div>

                            @foreach ($block_content as $item)
                                <div class="grid-item g-0">
                                    <a data-fancybox="gallery-{{ $block['id'] }}" class="gallery" href="{{ image($item['image']) }}"><img
                                            class="img-fluid @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif" alt="{{ $item['title'] ?? $item['image'] }}"
                                            title="{{ $item['title'] ?? $item['image'] }}" src="{{ image($item['image']) }}"></a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @else
                    @foreach ($block_content as $item)
                        @if ($item->media_id)
                            <div class="{{ $class }} mb-5">
                                <div class="block-gallery-image-box">

                                    @if ($item->url)
                                        <a href="{{ $item->url }}"><img class="img-fluid @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif"
                                                alt="{{ $item->title ?? $item->media_id }}" title="{{ $item->title ?? $item->media_id }}" src="{{ image($item->media_id, 'thumb') }}"></a>
                                    @else
                                        <a data-fancybox="gallery-{{ $block->id }}" class="gallery" href="{{ image($item->media_id) }}"><img
                                                class="img-fluid @if ($block_settings->rounded ?? null) rounded @endif @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif"
                                                alt="{{ $item->title ?? $item->media_id }}" title="{{ $item->title ?? $item->media_id }}" src="{{ image($item->media_id, 'thumb') }}"></a>
                                    @endif
                                </div>

                                @if ($item->caption ?? null)
                                    <div class="caption">{{ $item->caption }}</div>
                                @endif
                            </div>
                        @endif
                    @endforeach

                @endif
            @endif

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

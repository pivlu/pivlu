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

        <div class="block">

            <div class="row">

                @include('pivlu::web.includes.block-header')


                @foreach ($block_items as $item)
                    @php
                        $block_item_media_id = $item->active_language_content->media_id ?? null;
                        $block_item_data = json_decode($item->active_language_content->data ?? null);
                    @endphp

                    <div class="{{ $class }} mb-5">

                        <div class="testimonial @if ($block_settings->items_style_id ?? null) style_{{ $block_settings->items_style_id }} @endif ">

                            @if (($block_settings->use_images ?? null) && ($block_item_media_id ?? null))
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="{{ $item->active_language_content->getFirstMediaUrl('block_item_media', 'large') }}" class="rounded-circle shadow-1-strong" width="150" height="150"
                                        alt="{{ $block_item_data->name ?? $block_item_media_id }}" />
                                </div>
                            @endif


                            @if ($block_settings->use_star_rating ?? null)
                                <div class="float-end ms-2">
                                    @if ($block_item_data->rating == 1)
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i><i
                                            class="bi bi-star text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i>
                                    @elseif($block_item_data->rating == 1.5)
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-half text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i><i
                                            class="bi bi-star text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i>
                                    @elseif($block_item_data->rating == 2)
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i><i
                                            class="bi bi-star text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i>
                                    @elseif($block_item_data->rating == 2.5)
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-half text-warning me-1"></i><i
                                            class="bi bi-star text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i>
                                    @elseif($block_item_data->rating == 3)
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i
                                            class="bi bi-star text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i>
                                    @elseif($block_item_data->rating == 3.5)
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i
                                            class="bi bi-star-half text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i>
                                    @elseif($block_item_data->rating == 4)
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i
                                            class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star text-warning me-1"></i>
                                    @elseif($block_item_data->rating == 4.5)
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i
                                            class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-half text-warning me-1"></i>
                                    @else
                                        <i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i><i
                                            class="bi bi-star-fill text-warning me-1"></i><i class="bi bi-star-fill text-warning me-1"></i>
                                    @endif
                                </div>
                            @endif


                            <div class="title">
                                {{ $block_item_data->name }}
                            </div>

                            @if ($block_item_data->subtitle ?? null)
                                <div class="caption text-start p-0 mt-3 mb-2" style="font-size: 0.9rem">{{ $block_item_data->subtitle }}</div>
                            @endif


                            <p>
                                <i class="bi bi-quote pe-1"></i> {!! nl2br($block_item_data->content) !!}
                            </p>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>

    </div>

    <div class="clearfix"></div>
@endif

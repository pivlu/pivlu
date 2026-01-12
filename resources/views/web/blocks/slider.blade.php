@if (count($block_items) > 0)

    <div @if (($block_settings->bg_style ?? null) == 'image' && ($block->media_id ?? null)) style="display: block; justify-content: center; align-items: center; overflow: hidden; background-image: @if ($block_settings->cover_dark ?? null) linear-gradient(rgb(0 0 0 / 50%), rgb(0 0 0 / 50%)), @endif
        url('{{ $block->getFirstMediaUrl('block_media') }}'); background-size: cover; @if ($block_settings->cover_fixed ?? null) background-attachment: fixed @endif;" @endif 
        @if (($block_settings->bg_style ?? null) == 'color') style="background-color: {{ $block_settings->bg_color ?? '#ffffff' }};" @endif>


        <div class="block style_{{ $block_settings->style_id ?? null }}" @if ($block_settings->padding_y ?? null) style="padding-top: {{ $block_settings->padding_y }}px; padding-bottom: {{ $block_settings->padding_y }}px" @endif>

            <div class="container-xxl">

                <div id="carousel_{{ $block->id }}" class="carousel slide" @if ($block_settings->delay_seconds ?? null) data-bs-ride="carousel" @else data-bs-ride="ride" @endif>

                    <div class="carousel-inner">

                        @foreach ($block_items as $slide)
                            @php
                                $block_item_media_id = $slide->active_language_content->media_id ?? null;
                                $block_item_data = json_decode($slide->active_language_content->data ?? null);
                            @endphp

                            <div class="carousel-item @if ($loop->first) active @endif" @if ($block_settings->delay_seconds ?? null) data-bs-interval="{{ $block_settings->delay_seconds * 1000 }}" @endif>
                                <div class="row">
                                    @if ($block_item_media_id)
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 d-lg-block d-none">
                                            <img src="{{ $slide->active_language_content->getFirstMediaUrl('block_item_media', 'large') }}" alt="{{ $block_item_data->title }}" class="d-block w-100 block-slider-img @if ($block_settings->rounded_images ?? null) rounded @endif">
                                        </div>
                                    @endif

                                    <div class="@if (!$block_item_media_id) col-12 @else col-xl-6 col-lg-6 col-md-12 col-md-12 col-12 @endif">
                                        <div class="title text-clamp-3 mb-5 mt-4 @if ($block_settings->shadow_title ?? null) text-shadow @endif" style="color: {{ $block_settings->font_color_title ?? '#000000' }}; font-size: {{ $block_settings->font_size_title ?? '2rem' }};">
                                            {{ $block_item_data->title ?? null }}
                                        </div>
                                        <div class="block-slider-content text-clamp-5 @if ($block_settings->shadow_content ?? null) text-shadow @endif" style="color: {{ $block_settings->font_color_content ?? '#000000' }}; font-size: {{ $block_settings->font_size_content ?? '2rem' }};">
                                            {!! $block_item_data->content ?? null !!}</div>
                                        @if ($block_item_data->url ?? null)
                                            <a class="mt-4 btn btn_{{ $block_settings->button_id ?? 'primary' }} {{ $block_settings->button_size ?? '' }}" href="https://{{ $block_item_data->url }}"
                                                title="{{ $block_item_data->title ?? null }}">{{ __('Read More') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_{{ $block->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{ __('Previous') }}</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel_{{ $block->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{ __('Next') }}</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
@endif

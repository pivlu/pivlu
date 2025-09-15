@if ($block_settings->slider_id ?? null)
    @php
        $block_items = block_component_content($block_settings->slider_id);
    @endphp

    <div @if (($block_settings->bg_style ?? null) == 'image' && ($block_settings->bg_media_id ?? null)) style="display: block; justify-content: center; align-items: center; overflow: hidden; background-image: @if ($block_settings->cover_dark ?? null) linear-gradient(rgb(0 0 0 / 50%), rgb(0 0 0 / 50%)), @endif
        url('{{ str_replace('\\', '/', image($block_settings->bg_media_id)) }}'); background-size: cover; @if ($block_settings->cover_fixed ?? null) background-attachment: fixed @endif;" @endif>

        <div class="container-xxl">
            <div class="block">
                <div class="row">

                    @if (count($block_items) > 0)

                        <div id="carousel_{{ $block->id }}" class="carousel slide" data-bs-ride="carousel"
                            @if ($block_settings->delay_seconds ?? null) data-bs-interval="{{ $block_settings->delay_seconds * 1000 }}" @else data-bs-interval="false" @endif>

                            <div class="carousel-inner">

                                @foreach ($block_items as $slide)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <div class="row">
                                            @if ($slide->media_id)
                                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 d-lg-block d-none">
                                                    <img src="{{ image($slide->media_id) }}" alt="{{ $slide->title }}" class="d-block w-100 block-slider-img @if ($block_settings->rounded_images) rounded @endif">
                                                </div>
                                            @endif

                                            <div class="@if (!$slide->media_id) col-12 @else col-xl-6 col-lg-6 col-md-12 col-md-12 col-12 @endif">
                                                <div class="title mb-4 mt-3 @if ($block_settings->shadow_title ?? null) text-shadow @endif"
                                                    style="color: {{ $block_settings->font_color_title ?? 'black' }}; font-size: {{ $block_settings->font_size_title ?? '2rem' }}!important">
                                                    {{ $slide->title }}
                                                </div>
                                                <div class="block-slider-content block-slider-truncate-text @if ($block_settings->shadow_content ?? null) text-shadow @endif"
                                                    style="color: {{ $block_settings->font_color_content ?? 'black' }}; font-size: {{ $block_settings->font_size_content ?? '1.2rem' }}!important">
                                                    {!! $slide->content !!}</div>
                                                @if ($slide->url)
                                                    <a class="mt-4 btn btn_{{ $block_settings->button_id ?? 'primary' }}" href="https://{{ $slide->url }}" title="{{ $slide->title }}">{{ __('Read More') }}</a>
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

                    @endif

                </div>
            </div>
        </div>
    </div>
@endif

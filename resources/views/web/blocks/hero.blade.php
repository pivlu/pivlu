@php
    //dd($block_data);
@endphp

@if ($block_data ?? null)   

    @if (!($block_settings->use_image ?? null))

        <div class="block style_{{ $block_settings->style_id ?? null }}" style="@if ($block_settings->padding_y ?? null) padding-top: {{ $block_settings->padding_y }}px; padding-bottom: {{ $block_settings->padding_y }}px @endif">
            <div class="container-xxl">

                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="title @if ($block_settings->shadow_title ?? null) text-shadow @endif">{!! $block_data->title !!}</div>

                        @if ($block_data->content)
                            <div class="block-hero-content @if ($block_settings->shadow_content ?? null) text-shadow @endif">{!! $block_data->content !!}</div>
                        @endif

                        @if ($block_data->btn1_label || $block_data->btn2_label)
                            <div class="row justify-content-center">
                                <div class="col @if ($block_data->btn2_label) col-12 col-12 col-md-6 col-lg-3 @else col-12 @endif">
                                    @if ($block_data->btn1_label)
                                        <a href="{{ $block_data->btn1_url ?? '#' }}" class="block-hero-button1 btn btn_{{ $block_data->btn1_id }}">
                                            @if ($block_data->btn1_icon)
                                                {!! $block_data->btn1_icon !!}
                                            @endif {{ $block_data->btn1_label }}
                                        </a>                                       
                                    @endif
                                </div>

                                <div class="col col-12 col-md-6 col-lg-3">
                                    @if ($block_data->btn2_label ?? null)
                                        <a href="{{ $block_data->btn2_url ?? '#' }}" class="block-hero-button2 btn btn_{{ $block_data->btn2_id }}">
                                            @if ($block_data->btn2_icon)
                                                {!! $block_data->btn2_icon !!}
                                            @endif {{ $block_data->btn2_label }}
                                        </a>                                        
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @elseif ($block_settings->image_position == 'cover')
        <div
            style="display: block; justify-content: center; align-items: center; overflow: hidden; background-image: @if ($block_settings->cover_dark ?? null) linear-gradient(rgb(0 0 0 / 50%), rgb(0 0 0 / 50%)), @endif url('{{ str_replace('\\', '/', $block->getFirstMediaUrl('block_media')) }}'); background-size: cover; @if ($block_settings->cover_fixed ?? null) background-attachment: fixed; @endif">

            <div class="container-xxl">
                <div class="block style_{{ $block_settings->style_id ?? null }}"
                    style="@if ($block_settings->cover_fixed ?? null) background-attachment: fixed; @endif @if ($block_settings->padding_y ?? null) padding-top: {{ $block_settings->padding_y }}px; padding-bottom: {{ $block_settings->padding_y }}px @endif">
                    <div class="title @if ($block_settings->shadow_title ?? null) text-shadow @endif">{!! $block_data->title !!}</div>
                    @if ($block_data->content)
                        <div class="block-hero-content @if ($block_settings->shadow_content ?? null) text-shadow @endif">{!! $block_data->content !!}</div>
                    @endif

                    @if ($block_data->btn1_label || $block_data->btn2_label)
                        <div class="row justify-content-center">
                            <div class="col @if ($block_data->btn2_label) col-12 col-12 col-md-6 col-lg-4 @else col-12 @endif">
                                @if ($block_data->btn1_label)
                                    <a href="{{ $block_data->btn1_url ?? '#' }}" class="block-hero-button1 btn btn_{{ $block_data->btn1_id }}">
                                        @if ($block_data->btn1_icon)
                                            {!! $block_data->btn1_icon !!}
                                        @endif {{ $block_data->btn1_label }}
                                    </a>                                   
                                @endif
                            </div>

                            <div class="col col-12 col-md-6 col-lg-4">
                                @if ($block_data->btn2_label)
                                    <a href="{{ $block_data->btn2_url ?? '#' }}" class="block-hero-button2 btn btn_{{ $block_data->btn2_id }}">
                                        @if ($block_data->btn2_icon)
                                            {!! $block_data->btn2_icon !!}
                                        @endif {{ $block_data->btn2_label }}
                                    </a>                                   
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    @elseif ($block_settings->image_position == 'top')
        <div class="block style_{{ $block_settings->style_id ?? null }}"
            style="@if ($block_settings->padding_y ?? null) padding-top: {{ $block_settings->padding_y }}px; padding-bottom: {{ $block_settings->padding_y }}px @endif">

            <div class="container-xxl">
                @if ($block->media_id)
                    <div class="row">
                        <div class="{{ $block_settings->img_container_width ?? 'col-12' }}">

                            @if ($block_settings->img_click ?? null)
                                <a data-fancybox="gallery-{{ $block['id'] }}" class="gallery" href="{{ $block->getFirstMediaUrl('block_media') }}">
                                    <img src="{{ $block->getFirstMediaUrl('block_media') }}" class="block-hero-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif" alt="{{ $block_data->title }}">
                                </a>
                            @else
                                <img src="{{ $block->getFirstMediaUrl('block_media') }}" class="block-hero-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif" alt="{{ $block_data->title }}">
                            @endif
                        </div>
                    </div>
                @endif

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="title @if ($block_extra['shadow_title'] ?? null) text-shadow @endif">{!! $block_data->title !!}</div>

                        @if ($block_data->content)
                            <div class="block-hero-content @if ($block_extra['shadow_content'] ?? null) text-shadow @endif">{!! $block_data->content !!}</div>
                        @endif

                        @if ($block_data->btn1_label || $block_data->btn2_label)
                            <div class="row justify-content-center">
                                <div class="col @if ($block_data->btn2_label) col-12 col-12 col-md-6 col-lg-4 @else col-12 @endif">
                                    @if ($block_data->btn1_label)
                                        <a href="{{ $block_data->btn1_url ?? '#' }}" class="block-hero-button1 btn btn_{{ $block_data->btn1_id }}">
                                            @if ($block_data->btn1_icon)
                                                {!! $block_data->btn1_icon !!}
                                            @endif {{ $block_data->btn1_label }}
                                        </a>                                      
                                    @endif
                                </div>

                                <div class="col col-12 col-md-6 col-lg-4">
                                    @if ($block_data->btn2_label ?? null)
                                        <a href="{{ $block_data->btn2_url ?? '#' }}" class="block-hero-button2 btn btn_{{ $block_data->btn2_id }}">
                                            @if ($block_data->btn2_icon)
                                                {!! $block_data->btn2_icon !!}
                                            @endif {{ $block_data->btn2_label }}
                                        </a>                                        
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    @elseif ($block_settings->image_position == 'bottom')
        <div class="block style_{{ $block_settings->style_id ?? null }}"
            style="@if ($block_settings->padding_y ?? null) padding-top: {{ $block_settings->padding_y }}px; padding-bottom: {{ $block_settings->padding_y }}px @endif">

            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <div class="title @if ($block_settings->shadow_title ?? null) text-shadow @endif">{!! $block_data->title !!}</div>

                        @if ($block_data->content)
                            <div class="block-hero-content @if ($block_settings->shadow_content ?? null) text-shadow @endif">{!! $block_data->content !!}</div>
                        @endif

                        @if ($block_data->btn1_label || $block_data->btn2_label)
                            <div class="row justify-content-center">
                                <div class="col @if ($block_data->btn2_label) col-12 col-12 col-md-6 col-lg-4 @else col-12 @endif">
                                    @if ($block_data->btn1_label)
                                        <a href="{{ $block_data->btn1_url ?? '#' }}" class="block-hero-button1 btn btn_{{ $block_data->btn1_id }}">
                                            @if ($block_data->btn1_icon)
                                                {!! $block_data->btn1_icon !!}
                                            @endif {{ $block_data->btn1_label }}
                                        </a>
                                    @endif
                                </div>

                                <div class="col col-12 col-md-6 col-lg-4">
                                    @if ($block_data->btn2_label ?? null)
                                        <a href="{{ $block_data->btn2_url ?? '#' }}" class="block-hero-button2 btn btn_{{ $block_data->btn2_id }}">
                                            @if ($block_data->btn2_icon)
                                                {!! $block_data->btn2_icon !!}
                                            @endif {{ $block_data->btn2_label }}
                                        </a>                                        
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                @if ($block->media_id)
                    <div class="row mt-4">
                        <div class="{{ $block_settings->img_container_width ?? 'col-12' }}">

                            @if ($block_settings->img_click ?? null)
                                <a data-fancybox="gallery-{{ $block['id'] }}" class="gallery" href="{{ $block->getFirstMediaUrl('block_media') }}">
                                    <img src="{{ $block->getFirstMediaUrl('block_media') }}" class="block-hero-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif" alt="{{ $block_data->title }}">
                                </a>
                            @else
                                <img src="{{ $block->getFirstMediaUrl('block_media') }}" class="block-hero-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif" alt="{{ $block_data->title }}">
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @elseif ($block_settings->image_position == 'left')
        @php
            if (($block_settings->img_col ?? null) == '25') {
                $hero_col1 = 'col-12 col-sm-6 col-md-3';
                $hero_col2 = 'col-12 col-sm-6 col-md-9';
            } elseif (($block_settings->img_col ?? null) == '33') {
                $hero_col1 = 'col-12 col-sm-6 col-md-4';
                $hero_col2 = 'col-12 col-sm-6 col-md-8';
            } else {
                $hero_col1 = 'col-12 col-sm-6 col-md-6';
                $hero_col2 = 'col-12 col-sm-6 col-md-6';
            }
        @endphp

        <div class="block style_{{ $block_settings->style_id ?? null }}"
            style="@if ($block_settings->padding_y ?? null) padding-top: {{ $block_settings->padding_y }}px; padding-bottom: {{ $block_settings->padding_y }}px @endif">

            <div class="container-xxl">
                <div class="row">
                    <div class="{{ $hero_col1 }} d-none d-sm-block text-center">
                        @if ($block->media_id)
                            @if ($block_settings->img_click ?? null)
                                <a data-fancybox="gallery-{{ $block['id'] }}" class="gallery" href="{{ $block->getFirstMediaUrl('block_media') }}">
                                    <img src="{{ $block->getFirstMediaUrl('block_media') }}" class="block-hero-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif" alt="{{ $block_data->title }}">
                                </a>
                            @else
                                <img src="{{ $block->getFirstMediaUrl('block_media') }}" class="block-hero-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif" alt="{{ $block_data->title }}">
                            @endif
                        @endif
                    </div>

                    <div class="{{ $hero_col2 }}">
                        <div class="title @if ($block_settings->shadow_title ?? null) text-shadow @endif">{!! $block_data->title !!}</div>

                        @if ($block_data->content)
                            <div class="block-hero-content @if ($block_settings->shadow_content ?? null) text-shadow @endif">{!! $block_data->content !!}</div>
                        @endif

                        @if ($block_data->btn1_label || $block_data->btn2_label)
                            <div class="row">
                                <div class="col @if ($block_data->btn2_label) col-12 col-12 col-md-6 col-lg-4 @else col-12 @endif">
                                    @if ($block_data->btn1_label)
                                        <a href="{{ $block_data->btn1_url ?? '#' }}" class="block-hero-button1 btn btn_{{ $block_data->btn1_id }}">
                                            @if ($block_data->btn1_icon)
                                                {!! $block_data->btn1_icon !!}
                                            @endif {{ $block_data->btn1_label }}
                                        </a>
                                    @endif
                                </div>

                                <div class="col col-12 col-md-6 col-lg-4">
                                    @if ($block_data->btn2_label ?? null)
                                        <a href="{{ $block_data->btn2_url ?? '#' }}" class="block-hero-button2 btn btn_{{ $block_data->btn2_id }}">
                                            @if ($block_data->btn2_icon)
                                                {!! $block_data->btn2_icon !!}
                                            @endif {{ $block_data->btn2_label }}
                                        </a>                                        
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    @elseif ($block_settings->image_position == 'right')
        @php
            if (($block_settings->img_col ?? null) == '25') {
                $hero_col2 = 'col-12 col-sm-6 col-md-3';
                $hero_col1 = 'col-12 col-sm-6 col-md-9';
            } elseif (($block_settings->img_col ?? null) == '33') {
                $hero_col2 = 'col-12 col-sm-6 col-md-4';
                $hero_col1 = 'col-12 col-sm-6 col-md-8';
            } else {
                $hero_col2 = 'col-12 col-sm-6 col-md-6';
                $hero_col1 = 'col-12 col-sm-6 col-md-6';
            }
        @endphp
        <div class="block style_{{ $block_settings->style_id ?? null }}"
            style="@if ($block_settings->padding_y ?? null) padding-top: {{ $block_settings->padding_y }}px; padding-bottom: {{ $block_settings->padding_y }}px @endif">

            <div class="container-xxl">
                <div class="row">
                    <div class="{{ $hero_col1 }}">
                        <div class="title @if ($block_settings->shadow_title ?? null) text-shadow @endif">{!! $block_data->title !!}</div>

                        @if ($block_data->content)
                            <div class="block-hero-content @if ($block_settings->shadow_content ?? null) text-shadow @endif">{!! $block_data->content !!}</div>
                        @endif

                        @if ($block_data->btn1_label)
                            <a href="{{ $block_data->btn1_url ?? '#' }}" class="block-hero-button1 btn btn_{{ $block_data->btn1_id }}">
                                @if ($block_data->btn1_icon)
                                    {!! $block_data->btn1_icon !!}
                                @endif {{ $block_data->btn1_label }}
                            </a>
                        @endif

                        @if ($block_data->btn2_label)
                            <a href="{{ $block_data->btn2_url ?? '#' }}" class="ms-4 block-hero-button2 btn btn_{{ $block_data->btn2_id }}">
                                @if ($block_data->btn2_icon)
                                    {!! $block_data->btn2_icon !!}
                                @endif {{ $block_data->btn2_label }}
                            </a>
                        @endif                        

                    </div>

                    <div class="{{ $hero_col2 }} d-none d-sm-block text-center">
                        @if ($block->media_id)
                            @if ($block_settings->img_click ?? null)
                                <a data-fancybox="gallery-{{ $block['id'] }}" class="gallery" href="{{ $block->getFirstMediaUrl('block_media') }}">
                                    <img src="{{ $block->getFirstMediaUrl('block_media') }}" class="block-hero-img img-fluid float-end @if ($block_settings->shadow ?? null) shadow @endif" alt="{{ $block_data->title }}">
                                </a>
                            @else
                                <img src="{{ $block->getFirstMediaUrl('block_media') }}" class="block-hero-img img-fluid float-end @if ($block_settings->shadow ?? null) shadow @endif" alt="{{ $block_data->title }}">
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>

    @endif

@endif

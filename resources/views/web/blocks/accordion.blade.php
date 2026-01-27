@if (count($block_items) > 0)
    <div class="container-xxl">
        <div class="block">

            @include('pivlu::web.includes.block-header')

            @if ($block_settings->bg_color_item_active_title ?? null)
                @php
                    $accordion_item_title_css = $block_settings->bg_color_item_active_title . '!important';
                @endphp
                <style>
                    .accordion-button:not(.collapsed) {
                        /*color: unset !important;*/
                        background-color: {{ $accordion_item_title_css }};
                    }

                    .accordion-button .accordion_collapse_first_show:not(.collapsed) {
                        /*color: unset !important;*/
                        background-color: {{ $accordion_item_title_css }};
                    }
                </style>
            @endif

            <div class="accordion @if ($block_settings->remove_border ?? null) accordion-flush @endif" id="accordion_{{ $block['id'] }}">
                @foreach ($block_items as $block_item)
                    @php
                        $block_item_data = json_decode($block_item->active_language_content->data ?? null);
                    @endphp

                    <div class="accordion-item">
                        <div class="accordion-header" id="heading_{{ $loop->index }}">
                            <button
                                class="accordion-button collapsed block-accordion-title @if ($block_settings->items_title_style_id ?? null) style_{{ $block_settings->items_title_style_id }} @endif @if ($loop->index == 0 && ($block_settings->collapse_first_item ?? null)) accordion_collapse_first_show @endif"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $loop->index }}" aria-expanded="@if ($loop->index == 0) true @else false @endif"
                                aria-controls="collapse_{{ $loop->index }}">
                                <div class="title">{{ $block_item_data->title ?? null }}</div>
                            </button>
                        </div>

                        <div id="collapse_{{ $loop->index }}" class="accordion-collapse collapse @if ($loop->index == 0 && ($block_settings->collapse_first_item ?? null)) show @endif" aria-labelledby="heading_{{ $loop->index }}"
                            data-bs-parent="#accordion_{{ $block['id'] }}">
                            <div class="accordion-body block-accordion-content @if ($block_settings->items_content_style_id ?? null) style_{{ $block_settings->items_content_style_id }} @endif">
                                {!! $block_item_data->content ?? null !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
@endif

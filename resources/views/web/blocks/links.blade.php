@if (count($block_items) > 0)
    <div class="block">

        @include('pivlu::web.includes.block-header')

        @if (count($block_items) > 0)

            @if (($block_settings->display_style ?? null) == 'list')
                <ul>
            @endif

            @foreach ($block_items as $item)
                @php
                    $block_item_data = json_decode($item->active_language_content->data ?? null);
                @endphp

                @if (($block_settings->display_style ?? null) == 'list')
                    <li>
                @endif

                @if ($block_item_data->icon ?? null)
                    {!! $block_item_data->icon !!}
                @endif
                <a href="{{ $block_item_data->url }}" title="{{ $block_item_data->title }}" @if ($block_settings->new_tab ?? null) target="_blank" @endif>{{ $block_item_data->title }}</a>

                @if (($block_settings->display_style ?? null) == 'list')
                    </li>
                @else
                    <span class="me-3"></span>
                @endif
            @endforeach

        @endif

    </div>

@endif

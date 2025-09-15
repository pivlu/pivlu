@php
    $block_data = footer_block($block['id']);
    $block_content = json_decode($block_data->content);
    $block_header = json_decode($block_data->header);
@endphp

@if ($block_content ?? null)   
    @if ($block_header->add_header ?? null)
        @if ($block_header->title ?? null)
            <div class="title">
                {!! $block_header->title ?? null !!}
            </div>
        @endif

        @if ($block_header->content ?? null)
            <div class="subtitle">
                {!! $block_header->content ?? null !!}
            </div>
        @endif
    @endif

    @if (count($block_content) > 0)

        @if (($block_settings->display_style ?? null) != 'multiple')
            <ul>
        @endif

        @foreach ($block_content as $item)
            @if (($block_settings->display_style ?? null) != 'multiple')
                <li class="mb-2">
                    @if ($item->icon)
                        {!! $item->icon !!}
                    @endif
                    <a href="{{ $item->url }}" title="{{ $item->title }}">{{ $item->title }}</a>
                </li>
            @else
                @if ($item->icon)
                    {!! $item->icon !!}
                @endif <a href="{{ $item->url }}" title="{{ $item->title }}">{{ $item->title }}</a><span class="me-3"></span>
            @endif
        @endforeach

    @endif
@endif

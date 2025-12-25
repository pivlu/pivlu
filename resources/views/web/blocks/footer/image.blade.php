@php
    $block_data = footer_block($block['id']);
@endphp

@if ($block_data->content ?? null)
    @php
        $block_item = json_decode($block_data->content);
        $block_header = json_decode($block_data->header ?? null);
    @endphp

    @if ($block_item->media_id ?? null)
        @if ($block_item->url)
            <a title="{{ $block_item->title ?? $block_item->caption }}" href="{{ $block_item->url }}"><img src="{{ image($block_item->media_id) }}"
                    class="block-image-img img-fluid @if ($block_data->settings->shadow ?? null) shadow @endif @if ($block_data->settings->rounded ?? null) rounded @endif" alt="{{ $block_item->title ?? $block_item->media_id }}"></a>
        @else
            <img src="{{ image($block_item->media_id) }}" class="block-image-img img-fluid @if ($block_data->settings->shadow ?? null) shadow @endif @if ($block_data->settings->rounded ?? null) rounded @endif"
                alt="{{ $block_item->title ?? $block_item->media_id }}" title="{{ $block_item->title ?? $block_item->image }}">
        @endif

        @if ($block_item->caption ?? null)
            <div class="block-image-caption">{{ $block_item->caption }}</div>
        @endif

    @endif

@endif

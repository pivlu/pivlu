@php
    $block_data = footer_block($block['id']);
    $block_content = json_decode($block_data->content);
@endphp

@if ($block_content ?? null)
    @if ($block_content->media_id ?? null)
        @if ($block_content->url)
            <a title="{{ $block_content->title ?? $block_content->media_id }}" href="{{ $block_content->url }}"><img src="{{ image($block_content->media_id) }}"
                    class="block-image-img img-fluid @if ($block_data->settings->shadow ?? null) shadow @endif @if ($block_data->settings->rounded ?? null) rounded @endif" alt="{{ $block_content->title ?? 'image' }}"></a>
        @else
            <img src="{{ image($block_content->media_id) }}" class="block-image-img img-fluid @if ($block_data->settings->shadow ?? null) shadow @endif @if ($block_data->settings->rounded ?? null) rounded @endif"
                alt="{{ $block_content->title ?? 'image' }}" title="{{ $block_content->title ?? null }}">
        @endif

        @if ($block_content->caption ?? null)
            <div class="block-image-caption">{{ $block_content->caption }}</div>
        @endif

    @endif

@endif

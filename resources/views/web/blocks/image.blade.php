@if ($block_content ?? null)
    <div class="block text-center">

        @include('web.includes.block-header')

        @if ($block_content->media_id ?? null)
            @if ($block_content->url)
                <a title="{{ $block_content->title ?? $block_content->media_id }}" href="{{ $block_content->url }}"><img src="{{ image($block_content->media_id) }}"
                        class="block-image-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif" alt="{{ $block_content->title ?? $block_content->media_id }}"></a>
            @else
                <a data-fancybox="image" href="{{ image($block_content->media_id) }}"><img src="{{ image($block_content->media_id) }}"
                        class="block-image-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif" alt="{{ $block_content->title ?? $block_content->media_id }}"
                        title="{{ $block_content->title ?? $block_content->media_id }}"></a>
            @endif

            @if ($block_content->caption ?? null)
                <div class="caption">{{ $block_content->caption }}</div>
            @endif

        @endif
    </div>
@endif

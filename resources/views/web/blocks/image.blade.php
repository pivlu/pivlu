@if ($block_content->media_id ?? null)

    <div class="container-xxl">

        <div class="block text-center">

            @include('pivlu::web.includes.block-header')

            @if ($block_data->url ?? null)
                <a title="{{ $block_data->title ?? $block_content->media_id }}" href="{{ $block_data->url }}">
                    <img src="{{ $block_content->getFirstMediaUrl('block_content_media') }}"
                        class="block-image-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif" alt="{{ $block_data->title ?? $block_content->media_id }}">
                </a>
            @else
                <a data-fancybox="image" href="{{ $block_content->getFirstMediaUrl('block_content_media') }}"><img src="{{ $block_content->getFirstMediaUrl('block_content_media', 'large') }}"
                        class="block-image-img img-fluid @if ($block_settings->shadow ?? null) shadow @endif @if ($block_settings->rounded ?? null) rounded @endif" alt="{{ $block_data->title ?? $block_content->media_id }}"
                        title="{{ $block_data->title ?? $block_content->media_id }}"></a>
            @endif

            @if ($block_data->caption ?? null)
                <div class="caption">{{ $block_data->caption }}</div>
            @endif

        </div>
        
    </div>
@endif

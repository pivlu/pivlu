@php
    $block_data = block($block['id']);
@endphp


@if ($block_data->content ?? null)
    @php
        $block_item = unserialize($block_data->content);
        $block_header = unserialize($block_data->header ?? null);
    @endphp

    <div class="block text-center">

        @if ($block_header['add_header'] ?? null)
            <div class="block-header">
                @if ($block_header['title'] ?? null)
                    <div class="block-header-title title">
                        {{ $block_header['title'] ?? null }}
                    </div>
                @endif

                @if ($block_header['content'] ?? null)
                    <div class="block-header-content mt-3">
                        {!! $block_header['content'] ?? null !!}
                    </div>
                @endif
            </div>
        @endif

        @if ($block_item['media_id'] ?? null)
            @if ($block_item['url'])
                <a title="{{ $block_item['title'] ?? __('image') }}" href="{{ $block_item['url'] }}"><img src="{{ image($block_item['media_id']) }}"
                        class="block-image-img img-fluid @if ($block_extra['shadow'] ?? null) shadow @endif @if ($block_extra['rounded'] ?? null) rounded @endif" alt="{{ $block_item['title'] ?? __('image') }}"></a>
            @else
                <a data-fancybox="image" href="{{ image($block_item['media_id']) }}"><img src="{{ image($block_item['media_id']) }}"
                        class="block-image-img img-fluid @if ($block_extra['shadow'] ?? null) shadow @endif @if ($block_extra['rounded'] ?? null) rounded @endif" alt="{{ $block_item['title'] ?? __('image') }}"
                        title="{{ $block_item['title'] ?? __('image') }}"></a>
            @endif

            @if ($block_item['caption'] ?? null)
                <div class="caption">{{ $block_item['caption'] }}</div>
            @endif

        @endif
    </div>
@endif

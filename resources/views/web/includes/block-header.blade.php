@if ($block_header->add_header ?? null)
    <div class="block-header">
        @if ($block_header->title ?? null)
            <div class="block-header-title">
                {{ $block_header->title ?? null }}
            </div>
        @endif

        @if ($block_header->content ?? null)
            <div class="block-header-content">
                {!! $block_header->content ?? null !!}
            </div>
        @endif
    </div>
@endif

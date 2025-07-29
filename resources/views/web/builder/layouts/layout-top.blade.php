@foreach (layout_blocks($layout->id, 'top') as $block)
    @php
        $block_extra = unserialize($block->extra);
    @endphp

    <div class="section @if ($block_extra['style_id'] ?? null) style_{{ $block_extra['style_id'] }} @endif" id="layout-block-{{ $block->id }}">
        @include("web.builder.includes.blocks-switch", ['is_layout' => 1])
    </div>
@endforeach

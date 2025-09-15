@foreach (layout_blocks($layout->id, 'bottom') as $block)
    @php
        $block_extra = unserialize($block->block_extra);
    @endphp

    <div class="section" id="layout-block-{{ $block->id }}" @if ($block_extra['bg_color'] ?? null) style="background-color: {{ $block_extra['bg_color'] }}" @endif
        @if ($layout->bg_color_bottom) style="background-color: {{ $layout->bg_color_bottom }}" @endif>
        @include("web.includes.blocks-switch", ['is_layout' => 1])
    </div>
@endforeach

@php
    if ($blocks_source == 'homepage') {
        $source_blocks = homepage_blocks();
    } else {
        $source_blocks = content_blocks();
    }
@endphp


@foreach (homepage_blocks() as $block)
    @php
        if ($layout->id ?? null) {
            $block_data = layout_block($block['id']);
        } else {
            $block_data = block($block['id']);
        }

        $block_settings = json_decode($block->settings ?? null);
        $block_content = json_decode($block_data->content ?? null);
        $block_header = json_decode($block_data->header ?? null);
    @endphp

    <div class="section @if ($block_settings->style_id ?? null) style_{{ $block_settings->style_id }} @endif" id="block-{{ $block->id }}">
        @include('web.includes.blocks-switch', ['is_layout' => 0])
    </div>
@endforeach

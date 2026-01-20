@foreach (($content_blocks ?? []) as $key => $block_id)
    @php        
        $block = block($block_id);

        $block_content = $block->content ?? null;

        $block_settings = json_decode($block->settings ?? null);

        $block_data = json_decode($block->active_language_content->data ?? null);

        $block_header = json_decode($block->active_language_content->header ?? null);

        $block_items = $block->block_items ?? null;
    @endphp

    <div class="section @if ($block_settings->style_id ?? null) style_{{ $block_settings->style_id }} @endif" id="block-{{ $block_id }}">
        @include('pivlu::web.includes.blocks-switch', ['is_layout' => 0])
    </div>
@endforeach

@foreach ($content_blocks as $block)
    @php
        $block_settings = json_decode($block->settings);
        $block_data = block($block->id);
        $block_header = json_decode($block_data->header ?? null);
    @endphp

    <div class="section" id="block-{{ $block->id }}" @if ($block_settings->bg_color ?? null) style="background-color: {{ $block_settings->bg_color }}" @endif>
        @include('web.includes.blocks-switch')
    </div>
@endforeach

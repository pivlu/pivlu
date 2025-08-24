@foreach ($content_blocks as $block)
    @php        
        $block_settings = unserialize($block['settings']);        
    @endphp

    <div class="section" id="block-{{ $block['id'] }}" @if ($block_settings['bg_color'] ?? null) style="background-color: {{ $block_settings['bg_color'] }}" @endif>
        @include("web.includes.blocks-switch")
    </div>
@endforeach

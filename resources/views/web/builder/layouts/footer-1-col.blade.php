{{--
@foreach (footer_blocks($footer, 1) as $block)
    @php
        $block_extra = unserialize($block->extra);
    @endphp

    <div class="section" id="footer-block-{{ $block->id }}">
        @switch($block->type)
            @case('custom')
                @include("web.builder.blocks.footer.custom")
            @break
            @case('editor')
                @include("web.builder.blocks.footer.editor")
            @break           
            @case('image')
                @include("web.builder.blocks.footer.image")
            @break
            @case('links')
                @include("web.builder.blocks.footer.links")
            @break
            @case('text')
                @include("web.builder.blocks.footer.text")
            @break            
        @endswitch
    </div>
@endforeach
--}}
@foreach (footer_blocks($active_theme->id, $footer, 1) as $block)
    @php
        $block_settings = json_decode($block->settings);
    @endphp

    <div class="section" id="footer-block-{{ $block->id }}">
        @switch($block->block_type->type)
            @case('custom')
                @include('web.includes.blocks.footer.custom')
            @break

            @case('editor')
                @include('web.includes.blocks.footer.editor')
            @break           

            @case('image')
                @include('web.includes.blocks.footer.image')
            @break

            @case('links')
                @include('web.includes.blocks.footer.links')
            @break            
        @endswitch
    </div>
@endforeach

@foreach (footer_blocks($footer, 1) as $block)

    @php
        $block_extra = unserialize($block->block_extra);
    @endphp

    <div class="section" id="footer-block-{{ $block->id }}">
        @switch($block->type)
            @case('custom')
                @include("web.blocks.footer.custom")
            @break
            @case('editor')
                @include("web.blocks.footer.editor")
            @break
            @case('forum')
                @include("web.blocks.footer.forum")
            @break
            @case('image')
                @include("web.blocks.footer.image")
            @break
            @case('links')
                @include("web.blocks.footer.links")
            @break
            @case('map')
                @include("web.blocks.footer.map")
            @break
            @case('posts')
                @include("web.blocks.footer.posts")
            @break
            @case('search')
                @include("web.blocks.footer.search")
            @break
        @endswitch
    </div>
@endforeach

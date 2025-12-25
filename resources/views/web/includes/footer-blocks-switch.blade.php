@switch($block->block_type->type)
    @case('custom')
        @include('web.blocks.footer.custom')
    @break

    @case('editor')
        @include('web.blocks.footer.editor')
    @break

    @case('image')
        @include('web.blocks.footer.image')
    @break

    @case('links')
        @include('web.blocks.footer.links')
    @break
@endswitch

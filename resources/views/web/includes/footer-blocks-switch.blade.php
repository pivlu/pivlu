@switch($block->block_type->type)
    @case('custom')
        @include('pivlu::web.blocks.footer.custom')
    @break

    @case('editor')
        @include('pivlu::web.blocks.footer.editor')
    @break

    @case('image')
        @include('pivlu::web.blocks.footer.image')
    @break

    @case('links')
        @include('pivlu::web.blocks.footer.links')
    @break
@endswitch

@php
    $block_object = block($block['id']);

    $block_content = $block_object->content ?? null;

    $block_settings = json_decode($block_object->settings ?? null);

    $block_data = json_decode($block_object->active_language_content->data ?? null);

    $block_header = json_decode($block_object->active_language_content->header ?? null);

    $block_items = $block_object->block_items ?? null;
@endphp

@switch($block->block_type->type)
    @case('custom')
        @include('pivlu::web.blocks.custom')
    @break

    @case('editor')
        @include('pivlu::web.blocks.editor')
    @break

    @case('image')
        @include('pivlu::web.blocks.image')
    @break

    @case('links')
        @include('pivlu::web.blocks.links')
    @break
@endswitch

@php
    $block_data = footer_block($block['id']);
@endphp

@if ($block_data->content ?? null)

    {!! $block_data->content !!}

@endif

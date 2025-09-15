@php
    $block_data = footer_block($block['id']);
@endphp

@if ($block_data->content ?? null)
    @php
        $block_content = unserialize($block_data->content ?? null);
    @endphp

    @if ($block_content['title'] ?? null)
        <div class="title">
            {!! $block_content['title'] ?? null !!}
        </div>
    @endif

    {!! nl2br($block_content['content'] ?? null) !!}
@endif

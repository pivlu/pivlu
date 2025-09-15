@php
    $block_content = json_decode($block_data->content);
@endphp


<div class="@if ($block_settings->block_align == 'float-end') float-end ms-5 mb-4 @elseif ($block_settings->block_align == 'float-start') float-start me-5 mb-4 @endif">
    <div class="block">
        @if ($block_content->title ?? null)
            <div class="title">{{ $block_content->title }}</div>
        @endif

        @if (count(post_toc($post->id)) > 0)
            @foreach (post_toc($post->id) as $toc_item)
                <div class="mb-1">
                    <a class="fw-bold" href="#{{ $toc_item['slug'] }}">{{ $toc_item['title'] }}</a>
                </div>
            @endforeach
        @endif
    </div>
</div>

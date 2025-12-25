@if ($block_content ?? null)
    @if ($block_content->title || $block_content->content)
        <div class="block">
            <div class="alert alert-{{ $block_settings->type ?? 'info' }} block-alert-item" role="alert">
                @if ($block_content->title ?? null)
                    <div class="block-alert-title">{{ $block_content->title }}</div>
                @endif
                @if ($block_content->content ?? null)
                    <div class="block-alert-content">{!! nl2br($block_content->content) !!}</div>
                @endif
            </div>
        </div>
    @endif
@endif

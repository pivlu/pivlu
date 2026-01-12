@if ($block_data ?? null)
    @if ($block_data->title || $block_data->content)
        <div class="container-xxl">
            <div class="block">
                <div class="alert alert-{{ $block_settings->type ?? 'info' }} block-alert-item" role="alert">
                    @if ($block_data->title ?? null)
                        <div class="block-alert-title">{{ $block_data->title }}</div>
                    @endif
                    @if ($block_data->content ?? null)
                        <div class="block-alert-content">{!! nl2br($block_data->content) !!}</div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endif

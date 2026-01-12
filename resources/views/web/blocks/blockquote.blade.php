@if ($block_data ?? null)
    <div class="container-xxl">
        <div class="block-blockquote">
            <blockquote @if ($block_settings->shadow ?? null) class="shadow" @endif>
                <div class="block-blockquote-content">{!! $block_data->content ?? null !!}</div>

                @if ($block_data->source ?? null)
                    <div class="block-blockquote-source">
                        @if (($block_settings->use_avatar ?? null) && ($block->media_id ?? null))
                            <img class="block-blockquote-avatar img-fluid" alt="{{ $block_data->source ?? null }}" src="{{ $block->getFirstMediaUrl('block_media', 'thumb') }}">
                        @endif
                        {!! $block_data->source !!}
                    </div>
                @endif
            </blockquote>
        </div>
    </div>
@endif

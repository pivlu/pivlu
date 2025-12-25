@if ($block_content ?? null)
    <div class="container-xxl">
        <div class="block-blockquote">
            <blockquote @if ($block_settings->shadow ?? null) class="shadow" @endif>
                <div class="block-blockquote-content">{!! $block_content->content !!}</div>

                @if ($block_content->source ?? null)
                    <div class="block-blockquote-source">
                        @if (($block_settings->use_avatar ?? null) && ($block_settings->avatar_media_id ?? null))
                            <img class="block-blockquote-avatar img-fluid" alt="{{ $block_content->source }}" src="{{ image($block_settings->avatar_media_id) }}">
                        @endif
                        {!! $block_content->source !!}
                    </div>
                @endif
            </blockquote>
        </div>
    </div>
@endif

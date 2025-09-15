@if ($block_data->content ?? null)
    @php
        $item = unserialize($block_data->content);
    @endphp

    <div class="container-xxl">
        <div class="block-blockquote">
            <blockquote @if ($block_settings['shadow'] ?? null) class="shadow" @endif>
                <div class="block-blockquote-content">{!! $item['content'] !!}</div>

                @if ($item['source'] ?? null)
                    <div class="block-blockquote-source">
                        @if (($block_settings['use_avatar'] ?? null) && ($block_settings['avatar'] ?? null))
                            <img class="block-blockquote-avatar img-fluid" alt="{{ $item['source'] }}" src="{{ image($block_settings['avatar']) }}">
                        @endif
                        {!! $item['source'] !!}
                    </div>
                @endif
            </blockquote>
        </div>
    </div>
@endif

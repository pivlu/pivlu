@if ($block_content ?? null)
    <div class="block text-center">

        @include('web.includes.block-header')

        @if ($block_content->embed ?? null)
            <div @if ($block_content->full_width_responsive ?? null) class="ratio ratio-16x9" @endif>
                {!! $block_content->embed !!}
            </div>
            @if ($block_content->caption ?? null)
                <div class="caption">{{ $block_content->caption }}</div>
            @endif
        @endif
    </div>

@endif

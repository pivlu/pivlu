@if ($block_data ?? null)
    <div class="block text-center">

        @include('pivlu::web.includes.block-header')

        @if ($block_data->embed ?? null)
            <div @if ($block_settings->full_width_responsive ?? null) class="ratio ratio-16x9" @endif>
                {!! $block_data->embed !!}
            </div>
            @if ($block_data->caption ?? null)
                <div class="caption">{{ $block_data->caption }}</div>
            @endif
        @endif
    </div>

@endif

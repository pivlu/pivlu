@if ($block_data->content ?? null)
    <div class="container-xxl">
        <div class="block">
            {!! $block_data->content !!}
        </div>
    </div>
@endif

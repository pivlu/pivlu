@if ($block_data->content ?? null)
    <div class="block">
        <div class="container-xxl">
            {!! $block_data->content !!}
        </div>
    </div>
@endif

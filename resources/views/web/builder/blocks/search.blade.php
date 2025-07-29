@php
    if ($layout->id ?? null) {
        $block_data = layout_block($block['id']);
    } else {
        $block_data = block($block['id']);
    }
@endphp

@if ($block_data->content ?? null)
    @php
        $block_item = unserialize($block_data->content);
    @endphp

    <div class="block">

        @if ($block_item['title'] ?? null)
            <div class="block-title title">
                {{ $block_item['title'] ?? null }}
            </div>
        @endif

        @if ($block_item['description'] ?? null)
            <div class="block-content mt-3">
                {{ $block_item['description'] ?? null }}
            </div>
        @endif

        <div class="mt-2 mb-2">
            @if ($block_extra['offset'] ?? null)
                <div class="col-md-6 offset-md-3">
            @endif
                <form methpd="get" action="{{ route('posts.search', ['lang' => $lang]) }}">
                    <input type="text" class="form-control @if ($block_extra['form_large'] ?? null) form-control-lg @endif" name="s" required placeholder="{{ $block_item['placeholder'] ?? null }}" value="{{ $s ?? null }}">
                </form>

            @if ($block_extra['offset'] ?? null)
                </div>            
            @endif
        </div>
    </div>
@endif

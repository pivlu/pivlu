<div class="container-xxl">
    <div class="row">

        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 ps-0">
            @foreach (content_blocks($module, $content_id) as $block)
                @php
                    $block_extra = unserialize($block->block_extra);
                @endphp
                <div class="section" id="block-{{ $block->id }}" @if ($block_extra['bg_color'] ?? null) style="background-color: {{ $block_extra['bg_color'] }}" @endif>
                    @include("web.includes.blocks-switch")
                </div>
            @endforeach
        </div>

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 pe-0">
            @foreach (layout_blocks($layout->id, 'sidebar') as $block)
                @php
                    $block_extra = unserialize($block->block_extra);
                @endphp

                <div class="section" id="layout-block-{{ $block->id }}" @if ($layout->bg_color_sidebar) style="background-color: {{ $layout->bg_color_sidebar }}" @endif>
                    @include("web.includes.blocks-switch", ['is_layout' => 1])
                </div>
            @endforeach
        </div>

    </div>
</div>

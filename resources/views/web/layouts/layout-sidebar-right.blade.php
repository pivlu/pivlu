<div class="@if ($page->container_fluid ?? null) container-fluid @else container-xxl @endif">
    <div class="row">

        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 ps-0">
            @include("web.layouts.layout-content")
        </div>

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 pe-0 h-100">
            @foreach (layout_blocks($layout->id, 'sidebar') as $block)
                @php
                    $block_extra = unserialize($block->extra);
                @endphp

                <div class="section" id="layout-block-{{ $block->id }}" @if ($layout->bg_color_sidebar) style="background-color: {{ $layout->bg_color_sidebar }}" @endif>
                    @include("web.includes.blocks-switch", ['is_layout' => 1])
                </div>
            @endforeach
        </div>

    </div>
</div>

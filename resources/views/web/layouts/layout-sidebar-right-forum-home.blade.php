<div class="@if ($config->tpl_forum_container_fluid ?? null) container-fluid @else container-xxl @endif">
    <div class="row">                

        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 h-100">
            <div class="style_forum mt-4">
                @include('pivlu::web.includes.forum-index')
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
            @foreach (layout_blocks($layout->id, 'sidebar') as $block)
                @php
                    $block_extra = unserialize($block->extra);
                @endphp

                <div class="section" id="layout-block-{{ $block->id }}" @if ($layout->bg_color_sidebar) style="background-color: {{ $layout->bg_color_sidebar }}" class="px-2" @endif>
                    @include('pivlu::web.includes.blocks-switch', ['is_layout' => 1])
                </div>
            @endforeach
        </div>

    </div>
</div>

<div class="row gx-5">

    @for ($footer_col = 1; $footer_col <= 4; $footer_col++)
        <div class="col-md-3 col-sm-6 col-12">
            @foreach (footer_blocks($footer, $footer_col) as $block)
                @php
                    $block_extra = unserialize($block->extra);
                @endphp

                <div class="section mb-3" id="footer-block-{{ $block->id }}">
                    @switch($block->type)
                        @case('custom')
                            @include('web.builder.blocks.footer.custom')
                        @break

                        @case('editor')
                            @include('web.builder.blocks.footer.editor')
                        @break

                        @case('image')
                            @include('web.builder.blocks.footer.image')
                        @break

                        @case('links')
                            @include('web.builder.blocks.footer.links')
                        @break

                        @case('text')
                            @include('web.builder.blocks.footer.text')
                        @break
                    @endswitch
                </div>
            @endforeach
        </div>
    @endfor

</div>

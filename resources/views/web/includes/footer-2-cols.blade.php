<div class="row">

    @for ($footer_col = 1; $footer_col <= 2; $footer_col++)
        <div class="col-md-6 col-12">
            @foreach (footer_blocks($active_theme->id, $footer, $footer_col) as $block)
                @php
                    $block_settings = json_decode($block->settings);
                @endphp

                <div class="section" id="footer-block-{{ $block->id }}">
                    @switch($block->block_type->type)
                        @case('custom')
                            @include('web.includes.blocks.footer.custom')
                        @break

                        @case('editor')
                            @include('web.includes.blocks.footer.editor')
                        @break

                        @case('image')
                            @include('web.includes.blocks.footer.image')
                        @break

                        @case('links')
                            @include('web.includes.blocks.footer.links')
                        @break
                    @endswitch
                </div>
            @endforeach
        </div>
    @endfor

</div>

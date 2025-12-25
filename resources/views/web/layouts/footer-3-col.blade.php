<div class="row gx-5">

    @for ($footer_col = 1; $footer_col <= 3; $footer_col++)
        <div class="col-md-4 col-12">
            @foreach (footer_blocks($footer->id, $destination, $footer_col) as $block)
                @php
                    $block_extra = unserialize($block->extra);
                @endphp

                <div class="section mb-3" id="footer-block-{{ $block->id }}">
                    @include('web.includes.footer-blocks-switch')
                </div>
            @endforeach
        </div>
    @endfor

</div>

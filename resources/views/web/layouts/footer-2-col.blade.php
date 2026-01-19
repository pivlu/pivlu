<div class="row gx-5">

    @for ($footer_col = 1; $footer_col <= 2; $footer_col++)
        <div class="col-md-6 col-12">
            @foreach (footer_blocks($config->footer_id, $destination, $footer_col) as $block)               
                <div class="section mb-3" id="footer-block-{{ $block->id }}">
                    @include('pivlu::web.includes.footer-blocks-switch')
                </div>
            @endforeach
        </div>
    @endfor

</div>

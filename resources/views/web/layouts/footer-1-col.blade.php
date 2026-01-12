@foreach (footer_blocks($tpl_footer->id, $destination, $col = 1) as $block)    
    <div class="section" id="footer-block-{{ $block->id }}">
        @include('pivlu::web.includes.footer-blocks-switch')
    </div>
@endforeach

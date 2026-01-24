@if ($config->footer_id ?? null)
    <div id="footer" >
        <!-- ======= Primary Footer ======= -->
        <div class="style_footer py-4 @if($config->footer_use_custom_style ?? null) style_{{ $config->footer_style_id ?? null }} @endif">
            <div class="container-xxl overflow-hidden">
                @php
                    $footer_columns = $config->footer_columns ?? 1;
                @endphp

                @include("pivlu::web.layouts.footer-{$footer_columns}-col", ['destination' => 'primary'])
            </div>
        </div>


        @if (($config->footer2_show ?? null) == 1)
            <!-- ======= Secondary Footer ======= -->
            <div class="style_footer2 py-3 @if($config->footer2_use_custom_style ?? null) style_{{ $config->footer2_style_id ?? null }} @endif">
                <div class="container-xxl overflow-hidden">
                    @php
                        $footer2_columns = $config->footer2_columns ?? 1;
                    @endphp

                    @include("pivlu::web.layouts.footer-{$footer2_columns}-col", ['destination' => 'secondary'])
                </div>
            </div>
        @endif
    </div>
@endif

@if (Cookie::get('preview_theme'))
    <div class="preview-theme-notice bg-warning text-center py-2">
        <span class="text-dark">{{ __('You are previewing a theme. ') }}</span>
        <a href="{{ route('preview_theme', ['theme_code' => 'default']) }}" class="text-dark text-decoration-underline">{{ __('Click here to exit preview mode.') }}</a>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<!-- Fancybox -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js"></script>

<script>
    Fancybox.bind("[data-fancybox]", {});
</script>

@if (($config->addthis_code ?? null) && ($config->addthis_code_enabled ?? null))
    <!-- Addthis tools -->
    {!! $config->addthis_code ?? null !!}
@endif

{!! $config->template_global_footer_code ?? null !!}

@php
    $footer = footer();
@endphp

<div id="footer">
    <!-- ======= Primary Footer ======= -->
    <div class="style_footer py-4">
        <div class="@if ((($is_forum_page ?? null) && ($config->tpl_forum_container_fluid ?? null)) || (($is_page ?? null) && ($page->container_fluid ?? null))) container-fluid @else container-xxl @endif overflow-hidden">
            @php
                $footer_columns = $footer->footer_columns ?? 1;
            @endphp

            @include("pivlu::web.layouts.footer-{$footer_columns}-col", ['destination' => 'primary'])
        </div>
    </div>


    @if ($footer->footer2_show ?? null)
        <!-- ======= Secondary Footer ======= -->
        <div class="style_footer2 py-3">
            <div class="@if ((($is_forum_page ?? null) && ($config->tpl_forum_container_fluid ?? null)) || (($is_page ?? null) && ($page->container_fluid ?? null))) container-fluid @else container-xxl @endif">
                @php
                    $footer2_columns = $footer->footer2_columns ?? 1;
                @endphp

                @include("pivlu::web.layouts.footer-{$footer2_columns}-col", ['destination' => 'secondary'])
            </div>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<!-- Fancybox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>

@if (($config->addthis_code ?? null) && ($config->addthis_code_enabled ?? null))
    <!-- Addthis tools -->
    {!! $config->addthis_code ?? null !!}
@endif

{!! $config->template_global_footer_code ?? null !!}

@if ($config->popup_enabled ?? null)
    @php
        $popup_title_key = 'popup_title_' . active_lang()->id;
        $popup_content_key = 'popup_content_' . active_lang()->id;
        $popup_destination_page_label_key = 'popup_destination_page_label_' . active_lang()->id;
        $popup_destination_page_url_key = 'popup_destination_page_url_' . active_lang()->id;
        $popup_button_label_key = 'popup_button_label_' . active_lang()->id;

        $popup_content = $config->$popup_content_key;
        $popup_content = str_replace(["\r", "\n", '<br>'], '', $popup_content);

    @endphp
    <script src="{{ asset('assets/js/cookies.js') }}"></script>
    <script>
        var options = {
            title: '{{ $config->$popup_title_key ?? __('Accept terms') }}',
            message: "{{ $popup_content ?? __('Accept terms') }}",
            delay: 600,
            expires: {{ $config->popup_days ?? 30 }}, // 30 days default
            link: '{{ $config->$popup_destination_page_url_key ?? '#' }}',
            uncheckBoxes: true,
            acceptBtnLabel: '{{ $config->$popup_button_label_key ?? __('I agree') }}',
            moreInfoLabel: '{{ $config->$popup_destination_page_label_key ?? '#' }}',
        }

        $(document).ready(function() {
            $('body').ihavecookies(options);

            $('#ihavecookiesBtn').on('click', function() {
                $('body').ihavecookies(options, 'reinit');
            });
        });
    </script>
@endif

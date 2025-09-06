<div id="footer">
    <!-- ======= Primary Footer ======= -->
    <div class="">
        <div class="container-xxl">
            @php
                $footer_columns = $config->footer_columns ?? 1;
            @endphp

            @switch($footer_columns)
                @case('1')
                    @include("web.layouts.footer-1-col", ['footer' => 'primary'])
                @break

                @case('2')
                    @include("web.layouts.footer-2-cols", ['footer' => 'primary'])
                @break

                @case('3')
                    @include("web.layouts.footer-3-cols", ['footer' => 'primary'])
                @break

                @case('4')
                    @include("web.layouts.footer-4-cols", ['footer' => 'primary'])
                @break
            @endswitch
        </div>
    </div>


    @if ($config->footer2_show ?? null)
        <!-- ======= Secondary Footer ======= -->
        <div class="{{ get_style('footer2') }}">
            <div class="container-xxl">
                @php
                    $footer_columns = $config->footer2_columns ?? 1;
                @endphp

                @switch($footer_columns)
                    @case('1')
                        @include("web.layouts.footer-1-col", ['footer' => 'secondary'])
                    @break

                    @case('2')
                        @include("web.layouts.footer-2-cols", ['footer' => 'secondary'])
                    @break

                    @case('3')
                        @include("web.layouts.footer-3-cols", ['footer' => 'secondary'])
                    @break

                    @case('4')
                        @include("web.layouts.footer-4-cols", ['footer' => 'secondary'])
                    @break
                @endswitch
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
        $popup_content = str_replace(array("\r", "\n", "<br>"), '', $popup_content);

    @endphp
    <script src="{{ config('app.cdn') }}/js/cookies.js"></script>
    <script>
        var options = {
            title: '{{ $config->$popup_title_key ?? __("Accept terms") }}',
            message: "{{ $popup_content ?? __("Accept terms") }}",
            delay: 600,
            expires: {{ $config->popup_days ?? 30 }}, // 30 days default
            link: '{{ $config->$popup_destination_page_url_key ?? "#" }}',           
            uncheckBoxes: true,
            acceptBtnLabel: '{{ $config->$popup_button_label_key ?? __("I agree") }}',
            moreInfoLabel: '{{ $config->$popup_destination_page_label_key ?? "#" }}',
        }

        $(document).ready(function() {
            $('body').ihavecookies(options);            

            $('#ihavecookiesBtn').on('click', function() {
                $('body').ihavecookies(options, 'reinit');
            });
        });
    </script>
@endif

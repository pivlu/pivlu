<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="{{ $config->site_author ?? 'Pivlu - https://pivlu.com' }}">

<!-- Favicon -->
@if ($config->favicon_url ?? null)
    <link rel="shortcut icon" href="{{ $config->favicon_url }}">
@else
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
@endif

<!-- Bootstrap CSS-->
@if (($langDir ?? null) == 'rtl')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK+FeSepNUTGILpC6LN/0YFFomNYKtD1YNSZCBh8YkG6JekW5D" crossorigin="anonymous">
@else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endif

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<!-- Fancybox -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css" />

<!-- Main CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/css/builder.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/blocks.css') }}" />

<!-- Custom CSS File -->
<link rel="stylesheet" href='{{ asset("custom/themes/$config->theme_code.css") }}' />
<link rel="stylesheet" href='{{ asset('custom/styles.css') }}' />

<!-- Syntax highlight-->
<link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism.css') }}">
<script src="{{ asset('assets/vendor/prism/prism.js') }}"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


{!! $config->theme_global_head_code ?? null !!}

@if ($config->popup_enabled ?? null)
    <link rel="stylesheet" href="{{ asset('assets/css/cookie.css') }}">
@endif

@if (($config->google_analytics_id ?? null) && ($config->google_analytics_enabled ?? null))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $config->google_analytics_id ?? null }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ $config->google_analytics_id ?? null }}');
    </script>
@endif

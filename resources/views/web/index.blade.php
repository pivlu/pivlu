<!DOCTYPE html>
<html lang="{{ $tpl_locale->code }}" dir="{{ $tpl_locale->dir ?? 'ltr' }}">

<head>
    <title>{{ $tpl_config_locale->site_meta_title ?? __('Pivlu website') }}</title>
    <meta name="description" content="{{ $tpl_config_locale->site_meta_description ?? __('Pivlu website') }}">

    @include('pivlu::web.global.head')

    <!-- Syntax highlight-->
    <link rel="stylesheet" href="https://cdn.clevada.com/vendors/prism/prism.css">
    <script src="https://cdn.clevada.com/vendors/prism/prism.js"></script>
</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        @include('pivlu::web.global.navigation')

        <div class="container-xxl">
            @include('pivlu::web.includes.get-blocks', ['blocks_source' => 'homepage', 'is_layout' => 0])           
        </div>

    </div>
    <!-- End Main Content -->

    {{--@include('pivlu::web.global.footer')--}}

</body>

</html>

<!DOCTYPE html>
<html lang="{{ $config->locale }}" dir="{{ $config->text_dir }}">

<head>
    <title>{{ $config->site_meta_title ?? __('Pivlu website') }}</title>
    <meta name="description" content="{{ $config->site_meta_description ?? __('Pivlu website') }}">
    @include('pivlu::web.global.head')   
</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        @include('pivlu::web.global.navigation')
        
        @include('pivlu::web.includes.get-blocks')

    </div>
    <!-- End Main Content -->

    @include('pivlu::web.global.footer')

</body>

</html>

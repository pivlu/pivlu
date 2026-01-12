<!DOCTYPE html>
<html lang="{{ $config->locale }}" dir="{{ $config->text_dir }}">

<head>

    <title>{{ $page->meta_title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? config('app.name') }}">

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

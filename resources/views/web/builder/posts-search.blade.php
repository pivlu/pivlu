<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $site_text_dir }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ __('Search') }} {{ $s }} - {{ $config_lang->site_label }}</title>
    <meta name="description" content="{{ __('Search') }} {{ $s }} - {{ $config_lang->site_label }}">
    @include('web.builder.global.head')
</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        @include('web.builder.global.navigation')

        @include('web.builder.includes.posts-search')

        <div class="container-xxl mt-5 style_posts">            

            @include('web.builder.includes.posts-listing')            

            {{ $posts->links() }}
        </div>

    </div>

    @include('web.builder.global.footer')

</body>

</html>

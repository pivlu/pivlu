<!DOCTYPE html>
<html lang="{{ $config->locale }}" dir="{{ $config->text_dir }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $categ->title }} | {{ $config_lang->site_label ?? null }}</title>
    <meta name="description" content="{{ $categ->description ?? $categ->title }}">

    @include('pivlu::web.global.head')
</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        @include('pivlu::web.global.navigation')

        @include('pivlu::web.includes.posts-search')

        @if (($layout_top ?? null) == 1)
            @include('pivlu::web.layouts.layout-top')
        @endif

        @if (($layout_sidebar ?? null) == 'left')
            @include('pivlu::web.layouts.layout-sidebar-left-posts-categ')
        @elseif (($layout_sidebar ?? null) == 'right')
            @include('pivlu::web.layouts.layout-sidebar-right-posts-categ')
        @else
            <div class="container-xxl mt-4 style_posts">
                @include('pivlu::web.layouts.layout-content-posts-categ')
            </div>
        @endif        

        @if (($layout_bottom ?? null) == 1)
            @include('pivlu::web.layouts.layout-bottom')
        @endif
    </div>
    <!-- End Main Content -->

    @include('pivlu::web.global.footer')

</body>

</html>

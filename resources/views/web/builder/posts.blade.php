<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $site_text_dir }}">

<head>
    <title>{{ $config_lang->posts_meta_title ?? __('Blog') }}</title>
    <meta name="description" content="{{ $config_lang->posts_meta_description ?? __('Blog') }}">

    @include('web.builder.global.head')
</head>

<body class="style_global">

    <!-- Main Content -->
    <div class="content">

        @include('web.builder.global.navigation')

        @include('web.builder.includes.posts-search')

        @if (($layout_top ?? null) == 1)
            @include('web.builder.layouts.layout-top')
        @endif

        @if (($layout_sidebar ?? null) == 'left')
            @include('web.builder.layouts.layout-sidebar-left-posts')
        @elseif (($layout_sidebar ?? null) == 'right')
            @include('web.builder.layouts.layout-sidebar-right-posts')
        @else
            <div class="container-xxl mt-4 style_posts">
                @include('web.builder.layouts.layout-content-posts')
            </div>
        @endif

        @if (($layout_bottom ?? null) == 1)
            @include('web.builder.layouts.layout-bottom')
        @endif

    </div>
    <!-- End Main Content -->

    @include('web.builder.global.footer')

</body>

</html>

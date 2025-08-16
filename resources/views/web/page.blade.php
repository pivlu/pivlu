<!DOCTYPE html>
<html lang="{{ $lang ?? 'en' }}" dir="{{ $langDir ?? 'ltr' }}">

<head>

    <title>{{ $page->meta_title ?? 'Clevada site' }}</title>
    <meta name="description" content="{{ $page->meta_description ?? 'Clevada site' }}">

    @include("web.global.head")

</head>

<body class="{{ get_default_style() }}">

    <!-- Start Main Content -->
    <div class="content">
        @include("web.global.navigation")

        @if (($layout_top ?? null) == 1)
            @include("web.layouts.layout-top")
        @endif

        @if (($layout_sidebar ?? null) == 'left')
            @include("web.layouts.layout-sidebar-left")
        @elseif (($layout_sidebar ?? null) == 'right')
            @include("web.layouts.layout-sidebar-right")
        @else
            @include("web.layouts.layout-content")
            
        @endif

        @if (($layout_bottom ?? null) == 1)
            @include("web.layouts.layout-bottom")
        @endif

    </div>
    <!-- End Main Content -->

    @include("web.global.footer")

</body>

</html>

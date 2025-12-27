<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $site_text_dir }}">

<head>

    <title>{{ $page->meta_title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? config('app.name') }}">

    @include('pivlu::web.global.head')

</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">
        @include('pivlu::web.global.navigation')        

        @if (($layout_top ?? null) == 1)
            @include('pivlu::web.layouts.layout-top')
        @endif

        @if (($layout_sidebar ?? null) == 'left')
            @include('pivlu::web.layouts.layout-sidebar-left')
        @elseif (($layout_sidebar ?? null) == 'right')
            @include('pivlu::web.layouts.layout-sidebar-right')
        @else
            {{--
            <div class="@if ($page->container_fluid ?? null) container-fluid @else container-xxl @endif mt-4 style_forum">
                @include('pivlu::web.layouts.layout-content')
            </div>
            --}}
            @include('pivlu::web.layouts.layout-content')
        @endif

        @if (($layout_bottom ?? null) == 1)
            @include('pivlu::web.layouts.layout-bottom')
        @endif

    </div>
    <!-- End Main Content -->

    @include('pivlu::web.global.footer')

</body>

</html>

<!DOCTYPE html>
<html lang="{{ $config->locale }}" dir="{{ $config->text_dir }}">

<head>
    <title>{{ $post->posts_meta_title ?? __('Blog') }}</title>
    <meta name="description" content="{{ $config_lang->posts_meta_description ?? __('Blog') }}">

    @include('pivlu::web.global.head')
</head>

<body class="style_global">

    <!-- Main Content -->
    <div class="content">

        @include('pivlu::web.global.navigation')

        @include('pivlu::web.includes.posts-search')

        <div class="container-xxl mt-4 style_posts">

            @include('pivlu::web.includes.post-type-taxonomies')

            @include('pivlu::web.includes.posts-listing')

            {{ $posts->links() }}

        </div>

    </div>
    <!-- End Main Content -->

    @include('pivlu::web.global.footer')

</body>

</html>

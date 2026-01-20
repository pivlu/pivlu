<!DOCTYPE html>
<html lang="{{ $config->locale }}" dir="{{ $config->text_dir }}">

<head>
    <title>{{ $s }} - {{ __('search results') }}</title>
    <meta name="description" content="{{ __('Search results for %s', ['s' => $s]) }}">

    @include('pivlu::web.global.head')
</head>

<body class="style_global">

    <!-- Main Content -->
    <div class="content">

        @include('pivlu::web.global.navigation')

        @include('pivlu::web.includes.posts-search')

        <div class="container-xxl mt-4 style_posts">

            <h2>{{ $s }} - {{ __('search results') }}</h2>

            @if ($posts->total() > 0)

                <div class="fw-bold fs-5 mt-3 mb-1">{{ $posts->total() }} {{ __('articles') }}</div>

                @foreach ($posts as $post)
                    <div class="mb-2">
                        <i class="bi bi-arrow-right-short"></i> <a class="fw-bold" title="{{ $post->active_language_content->title }}"
                            href="{{ $post->active_language_content->url ?? '#' }}">{{ $post->active_language_content->title }}</a>
                        <span class="text-muted small">{{ date_locale($post->created_at, 'datetime') }}</span>
                    </div>
                @endforeach

                {{ $posts->appends(['s' => $s])->links() }}
            @else
                <div class="">
                    {{ __('No articles found for your search.') }}
                </div>
            @endif



        </div>

    </div>
    <!-- End Main Content -->

    @include('pivlu::web.global.footer')

</body>

</html>

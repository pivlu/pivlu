<!DOCTYPE html>

<html lang="{{ theme_meta('locale') }}" dir="{{ theme_meta('dir') }}">

<head>
    <title>{{ $post->title }}</title>
    <meta name="description" content="Site meta description">

    @include("{$theme_path}.includes.head")
</head>

<body>

    @include("{$theme_path}.includes.navigation")

    <!-- Main Content -->
    <div class="main">

        <div class="container">

            <div class="post">

                <div class="post_head text-center col-md-10 offset-md-1">

                    <div class="title mb-3">{{ $post->title }}</div>

                    @if ($post->summary)
                        <div class="summary mb-3">
                            {{ $post->summary }}
                        </div>
                    @endif

                    <div class="meta mb-3">
                        @if ($post->created_at)
                            {{ date_locale($post->created_at) }}
                        @endif


                        <img src="{{ avatar($post->user_id) }}" alt="{{ $post->author_name }}" class="avatar rounded-circle ms-2">

                        <a href="{{ route('profile', ['username' => $post->user->username]) }}">{{ $post->author_name }}</a>

                        @if ($post->hits)
                            <i class="bi bi-eye ms-2"></i> {{ $post->hits }} {{ __('visits') }}
                        @endif

                        @if ($post->minutes_to_read > 0)
                            <i class="bi bi-clock ms-2"></i> {{ $post->minutes_to_read }} {{ __('minutes read') }}
                        @endif
                    </div>


                    <div class="main-image mb-4 post-main-img-full-width">
                        <img class="img-fluid rounded" src="{{ $post->image }}" alt="{{ $post->title }}" title="{{ $post->title }}">
                    </div>

                </div>


                <div class="content">
                    @foreach ($content_blocks as $block)
                        @php
                            $block_settings = unserialize($block['settings']);
                        @endphp
                        <div class="section @if ($block_settings['style_id'] ?? null) style_{{ $block_settings['style_id'] }} @endif" id="block-{{ $block['id'] }}">
                            @include('web.blocks.blocks-switch')
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>

    @include("{$theme_path}.includes.footer")

</body>

</html>

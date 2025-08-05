<!DOCTYPE html>

<html lang="{{ theme_meta('locale') }}" dir="{{ theme_meta('dir') }}">

<head>
    <title>{{ $page->meta_title }}</title>
    <meta name="description" content="{{ $page->meta_description}}">

    @include("{$theme_path}.includes.head")
</head>

<body>

    @include(theme_menu())

    <!-- Main Content -->
    <div class="main">

        <div class="container">

            <div class="post">

                <div class="post_head text-center col-md-10 offset-md-1">

                    <div class="title mb-3">{{ $page->title }}</div>

                    @if ($page->summary)
                        <div class="summary mb-3">
                            {{ $page->summary }}
                        </div>
                    @endif

                    <div class="meta mb-3">
                        @if ($page->created_at)
                            {{ date_locale($page->created_at) }}
                        @endif

                        <img src="{{ avatar($page->author_avatar) }}" alt="{{ $page->author_name }}" class="avatar rounded-circle ms-2">

                        <a href="{{ route('profile', ['username' => $page->user->username]) }}">{{ $page->author_name }}</a>                                          
                    </div>

                    @if ($page->media_id)
                        <div class="main-image mb-4 post-main-img-full-width">
                            <img class="img-fluid rounded" src="{{ $page->image }}" alt="{{ $page->title }}" title="{{ $page->title }}">
                        </div>
                    @endif
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

    @include(theme_footer())

</body>

</html>

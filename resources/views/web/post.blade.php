<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $site_text_dir }}">

<head>
    <title>{{ $post->meta_title ?? $post->title }}</title>
    <meta name="description" content="{{ $post->meta_description ?? ($post->summary ?? strip_tags(substr($post->content, 0, 300))) }}">

    @include('pivlu::web.global.head')

    <meta property="og:title" content="{{ $post->title }}" />
    @if ($post->image)
        <meta property="og:image" content="{{ image($post->image) }}" />
    @endif
    <meta property="og:site_name" content="{{ $config_lang->site_label ?? config('app.name') }}" />
    <meta property="og:description" content="{{ $post->meta_description ?? ($post->summary ?? strip_tags(substr($post->content, 0, 300))) }}" />
    <meta property="fb:app_id" content="{{ $config->facebook_app_id ?? null }}" />
    <meta property="og:type" content="article" />

    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <!-- END CSS for this page -->

    @if ($config->posts_comments_fb_enabled ?? null)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/{{ $locale ?? 'en_US' }}/sdk.js#xfbml=1&version=v15.0&appId={{ $config->facebook_app_id ?? null }}&autoLogAppEvents=1"
            nonce="Fr0Xvgjc"></script>
    @endif
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
            @include('pivlu::web.layouts.layout-sidebar-left-posts-post')
        @elseif (($layout_sidebar ?? null) == 'right')
            @include('pivlu::web.layouts.layout-sidebar-right-posts-post')
        @else
            <div class="container-xxl mt-4 style_posts">
                @include('pivlu::web.includes.post-item')
            </div>
        @endif       

        @if (($layout_bottom ?? null) == 1)
            @include('pivlu::web.layouts.layout-bottom')
        @endif
    </div>
    <!-- End Main Content -->

    @include('pivlu::web.global.footer')

    @if (!($config->posts_likes_disabled ?? null))
        <script>
            jQuery(document).ready(function() {
                $(".like").on('click', function(event, value, caption) {
                    $.ajax({
                        type: 'GET',
                        data: {
                            post_id: '{{ json_encode($post->id) }}'
                        },
                        url: "{{ route('post.like', ['categ_slug' => $post->categ_slug, 'slug' => $post->slug])",
                        success: function(data) {
                            if (data == 'liked') {
                                var elem = document.getElementById('like_success');
                                $(elem).show();
                            }
                            if (data == 'already_liked') {
                                var elem = document.getElementById('like_error');
                                var elem2 = document.getElementById('like_success');
                                $(elem2).hide();
                                $(elem).show();
                            }
                            if (data == 'login_required') {
                                var elem = document.getElementById('login_required');
                                $(elem).show();
                            }
                        }
                    });
                });
            });
        </script>
    @endif

</body>

</html>

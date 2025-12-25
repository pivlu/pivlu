@if (!($config->tpl_post_hide_breadcrumb ?? null))
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb  @if ($config->tpl_post_head_align_center ?? null) justify-content-center @endif">
            <li class="breadcrumb-item"><a href="{{ route('home', ['lang' => getRouteLang()]) }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('posts', ['lang' => getRouteLang()]) }}">{{ $config_lang->posts_label ?? __('Posts') }}</a>
            </li>
            @foreach (breadcrumb($post->categ_id) as $bread_categ)
                <li class="breadcrumb-item"><a href="{{ $bread_categ->url }}">{{ $bread_categ->title }}</a></li>
            @endforeach
        </ol>
    </nav>
@endif

<div class="post">

    <div class="post_head @if ($config->tpl_post_head_align_center ?? null) text-center col-md-10 offset-md-1 @endif">

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


            <img src="{{ avatar($post->user_id) }}" alt="{{ $post->author->name }}" class="avatar rounded-circle ms-2">

            <a href="{{ route('profile', ['username' => $post->author->username, 'lang' => getRouteLang()]) }}">{{ $post->author->name }}</a>

            @if ($post->hits)
                <i class="bi bi-eye ms-2"></i> {{ $post->hits }} {{ __('visits') }}
            @endif

            @if ($post->minutes_to_read > 0)
                <i class="bi bi-clock ms-2"></i> {{ $post->minutes_to_read }} {{ __('minutes read') }}
            @endif
        </div>

        @if ($post->image && !($config->tpl_post_hide_image ?? null))
            <div class="main-image mb-4 @if ($config->tpl_post_image_force_full_width ?? null) post-main-img-full-width @endif">
                <img class="img-fluid {{ $config->tpl_post_image_height_class ?? null }} @if ($config->tpl_post_image_rounded ?? null) rounded @endif @if ($config->tpl_post_image_shadow ?? null) shadow @endif"
                    src="{{ image($post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}">
            </div>
        @endif
    </div>

    <div class="addthis_inline_share_toolbox mb-2"></div>


    <div class="content">
        @foreach ($content_blocks as $block)
            @php
                $block_extra = unserialize($block['extra']);
            @endphp
            <div class="section @if ($block_extra['style_id'] ?? null) style_{{ $block_extra['style_id'] }} @endif" id="block-{{ $block['id'] }}">
                @include('web.includes.blocks-switch')
            </div>
        @endforeach
    </div>


    @if ($post->cf_group_id && isset($post->cf_array_display))
        <div class="specs mb-3">
            @foreach (unserialize($post->cf_array_display) as $key => $specs)
                <div class="col-12 specs_section mb-1">{{ $key }}</div>

                @foreach ($specs as $spec => $value)
                    @if ($value)
                        <div class="specs_list mb-1">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                    <div class="fw-bold">{{ $spec }}:</div>
                                </div>

                                <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                                    {!! $value !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="mb-3"></div>
            @endforeach
        </div>
    @endif

    @if ($tags)
        <div class="tags mb-3">
            @foreach ($tags as $tag_item)
                <div class="me-3 mb-2 float-start"><a class="tag" href="{{ route('posts.tag', ['slug' => $tag_item->tag->slug, 'lang' => getRouteLang()]) }}">{{ $tag_item->tag->tag }}</a></div>
            @endforeach
        </div>
    @endif
    
    @if (($config->posts_likes_enabled ?? null) && !($post->disable_likes ?? null))
        <div class="post_likes mb-4">
            <button class="btn btn-light like border border-secondary"><i class="bi bi-hand-thumbs-up"></i> {{ __('I like') }} ({{ $post->likes }})</button>

            <div id="like_success" class="text-success small mt-2" style="display: none; font-weight:bold">
                {{ __('You like this') }}</div>
            <div id="like_error" class="text-danger small mt-2" style="display: none; font-weight:bold">
                {{ __('You already like this') }}</div>
            <div id="login_required" class="text-danger small mt-2" style="display: none; font-weight:bold">
                {{ __('You must login to like') }}:
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
        </div>

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script>
            jQuery(document).ready(function() {
                $(".like").on('click', function(event, value, caption) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: {
                            post_id: '{{ json_encode($post->id) }}'
                        },
                        url: "{{ route('post.like', ['categ_slug' => $post->category->slug, 'slug' => $post->slug, 'lang' => getRouteLang()]) }}",
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


    @if (($config->posts_comments_enabled ?? null) && !($post->disable_comments ?? null))
        @if ($config->posts_comments_enabled ?? null)
            @include('web.includes.post-comments')
        @endif
        @if ($config->posts_comments_fb_enabled ?? null)
            <div class="fb-comments" data-href="{{ $post->url }}" data-width="100%" data-numposts="10"></div>
        @endif
    @endif
</div>

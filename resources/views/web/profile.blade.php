<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $site_text_dir }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $user->name }}</title>
    <meta name="description" content="{{ $user->name }} - {{ __('profile page') }}">

    @include('web.global.head')
</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        @include('web.global.navigation')

        <div class="container-xxl mt-5">

            <div>
                <img src="{{ avatar($user->id) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle float-start me-2" style="max-height: 50px;">
                <div class="fw-bold fs-5 pt-0">{{ $user->name }}</div>
                <div class="text-muted">{{ __('Member since') }}: {{ date_locale($user->created_at) }}</div>
            </div>

            @if ($bio ?? null)
                <div class="clearfix"></div>
                <div class="pofile-bio mt-2">{!! nl2br($bio) !!}</div>
            @endif

            <div class="clearfix"></div>
            <hr class="clearfix mt-3">

            @if ($posts->total() > 0)

                <div class="fw-bold fs-5 mt-3 mb-1">{{ $posts->total() }} {{ __('articles') }}</div>

                @foreach ($posts as $post)
                    <div class="mb-2">
                        <i class="bi bi-arrow-right-short"></i> <a class="fw-bold" title="{{ $post->title }}" href="{{ $post->url }}">{{ $post->title }}</a>
                        <span class="text-muted small">{{ date_locale($post->created_at, 'datetime') }}</span>
                    </div>
                @endforeach

                {{ $posts->appends(['id' => $user->id, 'slug' => $user->slug])->links() }}

            @endif


            @if ($forum_topics->total() > 0)

                <div class="fw-bold fs-5 mt-3 mb-1">{{ $forum_topics->total() }} {{ __('forum topics') }}</div>

                @foreach ($forum_topics as $topic)
                    <div class="mb-2">
                        <i class="bi bi-arrow-right-short"></i> <a class="fw-bold" title="{{ $topic->title }}" href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}">{{ $topic->title }}</a>
                        <span class="text-muted small">{{ date_locale($topic->created_at, 'datetime') }}</span>
                    </div>
                @endforeach

                {{ $forum_topics->appends(['id' => $user->id, 'slug' => $user->slug])->links() }}

            @endif

            @if ($forum_posts->total() > 0)

                <div class="fw-bold fs-5 mt-3 mb-1">{{ $forum_posts->total() }} {{ __('forum responses') }}</div>

                <table class="table">
                    @foreach ($forum_posts as $post)
                        <tbody>
                            <tr>
                                <td>
                                    <span class="text-muted small">{{ date_locale($post->created_at, 'datetime') }} {{ __('in') }}</span>
                                    <b><a title="{{ $post->topic->title }}"
                                            href="{{ route('forum.post', ['topic_id' => $post->topic_id, 'slug' => $post->topic->slug, 'post_id' => $post->id]) }}">{{ $post->topic->title }}</a></b>
                                    <div class="text-clamp-3">{!! strip_tags($post->content) !!}</div>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>

                {{ $forum_posts->appends(['id' => $user->id, 'slug' => $user->slug])->links() }}

            @endif

        </div>

    </div>
    <!-- End Main Content -->

    @include('web.global.footer')

</body>

</html>

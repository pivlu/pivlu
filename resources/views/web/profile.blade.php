<!DOCTYPE html>
<html lang="{{ $config->locale }}" dir="{{ $config->text_dir }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $user->name }}</title>
    <meta name="description" content="{{ $user->name }} - {{ __('profile page') }}">

    @include('pivlu::web.global.head')
</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        @include('pivlu::web.global.navigation')

        <div class="container-xxl mt-5">

            <div>
                <img src="{{ avatar($user) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle float-start me-2" style="max-height: 50px;">
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
                        <i class="bi bi-arrow-right-short"></i> <a class="fw-bold" title="{{ $post->active_language_content->title }}" href="{{ $post->active_language_content->url ?? '#' }}">{{ $post->active_language_content->title }}</a>
                        <span class="text-muted small">{{ date_locale($post->created_at, 'datetime') }}</span>
                    </div>
                @endforeach

                {{ $posts->appends(['id' => $user->id, 'slug' => $user->slug])->links() }}

            @endif


        </div>

    </div>
    <!-- End Main Content -->

    @include('pivlu::web.global.footer')

</body>

</html>

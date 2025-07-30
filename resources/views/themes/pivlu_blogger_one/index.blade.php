<!DOCTYPE html>

<html lang="{{ theme_meta('locale') }}" dir="{{ theme_meta('dir') }}">

<head>
    <title>Pivlu Clean Blog</title>
    <meta name="description" content="Site meta description">

    @include("{$theme_path}.includes.head")
</head>

<body>

    @include(theme_menu())

    @include(theme_section('hero'))

    <!-- Main Content -->
    <div class="container">

        @if (posts()->total() == 0)
            @include(theme_section('samples.homepage-posts'))
        @endif

        @foreach (posts() as $post)
            <!-- Blog Post Item Start-->
            <div class="listings-box">

                <div class="row">

                    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-4 col-12">
                        <a title="{{ $post->title }}" href="{{ $post->url }}">
                            <img src="{{ $post->image }}" class="img-fluid mb-3 rounded" alt="{{ $post->title }}"></a>
                    </div>

                    <div class="col-xl-9 col-lg-7 col-md-7 col-sm-8 col-12">

                        <h1 class="title">
                            <a href="{{ $post->url }}">{{ $post->title }}</a>
                        </h1>

                        <div class="summary">
                            <p>{{ $post->summary }}</p>
                        </div>

                        <div class="meta">
                            <img class="avatar-small rounded-circle" src="{{ $post->author_avatar }}" alt="{{ $post->author_name }}"> <a href="#"> {{ $post->author_name }}</a> <i class="far fa-calendar ms-3"></i>
                            December 21,
                            2020, 18:45
                        </div>

                    </div>

                </div>

            </div>
            <!-- Blog Post Item End -->
        @endforeach


        <div class="text-center">
            {{ posts()->links() }}
        </div>


    </div>
    <!-- End container -->

    @include(theme_footer())

</body>

</html>

<!DOCTYPE html>

<html lang="{{ theme_meta('locale') }}" dir="{{ theme_meta('dir') }}">

<head>
    <title>Clean Blog | Free Bootstrap 5 blog template</title>
    <meta name="description" content="Site meta description">

    @include("{$theme_path}.includes.head")
</head>

<body>

    @include("{$theme_path}.includes.navigation")

    <!-- Page Header -->
    <div class="head" style="background: url('{{ theme_asset('assets/img/top.jpg') }}') top center; background-size: cover;">
        <div class="container">

            <div class="site-heading">
                <div class="title">Bootstrap24 Clean Blog</div>
                <div class="subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eu mattis eros. Donec urna nulla, tristique et suscipit lacinia, dignissim sit amet lectus. Pellentesque quam arcu,
                    feugiat at tellus in, venenatis fermentum lectus</div>
            </div>

        </div>
    </div>

    <!-- Main Content -->
    <div class="container">

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
                            <img class="avatar-small rounded-circle" src="{{ $post->author_avatar }}" alt="{{ $post->author_name }}"> <a href="#"> {{ $post->author_name }}</a> <i class="far fa-calendar ms-3"></i> December 21,
                            2020, 18:45
                        </div>

                    </div>

                </div>

            </div>
            <!-- Blog Post Item End -->
        @endforeach






        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>


    </div>
    <!-- End container -->

    @include("{$theme_path}.includes.footer")

</body>

</html>

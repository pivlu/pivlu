<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home', ['lang' => getRouteLang()]) }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('forum', ['lang' => getRouteLang()]) }}">{{ $config_lang->forum_label ?? 'Forum' }}</a></li>
        @foreach (breadcrumb($categ->id, 'forum') as $b_categ)
            <li class="breadcrumb-item"><a href="{{ route('forum.categ', ['slug' => $b_categ->slug]) }}">{{ $b_categ->title }}</a></li>
        @endforeach
    </ol>
</nav>

@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        @if ($message == 'error_content')
            {{ __('Error. Please input content') }}
        @endif
        @if ($message == 'error_topic_not_active')
            {{ __("Error. You can't reply to this topic") }}
        @endif
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-info font-weight-bold">
        @if ($message == 'reported')
            <i class="fas fa-exclamation-triangle"></i> {{ __('Report was sent. Thank you') }}
        @endif
        @if ($message == 'post_created')
            {{ __('Your reply was added') }}
        @endif
    </div>
@endif

<div class="mb-3">
    <div class="float-end">
        <a class="btn @if ($config->tpl_forum_btn_id ?? null) btn_{{ $config->tpl_forum_btn_id }} {{ button($config->tpl_forum_btn_id)->font_weight ?? null }} {{ button($config->tpl_forum_btn_id)->rounded ?? null }} {{ button($config->tpl_forum_btn_id)->size ?? null }} {{ button($config->tpl_forum_btn_id)->shadow ?? null }}
            @else btn_1 @endif ms-3"
            href="{{ route('forum.topic.create', ['categ_id' => $categ->allow_topics ? $categ->id : '']) }}"><i class="bi bi-plus-circle"></i> {{ __('New topic') }}</a>
    </div>

    <div class="float-end">
        <form class="row row-cols-lg-auto g-0 align-items-center" method="GET" action="{{ route('forum.search_results') }}">
            <div class="col-12">
                <label class="visually-hidden" for="inlineFormInputGroupSearch">{{ __('Search in forum') }}</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="s" placeholder="{{ __('Search in forum') }}" aria-label="{{ __('Search in forum') }}" aria-describedby="addonForumSearch">
                    <span class="input-group-text bg-light p-0" id="addonForumSearch"><button type="submit" class="btn btn-light border-0"><i class="bi bi-search"></i></button></span>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="fw-bold fs-5 mb-2">{{ $topic->title }}</div>

<div class="text-muted small mb-3">{{ __('Created at') }} {{ date_locale($topic->created_at, 'datetime') }} {{ __('by') }} <a class="fw-bold"
        href="{{ route('profile', ['username' => $topic->author->username]) }}">{{ $topic->author->name }}</a></div>

<div class="card card-forum mb-4">
    @include('pivlu::web.includes.forum-topic-header')

    @include('pivlu::web.includes.forum-topic-body')
</div>

<div class="mb-3"></div>

@foreach ($posts as $post)
    <div class="card card-forum mb-4">

        @include('pivlu::web.includes.forum-post-header')

        <div class="card-body @if ($post->count_best_answer > 0 && $loop->index == 0) forum-post-best-answer @endif">
            @include('pivlu::web.includes.forum-post-body')
        </div>
    </div>
@endforeach

{{ $posts->links() }}

<div class="mb-3"></div>

@if (!Auth::user())
    {{ __('You must be logged to post new topic') }}. <a href="{{ route('login') }}">{{ __('Login') }}</a> {{ __('or') }} <a href="{{ route('register') }}">{{ __('register account') }}</a>
@else
    <a name="reply"></a>

    @if ($topic->deleted_at || $topic->closed_at)
        <div class="text-danger font-weight-bold">{{ __('This topic is closed') }}</div>
    @else
        <form method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>{{ __('Post reply') }}</label>
                <textarea id="trumbowyg-editor" class="form-control trumbowyg-editor" name="content" required></textarea>
            </div>

            @if ($config->tpl_forum_uploads_enabled ?? null)
                <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-file-image"></i> {{ __('Attach images') }}
                </a>

                <div class="collapse" id="collapseExample">
                    <small class="form-text text-muted mb-3">{{ __('Maximum 6 images. File extensions: jpg,jpeg,bmp,png,gif,webp. Maximum 2.5 MB size per file.') }}</small>

                    <div class="row">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="col-12 col-md-6 mb-3">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="image_{{ $i }}">
                                </div>
                            </div>
                        @endfor
                    </div>

                </div>
            @endif

            <div class="form-group mt-3">
                <button type="submit"
                    class="btn @if ($config->tpl_forum_btn_id ?? null) btn_{{ $config->tpl_forum_btn_id }} {{ button($config->tpl_forum_btn_id)->font_weight ?? null }} {{ button($config->tpl_forum_btn_id)->rounded ?? null }} {{ button($config->tpl_forum_btn_id)->size ?? null }} {{ button($config->tpl_forum_btn_id)->shadow ?? null }}
                    @else btn_1 @endif">{{ __('Post reply') }}</button>
            </div>

        </form>
    @endif
@endif

<div class="mb-3"></div>
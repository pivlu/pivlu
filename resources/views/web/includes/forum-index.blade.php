<div class="float-end">
    <a class="btn @if ($config->tpl_forum_btn_id ?? null) btn_{{ $config->tpl_forum_btn_id }} {{ button($config->tpl_forum_btn_id)->font_weight ?? null }} {{ button($config->tpl_forum_btn_id)->rounded ?? null }} {{ button($config->tpl_forum_btn_id)->size ?? null }} {{ button($config->tpl_forum_btn_id)->shadow ?? null }}
    @else btn_1 @endif ms-3"
        href="{{ route('forum.topic.create') }}"><i class="bi bi-plus-circle"></i> {{ __('New topic') }}</a>
</div>

<div class="float-start">
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

<div class="clearfix mb-3"></div>

@php
    if (($config->tpl_forum_index_show_latest_topics ?? null) && ($config->tpl_forum_index_show_latest_posts ?? null)) {
        $last_content_cols = 'col-6';
    } else {
        $last_content_cols = 'col-12';
    }
@endphp

@if (($config->tpl_forum_index_show_latest_topics ?? null) || ($config->tpl_forum_index_show_latest_posts ?? null))
    <div class="@if ($config->tpl_forum_container_fluid ?? null) container-fluid px-0 @else container-xxl px-0 @endif">
        <div class="row gx-5">

            <div class="{{ $last_content_cols }}">
                @if ($config->tpl_forum_index_show_latest_topics ?? null)
                    <div class="fw-bold mb-2">{{ __('Last subjects') }}</div>
                    <table class="table table-sm forum-last-content">
                        @foreach ($last_topics as $topic)
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="float-end ms-2 text-muted small">{{ date_locale($topic->created_at, 'datetime') }}</div>
                                        <a class="fw-bold" title="{{ $topic->title }}" href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}">{{ $topic->title }}</a>
                                        <div class="text-clamp-1">{{ $topic->category->title }}</div>

                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                @endif
            </div>

            <div class="{{ $last_content_cols }}">
                @if ($config->tpl_forum_index_show_latest_posts ?? null)
                    <div class="fw-bold mb-2">{{ __('Last responses') }}</div>
                    <table class="table table-sm forum-last-content">
                        @foreach ($last_posts as $post)
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="float-end ms-2 text-muted small">{{ date_locale($post->created_at, 'datetime') }}</div>

                                        <a class="fw-bold" href="{{ route('profile', ['username' => $post->author->username]) }}">
                                            {{ $post->author->name }}</a> {{ __('in') }} <a title="{{ $post->topic->title }}"
                                            href="{{ route('forum.post', ['topic_id' => $post->topic_id, 'slug' => $post->topic->slug, 'post_id' => $post->id]) }}">{{ $post->topic->title }}</a>
                                        <div class="text-clamp-1">{!! strip_tags($post->content) !!}</div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
@endif

@foreach ($forum_tree as $section)
    <div class="col-12 mb-4">
        <div class="forum-section">

            <div class="card-header forum-card-header">
                {!! $section->icon ?? null !!} <a class="section-title" title="{{ $section->title }}" href="{{ route('forum.categ', ['slug' => $section->slug]) }}">{{ $section->title }}</a>
                @if ($section->description)
                    <div class="mb-1"></div><small>{{ $section->description }}</small>
                @endif
            </div>

            <div class="card-body forum-categ-card-body">
                <div class="table-responsive-md">
                    <table class="table table-forum">
                        <tbody>
                            @foreach ($section->children as $categ)
                                <tr>
                                    <td>
                                        {!! $categ->icon ?? null !!} <a class="forum-categ-link" title="{{ $categ->title }}" href="{{ route('forum.categ', ['slug' => $categ->slug]) }}">{{ $categ->title }}</a>

                                        <div class="mb-1"></div>

                                        @if ($categ->description)
                                            <small>{{ $categ->description }}</small>
                                            <div class="mb-1"></div>
                                        @endif

                                        @foreach ($categ->children as $subcateg)
                                            <i class="bi bi-dot"></i> <a class="forum-subcateg-link me-2" title="{{ $subcateg->title }}"
                                                href="{{ route('forum.categ', ['slug' => $subcateg->slug]) }}">{{ $subcateg->title }}</a>
                                        @endforeach
                                    </td>

                                    <td width="130">
                                        <b>{{ $categ->count_tree_topics ?? 0 }}</b> {{ __('subjects') }}

                                        <div class="mb-2"></div>
                                        <b>{{ $categ->count_tree_posts ?? 0 }}</b> {{ __('responses') }}
                                    </td>

                                    <td width="400">
                                        @if (!($categ->last_activity ?? null))
                                            {{ __('No activity') }}
                                        @endif

                                        @if (($categ->last_activity->last_activity_type ?? null) == 'topic')
                                            <small>

                                                <img src="{{ avatar($categ->last_activity->last_topic->author->id) }}" class="forum-avatar rounded-circle">
                                                <b>{{ $categ->last_activity->last_topic->author->name }}</b>

                                                {{ __('created new topic') }}:<br>
                                                <a class="forum-link" title="{{ $categ->last_activity->last_topic->title }}"
                                                    href="{{ route('forum.topic', ['id' => $categ->last_activity->last_topic->id, 'slug' => $categ->last_activity->last_topic->slug]) }}">{{ substr($categ->last_activity->last_topic->title, 0, 40) }}
                                                    @if (strlen($categ->last_activity->last_topic->title) > 40)
                                                        ...
                                                    @endif
                                                </a> {{ __('at') }}
                                                <span class="small">{{ date_locale($categ->last_activity->last_topic->created_at, 'datetime') }}</span>
                                            </small>
                                            <div class="mb-2"></div>
                                        @endif


                                        @if (($categ->last_activity->last_activity_type ?? null) == 'post')
                                            <a class="forum-link" title="{{ $categ->last_activity->last_post->topic->title }}"
                                                href="{{ route('forum.topic', ['id' => $categ->last_activity->last_post->topic_id, 'slug' => $categ->last_activity->last_post->topic->slug]) }}">{{ substr($categ->last_activity->last_post->topic->title, 0, 48) }}
                                                @if (strlen($categ->last_activity->last_post->topic->title) > 48)
                                                    ...
                                                @endif
                                            </a>

                                            <div class="mt-1"></div>

                                            <img src="{{ avatar($categ->last_activity->last_post->author->id) }}" class="forum-avatar rounded-circle">
                                            <a class="forum-link"
                                                href="{{ route('profile', ['username' => $categ->last_activity->last_post->author->username]) }}">{{ $categ->last_activity->last_post->author->name }}</a>
                                            <span class="small">{{ date_locale($categ->last_activity->last_post->created_at, 'datetime') }}</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach

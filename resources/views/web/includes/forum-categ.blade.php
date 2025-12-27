@if ($message = Session::get('success'))
    <div class="alert alert-success">
        @if ($message == 'topic_created')
            {{ __('Topic created') }}
        @endif
    </div>
@endif

<div class="float-end">
    <a class="btn @if ($config->tpl_forum_btn_id ?? null) btn_{{ $config->tpl_forum_btn_id }} {{ button($config->tpl_forum_btn_id)->font_weight ?? null }} {{ button($config->tpl_forum_btn_id)->rounded ?? null }} {{ button($config->tpl_forum_btn_id)->size ?? null }} {{ button($config->tpl_forum_btn_id)->shadow ?? null }}
        @else btn_1 @endif ms-3"
        href="{{ route('forum.topic.create', ['categ_id' => $categ->allow_topics ? $categ->id : '']) }}"><i class="bi bi-plus-circle"></i> {{ __('New topic') }}</a>
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

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home', ['lang' => getRouteLang()]) }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('forum', ['lang' => getRouteLang()]) }}">{{ $config_lang->forum_label ?? 'Forum' }}</a></li>
        @foreach (breadcrumb($categ->id, 'forum') as $b_categ)
            <li class="breadcrumb-item"><a href="{{ route('forum.categ', ['slug' => $b_categ->slug]) }}">{{ $b_categ->title }}</a></li>
        @endforeach
    </ol>
</nav>

@if ($has_subcategories ?? null)
    @include('pivlu::web.includes.forum-subcategories')
@endif

@if ($categ_topics->total() > 0)
    <div class="card forum-section">

        <div class="card-header forum-categ-card-header">
            <a class="section-title" title="{{ $categ->title }}" href="{{ route('forum.categ', ['slug' => $categ->slug]) }}">{{ $categ->title }}</a>
            @if ($categ->description)
                <br><small>{{ $categ->description }}</small>
            @endif
        </div>

        <div class="card-body forum-categ-card-body">
            <div class="table-responsive-md">
                <table class="table table-forum">
                    <tbody>
                        @foreach ($categ_topics as $topic)
                            <tr>
                                <td>
                                    <div class="fw-bold fs-6 mb-1">
                                        <a class="forum-link" title="{{ $topic->title }}" href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}">{{ $topic->title }}</a>
                                    </div>
                                    <div class="text-muted small">
                                        <span class="float-start me-1">
                                            <img src="{{ avatar($topic->user_id) }}" class="img-fluid rounded rounded-circle" style="max-height: 20px;">
                                        </span>

                                        <a class="forum-link" href="{{ route('profile', ['username' => $topic->author->username]) }}">{{ $topic->author->name ?? null }}</a>
                                        {{ __('at') }} {{ date_locale($topic->created_at, 'datetime') ?? null }}
                                    </div>
                                </td>

                                <td width="130">
                                    <div class="text-muted text-small"><b>{{ $topic->count_posts }}</b> {{ __('responses') }}</div>
                                </td>

                                <td width="400">
                                    {{ __('Last activity') }}:<br>
                                    @if ($topic->count_posts > 0 && ($topic->last_activity_user_id ?? null))
                                        <span class="float-start me-1">
                                            <img src="{{ avatar($topic->last_activity_user_id) }}" class="img-fluid rounded rounded-circle" style="max-height: 20px;">
                                        </span>

                                        <a class="forum-link" href="{{ route('profile', ['username' => $topic->last_activity_author->username]) }}">{{ $topic->last_activity_author->name ?? null }}</a>
                                        {{ __('at') }} {{ date_locale($topic->last_activity_at, 'datetime') ?? null }}
                                    @else
                                        <div class="text-muted small">{{ __('never') }}</div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                </table>
            </div>
        </div>

    </div>
@else
    @if ($categ->allow_topics == 1 && !$has_subcategories)
        {{ 'There are no topics in' }} "{{ $categ->title }}"
    @endif
@endif

<small>{{ $categ_topics->links() }}</small>

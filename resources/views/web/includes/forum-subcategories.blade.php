@if (count($categ_topics) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">{{ __('Subject') }}</th>
                <th scope="col">{{ __('Responses') }}</th>
                <th scope="col">{{ __('Activity') }}</th>
            </tr>
        </thead>

        @foreach ($categ_topics as $topic)
            <tbody>
                <tr>
                    <th>
                        <a class="section-title" title="{{ $topic->title }}" href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}">{{ $topic->title }}</a>
                        <div class="mb-1">{{ $topic->categ_title }}</div>
                    </th>
                    <td><b>{{ $topic->count_posts ?? 0 }}</b> {{ __('responses') }}</td>
                    <td>Otto</td>
                </tr>

            </tbody>
        @endforeach
    </table>
@endif

<div class="col-12 mb-4">
    <div class="forum-section">

        <div class="card-header forum-card-header">
            {!! $categ->icon ?? null !!} <a class="section-title" title="{{ $categ->title }}" href="{{ route('forum.categ', ['slug' => $categ->slug]) }}">{{ $categ->title }}</a>
            @if ($categ->description)
                <div class="mb-1"></div><small>{{ $categ->description }}</small>
            @endif
        </div>


        <div class="card-body forum-categ-card-body">
            <div class="table-responsive-md">
                <table class="table table-forum">
                    <tbody>
                        @foreach ($categ->children as $categ)                            
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

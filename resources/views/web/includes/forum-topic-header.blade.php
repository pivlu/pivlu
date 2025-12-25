<div class="card-header forum-card-header">
    {{ date_locale($topic->created_at, 'datetime') }}
    <span class="float-end fw-bold"><a title="{{ __('Permalink to this topic') }}" href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}">#1</a></span>
</div>

<div class="card-header forum-topic-header-info">
    <span class="float-end">
        {{ __('Registered') }}: {{ date_locale($topic->author->created_at) }}
        <br>
        {{ __('Topics') }}: {{ $topic->author->forum_count_topics }}
        <br>
        {{ __('Posts') }}: {{ $topic->author->forum_count_posts }}
    </span>


    <span class="float-start me-2">
        <img src="{{ avatar($topic->user_id) }}" class="img-fluid" style="max-width: 90px;">
    </span>

    <a class="fw-bold" href="{{ route('profile', ['username' => $topic->author->username]) }}">{{ $topic->author->name }}</a>
    <br>
    {{ __('Helpful posts') }}: <span @if ($topic->author->forum_count_likes > 10) class="bold text-success" @endif>{{ $topic->author->forum_count_likes }}</span><br>
    {{ __('Best answer posts') }}: <span @if ($topic->author->forum_count_best_answer > 10) class="bold text-success" @endif>{{ $topic->author->forum_count_best_answer }}</span>
</div>

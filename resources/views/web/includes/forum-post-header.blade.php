<a class="anchor" href="#" name="{{ $post->id }}"></a>

<div class="card-header forum-card-header">
    {{ date_locale($post->created_at, 'datetime') }}
    <span class="float-end fw-bold"><a href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}#{{ $post->id }}">#{{ $loop->iteration + 1 }}</a></span>

</div>

<div class="card-header forum-topic-header-info">
    <span class="float-end">
        {{ __('Registered') }}: {{ date_locale($post->created_at, 'datetime') }}
        <br>        
        {{ __('Topics') }}: {{ $post->author->forum_count_topics }}        
        <br>
        {{ __('Posts') }}: {{ $post->author->forum_count_posts }}        
    </span>

    <span class="float-start me-2">
        <img src="{{ avatar($post->user_id) }}" class="img-fluid" style="max-width: 90px;">
    </span>

    <a class="fw-bold" href="{{ route('profile', ['username' => $post->author->username]) }}">{{ $post->author->name }}</a>
    <br>
    {{ __('Helpful posts') }}: <span @if ($post->author->forum_count_likes > 10) class="bold text-success" @endif>{{ $post->author->forum_count_likes }}</span><br>
    {{ __('Best answer posts') }}: <span @if ($post->author->forum_count_best_answer > 10) class="bold text-success" @endif>{{ $post->author->forum_count_best_answer }}</span>
</div>

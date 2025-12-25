@if ($post->count_best_answer > 0 and $loop->index == 0)
    <button class="float-end btn btn-sm forum-btn-best-answer ms-2 mb-2">{{ __('Best answer') }} ({{ $post->count_best_answer }} {{ __('votes') }})</button>
@endif

{!! strip_tags($post->content, '<code><p><br><a><img><b><strong><i><blockquote><pre><iframe><ol><ul<li><h1><h2><h3><h4><hr>') !!}

@if ($post->attachments)
    <div class="mt-3 mb-3">
        <div class="row">
            @foreach ($post->attachments as $image)
                @if (($config->tpl_forum_images_public ?? null) || Auth::user())                
                    <div class="col-lg-2 col-md-3 col-4 mb-4">
                        <a data-fancybox="gallery_post_{{ $post->id }}" href="{{ image($image->drive_code) }}">
                            <img class="img-fluid mb-2" src="{{ thumb_square($image->drive_code) }}" alt="{{ $topic->title }} - {{ $image->drive_code }}" title="{{ $topic->title }}">
                        </a>
                    </div>
                @else
                    <div class="col-12 mb-2">
                        <i class="bi bi-file-image"></i> Image #{{ $loop->iteration }} - <a href="{{ route('login') }}">{{ __('Login to view image') }}</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif

@if ($post->author->forum_signature ?? null)
    <div class="mt-5 forum_signature">{!! $post->author->forum_signature !!}</div>
@endif

@if (!$topic->closed_at && $post->user_id != (Auth::user()->id ?? null))

    <hr>

    <span class="float-end">
        @if ($config->tpl_forum_likes_enabled ?? null)
            @if (forum_check_like('post', $post->id))
                <span class="text-success small me-2"><i class="bi bi-hand-thumbs-up-fill"></i> {{ __('You like this') }} ({{ forum_check_like('post', $post->id) }} {{ __('votes') }})</span>
            @else
                <button class="btn btn-sm btn-success ms-2" id="like-post-{{ $post->id }}"><i class="bi bi-hand-thumbs-up"></i></button>
                <script>
                    $('#like-post-{{ $post->id }}').click(function() {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('forum.like', ['type' => 'post', 'id' => $post->id]) }}",
                            success: function(data) {
                                if (data == 'liked') {
                                    var elem = document.getElementById('like-success-post-{{ $post->id }}');
                                    var like_button = document.getElementById('like-post-{{ $post->id }}');
                                    $(elem).show();
                                    $(like_button).hide();
                                }
                                if (data == 'already_liked') {
                                    var elem = document.getElementById('like-error-{{ $post->id }}');
                                    var like_button = document.getElementById('like-post-{{ $post->id }}');
                                    var elem2 = document.getElementById('like-success-{{ $post->id }}');
                                    $(elem2).hide();
                                    $(like_button).hide();
                                    $(elem).show();
                                }
                                if (data == 'login_required') {
                                    var like_button = document.getElementById('like-post-{{ $post->id }}');
                                    var elem = document.getElementById('like-login-{{ $post->id }}');
                                    $(elem).show();
                                    $(like_button).hide();
                                }
                            }
                        });
                    });
                </script>

                <span id="like-success-post-{{ $post->id }}" class="text-success fw-bold me-2" style="display: none;"><i class="bi bi-hand-thumbs-up"></i> {{ __('You like this') }}</span>
                <span id="like-error-{{ $post->id }}" class="text-danger fw-bold me-2" style="display: none;">{{ __('You already like this') }}</span>

                <span id="like-login-{{ $post->id }}" style="display: none">
                    {{ __('You must be logged') }}: <a class="text-danger" href="{{ route('login') }}">{{ __('Login') }}</a>
                </span>
            @endif

        @endif


        @if (forum_check_best_answer($post->id))
            <span class="text-success small me-2"><i class="bi bi-star-fill"></i> {{ __('You voted best answer') }} ({{ forum_check_best_answer($post->id) }} {{ __('votes') }})</span>
        @else
            <button class="btn btn-sm btn-success ms-2" id="best-answer-post-{{ $post->id }}"><i class="bi bi-star-fill"></i> {{ __('Best answer') }}</button>
            <script>
                $('#best-answer-post-{{ $post->id }}').click(function() {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('forum.best_answer', ['id' => $post->id]) }}',
                        success: function(data) {
                            if (data == 'voted') {
                                var elem = document.getElementById('best-answer-success-post-{{ $post->id }}');
                                var best_button = document.getElementById('best-answer-post-{{ $post->id }}');
                                $(elem).show();
                                $(best_button).hide();
                            }
                            if (data == 'already_voted') {
                                var elem = document.getElementById('best-answer-error-{{ $post->id }}');
                                var best_button = document.getElementById('best-answer-post-{{ $post->id }}');
                                var elem2 = document.getElementById('best-answer_success-{{ $post->id }}');
                                $(elem2).hide();
                                $(best_button).hide();
                                $(elem).show();
                            }
                            if (data == 'login_required') {
                                var best_button = document.getElementById('best-answer-post-{{ $post->id }}');
                                var elem = document.getElementById('best-login-{{ $post->id }}');
                                $(elem).show();
                                $(best_button).hide();
                            }
                        }
                    });
                });
            </script>

            <span id="best-answer-success-post-{{ $post->id }}" class="text-success fw-bold ms-2" style="display: none;"><i class="bi bi-star"></i> {{ __('Best answer') }}</span>
            <span id="best-answer-error-{{ $post->id }}" class="text-danger fw-bold ms-2" style="display: none;">{{ __('You already voted this') }}</span>

            <span id="best-login-{{ $post->id }}" style="display: none">
                {{ __('You must be logged') }}: <a class="text-danger" href="{{ route('login') }}">{{ __('Login') }}</a>
            </span>
        @endif
    </span>

    <a class="btn btn-sm btn-light" href="#"><i class="bi bi-chat-quote"></i> {{ __('Quote') }}</a>

@endif

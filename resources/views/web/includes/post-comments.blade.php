@if ($comments->total() > 0)
    <div class="mb-3 mt-3 fs-5">
        {{ $comments->total() }} {{ __('comments') }}
    </div>

    <a class="anchor" name="comments" id="comments"></a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success mb-3">
            @if ($message == 'comment_added')
                {{ __('Comment added') }}
            @endif
            @if ($message == 'comment_pending')
                {{ __('Comment must be approved before publish') }}
            @endif
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger mb-3">
            @if ($message == 'login_required')
                {{ __('You must be logged to comment') }}
            @endif
            @if ($message == 'recaptcha_error')
                {{ __('Wrong antispam') }}
            @endif
        </div>
    @endif

    <ul class="comment-list">
        @foreach ($comments as $comment)
            <li class="comment mb-2">
                <div class="comment-body">
                    @if ($comment->user_id)
                        @if ($comment->author->avatar)
                            <img src="{{ avatar($comment->user_id) }}" alt="{{ $comment->author->name }}" class="img-fluid rounded-circle" style="max-height: 25px;">
                        @endif
                        <span class="author"><a href="{{ route('profile', ['username' => $comment->author->username]) }}"><b>{{ $comment->author->name }}</b></a></span>
                        <span class="meta">{{ date_locale($comment->created_at, 'datetime') }}</span>
                    @else
                        <span class="author"><b>{{ $comment->name }}</b></span>
                        <span class="meta">{{ date_locale($comment->created_at, 'datetime') }}</span>
                    @endif
                    <div class="comment">{!! nl2br(e($comment->comment)) !!}</div>
                    <hr>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="clearfix"></div>
    {{ $comments->fragment('comments')->links() }}
@endif


@if (!(($config->posts_comments_disabled ?? null) || ($post->disable_comments ?? null)))
    @if (($config->posts_comments_require_login ?? null) && !Auth::check())
        {{ __('You must login to comment') }}: <a href="{{ route('login') }}">{{ __('Login') }}</a>
    @else
        <div class="comment-form-wrap mt-2 mb-4">
            <form method="post" action="{{ route('post.comment', ['categ_slug' => $post->category->slug, 'slug' => $post->slug]) }}">
                @csrf

                <div class="mb-2 fs-5">{{ __('Leave a comment') }}:</div>

                <div class="form-group">
                    <label for="name">{{ __('Name') }}:</label>
                    @if (Auth::user())
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <div class="">
                            {{ Auth::user()->name }}
                        </div>
                    @else
                        <input type="text" class="form-control" name="name" required>
                    @endif
                </div>

                <div class="form-group">
                    <label for="message">{{ __('Message') }}:</label>
                    <textarea name="comment" rows="6" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    @if ($config->posts_comments_antispam_enabled ?? null)
                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                    @endif
                    <input type="submit" value="{{ __('Submit comment') }}" class="btn btn_1">
                </div>

            </form>
        </div>
    @endif
@endif

<nav class="nav nav-tabs mb-3" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($post_menu_tab ?? null) == 'details') active @endif" href="{{ route('admin.posts.show', ['id' => $post->id]) }}"><i class="bi bi-pencil-square"></i>
        {{ __(json_decode($post_type->default_language_content->labels ?? null)->singular ?? $post_type->name) }} {{ __('details') }}
    </a>

    @if (count(admin_languages()) > 1 && $post_type->multilingual_content == 1)
        <div class="dropdown float-end">
            <a class="nav-item nav-link dropdown-toggle float-end" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-box-arrow-up-right"></i> {{ __('Preview') }}
            </a>
            <ul class="dropdown-menu bg-secondary dropdown-menu-end">
                @foreach ($preview_urls as $lang_name => $preview_url)
                    @if ($preview_url)
                        <li><a class="dropdown-item" target="_blank" href="{{ $preview_url }}">{{ $lang_name }}</a></li>
                    @else
                        <li class="dropdown-item" target="_blank" href="#">{{ $lang_name }} <span class="text-danger">{{ __('Not set') }}</span></li>
                    @endif
                @endforeach
            </ul>
        </div>
    @else
        @foreach ($preview_urls as $lang_name => $preview_url)
            @if ($preview_url)
                <a target="_blank" href="{{ $preview_url }}" class="nav-item nav-link"><i class="bi bi-box-arrow-up-right"></i>
                    {{ __('Preview') }}</a>
            @endif
        @endforeach
    @endif
</nav>

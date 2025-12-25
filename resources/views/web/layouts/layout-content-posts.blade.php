@if ($config->posts_custom_content ?? null)
    <div class="custom_content">
        @if ($config_lang->posts_custom_title ?? null)
            <div class="mt-4 mb-3 title">
                {!! $config_lang->posts_custom_title ?? null !!}
            </div>
        @endif

        @if ($config_lang->posts_custom_text ?? null)
            <div class="mt-3 mb-4 text">
                {!! $config_lang->posts_custom_text ?? null !!}
            </div>
        @endif
    </div>
@endif

@if (!($config->tpl_posts_hide_categs_list ?? null))
    @if (count($categories) > 0)
        <div class="mb-1 fw-bold">
            {{ __('Categories') }}:
        </div>

        <div class="mb-5 mt-4 categ-list d-block clearfix">
            @foreach ($categories as $categ)
                @if (($config->tpl_posts_categs_list_hide_if_empty ?? null) && $categ->posts_count == 0)
                    @php continue @endphp
                @endif

                @php 
                    if($categ->lang_id == get_default_language()->id)
                        $categ_url = route('posts.categ', ['categ_slug' => $categ->slug]);
                    else
                        $categ_url = route('locale.posts.categ', ['locale' => get_language_code_from_id($categ->lang_id), 'categ_slug' => $categ->slug]);
                @endphp 
                
                <div class="float-start d-block me-4">
                    <a class="@if (($config->tpl_posts_categs_list_layout ?? null) == 'boxes') posts-categ-item-box @else posts-categ-item-link @endif"
                        href="{{ $categ_url }}">{{ $categ->title }} @if ($config->tpl_posts_categs_list_show_counter ?? null)
                            ({{ $categ->posts_count }})
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endif


@include('web.includes.posts-listing')
{{ $posts->links() }}

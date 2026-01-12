@if (count($post_type_taxonomies) > 0)

    <div class="mb-5">
        @foreach ($post_type_taxonomies as $post_type_taxonomy)
            <div class="mb-2 fw-bold">
                <a href="{{ $post_type_taxonomy->active_language_content->url }}">
                    {{ $post_type_taxonomy->active_language_content->name ?? ($post_type_taxonomy->default_language_content->name ?? null) }}:
                </a>
            </div>

            <div class="mb-2 taxonomy-list d-block clearfix">
                @foreach ($post_type_taxonomy->active_taxonomies as $taxonomy)
                    <div class="float-start d-block me-3 mb-4">
                        <a class="taxonomy-item-box" href="{{ $taxonomy->active_language_content->url ?? ($taxonomy->default_language_content->url ?? '#') }}">
                            {{ $taxonomy->active_language_content->name ?? ($taxonomy->default_language_content->name ?? null) }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

@endif

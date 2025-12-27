<option @if (in_array($taxonomy_item->id, $search_taxonomy_ids)) selected @endif value="{{ $taxonomy_item->id }}">
    @for ($i = 1; $i < $loop->depth; ++$i)
        --
    @endfor {{ $taxonomy_item->default_language_content->name ?? null}}
</option>


@if (count($taxonomy_item->children) > 0)
    @foreach ($taxonomy_item->children as $taxonomy_item)
        @include('pivlu::admin.posts.includes.loops.posts-filter-taxonomies-loop', $taxonomy_item)
    @endforeach
@endif

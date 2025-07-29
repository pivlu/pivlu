
<option @if (($search_taxonomy_id ?? null) == $taxonomy_item->id) selected @endif value="{{ $taxonomy_item->id }}">
    @for ($i = 1; $i < $loop->depth; ++$i)---@endfor {{ $taxonomy_item->name }}
</option>


@if (count($taxonomy_item->children) > 0)
    @foreach ($taxonomy_item->children as $taxonomy_item)
        @include('admin.posts.loops.posts-filter-taxonomies-loop', $taxonomy_item)
    @endforeach
@endif

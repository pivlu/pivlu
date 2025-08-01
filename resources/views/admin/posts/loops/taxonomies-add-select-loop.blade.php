<option value="{{ $post_taxonomy->id }}">@for ($i = 1; $i < $loop->depth; $i++)---@endfor {{ $post_type_taxonomy->default_language_content->name }}</option>


@if (count($post_taxonomy->children) > 0)

	@foreach($post_taxonomy->children as $post_taxonomy)	
	@include('admin.posts.loops.taxonomies-add-select-loop', $post_taxonomy)
	@endforeach

@endif

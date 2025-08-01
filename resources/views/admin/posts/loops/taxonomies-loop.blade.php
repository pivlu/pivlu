<tr @if ($post_taxonomy->active != 1) class="table-warning" @endif>
    <td>
        @if ($post_taxonomy->active != 1)
            <span class="float-end ms-2"><button type="button" class="btn btn-warning btn-sm disabled">{{ __('Inactive') }}</button></span>
        @endif

        @if ($loop->depth == 1)
            <div class="listing fw-bold">
                @for ($i = 1; $i < $loop->depth; $i++)
                    ---
                @endfor {!! $post_taxonomy->icon ?? null !!}
                <a target="_blank" href="{{ route('home') }}/{{ $post_type->default_language_content->slug }}/{{ $post_taxonomy->default_language_content->slug }}">{{ $post_taxonomy->default_language_content->name }}</a>
            </div>
        @else
            <div class="listing">
                @for ($i = 1; $i < $loop->depth; $i++)
                    ---
                @endfor {!! $post_taxonomy->icon ?? null !!} <a target="_blank"
                    href="{{ route('home') }}/{{ $post_type->slug }}/{{ $taxonomy_term->slug }}/{{ $post_taxonomy->default_language_content->slug }}">{{ $post_taxonomy->default_language_content->name }}</a>
            </div>
        @endif
        <div class="text-muted small">
            <b>ID</b> {{ $post_taxonomy->id }} | <b>{{ __('Position') }}:</b> {{ $post_taxonomy->position }}
            @if ($post_taxonomy->description)
                <br>{{ $post_taxonomy->description }}
            @endif
            @if ($post_taxonomy->menu_label)
                <br>{{ __('Menu label') }}: {{ $post_taxonomy->menu_label }}
            @endif

            @if ($post_taxonomy->image)
                <br>
                <a target="_blank" href="{{ image($post_taxonomy->image) }}"><img src="{{ thumb_rectangle($post_taxonomy->image) }}" class="img-fluid" style="max-height: 35px; max-width: 100px" alt="Image"></a>
            @endif

        </div>

    </td>

    <td>
        <a href="{{ route('admin.posts.index', ['search_item_id' => $post_taxonomy->id]) }}">{{ $post_taxonomy->count_posts ?? 0 }} </a>
    </td>

    <td>
        <div class="d-grid gap-2">

            <a href="{{ route('admin.post-taxonomies.show', ['id' => $post_taxonomy->id]) }}" class="btn btn-primary btn-sm mb-2">{{ __('Manage category') }}</button>

                <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $post_taxonomy->id }}" class="btn btn-danger btn-sm">{{ __('Delete category') }}</a>
                <div class="modal fade confirm-{{ $post_taxonomy->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ __('Are you sure you want to delete this category? All posts from this item will be assigned to "Uncategorized".') }}
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="{{ route('admin.post-taxonomies.show', ['id' => $post_taxonomy->id, 'post_type_taxonomy_id' => $post_type_taxonomy->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                    <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </td>
</tr>

@if (count($post_taxonomy->children) > 0)

    @foreach ($post_taxonomy->children as $post_taxonomy)
        @include('admin.posts.loops.taxonomies-loop', $post_taxonomy)
    @endforeach

@endif

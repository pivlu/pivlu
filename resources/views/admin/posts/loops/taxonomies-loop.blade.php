<tr @if ($item->active != 1) class="table-warning" @endif>
    <td>
        @if ($item->active != 1)
            <span class="float-end ms-2"><button type="button" class="btn btn-warning btn-sm disabled">{{ __('Inactive') }}</button></span>
        @endif

        @if ($loop->depth == 1)
            <div class="listing fw-bold">
                @for ($i = 1; $i < $loop->depth; $i++)
                    ---
                @endfor {!! $item->icon ?? null !!}
                <a target="_blank" href="{{ route('home') }}/{{ $post_type->slug }}/{{ $taxonomy_term->slug }}/{{ $item->default_language_content->slug }}">{{ $item->default_language_content->name }}</a>
            </div>
        @else
            <div class="listing">
                @for ($i = 1; $i < $loop->depth; $i++)
                    ---
                @endfor {!! $item->icon ?? null !!} <a target="_blank"
                    href="{{ route('home') }}/{{ $post_type->slug }}/{{ $taxonomy_term->slug }}/{{ $item->default_language_content->slug }}">{{ $item->default_language_content->name }}</a>
            </div>
        @endif
        <div class="text-muted small">
            <b>ID</b> {{ $item->id }} | <b>{{ __('Position') }}:</b> {{ $item->position }}
            @if ($item->description)
                <br>{{ $item->description }}
            @endif
            @if ($item->menu_label)
                <br>{{ __('Menu label') }}: {{ $item->menu_label }}
            @endif

            @if ($item->image)
                <br>
                <a target="_blank" href="{{ image($item->image) }}"><img src="{{ thumb_rectangle($item->image) }}" class="img-fluid" style="max-height: 35px; max-width: 100px" alt="Image"></a>
            @endif

        </div>

    </td>

    <td>
        <a href="{{ route('admin.posts.index', ['search_item_id' => $item->id]) }}">{{ $item->count_posts ?? 0 }} </a>
    </td>

    <td>
        <div class="d-grid gap-2">

            <a href="{{ route('admin.taxonomies.show', ['id' => $item->id]) }}" class="btn btn-primary btn-sm mb-2">{{ __('Manage category') }}</button>

                <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $item->id }}" class="btn btn-danger btn-sm">{{ __('Delete category') }}</a>
                <div class="modal fade confirm-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
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
                                <form method="POST" action="{{ route('admin.taxonomies.show', ['id' => $item->id, 'type' => $type, 'taxonomy' => $taxonomy]) }}">
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

@if (count($item->children) > 0)

    @foreach ($item->children as $item)
        @include('admin.posts.loops.taxonomies-loop', $item)
    @endforeach

@endif

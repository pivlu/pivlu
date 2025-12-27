<tr @if ($post_taxonomy->active != 1) class="table-warning" @endif>

    <td>
        {{ $post_taxonomy->id }}
    </td>

    <td>
        @if ($post_taxonomy->active != 1)
            <span class="float-end ms-2 badge bg-warning">{{ __('Inactive') }}</span>
        @endif

        @foreach ($post_taxonomy->all_languages_contents as $post_taxonomy_content)
            <div class="d-flex">
                @for ($i = 2; $i < $loop->depth; $i++)
                    <div class="ms-5">
                    </div>
                @endfor

                <div class="mb-2">
                    @if (count(admin_languages()) > 1)
                        <div class="@if ($loop->depth == 2) fw-bold @endif"><span class="me-1">{!! flag($post_taxonomy_content->lang_code) !!}</span>
                            @if ($post_taxonomy_content->name)
                                {{ $post_taxonomy_content->name }}</a>
                            @else
                                <span class="text-danger">{{ __('not set') }}</span>
                            @endif
                        </div>
                    @endif

                    <div class="small">
                        <b>{{ __('URL') }}:</b>
                        @if ($post_taxonomy_content->slug)
                            <a target="_blank" href="{{ route('home') }}/{{ $post_taxonomy_content->url_path ?? null }}">{{ route('home') }}/{{ $post_taxonomy_content->url_path ?? null }}</a>
                        @else
                            -
                        @endif

                        <div class="mb-0"></div>

                        <b>{{ __('Meta title') }}:</b>
                        @if ($post_taxonomy_content->meta_title)
                            {{ $post_taxonomy_content->meta_title }}</a>
                        @else
                            <span class="text-danger">{{ __('not set') }}</span>
                        @endif

                        <div class="mb-0"></div>

                        <b>{{ __('Meta description') }}:</b>
                        @if ($post_taxonomy_content->meta_description)
                            {{ $post_taxonomy_content->meta_description }}</a>
                        @else
                            <span class="text-danger">{{ __('not set') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach


        <div class="text-muted small">
            @if ($post_taxonomy->icon)
                <div class="mt-1">
                    {!! $post_taxonomy->icon ?? null !!}
                </div>
            @endif

            @if ($post_taxonomy->media_id)
                <div class="mt-1"></div>
                <div class="float-start me-2"><img style="max-width:35px; height:auto;" src="{{ image($post_taxonomy->media_id, 'thumb_square') }}" /></div>

                <a target="_blank" href="{{ image($post_taxonomy->media_id) }}">{{ __('Large') }}</a> |
                <a target="_blank" href="{{ image($post_taxonomy->media_id, 'square') }}">{{ __('Square') }}</a> |
                <a target="_blank" href="{{ image($post_taxonomy->media_id, 'small') }}">{{ __('Small') }}</a> |
                <a target="_blank" href="{{ image($post_taxonomy->media_id, 'thumb') }}">{{ __('Thumb') }}</a> |
                <a target="_blank" href="{{ image($post_taxonomy->media_id, 'thumb_square') }}">{{ __('Thumb square') }}</a>
            @endif
        </div>

    </td>

    <td>
        <a href="{{ route('admin.posts.index', ['post_type_id' => $post_type->id, 'search_taxonomy_id' => $post_taxonomy->id]) }}">{{ $post_taxonomy->count_posts ?? 0 }} </a>
    </td>

    <td>
        <div class="d-grid gap-2">

            @can('update', [Pivlu\Models\PostTaxonomy::class, $post_type->id])
                <a href="{{ route('admin.post-taxonomies.show', ['id' => $post_taxonomy->id]) }}" class="btn btn-primary btn-sm mb-2">{{ __('Edit') }}</a>
            @endcan

            @can('delete', [Pivlu\Models\PostTaxonomy::class, $post_type->id])
                <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $post_taxonomy->id }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                <div class="modal fade confirm-{{ $post_taxonomy->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ __('Are you sure you want to delete this taxonomy? All posts from this item taxonomy be assigned to "Uncategorized".') }}
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
            @endcan
        </div>
    </td>
</tr>

@if (count($post_taxonomy->children) > 0)

    @foreach ($post_taxonomy->children as $post_taxonomy)
        @include('pivlu::admin.posts.includes.loops.taxonomies-loop', $post_taxonomy)
    @endforeach

@endif

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.posts.index', ['post_type_id' => $post_type->id]) }}">{{ $post_type->default_language_content->name ?? __('Posts') }}</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    @if ($post_type->type != 'page')
        @include('pivlu::admin.posts.includes.menu')
    @endif

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-6 order-md-1 order-first">
                <div class="card-title fw-bold">
                    {{ __(json_decode($post_type->default_language_content->labels ?? null)->all ?? __('All')) }} ({{ $posts->total() ?? 0 }})
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    @can('create', [Pivlu\Models\Post::class, $post_type->id])
                        <a href="{{ route('admin.posts.create', ['post_type_id' => $post_type->id]) }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i>
                            {{ __(json_decode($post_type->default_language_content->labels ?? null)->create ?? __('Add new item')) }}
                        </a>
                    @endcan
                </div>
            </div>

        </div>

    </div>


    <div class="card-body">

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
            <div class="alert alert-success">
                @if ($message == 'created')
                    {{ __('Created') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
                @if ($message == 'deleted')
                    {{ __('Moved to trash') }}
                @endif
            </div>
        @endif

        <section>
            <form action="{{ route('admin.posts.index') }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">

                <div class="col-12">
                    <input type="text" name="search_terms" placeholder="{{ __('Search') }}" class="form-control me-2 mb-2 @if ($search_terms) is-valid @endif" value="<?= $search_terms ?>" />
                </div>

                <div class="col-12">
                    <select name="search_status" class="form-select me-2 mb-2 @if ($search_status) is-valid @endif">
                        <option value="">- {{ __('Any status') }} -</option>
                        <option @if ($search_status == 'published') selected @endif value="published">{{ __('Published') }}</option>
                        @if ($post_type != 'page')
                            <option @if ($search_status == 'pending') selected @endif value="pending">{{ __('Pending') }}</option>
                        @endif
                        <option @if ($search_status == 'draft') selected @endif value="draft">{{ __('Draft') }}</option>
                    </select>
                </div>

                @foreach ($post_type_taxonomy_terms as $taxonomy_term)
                    <div class="col-12">
                        @if ($taxonomy_term->hierarchical == 1)
                            @php
                                $select_is_valid = 0;
                                foreach ($taxonomy_term->taxonomies as $check_taxonomy) {
                                    if (in_array($check_taxonomy->id, $search_taxonomy_ids)) {
                                        $select_is_valid = 1;
                                    }
                                }
                            @endphp

                            <select class="form-select me-2 mb-2 @if ($select_is_valid == 1) is-valid @endif" name="search_taxonomy_ids[]">
                                <option selected="selected" value="">- {{ __(json_decode($taxonomy_term->default_language_content->labels ?? null)->all ?? 'All ') }} -</option>
                                @foreach ($taxonomy_term->taxonomies as $taxonomy_item)
                                    @php
                                        if ($taxonomy_item->parent_id) {
                                            continue;
                                        }
                                    @endphp
                                    @include('pivlu::admin.posts.includes.loops.posts-filter-taxonomies-loop', $taxonomy_item)
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="search_taxonomy_term" placeholder="{{ __(json_decode($taxonomy_term->default_language_content->labels ?? null)->search ?? 'Search ') }}"
                                class="form-control me-2 mb-2 @if ($search_taxonomy_term ?? null) is-valid @endif" value="<?= $search_taxonomy_term ?? null ?>" />
                        @endif
                    </div>
                @endforeach

                @if ($post_type != 'page')
                    <div class="col-12">
                        <select name="search_sticky" class="form-select me-2 mb-2 @if ($search_sticky) is-valid @endif">
                            <option value="">- {{ __('All items') }} -</option>
                            <option @if ($search_sticky == 1) selected @endif value="1">{{ __('Only sticky items') }}</option>
                        </select>
                    </div>
                @endif

                <div class="col-12">
                    <select name="search_sample" class="form-select me-2 mb-2 @if ($search_sample) is-valid @endif">
                        <option value="">- {{ __('All items') }} -</option>
                        <option @if ($search_sample == 1) selected @endif value="1">{{ __('Only sample items') }}</option>
                    </select>
                </div>

                <div class="col-12">
                    <button class="btn btn-secondary me-2 mb-2" type="submit"><i class="bi bi-check2"></i> {{ __('Apply') }}</button>
                    <a class="btn btn-light mb-2" href="{{ route('admin.posts.index', ['post_type_id' => $post_type->id]) }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                </div>

                <input type="hidden" name="post_type_id" value="{{ $post_type->id }}">
            </form>
        </section>

        <div class="mb-2"></div>

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>{{ __('Details') }}</th>
                        @if ($post_type->type != 'page')
                            <th width="300">{{ __('Taxonomies') }}</th>
                        @endif
                        <th width="260">{{ __('Author') }}</th>
                        <th width="160">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                        <tr @if ($post->status != 'published') class="table-light" @endif>

                            <td>
                                @if ($post->is_sample == 1)
                                    <div class="float-end ms-2 badge bg-primary fw-normal">{{ __('Sample post') }}</div>
                                @endif
                                @if ($post->status == 'published' && $post->is_sample == 0)
                                    <div class="float-end ms-2 badge bg-success fw-normal">{{ __('Published') }}</div>
                                @endif
                                @if ($post->status == 'draft')
                                    <div class="float-end ms-2 badge bg-warning fw-normal">{{ __('Draft') }}</div>
                                @endif
                                @if ($post->status == 'pending')
                                    <div class="float-end ms-2 badge bg-danger fw-normal">{{ __('Pending review') }}</div>
                                @endif
                                @if ($post->status == 'soft_reject')
                                    <div class="float-end ms-2 badge bg-info fw-normal">{{ __('Rejected (needs modifications)') }}</div>
                                @endif
                                @if ($post->status == 'hard_reject')
                                    <div class="float-end ms-2 badge bg-dark fw-normal">{{ __('Permanently rejected') }}</div>
                                @endif

                                @if ($post->sticky == 1)
                                    <div class="float-end ms-2 badge bg-info fs-6 fw-normal"><i class="bi bi-pin"></i> {{ __('Sticky') }}</div>
                                @endif

                                @if ($post->post_type->type != 'page')
                                    <div class="float-start me-3 mb-2"><img class="img-fluid rounded" style="width:150px; height: auto; " src="{{ post_image($post, 'crop') }}" /></div>
                                @endif


                                @foreach ($post->all_languages_contents as $page_content)
                                    <div class="fw-bold">
                                        @if ($page_content->title)
                                            {!! lang_label($page_content, $page_content->title) !!}
                                        @else
                                            <span class="text-danger">{!! lang_label($page_content, __('not set')) !!}</span>
                                        @endif
                                    </div>

                                    <div class="text-muted small">
                                        <div>
                                            @if ($page_content->title)
                                                <a target="_blank" href="{{ $page_content->url }}">{{ $page_content->url }}</a>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="mb-2"></div>
                                @endforeach

                                <span class="text-muted small">
                                    {{ __('Created') }}: {{ date_locale($post->created_at, 'datetime') }}
                                    @if ($post->updated_at)
                                        | {{ __('Updated') }}: {{ date_locale($post->updated_at, 'datetime') }} |
                                    @endif
                                    {{ $post->hits }} {{ __('hits') }}
                                </span>
                            </td>

                            @if ($post->post_type->type != 'page')
                                <td>
                                    @foreach ($post->taxonomies as $post_taxonomy)
                                        {{ $post_taxonomy->post_type_taxonomy->default_language_content->name }}:
                                        <a target="_blank"
                                            href="{{ route('home') }}/{{ $post_taxonomy->taxonomy->default_language_content->url_path ?? null }}">{{ $post_taxonomy->taxonomy->default_language_content->name ?? null }}</a>
                                        <br>
                                    @endforeach

                                </td>
                            @endif

                            <td>
                                <span class="float-start me-2"><img style="max-width:40px; height:auto;" class="rounded-circle" src="{{ $post->user->getFirstMediaUrl('avatars', 'thumb') }}" /></span>
                                <b><a target="_blank" href="{{ route('admin.accounts.show', ['id' => $post->user_id]) }}">{{ $post->user->name }}</a></b>
                                <div class="small">{{ $post->user->email }}</div>
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.posts.show', ['id' => $post->id]) }}" class="btn btn-primary btn-sm mb-2">
                                        {{ __(json_decode($post_type->default_language_content->labels ?? null)->update ?? __('Update')) }}
                                    </a>

                                    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $post->id }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                    <div class="modal fade confirm-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ __('Are you sure you want to move this item to trash?') }}

                                                    <div class="mt-2 fw-bold">
                                                        <i class="bi bi-info-circle"></i> {{ __('This item will be moved to trash. You can recover it or permanently delete from recycle bin.') }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('admin.posts.show', ['id' => $post->id]) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                        <button type="submit" class="btn btn-danger">{{ __('Yes. Move to trash') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {{ $posts->appends(['search_terms' => $search_terms, 'search_status' => $search_status, 'search_sticky' => $search_sticky, 'search_sample' => $search_sample, 'search_taxonomy_ids' => $search_taxonomy_ids, 'post_type_id' => $post_type->id])->links() }}

    </div>
    <!-- end card-body -->

</div>

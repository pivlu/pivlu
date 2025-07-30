<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.posts.index', ['type' => $type]) }}">{{ $post_type->name ?? __('Posts') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    <div class="card-header">

        <div class="row">

            @if ($type != 'page')
                <div class="col-12 col-sm-12 mb-3">
                    @include('admin.posts.includes.menu')
                </div>
            @endif

            <div class="col-12 col-sm-12 col-md-6 order-md-1 order-first">
                <div class="card-title fw-bold">
                    {{ __(json_decode($post_type->default_language_content->labels)->all ?? $post_type->name) }} ({{ $posts->total() ?? 0 }})
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <a href="{{ route('admin.posts.create', ['type' => $type]) }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i>
                        {{ __(json_decode($post_type->default_language_content->labels)->create ?? __('Add new item')) }}
                    </a>
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
                        <option @if ($search_status == 'active') selected @endif value="active">{{ __('Published') }}</option>
                        @if ($post_type != 'page')
                            <option @if ($search_status == 'pending') selected @endif value="pending">{{ __('Pending') }}</option>
                        @endif
                        <option @if ($search_status == 'draft') selected @endif value="draft">{{ __('Draft') }}</option>
                    </select>
                </div>

                @foreach ($taxonomy_terms as $taxonomy_term)
                    <div class="col-12">
                        @if ($taxonomy_term->hierarchical == 1)
                            <select class="form-select me-2 mb-2 @if ($search_taxonomy_id ?? null) is-valid @endif" name="search_taxonomy_id">
                                <option selected="selected" value="">- {{ __(json_decode($taxonomy_term->labels)->all ?? 'All ' . $taxonomy_term->name) }} -</option>
                                @foreach ($taxonomy_term->taxonomies as $taxonomy_item)
                                    @php
                                        if ($taxonomy_item->parent_id) {
                                            continue;
                                        }
                                    @endphp
                                    @include('admin.posts.loops.posts-filter-taxonomies-loop', $taxonomy_item)
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="search_taxonomy_term" placeholder="{{ __(json_decode($taxonomy_term->labels)->search ?? 'Search ' . $taxonomy_term->name) }}"
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
                    <button class="btn btn-secondary me-2 mb-2" type="submit"><i class="bi bi-check2"></i> {{ __('Apply') }}</button>
                    <a class="btn btn-light mb-2" href="{{ route('admin.posts.index', ['post_type' => $post_type]) }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                </div>

                <input type="hidden" name="type" value="{{ $type }}">
            </form>
        </section>

        <div class="mb-2"></div>

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>{{ __('Details') }}</th>
                        <th width="300">{{ __('Taxonomies') }}</th>
                        <th width="300">{{ __('Author') }}</th>
                        <th width="180">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                        <tr @if ($post->status != 'published') class="table-warning" @endif>

                            <td>
                                @if ($post->status == 'published')
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
                                    <div class="float-end ms-2 badge bg-info fw-normal"><i class="bi bi-pin"></i> {{ __('Sticky') }}</div>
                                @endif

                                <div class="float-start me-2 mb-2"><img class="img-fluid" style="width:150px; height: 150px; background-color: black" src="{{ image($post->media_id, 'thumb') }}" /></div>

                                <div class="fw-bold">
                                    @if ($post->status == 'published')
                                        @if ($post->type == 'page')
                                            <a target="_blank"
                                                href="{{ route('home') }}/{{ $post->default_language_content->slug ?? '-' }}">{{ $post->default_language_content->title ?? '-' }}</a>
                                        @else
                                            <a target="_blank"
                                                href="{{ route('home') }}/{{ $post_type->default_language_content->slug ?? '-' }}/{{ $post->default_language_content->slug ?? '-' }}">{{ $post->default_language_content->title ?? '-' }}</a>
                                        @endif
                                    @else
                                        {{ $post->default_language_content->title ?? '-' }}
                                    @endif
                                </div>

                                <span class="text-muted small">
                                    {{ __('Created') }}: {{ date_locale($post->created_at, 'datetime') }}
                                    @if ($post->updated_at)
                                        | {{ __('Updated') }}: {{ date_locale($post->updated_at, 'datetime') }} |
                                    @endif
                                    {{ $post->hits }} {{ __('hits') }}
                                </span>

                                @if ($post->categ_id)
                                    <div class="mb-1"></div>
                                    {{ __('Category') }}:
                                    @foreach (breadcrumb($post->categ_id, 'posts') as $item)
                                        <a @if ($item->active != 1) class="text-danger" @endif target="_blank" href="{{ route('posts.categ', ['categ_slug' => $item->slug]) }}">{{ $item->title }}</a>
                                        @if (!$loop->last)
                                            /
                                        @endif
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @foreach ($post->taxonomies as $post_taxonomy)
                                    <a target="_blank"
                                        href="{{ route('home') }}/{{ $post_type->slug }}/{{ $post_taxonomy->taxonomy->term->slug }}/{{ $post_taxonomy->taxonomy->slug }}">{{ $post_taxonomy->taxonomy->name }}</a>
                                    <br>
                                @endforeach
                            </td>

                            <td>
                                <span class="float-start me-2"><img style="max-width:40px; height:auto;" class="rounded-circle" src="{{ avatar($post->user_id) }}" /></span>
                                <b><a target="_blank" href="{{ route('admin.accounts.show', ['id' => $post->user_id]) }}">{{ $post->user->name }}</a></b>
                                <div class="small">{{ $post->user->email }}</div>
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.posts.show', ['id' => $post->id, 'type' => $type]) }}" class="btn btn-primary btn-sm mb-2">
                                        {{ __(json_decode($post_type->labels)->update ?? __('Update')) }}
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
                                                    <form method="POST" action="{{ route('admin.posts.show', ['id' => $post->id, 'type' => $type]) }}">
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

        {{ $posts->appends(['search_terms' => $search_terms, 'search_status' => $search_status, 'search_categ_id' => $search_categ_id])->links() }}

    </div>
    <!-- end card-body -->

</div>

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index', ['post_type_id' => $post_type->id]) }}">{{ $post_type->default_language_content->name ?? __('Posts') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __(json_decode($post_type_taxonomy->default_language_content->labels ?? null)->plural ?? null) }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    @include('pivlu::admin.posts.includes.menu')

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-6 order-md-1 order-first">
                <div class="card-title fw-bold">
                    @if ($post_type == 'post')
                        {{ __('All categories') }}
                    @else
                        {{ __(json_decode($post_type_taxonomy->default_language_content->labels ?? null)->all ?? null) }}
                    @endif
                    ({{ $count_taxonomies ?? 0 }})
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    @can('create', [Pivlu\Models\PostTaxonomy::class, $post_type->id])
                        <span class="float-end"><button data-bs-toggle="modal" data-bs-target="#create-taxonomy" class="btn btn-primary"><i class="bi bi-plus-circle"></i>
                                @if ($post_type == 'post')
                                    {{ __('Create category') }}
                                @else
                                    {{ __(json_decode($post_type_taxonomy->default_language_content->labels ?? null)->create ?? __('Create')) }}
                                @endif
                            </button></span>
                        @include('pivlu::admin.posts.includes.modal-create-taxonomy')
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
                    {{ __('Deleted') }}
                @endif
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                @if ($message == 'duplicate')
                    {{ __('Error. There is another item with this URL (slug)') }}
                @endif
                @if ($message == 'length')
                    {{ __('Error. Slug length must be minimum 3 characters') }}
                @endif
            </div>
        @endif

        <section>
            <form action="{{ route('admin.post-taxonomies.index') }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">

                <div class="col-12">
                    <input type="text" name="search_terms" placeholder="{{ __('Search') }}" class="form-control me-2 mb-2 @if ($search_terms) is-valid @endif" value="<?= $search_terms ?>" />
                </div>

                <div class="col-12">
                    <button class="btn btn-secondary me-2 mb-2" type="submit"><i class="bi bi-check2"></i> {{ __('Apply') }}</button>
                    <a class="btn btn-light mb-2" href="{{ route('admin.post-taxonomies.index', ['id' => $post_type_taxonomy->id]) }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                </div>

                <input type="hidden" name="id" value="{{ $post_type_taxonomy->id }}">
            </form>
        </section>

        <div class="mb-2"></div>

        <div class="table-responsive-md">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="60">{{ __('ID') }}</th>
                        <th>{{ __('Details') }}</th>
                        <th width="150">{{ __('Statistics') }}</th>
                        <th width="160">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($post_taxonomies as $post_taxonomy)
                        @include('pivlu::admin.posts.includes.loops.taxonomies-loop', $post_taxonomy)
                    @endforeach
                </tbody>
            </table>

            @if ($post_type_taxonomy->hierarchical == 0)
                {{ $post_taxonomies->appends(['post_type_taxonomy_id' => $post_type_taxonomy->id, 'search_terms' => $search_terms])->links() }}
            @endif
        </div>

    </div>
    <!-- end card-body -->

</div>

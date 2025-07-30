<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index', ['type' => $type]) }}">{{ $post_type->name ?? __('Posts') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __(json_decode($taxonomy_term->labels)->plural ?? $taxonomy_term->name) }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-12 mb-3">
                @include('admin.posts.includes.menu')
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-1 order-first">
                <div class="card-title fw-bold">
                    @if ($post_type == 'post')
                        {{ __('All categories') }}
                    @else
                        {{ __(json_decode($taxonomy_term->labels)->all ?? $taxonomy_term->name) }}
                    @endif
                    ({{ $count_items ?? 0 }})
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <span class="float-end"><button data-bs-toggle="modal" data-bs-target="#create-taxonomy" class="btn btn-primary"><i class="bi bi-plus-circle"></i>
                            @if ($post_type == 'post')
                                {{ __('Create category') }}
                            @else
                                {{ __(json_decode($taxonomy_term->labels)->create ?? __('Create') . ' ' . $taxonomy_term->name) }}
                            @endif
                        </button></span>
                    @include('admin.posts.includes.modal-create-taxonomy')
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
                    {{ __('Error. This category with this URL structure exist') }}
                @endif
                @if ($message == 'length')
                    {{ __('Error. Slug length must be minimum 3 characters') }}
                @endif
                @if ($message == 'create_post_no_categ')
                    {{ __('Error. To create a new article, you must assign it to a category. Please create a category first.') }}
                @endif
            </div>
        @endif

        <section>
            <form action="{{ route('admin.taxonomies.index') }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">

                <div class="col-12">
                    <input type="text" name="search_terms" placeholder="{{ __('Search') }}" class="form-control me-2 mb-2 @if ($search_terms) is-valid @endif" value="<?= $search_terms ?>" />
                </div>

                <div class="col-12">
                    <button class="btn btn-secondary me-2 mb-2" type="submit"><i class="bi bi-check2"></i> {{ __('Apply') }}</button>
                    <a class="btn btn-light mb-2" href="{{ route('admin.taxonomies.index', ['taxonomy' => $taxonomy, 'type' => $type]) }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                </div>

                <input type="hidden" name="taxonomy" value="{{ $taxonomy }}">
                <input type="hidden" name="type" value="{{ $type }}">
            </form>
        </section>

        <div class="mb-2"></div>

        <div class="table-responsive-md">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Details') }}</th>
                        <th width="150">{{ __('Statistics') }}</th>
                        <th width="160">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        @include('admin.posts.loops.taxonomies-loop', $item)
                    @endforeach
                </tbody>
            </table>

            @if ($taxonomy_term->hierarchical == 0)
                {{ $items->appends(['type' => $type, 'taxonomy' => $taxonomy, 'search_terms' => $search_terms])->links() }}
            @endif
        </div>

    </div>
    <!-- end card-body -->

</div>

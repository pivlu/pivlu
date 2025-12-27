<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.post-types.index') }}">{{ __('Post types') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ $post_type->default_language_content->name }}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Manage taxonomies') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('pivlu::admin.config.includes.menu-config-website')

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-6 order-md-1 order-first">
                <div class="card-title">
                    {{ __('Taxonomies for ') }} {{ $post_type->default_language_content->name }}
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#create-taxonomy" class="btn btn-primary"><i class="bi bi-plus-circle"></i> {{ __('Create taxonomy') }}</a>

                    @include('pivlu::admin.post-types.includes.modal-create-taxonomy')

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

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                @if ($message == 'duplicate')
                    {{ __('Error. This taxonmy exists') }}
                @endif
            </div>
        @endif

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>{{ __('Details') }}</th>
                        <th width="100">{{ __('Hierarchical') }}</th>
                        <th width="180">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($post_type_taxonomies as $post_type_taxonomy)
                        <tr @if ($post_type_taxonomy->active == 0) class="table-warning" @endif>

                            <td>
                                @if ($post_type_taxonomy->active == 0)
                                    <div class="float-end ms-2 badge bg-warning fw-normal">{{ __('Inactive') }}</div>
                                @endif

                                <div class="fw-bold">
                                    @foreach ($post_type_taxonomy->all_languages_contents as $lang_content)
                                        @if (count(admin_languages()) > 1)
                                            <span class="me-1">{!! flag($lang_content->lang_code) !!}</span>
                                        @endif

                                        @if ($lang_content->name)
                                            {{ $lang_content->name }}</a>
                                        @else
                                            <span class="text-danger">{{ __('not set') }}</span>
                                        @endif
                                        <div class="mb-1"></div>
                                    @endforeach
                                </div>


                                <span class="text-muted small">
                                    {{ __('Updated') }}: {{ date_locale($post_type_taxonomy->updated_at, 'datetime') }}
                                </span>
                            </td>

                            <td>
                                @if ($post_type_taxonomy->hierarchical == 1)
                                    <div class="badge bg-success fw-bold text-white fs-6">{{ __('Yes') }}</div>
                                @else
                                    <div class="badge bg-secondary fw-bold text-white fs-6">{{ __('No') }}</div>
                                @endif
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.post-type-taxonomies.show', ['id' => $post_type_taxonomy->id]) }}" class="btn btn-primary btn-sm mb-2">{{ __('Update') }}</a>

                                    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $post_type_taxonomy->id }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                    <div class="modal fade confirm-{{ $post_type_taxonomy->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ __('Are you sure you want to move this post type taxonomy?') }}

                                                    <div class="mt-2 fw-bold">
                                                        <i class="bi bi-info-circle"></i> {{ __('All posts assigned to this post type taxonomy will be assigned to uncategorized.') }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('admin.post-type-taxonomies.show', ['id' => $post_type_taxonomy->id]) }}">
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

        {{ $post_type_taxonomies->links() }}

    </div>
    <!-- end card-body -->

</div>

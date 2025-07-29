<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.post-types.index') }}">{{ __('Post types') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post_type->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-12 mb-4">
                @include('admin.config.includes.menu-config-website')
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-1 order-first">
                <div class="card-title">
                    {{ __('Taxonomies for ') }} {{ $post_type->name }}
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#create-taxonomy" class="btn btn-primary"><i class="bi bi-plus-circle"></i> {{ __('Add taxonomy') }}</a>

                    @include('admin.config.includes.modal-create-post-type-taxonomy')

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
                        <th width="300">{{ __('Labels') }}</th>
                        <th width="100">{{ __('Hierarchical') }}</th>
                        <th width="180">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($taxonomies as $taxonomy)
                        <tr @if ($taxonomy->active == 0) class="table-warning" @endif>

                            <td>
                                @if ($taxonomy->core == 1)
                                    <div class="float-end ms-2 badge bg-info fw-normal">{{ __('Protected type') }}</div>
                                @endif

                                @if ($taxonomy->active == 0)
                                    <div class="float-end ms-2 badge bg-warning fw-normal">{{ __('Inactive') }}</div>
                                @endif

                                <div class="fw-bold">
                                    {{ $taxonomy->name }}
                                </div>

                                <span class="text-muted small">
                                    {{ __('Created') }}: {{ date_locale($post_type->created_at, 'datetime') }}
                                    @if ($post_type->updated_at)
                                        | {{ __('Updated') }}: {{ date_locale($post_type->updated_at, 'datetime') }} |
                                    @endif
                                </span>
                            </td>

                            <td>
                                {{ __('Singular') }}: {{ json_decode($taxonomy->labels)->singular ?? null }}<br>
                                {{ __('Plural') }}: {{ json_decode($taxonomy->labels)->plural ?? null }}<br>
                                {{ __('Create') }}: {{ json_decode($taxonomy->labels)->create ?? null }}<br>
                                {{ __('Update') }}: {{ json_decode($taxonomy->labels)->update ?? null }}<br>
                                {{ __('Delete') }}: {{ json_decode($taxonomy->labels)->delete ?? null }}<br>
                                {{ __('All') }}: {{ json_decode($taxonomy->labels)->all ?? null }}<br>
                                {{ __('Search') }}: {{ json_decode($taxonomy->labels)->search ?? null }}<br>
                            </td>

                            <td>
                                @if ($taxonomy->hierarchical == 1)
                                    <div class="badge bg-light fw-bold text-info fs-6">{{ __('Yes') }}</div>
                                @else
                                    <div class="badge bg-light fw-bold text-dark fs-6">{{ __('No') }}</div>
                                @endif
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#update-taxonomy-{{ $taxonomy->id }}" class="btn btn-primary btn-sm mb-2">{{ __('Update') }}</a>
                                    @include('admin.config.includes.modal-update-post-type-taxonomy')

                                    @if ($taxonomy->core == 0)
                                        <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $taxonomy->id }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                        <div class="modal fade confirm-{{ $taxonomy->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('Are you sure you want to move this taxonomy?') }}

                                                        <div class="mt-2 fw-bold">
                                                            <i class="bi bi-info-circle"></i> {{ __('All posts assigned to this taxonomy will be assigned to uncategorized.') }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('admin.post-type-taxonomies.show', ['id' => $taxonomy->id, 'type' => $type]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __('Yes. Move to trash') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {{ $taxonomies->links() }}

    </div>
    <!-- end card-body -->

</div>

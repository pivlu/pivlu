<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.post-types.index') }}">{{ __('Post types') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('pivlu::admin.config.includes.menu-config-website')

    <div class="card-header">

        <div class="float-end">
            <a href="#" data-bs-toggle="modal" data-bs-target="#create-post-type" class="btn btn-primary"><i class="bi bi-plus-circle"></i> {{ __('Create custom post type') }}</a>
            @include('pivlu::admin.post-types.includes.modal-create-post-type')
        </div>

        <div class="card-title">
            {{ __('Post types') }}
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

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                @if ($message == 'duplicate')
                    {{ __('Error. There is another post type with the same identificator or url.') }}
                @endif
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

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>{{ __('Details') }}</th>
                        <th width="300">{{ __('URL slug') }}</th>
                        <th width="200">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($post_types as $post_type)
                        <tr @if ($post_type->active == 0) class="table-warning" @endif>

                            <td>
                                @if ($post_type->core == 1)
                                    <div class="float-end ms-2 badge bg-info fw-normal">{{ __('Core') }}</div>
                                @endif

                                @if ($post_type->internal_only == 1)
                                    <div class="float-end ms-2 badge bg-info fw-normal ms-1">{{ __('Internal only') }}</div>
                                @endif

                                @if ($post_type->active == 0)
                                    <div class="float-end ms-2 badge bg-warning fw-normal">{{ __('Inactive') }}</div>
                                @endif

                                <div class="fw-bold">
                                    @if ($post_type->type == 'page')
                                        {{ __('Page') }}
                                    @else
                                        @foreach ($post_type->all_languages_contents as $post_type_content)
                                            @if (count(admin_languages()) > 1)
                                                <span class="me-1">{!! flag($post_type_content->lang_code) !!}</span>
                                            @endif

                                            @if ($post_type_content->name)
                                                {{ $post_type_content->name }}</a>
                                            @else
                                                <span class="text-danger">{{ __('not set') }}</span>
                                            @endif
                                            <div class="mb-1"></div>
                                        @endforeach
                                    @endif
                                </div>

                                <span class="text-muted small">
                                    {{ __('Created') }}: {{ date_locale($post_type->created_at, 'datetime') }}
                                    @if ($post_type->updated_at)
                                        | {{ __('Updated') }}: {{ date_locale($post_type->updated_at, 'datetime') }}
                                    @endif

                                    @if ($post_type->custom_theme)
                                        <div>{{ __('Custom theme') }}: <b>{{ $post_type->custom_theme ?? null }}</b></div>
                                    @endif
                                </span>
                            </td>

                            <td>
                                @if ($post_type->type != 'page')
                                    @foreach ($post_type->all_languages_contents as $post_type_content)
                                        @if (count(admin_languages()) > 1)
                                            <span class="me-1">{!! flag($post_type_content->lang_code) !!}</span>
                                        @endif

                                        @if ($post_type_content->slug)
                                            @if ($post_type_content->lang_code == get_default_language()->code)
                                                <a target="_blank" href="{{ route('home') }}/{{ $post_type_content->slug }}">/{{ $post_type_content->slug }}</a>
                                            @else
                                                <a target="_blank"
                                                    href="{{ route('home') }}/{{ $post_type_content->lang_code }}/{{ $post_type_content->slug }}">/{{ $post_type_content->lang_code }}/{{ $post_type_content->slug }}</a>
                                            @endif
                                        @else
                                            <span class="text-danger">{{ __('not set') }}</span>
                                        @endif
                                        <div class="mb-1"></div>
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    @if ($post_type->type != 'page')
                                        <a href="{{ route('admin.post-type-taxonomies.index', ['post_type_id' => $post_type->id]) }}" class="btn btn-primary btn-sm mb-2">{{ __('Manage taxonomies') }}</a>
                                    @endif

                                    <a href="{{ route('admin.post-types.show', ['id' => $post_type->id]) }}" class="btn btn-secondary btn-sm mb-2">{{ __('Update') }}</a>

                                    @if ($post_type->core == 0)
                                        <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $post_type->id }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                        <div class="modal fade confirm-{{ $post_type->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('Are you sure you want to move this custom post type to trash?') }}

                                                        <div class="mt-2 fw-bold">
                                                            <i class="bi bi-info-circle"></i>
                                                            {{ __('The content items of this post type will be moved to trash. You can recover them or permanently delete from trash section.') }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('admin.post-types.show', ['id' => $post_type->id]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
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

        {{ $post_types->links() }}

    </div>
    <!-- end card-body -->

</div>

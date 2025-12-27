<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.post-types.index') }}">{{ __('Post types') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Update') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('pivlu::admin.config.includes.menu-config-website')

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
                    {{ __('Error. There is another post type with the same name or url.') }}
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



        <form method="post" action="{{ route('admin.post-type-taxonomies.show', ['id' => $post_type_taxonomy->id]) }}">
            @csrf
            @method('PUT')


            @foreach ($post_type_taxonomy->all_languages_contents as $content)
                @if (count(admin_languages()) > 1)
                    <div class="fw-bold fs-5">{!! flag($content->lang_code, 'circle') !!} {{ $content->lang_name }}</div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input class="form-control" name="name_{{ $content->lang_id }}" type="text" @if ($post_type->type == 'page') value="{{ __('Pages') }}"@else value="{{ $content->name }}" @endif
                                required />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Custom URL slug') }} ({{ __('optional') }})</label>
                            <input class="form-control" name="slug_{{ $content->lang_id }}" type="text" value="{{ $content->slug }}" />
                        </div>
                    </div>
                </div>

                <div class="mb-1">
                    <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseSettings_{{ $content->lang_id }}" role="button" aria-expanded="false"
                        aria-controls="collapseControls_{{ $content->lang_id }}">
                        {{ __('Post type labels') }} <i class="bi bi-chevron-down"></i>
                    </a>
                </div>

                <div class="collapse" id="collapseSettings_{{ $content->lang_id }}">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label singular') }}</label>
                                <input class="form-control" name="label_singular_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->singular ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label plural') }}</label>
                                <input class="form-control" name="label_plural_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->plural ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label create') }}</label>
                                <input class="form-control" name="label_create_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->create ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label update') }}</label>
                                <input class="form-control" name="label_update_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->update ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label delete') }}</label>
                                <input class="form-control" name="label_delete_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->delete ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label all') }}</label>
                                <input class="form-control" name="label_all_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->all ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label search') }}</label>
                                <input class="form-control" name="label_search_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->search ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label popular') }}</label>
                                <input class="form-control" name="label_popular_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->popular ?? '-' }}" />
                            </div>
                        </div>
                    </div>
                </div>

                @if (count(languages()) > 1 && !$loop->last)
                    <hr>
                @endif
            @endforeach

            <hr>

            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="form-group">
                        <label>{{ __('Position') }}</label>
                        <input class="form-control" name="position" type="number" min="0" step="1" value="{{ $post_type_taxonomy->position }}" />
                    </div>
                </div>
            </div>

            <div class="form-group mb-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="customSwitchHierarchical" name="hierarchical" @if ($post_type_taxonomy->hierarchical == 1) checked @endif>
                    <label class="form-check-label" for="customSwitchHierarchical">{{ __('Hierarchical') }}</label>
                </div>
            </div>

            <div class="form-group mb-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="customSwitchFilter" name="admin_filter" @if ($post_type_taxonomy->admin_filter == 1) checked @endif>
                    <label class="form-check-label" for="customSwitchFilter">{{ __('Admin filter') }}</label>
                </div>
            </div>

            <div class="form-group mb-0">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="customSwitchActive" name="active" @if ($post_type_taxonomy->active == 1) checked @endif>
                    <label class="form-check-label" for="customSwitchActive">{{ __('Active') }}</label>
                </div>
            </div>


            <button type="submit" class="btn btn-primary mt-3">{{ __('Update') }}</button>


        </form>

    </div>
    <!-- end card-body -->

</div>

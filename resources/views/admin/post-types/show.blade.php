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



        <form method="post" action="{{ route('admin.post-types.show', ['id' => $post_type->id]) }}">
            @csrf
            @method('PUT')


            @foreach ($post_type->all_languages_contents as $content)
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

                    @if ($post_type->type != 'page')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Custom URL slug') }} ({{ __('optional') }})</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="addon-slug">{{ config('app.url') }}/</span>
                                    <input class="form-control" name="slug_{{ $content->lang_id }}" type="text" value="{{ $content->slug }}" />
                                </div>
                            </div>
                        </div>
                    @endif
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
                                <label>{{ __('Label featured') }}</label>
                                <input class="form-control" name="label_featured_{{ $content->lang_id }}" type="text" value="{{ json_decode($content->labels ?? null)->featured ?? '-' }}" />
                            </div>
                        </div>
                    </div>
                </div>

                @if (count(languages()) > 1 && !$loop->last)
                    <hr>
                @endif
            @endforeach

            <hr>


            @if (!($post_type->type == 'page' || $post_type->type == 'post'))
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Icon code (admin)') }} ({{ __('optional') }})</label>
                            <input class="form-control" name="admin_menu_icon" type="text" value="{{ $post_type->admin_menu_icon }}" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Custom template') }} ({{ __('optional') }})</label>
                            <input class="form-control" name="custom_theme" type="text" value="{{ $post_type->custom_theme }}" />
                            <div class="text-muted small">
                                {{ __('The template name. Example: "pivlu_default". If set, the content of this post type (posts, pages, categories, tags, taxonomies...) will use this template. Leave empty to use active template.') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="customSwitchShowAdmin-{{ $post_type->id }}" name="show_in_admin_menu" @if ($post_type->show_in_admin_menu == 1) checked @endif>
                            <label class="form-check-label" for="customSwitchShowAdmin-{{ $post_type->id }}">{{ __('Show in admin menu') }}</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="customSwitchInternal-{{ $post_type->id }}" name="internal_only" @if ($post_type->internal_only == 1) checked @endif>
                            <label class="form-check-label" for="customSwitchInternal-{{ $post_type->id }}">{{ __('Internal only') }}</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="customSwitch-{{ $post_type->id }}" name="active" @if ($post_type->active == 1) checked @endif>
                            <label class="form-check-label" for="customSwitch-{{ $post_type->id }}">{{ __('Active') }}</label>
                        </div>
                    </div>
                </div>
            @endif

            @if ($post_type->type == 'page' || $post_type->type == 'post')
                <input type="hidden" name="active" checked>
                <input type="hidden" name="show_in_admin_menu" checked>
            @endif

            <button type="submit" class="btn btn-primary mt-3">{{ __('Update') }}</button>


        </form>

    </div>
    <!-- end card-body -->

</div>

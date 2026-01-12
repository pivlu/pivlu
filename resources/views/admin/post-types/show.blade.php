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



        <form method="post" action="{{ route('admin.post-types.show', ['id' => $post_type->id]) }}">
            @csrf
            @method('PUT')


            @foreach ($post_type->all_languages_contents as $lang_content)

                @if($post_type->multilingual_content == 0  && ($lang_content->lang_code != $config->default_language->code))
                    @php 
                    continue;
                    @endphp
                @endif

                <div class="fw-bold">{!! lang_label($lang_content) !!}</div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input class="form-control" name="name_{{ $lang_content->lang_id }}" type="text"
                                @if ($post_type->type == 'page') value="{{ __('Pages') }}"@else value="{{ $lang_content->name }}" @endif @if ($lang_content->lang_code == $config->default_language->code) required @endif />
                        </div>
                    </div>

                    @if ($post_type->type != 'page')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Custom URL slug') }} ({{ __('optional') }})</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="addon-slug">{{ config('app.url') }}/</span>
                                    <input class="form-control" name="slug_{{ $lang_content->lang_id }}" type="text" value="{{ $lang_content->slug }}" />
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('Title') }}</label>
                            <input class="form-control" name="title_{{ $lang_content->lang_id }}" type="text"
                                @if ($post_type->type == 'page') value="{{ __('Pages') }}"@else value="{{ $lang_content->title }}" @endif />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('Meta title') }}</label>
                            <input class="form-control" name="meta_title_{{ $lang_content->lang_id }}" type="text"
                                @if ($post_type->type == 'page') value="{{ __('Pages') }}"@else value="{{ $lang_content->meta_title }}" @endif />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('Meta description') }}</label>
                            <input class="form-control" name="meta_description_{{ $lang_content->lang_id }}" type="text"
                                @if ($post_type->type == 'page') value="{{ __('Pages') }}"@else value="{{ $lang_content->meta_description }}" @endif />
                        </div>
                    </div>
                </div>

                <div class="mb-1">
                    <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseSettings_{{ $lang_content->lang_id }}" role="button" aria-expanded="false"
                        aria-controls="collapseControls_{{ $lang_content->lang_id }}">
                        {{ __('Post type labels') }} <i class="bi bi-chevron-down"></i>
                    </a>
                </div>

                <div class="collapse" id="collapseSettings_{{ $lang_content->lang_id }}">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label singular') }}</label>
                                <input class="form-control" name="label_singular_{{ $lang_content->lang_id }}" type="text" value="{{ json_decode($lang_content->labels ?? null)->singular ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label plural') }}</label>
                                <input class="form-control" name="label_plural_{{ $lang_content->lang_id }}" type="text" value="{{ json_decode($lang_content->labels ?? null)->plural ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label create') }}</label>
                                <input class="form-control" name="label_create_{{ $lang_content->lang_id }}" type="text" value="{{ json_decode($lang_content->labels ?? null)->create ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label update') }}</label>
                                <input class="form-control" name="label_update_{{ $lang_content->lang_id }}" type="text" value="{{ json_decode($lang_content->labels ?? null)->update ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label delete') }}</label>
                                <input class="form-control" name="label_delete_{{ $lang_content->lang_id }}" type="text" value="{{ json_decode($lang_content->labels ?? null)->delete ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label all') }}</label>
                                <input class="form-control" name="label_all_{{ $lang_content->lang_id }}" type="text" value="{{ json_decode($lang_content->labels ?? null)->all ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label search') }}</label>
                                <input class="form-control" name="label_search_{{ $lang_content->lang_id }}" type="text" value="{{ json_decode($lang_content->labels ?? null)->search ?? '-' }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label featured') }}</label>
                                <input class="form-control" name="label_featured_{{ $lang_content->lang_id }}" type="text" value="{{ json_decode($lang_content->labels ?? null)->featured ?? '-' }}" />
                            </div>
                        </div>
                    </div>
                </div>

                @if (count(admin_languages()) > 1 && !$loop->last)
                    <hr>
                @endif
            @endforeach

            <hr>


            @if ($post_type->type != 'page')
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

                <div class="form-group mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="customSwitch-{{ $post_type->id }}" name="active" @if ($post_type->active == 1) checked @endif>
                        <label class="form-check-label" for="customSwitch-{{ $post_type->id }}">{{ __('Active') }}</label>
                    </div>
                </div>

                @if (count(admin_languages()) > 1)
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="multilingualSwitch-{{ $post_type->id }}" name="multilingual_content" @if ($post_type->multilingual_content == 1) checked @endif>
                                <label class="form-check-label" for="multilingualSwitch-{{ $post_type->id }}">{{ __('Multilingual content') }}</label>
                            </div>
                            <div class="text-muted small">
                                {{ __('If enabled, you will be able to create content in multiple languages for this post type.') }}
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if ($post_type->type == 'page')
                <input type="hidden" name="active" checked>
            @endif

            <button type="submit" class="btn btn-primary mt-3">{{ __('Update') }}</button>


        </form>

    </div>
    <!-- end card-body -->

</div>

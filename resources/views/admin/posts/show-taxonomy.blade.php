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

    <div class="card-body">

        <div class="card-title fw-bold">
            {{ __('Update') }}
        </div>

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
            </div>
        @endif

        <form action="{{ route('admin.post-taxonomies.show', ['id' => $post_taxonomy->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @foreach ($post_taxonomy->all_languages_contents as $content)
                @if (count(admin_languages()) > 1)
                    <div class="fw-bold fs-5">{!! flag($content->lang_code, 'circle') !!} {{ $content->lang_name }}</div>
                @endif

                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input class="form-control" name="name_{{ $content->lang_id }}" type="text" value="{{ $content->name }}" required />
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{ __('Custom permalink') }} ({{ __('optional') }})</label>
                            <input class="form-control" name="slug_{{ $content->lang_id }}" type="text" value="{{ $content->slug }}" />
                        </div>
                    </div>

                    <div class="mb-1">
                        <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseSettings_{{ $content->lang_id }}" role="button" aria-expanded="false"
                            aria-controls="collapseControls_{{ $content->lang_id }}">
                            {{ __('More settings') }} <i class="bi bi-chevron-down"></i>
                        </a>
                    </div>

                    <div class="collapse" id="collapseSettings_{{ $content->lang_id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Description') }} ({{ __('optional') }})</label>
                                    <textarea class="form-control" name="description_{{ $content->lang_id }}" rows="1">{{ $content->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Meta title') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="meta_title_{{ $content->lang_id }}" type="text" value="{{ $content->meta_title }}" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Meta description') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="meta_description_{{ $content->lang_id }}" type="text" value="{{ $content->meta_description }}" />
                                </div>
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
                @if ($post_type_taxonomy->hierarchical == 1)


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Select parent item') }}</label>
                            <select class="form-select" name="parent_id">
                                <option value="">{{ __('Root (no parent)') }}</option>

                                @foreach ($all_post_taxonomies as $select_taxonomy)
                                    @include('pivlu::admin.posts.includes.loops.taxonomies-edit-select-loop', $select_taxonomy)
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Icon code') }} ({{ __('optional') }})</label>
                        <input class="form-control" name="icon" type="text" value="{{ $post_taxonomy->icon }}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formFile" class="form-label">{{ __('Taxonomy image') }} ({{ __('optional') }})</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                        <div class="form-text text-muted small">{{ __('Maximum 5 MB') }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Position') }}</label>
                        <input class="form-control" name="position" type="number" min="0" step="1" value="{{ $post_taxonomy->position }}" />
                        <div class="text-muted small">{{ __('Position in the parent item. Leave empty to use the last position.') }}</div>
                    </div>
                </div>

            </div>

            <div class="col-12">
                <div class="form-group mb-0">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="customSwitch" name="active" @if ($post_taxonomy->active == 1) checked @endif>
                        <label class="form-check-label" for="customSwitch">{{ __('Active') }}</label>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary mt-3">{{ __('Update') }}</button>

        </form>


    </div>
    <!-- end card-body -->

</div>

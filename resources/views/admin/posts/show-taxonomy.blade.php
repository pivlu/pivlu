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
        @include('admin.posts.includes.menu')
    </div>

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


        <form action="{{ route('admin.taxonomies.show', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @foreach ($content_langs as $lang)
                @if (count($content_langs) > 1)
                    <div class="fw-bold fs-5">{!! flag($lang->code, 'circle') !!} {{ $lang->name }}</div>
                @endif
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input class="form-control" name="name_{{ $lang->id }}" type="text" value="{{ $lang->taxonomy_content['name'] ?? null }}" @if ($lang->is_default == 1) required @endif />
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>{{ __('Custom permalink') }} ({{ __('optional') }})</label>
                            <input class="form-control" name="slug_{{ $lang->id }}" type="text" value="{{ $lang->taxonomy_content['slug'] ?? null }}" />
                        </div>
                    </div>

                    <div class="mb-1">
                        <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseSettings_{{ $lang->id }}" role="button" aria-expanded="false"
                            aria-controls="collapseControls_{{ $lang->id }}">
                            {{ __('More settings') }} <i class="bi bi-chevron-down"></i>
                        </a>
                    </div>

                    <div class="collapse" id="collapseSettings_{{ $lang->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Description') }} ({{ __('optional') }})</label>
                                    <textarea class="form-control" name="description_{{ $lang->id }}" rows="1">{{ $lang->taxonomy_content['description'] ?? null }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Meta title') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="meta_title_{{ $lang->id }}" type="text" value="{{ $lang->taxonomy_content['meta_title'] ?? null }}" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Meta description') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="meta_description_{{ $lang->id }}" type="text" value="{{ $lang->taxonomy_content['meta_description'] ?? null }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            @endforeach

            @if (count($content_langs) > 1)
                <hr>
            @endif

            <div class="row">
                @if ($taxonomy_term->hierarchical == 1)
                           

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Select parent item') }}</label>
                            <select class="form-select" name="parent_id">
                                <option value="">{{ __('Root (no parent)') }}</option>

                                @foreach ($items as $taxonomy_item)
                                    @include('admin.posts.loops.taxonomies-edit-select-loop', $taxonomy_item)
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Icon code') }} ({{ __('optional') }})</label>
                        <input class="form-control" name="icon" type="text" value="{{ $item->icon }}" />
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
                        <input class="form-control" name="position" type="number" min="0" step="1" value="{{ $item->position }}" />
                        <div class="text-muted small">{{ __('Position in the parent item. Leave empty to use the last position.') }}</div>
                    </div>
                </div>

            </div>

            <div class="col-12">
                <div class="form-group mb-0">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="customSwitch" name="active" checked>
                        <label class="form-check-label" for="customSwitch">{{ __('Active') }}</label>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <input type="hidden" name="taxonomy" value="{{ $taxonomy }}">
                <input type="hidden" name="post_type" value="{{ $post_type }}">
                <input type="hidden" name="type" value="{{ $type ?? 'post' }}">
                <button type="submit" class="btn btn-primary">{{ __('Update category') }}</button>
            </div>

        </form>


    </div>
    <!-- end card-body -->

</div>

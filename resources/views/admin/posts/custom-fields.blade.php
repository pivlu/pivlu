@include('admin.includes.trumbowyg-assets')
@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.posts.index', ['type' => $type]) }}">
                            {{ $post_type->name ?? __('Posts') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Custom fields') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    <div class="card-header">

        <div class="row">

            <div class="col-12 mb-3">
                @include('admin.posts.includes.menu-post')
            </div>

            <div class="col-12">
                @if ($post->status != 'published')
                    <div class="fw-bold text-danger mt-1 mb-2">
                        <i class="bi bi-exclamation-circle"></i> {{ __('Post is not published. Go to post details to publish this post.') }}
                        <a href="{{ route('admin.posts.show', ['id' => $post->id]) }}">{{ __('Post details') }}</a>
                    </div>
                    <div class="clearfix"></div>
                @endif
            </div>

            <div class="clearfix"></div>

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
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif


        @if (count($cf_sections) == 0)
            {{ __('This post type has not any custom fields defined') }}
        @else
            <form method="post" enctype="multipart/form-data">
                @csrf
                @foreach ($cf_sections as $section)
                    <div class="fw-bold fs-5">{{ $section->name }}</div>

                    @foreach ($section->fields as $field)
                        <label>{{ $field->name }}</label>

                        @if ($field->type == 'textarea')
                            <textarea rows="4" name="{{ $field->id }}" class="form-control">{{ unserialize($post->cf_array)[$section->name][$spec->name] ?? null }}</textarea>
                        @elseif($field->type == 'bool')
                            <div class="col-md-4 col-lg-2 col-xl-1">
                                <select name="{{ $field->id }}" class="form-select">
                                    <option value="">-- {{ __('select') }} --</option>
                                    <option @if ((unserialize($post->cf_array)[$section->name][$field->name] ?? null) == 'yes') selected @endif value="yes">{{ __('Yes') }}</option>
                                    <option @if ((unserialize($post->cf_array)[$section->name][$field->name] ?? null) == 'no') selected @endif value="no">{{ __('No') }}</option>
                                </select>
                            </div>
                        @elseif($field->type == 'multiple')
                            <div class="col-md-4 col-lg-3">
                                <select name="{{ $field->id }}" class="form-select">
                                    <option value="">-- {{ __('select') }} --</option>
                                    @foreach (get_post_cf_options($section->id, $post->lang_id) as $option)
                                        <option @if ((unserialize($post->cf_array)[$section->name][$field->name] ?? null) == $option->id) selected @endif value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @elseif ($field->type == 'editor')
                            <textarea name="{{ $field->id }}" class="form-control trumbowyg">{{ unserialize($post->cf_array)[$section->name][$field->name] ?? null }}</textarea>
                        @elseif ($field->type == 'color')
                            <div id="hidden_div_color_{{ $field->id }}" style="display: @if ((unserialize($post->cf_array)[$section->name][$spec->name] ?? null) == 'multicolor') none @else block @endif" class="mt-2">
                                <div class="form-group">
                                    <input class="form-control form-control-color" id="color_{{ $field->id }}" name="{{ $spec->id }}"
                                        value="{{ unserialize($post->cf_array)[$section->name][$field->name] ?? '#cccccc' }}">
                                    <script>
                                        $('#color_{{ $field->id }}').spectrum({
                                            type: "color",
                                            showInput: true,
                                            showInitial: true,
                                            showAlpha: false,
                                            showButtons: false,
                                            allowEmpty: false,
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group mb-0 mt-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" value="multicolor" type="checkbox" id="multicolor_{{ $field->id }}" name="{{ $field->id }}" @if ((unserialize($post->cf_array)[$section->name][$field->name] ?? null) == 'multicolor') checked @endif>
                                    <label class="form-check-label" for="multicolor_{{ $spec->id }}">{{ __('Multicolor') }}</label>
                                </div>
                            </div>
                            <script>
                                $('#multicolor_{{ $spec->id }}').change(function() {
                                    select = $(this).prop('checked');
                                    if (select) {
                                        document.getElementById('hidden_div_color_{{ $spec->id }}').style.display = 'none';
                                        document.getElementById('color_{{ $spec->id }}').value = 'multicolor';
                                    } else
                                        document.getElementById('hidden_div_color_{{ $spec->id }}').style.display = 'block';
                                })
                            </script>
                        @elseif($field->type == 'url')
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="url-addon-{{ $field->id }}">https://</span>
                                <input type="text" class="form-control" id="url-{{ $field->id }}" aria-describedby="url-addon-{{ $spec->id }}" name="{{ $spec->id }}"
                                    value="{{ unserialize($post->cf_array)[$section->name][$spec->name] ?? null }}">
                            </div>
                        @else
                            <input type="text" name="{{ $field->id }}" class="form-control" value="{{ unserialize($post->cf_array)[$section->name][$field->name] ?? null }}">
                        @endif

                        <div class="mb-3"></div>
                    @endforeach

                    <div class="mb-4"></div>
                @endforeach

                <hr>
                <button type="submit" class="btn btn-primary"> {{ __('Update') }}</button>
            </form>
        @endif

    </div>
    <!-- end card-body -->

</div>

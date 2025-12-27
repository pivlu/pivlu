<!-- Tags -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

<style>
    .tagify__tag {
        line-height: 1.2em !important;
    }
</style>


<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index', ['post_type_id' => $post_type->id]) }}">
                            {{ $post_type->default_language_content->name ?? __('Posts') }}
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->default_language_content->title ?? '-' }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


@include('pivlu::admin.posts.includes.menu-post')

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
        @if ($message == 'main_image_deleted')
            {{ __('Deleted') }}
        @endif
        @if ($message == 'updated')
            {{ __('Updated') }}
        @endif
        @if ($message == 'deleted')
            {{ __('Deleted') }}
        @endif
    </div>
@endif

@if (Session::get('upload_fails') == true)
    <div class="alert alert-warning">
        {{ __('Warning: Image was not uploaded.') }}
    </div>
@endif

@if ($post->deleted_at)
    <div class="text-danger fw-bold mb-2">
        {{ __('This item is in the Trash.') }}
    </div>
@endif

<div class="row">

    <div class="col-md-6">


        <div class="row">

            <div class="col-12">
                <div class="builder-col sortable" id="sortable_top">
                    <div class="mb-4 text-center">
                        <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#addBlock"><i class="bi bi-plus-circle"></i> {{ __('Add content block') }}</a>
                    </div>

                    @foreach (content_blocks($post->id, $show_hidden = 1) as $block)
                        <div class="builder-block movable" id="item-{{ $block->id }}">
                            <div class="float-end ms-2">

                                @if ($block->hide == 1)
                                    <div class="badge bg-danger fs-6 me-2">{{ __('Hidden') }}</div>
                                @endif

                                <a href="{{ route('admin.blocks.show', ['id' => $block->id]) }}" class="btn btn-primary">{{ __('Manage content') }}</a>

                                <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $block->id }}" class="btn btn-outline-danger ms-2"><i class="bi bi-trash"></i></a>
                                <div class="modal fade confirm-{{ $block->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ __('Are you sure you want to remove this block from this post? Block content will be deleted.') }}
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{ route('admin.posts.content.delete', ['id' => $post->id, 'block_id' => $block->id]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($block->label)
                                <div class="listing">{{ $block->label }}</div>
                            @endif

                            <b>
                                @include('pivlu::admin.includes.block_type_label', ['type' => $block->block_type->type])
                            </b>

                            <div class="small text-muted">
                                ID: {{ $block->id }}. @if ($block->updated_at)
                                    {{ __('Updated at') }}: {{ date_locale($block->updated_at, 'datetime') }}
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @include('pivlu::admin.includes.modal-add-content-block', ['module' => 'posts', 'content_id' => $post->id])

    </div>


    <div class="col-md-6">

        <form method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">

                <div class="card-body">

                    @foreach ($content_langs as $lang)
                        @if (count($content_langs) > 1)
                            <div class="fw-bold fs-5">{!! flag($lang->code, 'circle') !!} {{ $lang->name }}</div>
                        @endif

                        <div class="form-group">
                            <label>
                                {{ __(json_decode($post_type->default_language_content->labels ?? null)->singular ?? null) }} {{ __('title') }}
                            </label>
                            <input type="text" class="form-control" name="title_{{ $lang->id }}" value="{{ $lang->post_content['title'] ?? null }}" @if ($lang->is_default == 1) required @endif />
                        </div>

                        <div class="form-group">
                            <label>{{ __('Summary') }}</label>
                            <textarea rows="3" class="form-control" name="summary_{{ $lang->id }}">{{ $lang->post_content['summary'] ?? null }}</textarea>
                        </div>

                        <div class="mb-1">
                            <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseSettings_{{ $lang->id }}" role="button" aria-expanded="false"
                                aria-controls="collapseControls_{{ $lang->id }}">
                                {{ __('More settings') }} <i class="bi bi-chevron-down"></i>
                            </a>
                        </div>

                        <div class="collapse" id="collapseSettings_{{ $lang->id }}">
                            @if ($post_type->type != 'page')
                                <div class="form-group">
                                    <label>{{ __('Search terms') }} ({{ __('separated by comma') }})</label>
                                    <input type="text" class="form-control" name="search_terms_{{ $lang->id }}" aria-describedby="searchHelp" value="{{ $lang->post_content['search_terms'] ?? null }}">
                                    <small id="searchHelp" class="form-text text-muted">
                                        {{ __("Search terms don't appear on website but they are used to find this item in search form") }}
                                        <br>
                                        <i class="bi bi-info-circle"></i> {{ __("Note: you don't need to add terms which are in the title or tags") }}
                                    </small>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>{{ __('Custom Meta title') }}</label>
                                <input type="text" class="form-control" name="meta_title_{{ $lang->id }}" aria-describedby="metaTitleHelp" value="{{ $lang->post_content['meta_title'] ?? null }}">
                                <small id="metaTitleHelp" class="form-text text-muted">
                                    {{ __('Leave empty to auto generate meta title based on title') }}
                                </small>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Custom Meta description') }}</label>
                                <input type="text" class="form-control" name="meta_description_{{ $lang->id }}" aria-describedby="metaDescHelp" value="{{ $lang->post_content['meta_description'] ?? null }}">
                                <small id="metaDescHelp" class="form-text text-muted">
                                    {{ __('Leave empty to auto generate meta description based on summary') }}
                                </small>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Custom slug') }}</label>
                                <input type="text" class="form-control" name="slug_{{ $lang->id }}" aria-describedby="slugHelp" value="{{ $lang->post_content['slug'] ?? null }}">
                                <small id="slugHelp" class="form-text text-muted">
                                    {{ __('Leave empty to auto generate slug based on title') }}
                                </small>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Custom template file') }}</label>
                                <input type="text" class="form-control" name="custom_tpl_file" aria-describedby="tplHelp" value="{{ $post->custom_tpl_file }}">
                                <small id="tplHelp" class="form-text text-muted">
                                    {{ __('Leave empty to use default') }}
                                </small>
                            </div>
                        </div>

                        @if (count(languages()) > 1 && !$loop->last)
                            <hr>
                        @endif
                    @endforeach

                    @if ($post_type->type != 'page')
                        <hr>

                        <div class="form-group">
                            <label for="formFile" class="form-label">{{ __('Change main image') }} ({{ __('optional') }})</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                            <div class="text-muted small">{{ __('Image file') }}. {{ __('Maximum image size') }}: {{ (int) (config('pivlu.uploads_image_max_size') ?? 5120) / 1024 }} MB</div>

                            @if ($post->media_id)
                                <div class="mt-3"></div>
                                <div class="float-start me-2"><img style="max-width:25px; height:auto;" src="{{ image($post->media_id, 'thumb_square') }}" /></div>

                                <a target="_blank" href="{{ image($post->media_id) }}">{{ __('Large') }}</a> |
                                <a target="_blank" href="{{ image($post->media_id, 'square') }}">{{ __('Square') }}</a> |
                                <a target="_blank" href="{{ image($post->media_id, 'small') }}">{{ __('Small') }}</a> |
                                <a target="_blank" href="{{ image($post->media_id, 'thumb') }}">{{ __('Thumb') }}</a> |
                                <a target="_blank" href="{{ image($post->media_id, 'thumb_square') }}">{{ __('Thumb square') }}</a>
                                | <a class="text-danger" href="{{ route('admin.posts.delete_main_image', ['id' => $post->id]) }}">{{ __('Delete image') }}</a>
                            @endif
                        </div>
                    @endif
                </div>

            </div>



            <div class="card">

                <div class="card-body">

                    <div class="float-end">

                        @if ($post->status != 'published')
                            <div class="btn btn-warning btn-sm float-end ms-2">{{ __('Not published') }}</div>
                        @endif

                        @if (count(admin_languages()) > 1)
                            <div class="dropdown float-end">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('Preview') }}
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($preview_urls as $lang_name => $preview_url)
                                        @if ($preview_url)
                                            <li><a class="dropdown-item" target="_blank" href="{{ route('home') }}/{{ $preview_url }}">{{ $lang_name }}</a></li>
                                        @else
                                            <li class="dropdown-item" target="_blank" href="#">{{ $lang_name }} <span class="text-danger">{{ __('Not set') }}</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <a target="_blank" href="{{ route('home') }}/{{ $post_type->slug }}/{{ $post->slug }}" class="btn btn-sm btn-secondary"><i class="bi bi-box-arrow-up-right"></i>
                                {{ __('Preview') }}</a>
                        @endif

                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label>{{ __('Publish status') }} </label>
                        <select class="form-select form-select-lg" name="status">
                            @can('publish', [Pivlu\Models\Post::class, $post, $post_type->id])
                                <option @if ($post->status == 'published') selected @endif value="published">{{ __('Published') }}</option>
                            @endcan
                            <option @if ($post->status == 'draft') selected @endif value="draft">{{ __('Save as draft') }}</option>
                        </select>
                        <div class="form-text">{{ __('Only published items are displayed on website') }}</div>
                    </div>

                    @if ($post_type->type == 'page')
                        <div class="form-group col-md-6 col-12 mb-4">
                            <label>{{ __('Parent page') }}</label>
                            <select name="parent_id" class="form-select">
                                <option value="">- {{ __('No parent') }} -</option>
                                @foreach ($root_pages as $root_page)
                                    @if ($post->id != $root_page->id)
                                        <option @if ($post->parent_id == $root_page->id) selected @endif value="{{ $root_page->id }}">
                                            {{ $root_page->default_language_content->title ?? __('no title') }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @foreach ($post_type_taxonomy_terms as $taxonomy_term)
                        <div class="col-12">
                            <div class="form-group">
                                @if ($taxonomy_term->hierarchical == 1)
                                    <label> {{ __(json_decode($taxonomy_term->default_language_content->labels ?? null)->plural ?? __('Select')) }}</label>

                                    @foreach ($taxonomy_term->taxonomies as $taxonomy_item)
                                        @php
                                            if ($taxonomy_item->parent_id) {
                                                continue;
                                            }
                                        @endphp
                                        @include('pivlu::admin.posts.includes.loops.posts-filter-taxonomies-loop-checkboxes', $taxonomy_item)
                                    @endforeach

                                    @if (count($taxonomy_term->taxonomies) == 0)
                                        <div class="form-text">{{ __('No item') }}</div>
                                    @endif
                                @else
                                    <label> {{ __(json_decode($taxonomy_term->default_language_content->labels ?? null)->plural ?? __('Select')) }}</label>
                                    <input type="text" class="form-control tagsinput" name="non-hierarchical-taxonomies[]" id="tags-{{ $taxonomy_term->id }}"
                                        placeholder='{{ __(json_decode($taxonomy_term->default_language_content->labels ?? null)->search ?? 'Add ' . $taxonomy_term->name) }}'
                                        value="{{ get_existing_taxonomies_list($post->id, $taxonomy_term->id) }}">

                                    @php
                                        $tax_list_array = get_taxonomies_list($taxonomy_term->taxonomy);
                                    @endphp

                                    <script>
                                        $(document).ready(function() {

                                            var input = document.querySelector('#tags-{{ $taxonomy_term->id }}'),
                                                tagify = new Tagify(input, {
                                                    enforceWhitelist: true,
                                                    tagTextProp: 'name',
                                                    whitelist: [
                                                        @foreach ($tax_list_array as $key => $tax_list_item)
                                                            {
                                                                "id": {{ $key }},
                                                                "value": "{!! $tax_list_item !!}",
                                                            },
                                                        @endforeach
                                                    ],
                                                    dropdown: {
                                                        searchKeys: ['value'], // very important to set by which keys to search for suggesttions when typing
                                                        maxItems: 200, // <- mixumum allowed rendered suggestions
                                                        classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                                                        enabled: 0, // <- show suggestions on focus
                                                        closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
                                                    }
                                                })
                                        });
                                    </script>
                                @endif
                            </div>
                        </div>
                    @endforeach


                    <div class="clearfix"></div>

                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __(json_decode($post_type->default_language_content->labels ?? null)->update ?? __('Update')) }}
                    </button>

                </div>

            </div>

        </form>
    </div>

</div>




@if (!$post->deleted_at)
    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $post->id }}"
        class="btn btn-danger float-end">{{ __(json_decode($post_type->default_language_content->labels ?? null)->delete ?? __('Delete')) }}</a>
    <div class="modal fade confirm-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to move this item to trash?') }}

                    <div class="mt-2 fw-bold">
                        <i class="bi bi-info-circle"></i> {{ __('This item will be moved to trash. You can recover it or permanently delete from recycle bin.') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.posts.show', ['id' => $post->id]) }}">
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


{{--
<script>
    $(document).ready(function() {
        'use strict';

        $('.tagsinput').tagsInput({
            'width': 'auto',
            'defaultText': "{{ __('Add a tag') }}",
            'autocomplete_url': "{{ route('admin.ajax', ['source' => 'posts_tags']) }}"
        });
    });
</script>
--}}


<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#sortable_top").sortable({
            axis: 'y',
            opacity: 0.8,
            revert: true,

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: "{{ route('admin.posts.sortable', ['id' => $post->id]) }}",
                });
            }
        });
        $("#sortable_top").disableSelection();

    });
</script>

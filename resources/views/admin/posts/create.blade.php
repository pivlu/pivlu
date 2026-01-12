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
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index', ['post_type_id' => $post_type_id]) }}">{{ $post_type->default_language_content->name ?? __('Posts') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __(json_decode($post_type->default_language_content->labels ?? null)->create ?? __('Create')) }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
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

<form action="{{ route('admin.posts.index') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row">

        <div class="form-group col-xl-8 col-md-7 col-sm-12">
            <div class="p-3 bg-white">

                @foreach (admin_languages() as $lang)
                    @if ($post_type->multilingual_content == 0 && $lang->is_default != 1)
                        @continue
                    @endif

                    <div class="form-group">
                        <label>
                            {!! lang_label($lang, __('Title')) !!}
                        </label>
                        <input type="text" class="form-control" name="title_{{ $lang->id }}" maxlength="225" @if ($lang->is_default == 1) required @endif />
                    </div>

                    <div class="mb-1">
                        <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseSettings_{{ $lang->id }}" role="button" aria-expanded="false"
                            aria-controls="collapseControls_{{ $lang->id }}">
                            {{ __('More settings') }} <i class="bi bi-chevron-down"></i>
                        </a>
                    </div>

                    <div class="collapse" id="collapseSettings_{{ $lang->id }}">
                        <div class="form-group">
                            <label>{{ __('Summary') }}</label>
                            <textarea rows="3" class="form-control" name="summary_{{ $lang->id }}"></textarea>
                        </div>

                        @if ($post_type->type != 'page')
                            <div class="form-group">
                                <label>{{ __('Search terms') }} ({{ __('separated by comma') }})</label>
                                <input type="text" class="form-control" name="search_terms_{{ $lang->id }}" aria-describedby="searchHelp">
                                <small id="searchHelp" class="form-text text-muted">
                                    {{ __("Search terms don't appear on website but they are used to find this item in search form") }}
                                    <br>
                                    <i class="bi bi-info-circle"></i> {{ __("Note: you don't need to add terms which are in the title or tags") }}
                                </small>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>{{ __('Custom Meta title') }}</label>
                            <input type="text" class="form-control" name="meta_title_{{ $lang->id }}" aria-describedby="metaTitleHelp">
                            <small id="metaTitleHelp" class="form-text text-muted">
                                {{ __('Leave empty to auto generate meta title based on title') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Custom Meta description') }}</label>
                            <input type="text" class="form-control" name="meta_description_{{ $lang->id }}" aria-describedby="metaDescHelp">
                            <small id="metaDescHelp" class="form-text text-muted">
                                {{ __('Leave empty to auto generate meta description based on summary') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Custom slug') }}</label>
                            <input type="text" class="form-control" name="slug_{{ $lang->id }}" aria-describedby="slugHelp" maxlength="225">
                            <small id="slugHelp" class="form-text text-muted">
                                {{ __('Leave empty to auto generate slug based on title') }}
                            </small>
                        </div>
                    </div>

                    @if (count(languages()) > 1 && !$loop->last && $post_type->multilingual_content == 1)
                        <hr>
                    @endif
                @endforeach

                <hr>

                <div class="form-group mb-3">
                    <label for="formFile" class="form-label">{{ __('Upload main image') }} ({{ __('optional') }})</label>
                    <input class="form-control" type="file" id="formFile" name="image" accept="image/*" />
                    <div class="text-muted small">{{ __('Image file') }}. {{ __('Maximum image size') }}: {{ (int) (config('pivlu.uploads_image_max_size') ?? 5120) / 1024 }} MB</div>
                </div>

            </div>
        </div>

        <div class="form-group col-xl-4 col-md-5 col-sm-12">
            <div class="p-3 bg-white mb-3">
                @if ($post_type->type == 'page')
                    <div class="form-group col-12 mb-4">
                        <label>{{ __('Parent page') }}</label>
                        <select name="parent_id" class="form-select">
                            <option value="">- {{ __('No parent') }} -</option>
                            @foreach ($root_pages as $root_page)
                                <option value="{{ $root_page->id }}">
                                    {{ $root_page->default_language_content->title }}
                                </option>
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
                                    @include('pivlu::admin.posts.includes.loops.create-post-taxonomies-loop-checkboxes', $taxonomy_item)
                                @endforeach

                                @if (count($taxonomy_term->taxonomies) == 0)
                                    <div class="form-text">{{ __('No item') }}</div>
                                @endif
                            @else
                                <label> {{ __(json_decode($taxonomy_term->default_language_content->labels ?? null)->plural ?? __('Select')) }}</label>
                                <input type="text" class="form-control tagsinput" name="non-hierarchical-taxonomies[]" id="tags-{{ $taxonomy_term->id }}"
                                    placeholder='{{ __(json_decode($taxonomy_term->default_language_content->labels ?? null)->search ?? 'Add ' . $taxonomy_term->name) }}'
                                    aria-describedby="tagsHelp-{{ $taxonomy_term->id }}" />

                                @php
                                    $tax_list_array = get_taxonomies_list($taxonomy_term->id);                                    
                                @endphp

                                <script>
                                    $(document).ready(function() {

                                        var input = document.querySelector('#tags-{{ $taxonomy_term->id }}'),
                                            tagify = new Tagify(input, {
                                                enforceWhitelist: true,
                                                tagTextProp: 'name',
                                                whitelist: [
                                                    @foreach ($tax_list_array as $tax_list_item)                                                        
                                                        {
                                                            "id": {{ $tax_list_item['id'] }},
                                                            "value": "{!! $tax_list_item['name'] !!}",
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
            

                <div class="d-grid gap-2 my-3">
                    <a class="btn btn-secondary fw-bold" data-bs-toggle="collapse" href="#collapseSettings" role="button" aria-expanded="false" aria-controls="collapseExample">
                        {{ __('More settings') }} <i class="bi bi-chevron-down"></i>
                    </a>
                </div>

                <div class="collapse" id="collapseSettings">

                    @if ($post_type->type != 'page')
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchSticky" name="sticky">
                                <label class="form-check-label" for="customSwitchSticky">{{ __('Sticky') }}</label>
                                <span class="form-text text-muted small">({{ __('Sticky items are displayed first') }})</span>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>{{ __('Custom template file') }}</label>
                        <input type="text" class="form-control" name="custom_tpl_file" aria-describedby="tplHelp">
                        <small id="tplHelp" class="form-text text-muted">
                            {{ __('Leave empty to use default') }}
                        </small>
                    </div>
                </div>


                <div class="clearfix"></div>

                <input type="hidden" name="post_type_id" value="{{ $post_type->id }}">
                <button type="submit" class="btn btn-gear">{{ __('Save and add content') }}</button>

                <div class="text-muted mt-3 small"><i class="bi bi-info-circle"></i> {{ __('This item will be saved as draft. After you add content blocks, you can publish it.') }}</div>
            </div>

        </div>

    </div><!-- end row -->
</form>

<script>
    $(document).ready(function() {

        var input = document.querySelector('#tags'),
            tagify = new Tagify(input, {
                whitelist: [{!! $all_tags ?? null !!}],
                dropdown: {
                    maxItems: 30, // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0, // <- show suggestions on focus
                    closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
                }
            })
    });
</script>

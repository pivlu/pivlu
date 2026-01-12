<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="ModalCreatePosTypeLabel" aria-hidden="true" id="create-post-type">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCreatePosTypeLabel">{{ __('Create new post type') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @foreach (admin_languages() as $lang)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{!! lang_label($lang, __('Name (plural)')) !!}</label>
                                    <input class="form-control" name="name_{{ $lang->id }}" type="text" @if ($lang->is_default == 1) required @endif />
                                    <div class="text-muted small">{{ __('Examples: "Books", "Mobile phones"') }}</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{!! lang_label($lang, __('Custom URL slug (optional)')) !!}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="addon-slug">{{ config('app.url') }}/@if ($lang->is_default == 0)
                                                {{ $lang->code }}/
                                            @endif
                                        </span>
                                        <input class="form-control" aria-describedby="addon-slug" name="slug_{{ $lang->id }}" type="text" />
                                    </div>
                                    <div class="text-muted small">{{ __('Examples: "books", "mobile-phones"') }}</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{!! lang_label($lang, __('Title')) !!}</label>
                                    <input class="form-control" name="title_{{ $lang->id }}" type="text" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{!! lang_label($lang, __('Meta title')) !!}</label>
                                    <input class="form-control" name="meta_title_{{ $lang->id }}" type="text" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{!! lang_label($lang, __('Meta description')) !!}</label>
                                    <input class="form-control" name="meta_description_{{ $lang->id }}" type="text" />
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="collapse show" id="collapseSettings_{{ $lang->id }}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('Label singular')) !!}</label>
                                        <input class="form-control" name="label_singular_{{ $lang->id }}" type="text" />
                                        <div class="text-muted small">{{ __('Examples: "Book", "Mobile phone"') }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('Label plural')) !!}</label>
                                        <input class="form-control" name="label_plural_{{ $lang->id }}" type="text" />
                                        <div class="text-muted small">{{ __('Examples: "Books", "Mobile phones"') }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('Label create')) !!}</label>
                                        <input class="form-control" name="label_create_{{ $lang->id }}" type="text" />
                                        <div class="text-muted small">{{ __('Examples: "Add new book", "Add new mobile phone"') }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('Label update')) !!}</label>
                                        <input class="form-control" name="label_update_{{ $lang->id }}" type="text" />
                                        <div class="text-muted small">{{ __('Examples: "Update book", "Update mobile phone"') }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('Label delete')) !!}</label>
                                        <input class="form-control" name="label_delete_{{ $lang->id }}" type="text" />
                                        <div class="text-muted small">{{ __('Examples: "Delete book", "Delete mobile phone"') }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('Label all')) !!}</label>
                                        <input class="form-control" name="label_all_{{ $lang->id }}" type="text" />
                                        <div class="text-muted small">{{ __('Examples: "All books", "All mobile phones"') }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('Label search')) !!}</label>
                                        <input class="form-control" name="label_search_{{ $lang->id }}" type="text" />
                                        <div class="text-muted small">{{ __('Examples: "Search book", "Search mobile phone"') }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('Label featured')) !!}</label>
                                        <input class="form-control" name="label_featured_{{ $lang->id }}" type="text" />
                                        <div class="text-muted small">{{ __('Examples: "Featured books", "Featured mobile phones"') }}</div>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Identificator') }} ({{ __('singular') }})</label>
                                <input class="form-control" name="type" type="text" minlength="1" maxlength="25" required />
                                <div class="text-muted small">{{ __('Only lowercases, letters, numbers and _. Examples: "book", "mobile_phone"') }}</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Icon code (admin)') }} ({{ __('optional') }})</label>
                                <input class="form-control" name="admin_menu_icon" type="text" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Custom template') }} ({{ __('optional') }})</label>
                                <input class="form-control" name="custom_theme" type="text" />
                                <div class="text-muted small">
                                    {{ __('The template name. Example: "pivlu_default". If set, the content of this post type (posts, pages, categories, tags, taxonomies...) will use this template. Leave empty to use active template.') }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="customSwitch" name="active" checked>
                            <label class="form-check-label" for="customSwitch">{{ __('Active') }}</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="customSwitchMultilingual" name="multilingual_content" checked>
                            <label class="form-check-label" for="customSwitchMultilingual">{{ __('Multilingual content') }}</label>
                        </div>
                        <div class="text-muted small">{{ __('If enabled, the content of this post type can be translated to multiple languages.') }}</div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

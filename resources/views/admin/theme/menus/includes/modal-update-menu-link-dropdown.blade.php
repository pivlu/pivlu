<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="updateLabel-{{ $link->id }}" aria-hidden="true" id="update-menu-link-dropdown-{{ $link->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('admin.theme-menu.dropdown.update', ['parent_id' => $parent_item->id, 'item_id' => $link->id]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="updateLabel-{{ $link->id }}">{{ __('Update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{ __('Link destination') }}</label>
                                <select name="type" class="form-select" id="update_menu_link_{{ $link->id }}" onchange="showDiv_{{ $link->id }}()" required>
                                    <option selected value="">-- {{ __('Choose an option') }} --</option>
                                    <option @if ($link->type == 'home') selected @endif value="home">{{ __('Homepage') }}</option>
                                    @if (($is_dropdown ?? null) != 1)
                                        <option @if ($link->type == 'dropdown') selected @endif value="dropdown">{{ __('Dropdown menu') }}</option>
                                    @endif
                                    <option @if ($link->type == 'page') selected @endif value="page">{{ __('Page') }}</option>
                                    <option @if ($link->type == 'post_type') selected @endif value="post_type">{{ __('Post type (content type)') }}</option>
                                    <option @if ($link->type == 'custom') selected @endif value="custom">{{ __('Custom link') }}</option>
                                </select>
                            </div>
                        </div>

                        <script>
                            function showDiv_{{ $link->id }}() {
                                var select = document.getElementById('update_menu_link_{{ $link->id }}');
                                var value = select.options[select.selectedIndex].value;

                                if (value == 'custom') {
                                    @foreach (admin_languages() as $lang)
                                        document.getElementById('hidden_div_custom_{{ $lang->id }}_{{ $link->id }}').style.display = 'block';
                                    @endforeach
                                    document.getElementById('hidden_div_page_{{ $link->id }}').style.display = 'none';
                                    document.getElementById('hidden_div_post_type_{{ $link->id }}').style.display = 'none';
                                } else if (value == 'page') {
                                    @foreach (admin_languages() as $lang)
                                        document.getElementById('hidden_div_custom_{{ $lang->id }}_{{ $link->id }}').style.display = 'none';
                                    @endforeach
                                    document.getElementById('hidden_div_page_{{ $link->id }}').style.display = 'block';
                                    document.getElementById('hidden_div_post_type_{{ $link->id }}').style.display = 'none';
                                } else if (value == 'post_type') {
                                    @foreach (admin_languages() as $lang)
                                        document.getElementById('hidden_div_custom_{{ $lang->id }}_{{ $link->id }}').style.display = 'none';
                                    @endforeach
                                    document.getElementById('hidden_div_post_type_{{ $link->id }}').style.display = 'block';
                                    document.getElementById('hidden_div_page_{{ $link->id }}').style.display = 'none';
                                } else {
                                    document.getElementById('hidden_div_page_{{ $link->id }}').style.display = 'none';
                                    @foreach (admin_languages() as $lang)
                                        document.getElementById('hidden_div_custom_{{ $lang->id }}_{{ $link->id }}').style.display = 'none';
                                    @endforeach
                                    document.getElementById('hidden_div_post_type_{{ $link->id }}').style.display = 'none';
                                }
                            }
                        </script>

                        <div id="hidden_div_page_{{ $link->id }}" style="display: @if ($link->type == 'page') block @else none @endif" class="mb-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Change page') }} ({{ __('optional') }})</label>
                                    <select name="page_id" class="form-select">
                                        @foreach ($pages as $page)
                                            <option @if ($link->value == $page->id) selected @endif value="{{ $page->id }}">{{ $page->default_language_content->title }}
                                                ({{ $page->default_language_content->url ?? null }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (count(admin_languages()) > 1)
                                        <div class="form-text">{{ __('Default language links are displayed in this select. The website link will use the current language url.') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="hidden_div_post_type_{{ $link->id }}" style="display: @if ($link->type == 'post_type') block @else none @endif" class="mb-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Post type (content type)') }}</label>
                                    <select name="post_type_id" class="form-select">
                                        <option value="">{{ __('Select a post type') }}</option>
                                        @foreach ($post_types as $post_type)
                                            <option @if ($link->value == $post_type->id) selected @endif value="{{ $post_type->id }}">
                                                {{ $post_type->default_language_content->name ?? ($post_type->default_language_content->title ?? null) }}
                                                ({{ $post_type->default_language_content->url ?? null }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (count(admin_languages()) > 1)
                                        <div class="form-text">{{ __('Default language links are displayed in this select. The website link will use the current language url.') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @foreach ($link->all_languages_contents as $lang_content)
                            <div id="hidden_div_custom_{{ $lang_content->lang_id }}_{{ $link->id }}" style="display: @if ($link->type == 'custom') block @else none @endif">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang_content, __('URL')) !!}</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="url-addon-{{ $lang_content->lang_id }}_{{ $link->id }}">https://</span>
                                            <input class="form-control" name="custom_url_{{ $lang_content->lang_id }}" type="text" value="{{ $lang_content->custom_url ?? null }}"
                                                aria-describedby="url-addon-{{ $lang_content->lang_id }}_{{ $link->id }}" />
                                        </div>
                                        <div class="form-text">{{ __('Full URL (e.g. "https://example.com/page")') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{!! lang_label($lang_content, __('Label')) !!}</label>
                                    <input class="form-control" name="label_{{ $lang_content->lang_id }}" type="text" value="{{ $lang_content->label }}" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{!! lang_label($lang_content, __('Description (optional)')) !!}</label>
                                    <input class="form-control" name="description_{{ $lang_content->lang_id }}" type="text" value="{{ $lang_content->description ?? null }}" />
                                    <div class="form-text">{{ __('The description will be displayed in the menu if the current theme supports it.') }}</div>
                                </div>
                            </div>
                            @if (count(admin_languages()) > 1 && !$loop->last)
                                <hr>
                            @endif
                        @endforeach


                        <div class="col-12">
                            <hr>
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="new_tab_{{ $link->id }}" name="new_tab" @if ($link->new_tab == 1) checked @endif>
                                    <label class="form-check-label" for="new_tab_{{ $link->id }}">{{ __('Open link in new tab') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-check-label">{{ __('Icon code') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="icon" value="{{ $link->icon ?? null }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-check-label">{{ __('CSS classes') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="css_classes" value="{{ $link->css_classes ?? null }}">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $link->id }}">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

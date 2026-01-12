<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-menu-link">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            @php
                if (($is_dropdown ?? null) == 1) {
                    $form_action = route('admin.theme-menu.dropdown', ['parent_id' => $parent_item->id]);
                } else {
                    $form_action = route('admin.theme-menus.item.create', ['menu_id' => $menu->id]);
                }
            @endphp

            <form method="post" action="{{ $form_action }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Add new link') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{ __('Link destination') }}</label>
                                <select name="type" class="form-select" id="createmenu" onchange="showDiv()" required>
                                    <option selected value="">-- {{ __('Choose an option') }} --</option>
                                    <option value="home">{{ __('Homepage') }}</option>
                                    @if (($is_dropdown ?? null) != 1)
                                        <option value="dropdown">{{ __('Dropdown menu') }}</option>
                                    @endif
                                    <option value="page">{{ __('Page') }}</option>
                                    <option value="post_type">{{ __('Post type (content type)') }}</option>
                                    <option value="custom">{{ __('Custom link') }}</option>
                                </select>
                            </div>
                        </div>

                        <script>
                            function showDiv() {
                                var select = document.getElementById('createmenu');
                                var value = select.options[select.selectedIndex].value;

                                if (value == 'custom') {
                                    @foreach(admin_languages() as $lang)
                                        document.getElementById('hidden_div_custom_{{ $lang->id }}').style.display = 'block';
                                    @endforeach
                                    document.getElementById('hidden_div_page').style.display = 'none';
                                    document.getElementById('hidden_div_post_type').style.display = 'none';
                                } else if (value == 'page') {
                                    document.getElementById('hidden_div_page').style.display = 'block';
                                    @foreach(admin_languages() as $lang)
                                        document.getElementById('hidden_div_custom_{{ $lang->id }}').style.display = 'none';
                                    @endforeach
                                    document.getElementById('hidden_div_post_type').style.display = 'none';
                                } else if (value == 'post_type') {
                                    document.getElementById('hidden_div_post_type').style.display = 'block';
                                    document.getElementById('hidden_div_page').style.display = 'none';
                                    @foreach(admin_languages() as $lang)
                                        document.getElementById('hidden_div_custom_{{ $lang->id }}').style.display = 'none';
                                    @endforeach
                                } else {
                                    document.getElementById('hidden_div_page').style.display = 'none';
                                    @foreach(admin_languages() as $lang)
                                        document.getElementById('hidden_div_custom_{{ $lang->id }}').style.display = 'none';
                                    @endforeach
                                    document.getElementById('hidden_div_post_type').style.display = 'none';
                                }
                            }
                        </script>

                        <div id="hidden_div_page" style="display: none" class="mb-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Select page') }}</label>
                                    <select name="page_id" class="form-select">
                                        <option value="">{{ __('Select a page') }}</option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id }}">{{ $page->default_language_content->title }} ({{ $page->default_language_content->url ?? null }})</option>
                                        @endforeach
                                    </select>
                                    @if (count(admin_languages()) > 1)
                                        <div class="form-text">{{ __('Default language links are displayed in this select. The website link will use the current language url.') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="hidden_div_post_type" style="display: none" class="mb-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Post type (content type)') }}</label>
                                    <select name="post_type_id" class="form-select">
                                        <option value="">{{ __('Select a post type') }}</option>
                                        @foreach ($post_types as $post_type)
                                            <option value="{{ $post_type->id }}">{{ $post_type->default_language_content->name ?? ($post_type->default_language_content->title ?? null) }}
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

                        @foreach (admin_languages() as $lang)
                            <div id="hidden_div_custom_{{ $lang->id }}" style="display: none">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{!! lang_label($lang, __('URL')) !!}</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="url-addon">https://</span>
                                            <input class="form-control" name="custom_url_{{ $lang->id }}" type="text" aria-describedby="url-addon" />
                                        </div>
                                        <div class="form-text">{{ __('Full URL (e.g. "https://example.com/page")') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{!! lang_label($lang, __('Label')) !!}</label>
                                    <input class="form-control" name="label_{{ $lang->id }}" type="text" required />
                                    <div class="form-text">{{ __('The title of the item on your custom menu.') }}</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{!! lang_label($lang, __('Description (optional)')) !!}</label>
                                    <input class="form-control" name="description_{{ $lang->id }}" type="text" />
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
                                    <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab">
                                    <label class="form-check-label" for="new_tab">{{ __('Open link in new tab') }}</label>
                                </div>
                            </div>
                        </div>

                        @if (($is_dropdown ?? null) != 1)
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-check-label">{{ __('Link style') }}</label>
                                    <select name="btn_id" class="form-select">
                                        <option value="">{{ __('Link') }}</option>
                                        @foreach ($buttons as $button)
                                            <option value="{{ $button->id }}">{{ __('Button') }} ({{ $button->label }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-check-label">{{ __('Icon code') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="icon">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-check-label">{{ __('CSS classes') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="css_classes">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Add menu link') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

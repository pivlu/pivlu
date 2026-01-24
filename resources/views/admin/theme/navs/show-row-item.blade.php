<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website appearance') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.theme-navs.index') }}">{{ __('Navigations') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $nav->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        @if ($message == 'updated')
            {{ __('Updated') }}
        @endif
        @if ($message == 'deleted')
            {{ __('Deleted') }}
        @endif
    </div>
@endif


<div class="card bg-light p-3 mb-4">

    <div class="row mb-3">
        <div class="col-6">
            <a href="{{ route('admin.theme-nav-rows.show', ['nav_id' => $nav->id, 'row_id' => $row->id]) }}" class="btn btn-secondary btn-sm">{{ __('Back to navigation row') }}</a>
        </div>

        <div class="col-6 text-end float-end">
            <form action="{{ route('admin.theme-nav-row.delete-item', ['nav_id' => $nav->id, 'row_id' => $row->id, 'item_id' => $item->id]) }}" method="POST"
                onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete item') }}</button>
            </form>

        </div>
    </div>

    <form action="{{ route('admin.theme-nav-row.show-item', ['nav_id' => $nav->id, 'row_id' => $row->id, 'item_id' => $item->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($item->type == 'menu_links')
            <h5 class="fw-bold">{{ __('Menu link item') }}</h5>

            <div class="row">
                <div class="col-lg-3 col-md-6">

                    <div class="form-group mb-3">
                        <label>Select menu link</label>
                        <select class="form-select" name="menu_links_id" required>
                            <option value="">{{ __('-- Select links menu --') }}</option>
                            @foreach ($menu_links as $menu_link)
                                <option value="{{ $menu_link->id }}" @if ($item->menu_links_id == $menu_link->id) selected @endif>{{ $menu_link->label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @endif


        @if ($item->type == 'html')
            @include('pivlu::admin.includes.trumbowyg-assets')

            <h5 class="fw-bold">{{ __('Text / HTML item') }}</h5>

            @foreach (admin_languages() as $lang_code => $language)
                <div class="form-group mb-3">
                    <label>{!! lang_label($language, __('Content')) !!}</label>
                    <textarea class="form-control trumbowyg" name="html_content_{{ $language->id }}" rows="6">{{ $item->getTranslation('html_content', $language->id) }}</textarea>
                </div>
            @endforeach
        @endif


        @if ($item->type == 'social_buttons')
            <h5 class="fw-bold">{{ __('Social links item') }}</h5>

            @php
                $social_links = json_decode($item->settings, true) ?? [['name' => null, 'icon' => null, 'url' => null]];
            @endphp

            @foreach ($social_links as $link)
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb3">
                            <label>{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name[]" value="{{ $link['name'] ?? '' }}">
                            <div class="form-text">{{ __('Enter the name of the social network (e.g., Facebook, Twitter).') }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb3">
                            <label>{{ __('Icon code') }}</label>
                            <input type="text" class="form-control" name="icon[]" value="{{ $link['icon'] ?? '' }}">
                            <div class="form-text">{{ __('Enter the icon class for the social network (e.g., fa-facebook, fa-twitter).') }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb3">
                            <label>{{ __('URL') }}</label>
                            <input type="text" class="form-control" name="url[]" value="{{ $link['url'] ?? '' }}">
                            <div class="form-text">{{ __('Enter the URL of the social network (e.g., https://facebook.com/your-profile, https://twitter.com/your-profile).') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach


            <button type="button" class="btn btn-secondary btn-sm mt-2 mb-3" id="add-social-link">{{ __('Add another social link') }}</button>

            <script>
                document.getElementById('add-social-link').addEventListener('click', function() {
                    var container = document.createElement('div');
                    container.classList.add('row', 'mb-3');

                    container.innerHTML = `
                        <div class="col-md-4">
                            <div class="form-group mb3">
                                <label>{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name[]">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb3">
                                <label>{{ __('Icon code') }}</label>
                                <input type="text" class="form-control" name="icon[]">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb3">
                                <label>{{ __('URL') }}</label>
                                <input type="text" class="form-control" name="url[]">
                            </div>
                        </div>
                    `;
                    this.insertAdjacentElement('beforebegin', container);
                });
            </script>

            <div class="form-text mt-3"><i class="bi bi-info-circle"></i> {{ __('To remove a social link, simply clear its fields and save the changes.') }}</div>
        @endif


        @if ($item->type == 'search')
            <h5 class="fw-bold">{{ __('Search item') }}</h5>

            @php
                $settings = json_decode($item->settings, true) ?? [];
            @endphp

            <div class="row">

                @foreach (admin_languages() as $lang_code => $language)
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>{!! lang_label($language, __('Search placeholder text')) !!}</label>
                            <input type="text" class="form-control" name="search_placeholder_text_{{ $language->id }}" value="{{ $item->getTranslation('search_placeholder_text', $language->id) }}">
                        </div>
                    </div>
                @endforeach

                <div class="form-group mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="switchCheckUseIcon" name="use_icon" id="use_icon" @if (($settings['use_icon'] ?? null) == 1) checked @endif>
                        <label class="form-check-label" for="switchCheckUseIcon">{{ __('Use search icon instead of text in the button') }}</label>
                    </div>
                </div>

                <script>
                    document.getElementById('switchCheckUseIcon').addEventListener('change', function() {
                        var butonTextDiv = document.getElementById('buton_text_div');
                        if (this.checked) {
                            butonTextDiv.style.display = 'none';
                        } else {
                            butonTextDiv.style.display = 'block';
                        }
                    });
                </script>

                <div id="buton_text_div" @if (($settings['use_icon'] ?? null) == 1) style="display: none;" @endif>
                    @foreach (admin_languages() as $lang_code => $language)
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label>{!! lang_label($language, __('Search button text')) !!}</label>
                                <input type="text" class="form-control" name="search_button_text_{{ $language->id }}" value="{{ $item->getTranslation('search_button_text', $language->id) }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <label>{{ __('Search input size') }}</label>
                    <select class="form-select mb-3" name="search_input_size" required>
                        <option value="normal" @if (($settings['search_input_size'] ?? null) == 'normal') selected @endif>{{ __('Normal') }}</option>
                        <option value="small" @if (($settings['search_input_size'] ?? null) == 'small') selected @endif>{{ __('Small') }}</option>
                        <option value="large" @if (($settings['search_input_size'] ?? null) == 'large') selected @endif>{{ __('Large') }}</option>
                    </select>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <label>{{ __('Search input minimum width') }}</label>
                    <input type="number" step="1" class="form-control" name="search_input_min_width" value="{{ $settings['search_input_min_width'] ?? null }}">
                    <div class="form-text mb-3 mt-1">{{ __('Set the minimum width of the search input in pixels (e.g., 300). Leave empty for default width.') }}</div>
                </div>

            </div>
        @endif


        @if ($item->type == 'custom_code')
            <link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism-live.css') }}">

            <h5 class="fw-bold">{{ __('Text / HTML item') }}</h5>
            
            @foreach (admin_languages() as $lang_code => $language)
                <div class="form-group mb-3">
                    <label>{!! lang_label($language, __('Custom code')) !!}</label>                    
                    <textarea name="content_{{ $language->id }}" class="prism-live line-numbers language-html fill">{{ $item->getTranslation('content', $language->id) }}</textarea>
                </div>
            @endforeach

            <script src="{{ asset('assets/vendor/prism/prism.js') }}"></script>
            <script src="{{ asset('assets/vendor/prism/prism-live.js') }}"></script>
        @endif


        <button type="submit" class="btn btn-primary btn-sm">{{ __('Save changes') }}</button>
    </form>
</div>

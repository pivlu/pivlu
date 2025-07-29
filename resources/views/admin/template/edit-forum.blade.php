@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.template') }}">{{ __('Template Builder') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-header">

        <div class="row">

            <div class="col-12">
                @include('admin.template.includes.menu-template')
            </div>

        </div>

    </div>


    <div class="card-body">

        <div class="mb-3">
            @include('admin.template.includes.menu-template-edit')
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
                @if ($message == 'updated')
                    <div class="fw-bold">{{ __('Updated') }}</div>
                    <i class="bi bi-exclamation-circle"></i>
                    {{ __("Note: if you don't see any changes on website, you can try to reload the website using CTRL+F5 or clear browser cache.") }}
                @endif
            </div>
        @endif

        <form method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card bg-light p-3 mb-3">

                        <div class="col-12 col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-check-label">{{ __('Button style') }}</label>
                                <select name="tpl_forum_btn_id" class="form-select">
                                    @foreach ($buttons as $button)
                                        <option @if (($config->tpl_forum_btn_id ?? null) == $button->id) selected @endif value="{{ $button->id }}">{{ __('Button') }} ({{ $button->label }})</option>
                                    @endforeach
                                </select>
                                <div class="text-muted small">{{ __('Create topic button, reply button...') }}</div>
                            </div>
                        </div>



                        <div class="fw-bold fs-5 mb-2">{{ __('Posts author bar') }}</div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>{{ __('Bar style') }}</label>
                                <select class="form-select" name="tpl_forum_posts_author_layout">
                                    <option @if (($config->tpl_forum_posts_author_layout ?? null) == 'horizontal') selected @endif value="horizontal">{{ __('Horizontal') }}</option>
                                    <option @if (($config->tpl_forum_posts_author_layout ?? null) == 'vertical') selected @endif value="vertical">{{ __('Vertical') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('Bar background color') }}</label><br>
                                    <input id="tpl_forum_post_author_bar_bg_color" name="tpl_forum_post_author_bar_bg_color" value="{{ $config->tpl_forum_post_author_bar_bg_color ?? '#16537E' }}">
                                    <script>
                                        $('#tpl_forum_post_author_bar_bg_color').spectrum({
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

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('Bar text color') }}</label><br>
                                    <input id="tpl_forum_post_author_bar_font_color" name="tpl_forum_post_author_bar_font_color" value="{{ $config->tpl_forum_post_author_bar_font_color ?? '#FFFFFF' }}">
                                    <script>
                                        $('#tpl_forum_post_author_bar_font_color').spectrum({
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

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('Bar links color') }}</label><br>
                                    <input id="tpl_forum_post_author_bar_link_color" name="tpl_forum_post_author_bar_link_color" value="{{ $config->tpl_forum_post_author_bar_link_color ?? '#eaf3f9' }}">
                                    <script>
                                        $('#tpl_forum_post_author_bar_link_color').spectrum({
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

                            <hr>

                            <div class="fw-bold fs-5 mb-2">{{ __('Posts cards settings') }}</div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('Card background color') }}</label><br>
                                    <input id="tpl_forum_post_bg_color" name="tpl_forum_post_bg_color" value="{{ $config->tpl_forum_post_bg_color ?? '#F8F9FA' }}">
                                    <script>
                                        $('#tpl_forum_post_bg_color').spectrum({
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

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('Card border color') }}</label><br>
                                    <input id="tpl_forum_post_border_color" name="tpl_forum_post_border_color" value="{{ $config->tpl_forum_post_border_color ?? '#F8F9FA' }}">
                                    <script>
                                        $('#tpl_forum_post_border_color').spectrum({
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

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('Text color') }}</label><br>
                                    <input id="tpl_forum_post_font_color" name="tpl_forum_post_font_color" value="{{ $template->tpl_forum_post_font_color ?? '#999999' }}">
                                    <script>
                                        $('#tpl_forum_post_font_color').spectrum({
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

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>{{ __('Links color') }}</label><br>
                                    <input id="tpl_forum_post_link_color" name="tpl_forum_post_link_color" value="{{ $config->tpl_forum_post_link_color ?? '#16537E' }}">
                                    <script>
                                        $('#tpl_forum_post_link_color').spectrum({
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

                        </div>

                    </div>
                </div>



                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card bg-light p-3 mb-3">

                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='tpl_forum_index_show_latest_topics'>
                                <input class="form-check-input" type="checkbox" id="tpl_forum_index_show_latest_topics" name="tpl_forum_index_show_latest_topics" @if ($config->tpl_forum_index_show_latest_topics ?? null) checked @endif>
                                <label class="form-check-label" for="tpl_forum_index_show_latest_topics">{{ __('Show latest topics in forum main page') }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='tpl_forum_index_show_latest_posts'>
                                <input class="form-check-input" type="checkbox" id="tpl_forum_index_show_latest_posts" name="tpl_forum_index_show_latest_posts" @if ($config->tpl_forum_index_show_latest_posts ?? null) checked @endif>
                                <label class="form-check-label" for="tpl_forum_index_show_latest_posts">{{ __('Show latest posts (responses) in forum main page') }}</label>
                            </div>
                        </div>                      

                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='tpl_forum_container_fluid'>
                                <input class="form-check-input" type="checkbox" id="tpl_forum_container_fluid" name="tpl_forum_container_fluid" @if ($config->tpl_forum_container_fluid ?? null) checked @endif>
                                <label class="form-check-label" for="tpl_forum_container_fluid">{{ __('Use fluid forum width (full width)') }}</label>
                            </div>
                        </div>

                        <div class="fw-bold fs-5">{{ __('Forum layouts') }}</div>
                        
                        <div class="text-muted mb-3">
                            {{ __('You can add content sections (above or below the main content) or sidebars using layouts.') }}
                            <a target="_blank" href="{{ route('admin.template.layouts') }}"><b>{{ __('Manage layouts') }}</b></a>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('Forum main page layout') }}</label>
                                    <select name="tpl_forum_home_layout_id" class="form-select">
                                        <option value="">- {{ __('Default (full width)') }} -</option>
                                        @foreach ($layouts as $layout)
                                            <option value="{{ $layout->id }}" @if(($config->tpl_forum_home_layout_id ?? null) == $layout->id) selected @endif>
                                                {{ $layout->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('Forum categories pages layout') }}</label>
                                    <select name="tpl_forum_categ_layout_id" class="form-select">
                                        <option value="">- {{ __('Default (full width)') }} -</option>
                                        @foreach ($layouts as $layout)
                                            <option value="{{ $layout->id }}" @if(($config->tpl_forum_categ_layout_id ?? null) == $layout->id) selected @endif>
                                                {{ $layout->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('Forum topic page layout') }}</label>
                                    <select name="tpl_forum_topic_layout_id" class="form-select">
                                        <option value="">- {{ __('Default (full width)') }} -</option>
                                        @foreach ($layouts as $layout)
                                            <option value="{{ $layout->id }}" @if(($config->tpl_forum_topic_layout_id ?? null) == $layout->id) selected @endif>
                                                {{ $layout->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <input type="hidden" name="module" value="forum">
            <button type="submit" class="btn btn-primary mt-3">{{ __('Update template') }}</button>
        </form>

    </div>
    <!-- end card-body -->

</div>

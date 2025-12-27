<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index', ['post_type_id' => $post_type->id]) }}">
                            {{ $post_type->default_language_content->name ?? __('Posts') }}
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Homepage') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('pivlu::admin.posts.includes.menu-post')

    <div class="card-header">
        
        <div class="float-end">
           
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

        <form method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="form-group col-xl-8 col-md-7 col-sm-12">
                    <div class="p-3 bg-light">

                        @foreach ($content_langs as $lang)
                            @if (count($content_langs) > 1)
                                <div class="fw-bold fs-5">{!! flag($lang->code, 'circle') !!} {{ $lang->name }}</div>
                            @endif
                                                      

                            <div class="form-group">
                                <label>{{ __('Homepage meta title') }}</label>
                                <input type="text" class="form-control" name="meta_title_{{ $lang->id }}" aria-describedby="metaTitleHelp" value="{{ $lang->post_content['meta_title'] ?? null }}">                                
                            </div>

                            <div class="form-group">
                                <label>{{ __('Homepage meta description') }}</label>
                                <input type="text" class="form-control" name="meta_description_{{ $lang->id }}" aria-describedby="metaDescHelp" value="{{ $lang->post_content['meta_description'] ?? null }}">                                
                            </div>                           

                            @if (count(languages()) > 1)
                                <hr>
                            @endif
                        @endforeach                        
                    </div>
                </div>

                <div class="form-group col-xl-4 col-md-5 col-sm-12">
                    <div class="p-3 bg-light mb-3">
                        
                        
                        

                        <div class="d-grid gap-2 my-3">
                            <a class="btn btn-secondary fw-bold" data-bs-toggle="collapse" href="#collapseSettings" role="button" aria-expanded="false" aria-controls="collapseExample">
                                {{ __('More settings') }} <i class="bi bi-chevron-down"></i>
                            </a>
                        </div>

                        <div class="collapse" id="collapseSettings">

                            @if ($post_type->type != 'page')
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="customSwitchComments" name="disable_comments" @if ($post->disable_comments) checked @endif
                                            @if ($config->posts_comments_disabled ?? null) disabled @endif>
                                        <label class="form-check-label" for="customSwitchComments">{{ __('Disable comments for this item') }}</label>
                                    </div>
                                    @if ($config->posts_comments_disabled ?? null)
                                        <div class="text-danger">{{ __('The commenting system is disabled globally.') }} <a target="_blank" href="{{ route('admin.posts.config') }}">{{ __('Change') }}</a></div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="customSwitchLike" name="disable_likes" @if ($post->disable_likes) checked @endif
                                            @if ($config->posts_likes_disabled ?? null) disabled @endif>
                                        <label class="form-check-label" for="customSwitchLikes">{{ __('Disable likes for this item') }}</label>
                                    </div>
                                    @if ($config->posts_likes_disabled ?? null)
                                        <div class="text-danger">{{ __('The like system is disabled globally.') }} <a target="_blank" href="{{ route('admin.posts.config') }}">{{ __('Change') }}</a></div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="customSwitchSticky" name="sticky" @if ($post->sticky) checked @endif>
                                        <label class="form-check-label" for="customSwitchSticky">{{ __('Sticky') }}</label>
                                        <span class="form-text text-muted small">({{ __('Sticky items are displayed first') }})</span>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>{{ __('Custom template file') }}</label>
                                <input type="text" class="form-control" name="custom_tpl_file" aria-describedby="tplHelp" value="{{ $post->custom_tpl_file }}">
                                <small id="tplHelp" class="form-text text-muted">
                                    {{ __('Leave empty to use default') }}
                                </small>
                            </div>
                        </div>


                        <div class="clearfix"></div>

                        <input type="hidden" name="status" value="published">

                        <button type="submit" class="btn btn-primary mt-3">
                            {{ __(json_decode($post_type->default_language_content->labels ?? null)->update ?? __('Update')) }}
                        </button>
                    </div>

                </div>

            </div><!-- end row -->
        </form>

    </div>
    <!-- end card-body -->

</div>

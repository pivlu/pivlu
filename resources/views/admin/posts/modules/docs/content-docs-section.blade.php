<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index', ['post_type_id' => $post_type->id]) }}">
                            {{ $post_type->default_language_content->name ?? __('Posts') }}
                        </a></li>
                    <li class="breadcrumb-item">{{ $post->default_language_content->title ?? '-' }}</li>
                    <li class="breadcrumb-item active">{{ $post_docs_section->default_language_content->title ?? '-' }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('admin.posts.includes.menu-post')

    <div class="card-header">

        <div class="row">

            <div class="col-12">               
                <div class="fw-bold fs-5">
                    {{ $post_docs_section->default_language_content->title ?? '-' }}
                </div>

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
                @if ($message == 'main_image_deleted')
                    {{ __('Deleted') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
                @if ($message == 'deleted')
                    {{ __('Deleted') }}
                @endif
                @if ($message == 'post_created')
                    <i class="bi bi-info-circle"></i> {{ __('Post created. You can add content to this post. After you add content blocks, you can publish the post.') }}
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

            <div class="col-12">
                <div class="builder-col sortable" id="sortable_top">
                    <div class="mb-4 text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addPostDocsSection" class="btn btn-primary btn-lg">{{ __('Add content section') }}</a>
                    </div>

                    
                </div>
            </div>
        </div>        

    </div>
    <!-- end card-body -->

</div>

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website template') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Custom code') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    @include('pivlu::admin.theme.includes.menu-themes')

    <div class="card-header">
        <h4 class="card-title">{{ __('Custom code') }}</h4>
    </div>

    <div class="card-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif

        <div class="alert alert-light" role="alert">
            <b><i class="bi bi-info-circle"></i> {{ __('This codes will be inserted in frontend template and are available for all templates') }}.</b><br>
            {{ __('Head code is inserted inside <head>...</head> section in your template code.') }}.<br>
            {{ __('Footer code is inserted at the end section in your template code.') }}.<br>
            {{ __('You can add global css / javascript code or link to external css / js files.') }}.
        </div>

        <form method="post">
            @csrf

            <div class="form-row">

                <div class="form-group col-12">
                    <label>{{ __('Code added in template head') }}</label>
                    <textarea class="form-control" name="template_global_head_code" rows="10">{{ $config->template_global_head_code ?? null }}</textarea>
                </div>

                <div class="form-group col-12">
                    <label>{{ __('Code added in template footer') }}</label>
                    <textarea class="form-control" name="template_global_footer_code" rows="10">{{ $config->template_global_footer_code ?? null }}</textarea>
                </div>

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>
        </form>

    </div>
    <!-- end card-body -->

</div>

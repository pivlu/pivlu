<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.config', ['tab' => 'website']) }}">{{ __('Configuration') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Website settings') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    <div class="card-header">

        @include('admin.config.includes.menu-config-website')

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
    
        <form method="post">
            @csrf

            <div class="fs-5 fw-bold mb-2">{{ __('Enable / disable public website') }}:</div>

            <div class="fw-bold mb-2 mt-1">
                {{ __('Public website status') }}:
                @if ($config->website_disabled ?? null)
                    <span class="text-white badge bg-danger">
                        {{ __('disabled.') }}
                    </span>
                @else
                    <span class="text-white badge bg-success">
                        {{ __('enabled.') }}
                    </span>
                @endif
            </div>

            <div class="form-group mb-0">
                <div class="form-check form-switch">
                    <input type="hidden" value="" name="website_disabled">
                    <input class="form-check-input" type="checkbox" id="website_disabled" name="website_disabled" @if ($config->website_disabled ?? null) checked @endif>
                    <label class="form-check-label text-danger" for="website_disabled">{{ __('Disable public website') }}</label>
                </div>
            </div>

            <div class="text-muted mb-4">                
                {{ __('Disable public website and redirect to login page.') }}
                <b>{{ __('Use this settings if you only need to use internal apps (internal collaboration, tasks, projects, workspaces...).') }}</b>
            </div>

            <div class="form-group mt-1 mb-0">
                <div class="form-check form-switch">
                    <input type="hidden" value="" name="website_maintenance_enabled">
                    <input class="form-check-input" type="checkbox" id="website_maintenance" name="website_maintenance_enabled" @if ($config->website_maintenance_enabled ?? null) checked @endif>
                    <label class="form-check-label" for="website_maintenance">{{ __('Enable maintenance mode') }}</label>
                </div>
            </div>

            <div class="text-muted small mb-3">                
                {{ __('If enabled, public website can not be accessible by visitors and registered users can not use their accounts. Administrators and internal users can use their accounts.') }}
            </div>

            <script>
                $('#website_maintenance').change(function() {
                    select = $(this).prop('checked');
                    if (select)
                        document.getElementById('hidden_div').style.display = 'block';
                    else
                        document.getElementById('hidden_div').style.display = 'none';
                })
            </script>

            <div id="hidden_div" @if ($config->website_maintenance_enabled ?? null) style="display: visible" @else style="display: none" @endif>
                <div class="form-group col-12">
                    <label>{{ __('Add a custom text for maintenance page') }} </label>
                    <textarea name="website_maintenance_text" class="form-control" rows="5">{!! $config->website_maintenance_text ?? null !!}</textarea>
                    <div class="text-muted small">{{ __('Tip: you can use HTML code.') }}</div>
                </div>
            </div>
                        

            <div class="form-group">
                <label>{{ __('Website author') }}</label>
                <input type="text" class="form-control" name="site_author" value="{{ $config->site_author ?? null }}">
                <small class="text-muted small">{{ __('Used in "meta author" tag') }}</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>
        </form>
        
    </div>
    <!-- end card-body -->

</div>

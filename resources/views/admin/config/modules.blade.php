<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.modules') }}">{{ __('Plugins / Modules') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif

        <div class="col-12">

            <div class="fs-5 fw-bold mt-1 mb-2">{{ __('Enable / disable modules') }}</div>

            <b>{{ __('Active') }}</b>: {{ __('Module is enabled.') }}
            <br>
            <b>{{ __('Inactive') }}</b>: {{ __('Module is not active, but administrators and internal users (with module permission) can manage or add content to this module.') }}
            <br>
            <b>{{ __('Disabled') }}</b>: {{ __('Module is disabled and it can not be used.') }}

        </div>

    </div>

</div>


<form method="post">
    @csrf

    <div class="row">

        <div class="col-md-6 col-lg-4 col-xl-3">

            @foreach ($modules as $module)
                <div class="card">

                    <div class="card-body">

                        <div class="text-center">
                            <div style="font-size: 4em">{!! $module->icon !!}</div>
                            <div class="fs-4">{{ $module->name }}</div>
                            <hr>
                        </div>

                        <div class="mb-3">{{ $module->description }}</div>
                        <div class="form-group">
                            <label>{{ __('Module status') }}</label>
                            <select name="module_{{ $module->id }}" class="form-select @if (($module->status ?? null) == 'active') is-valid @else is-invalid @endif" onchange="this.form.submit()">
                                <option @if (($module->status ?? null) == 'disabled') selected @endif value="disabled">{{ __('Disabled') }}</option>
                                <option @if (($module->status ?? null) == 'active') selected @endif value="active">{{ __('Active') }}</option>
                                <option @if (($module->status ?? null) == 'inactive') selected @endif value="inactive">{{ __('Inactive') }}</option>
                            </select>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</form>

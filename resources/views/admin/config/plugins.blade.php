<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.plugins') }}">{{ __('Plugins') }}</a></li>
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

            <div class="fs-5 fw-bold mt-1 mb-2">{{ __('Enable / disable plugins') }}</div>

            <b>{{ __('Active') }}</b>: {{ __('Plugin is enabled.') }}
            <br>
            <b>{{ __('Inactive') }}</b>: {{ __('Plugin is not active, but administrators and internal users (with plugin permission) can manage or add content to this module.') }}
            <br>
            <b>{{ __('Disabled') }}</b>: {{ __('Plugin is disabled and it can not be used.') }}

        </div>

    </div>

</div>


<form method="post">
    @csrf

    <div class="row">

        <div class="col-md-6 col-lg-4 col-xl-3">

            @foreach ($plugins as $plugin)
                <div class="card">

                    <div class="card-body">

                        <div class="text-center">
                            <div style="font-size: 4em">{!! $plugin->icon !!}</div>
                            <div class="fs-4">{{ $plugin->name }}</div>
                            <hr>
                        </div>

                        <div class="mb-3">{{ $plugin->description }}</div>
                        <div class="form-group">
                            <label>{{ __('Plugin status') }}</label>
                            <select name="plugin_{{ $plugin->id }}" class="form-select @if (($plugin->status ?? null) == 'active') is-valid @else is-invalid @endif" onchange="this.form.submit()">
                                <option @if (($plugin->status ?? null) == 'disabled') selected @endif value="disabled">{{ __('Disabled') }}</option>
                                <option @if (($plugin->status ?? null) == 'active') selected @endif value="active">{{ __('Active') }}</option>
                                <option @if (($plugin->status ?? null) == 'inactive') selected @endif value="inactive">{{ __('Inactive') }}</option>
                            </select>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</form>

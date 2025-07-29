<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.plugins') }}">{{ __('Plugins') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

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
                @if ($message == 'created')
                    {{ __('Created') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
                @if ($message == 'deleted')
                    {{ __('Deleted') }}
                @endif
            </div>
        @endif

        <div class="fw-bold fs-5 mb-2">{{ __('Installed plugins') }}</div>

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">
                <tbody>
                    @foreach ($installed_plugins as $plugin)
                        <tr @if ($plugin->active == 0) class="table-light" @endif>

                            <td>

                                @if ($plugin->active == 0)
                                    <div class="float-end ms-1 badge bg-warning fw-normal">{{ __('Inactive') }}</div>
                                @endif

                                @if ($plugin->active == 1)
                                    <div class="float-end ms-1 badge bg-success fw-normal">{{ __('Active') }}</div>
                                @endif

                                <div class='fw-bold fs-5 mb-1'>
                                    {{ $plugin->name }}
                                </div>

                                <b>{{ __('Version') }}</b>: {{ $plugin->version }}

                            </td>

                            <td>
                                <div class="d-grid gap-2">



                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


        <div class="fw-bold fs-5 mt-4 mb-2">{{ __('Local plugins') }}</div>

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">
                <tbody>
                    @foreach ($local_plugins as $local_key => $local_plugin)
                        <tr @if ($plugin->active == 0) class="table-light" @endif>

                            <td>
                                <div class='fw-bold fs-5 mb-1'>
                                    {{ $local_plugin['name'] }}
                                </div>

                                <b>{{ __('Version') }}</b>: {{ $local_plugin['version'] }}

                            </td>

                            <td width=180>
                                <div class="d-grid gap-2">

                                    <a class="btn btn-primary float-end" href="{{ route('admin.plugins.install', ['type' => 'local', 'plugin' => $local_key, 'path' => $local_plugin['local_path']]) }}">{{ __('Install plugin') }}</a>

                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


        <div class="fw-bold fs-5 mb-2 mt-4">{{ __('Featured plugins') }}</div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4">
            @foreach ($featured_plugins as $key => $featured_plugin)
                <div class="col">
                    <div class="card h-100 bg-light rounded border">
                        <div class="card-body">
                            <h4 class="card-title fw-bold">{{ $featured_plugin['name'] }}</h4>
                            @if ($featured_plugin['description'])
                                <p class="card-text">{{ $featured_plugin['description'] }}</p>
                            @endif
                        </div>

                        <div class="card-footer bg-light">
                            <a class="btn btn-secondary" href="{{ $featured_plugin['url'] }}" target="_blank">Plugin details</a>

                            <a class="btn btn-primary float-end" href="{{ route('admin.plugins.install', ['plugin' => $key]) }}">Install plugin</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!-- end card-body -->

</div>

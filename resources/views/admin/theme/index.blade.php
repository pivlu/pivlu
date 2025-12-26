<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('Website template') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('pivlu::admin.theme.includes.menu-themes')

    <div class="card-header">

        <div class="float-end">
            <a href="#" data-bs-toggle="modal" data-bs-target="#create-theme" class="btn btn-primary"><i class="bi bi-plus-circle"></i> {{ __('Create new template') }}</a>
            @include('pivlu::admin.theme.includes.modal-create-theme')
        </div>

        <div class="card-title">
            {{ __('Templates') }}
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

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                @if ($message == 'duplicate')
                    {{ __('Error. This theme exists') }}
                @endif
            </div>
        @endif


        <div class="table-responsive-md mt-2">
            <table class="table table-bordered table-hover">

                <tbody>
                    @foreach ($themes as $theme)
                        <tr @if ($theme->is_active == 1) class="table-light" @endif>
                            <td>
                                <div class="float-end">
                                    @if ($theme->is_active == 0)
                                        <a href="{{ route('admin.themes.set-active', ['id' => $theme->id]) }}" class="btn btn-primary btn-lg ms-2"><i class="bi bi-check-square"></i>
                                            {{ __('Set as active') }}</a>
                                    @endif

                                    <a class="btn btn-secondary btn-lg ms-2" target="_blank" href="{{ route('home', ['preview_theme' => $theme->code]) }}"><i class="bi bi-box-arrow-up-right"></i>
                                        {{ __('Preview') }}</a>

                                    <a href="{{ route('admin.themes.show', ['id' => $theme->id]) }}" class="btn btn-success btn-lg ms-2"><i class="bi bi-pencil-square"></i>
                                        {{ __('Edit template') }}</a>
                                </div>

                                <div class="fw-bold fs-5">
                                    {{ $theme->label }}
                                    @if ($theme->is_active == 1)
                                    <span class="badge bg-success fs-6 fw-normal">{{ __('Active template') }}</span>
                                    @endif
                                </div>

                                <div class="small text-muted mt-1">
                                    {{ __('Created at') }} {{ $theme->created_at }}
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{ $themes->links() }}


    </div>
    <!-- end card-body -->

</div>

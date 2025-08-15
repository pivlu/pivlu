<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Appearance') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('Theme builder') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('admin.theme.includes.menu-themes')

    <div class="card-header">

        <div class="float-end">
            <a href="#" data-bs-toggle="modal" data-bs-target="#create-theme" class="btn btn-primary"><i class="bi bi-plus-circle"></i> {{ __('Create new theme') }}</a>
            @include('admin.theme.includes.modal-create-theme')
        </div>

        <div class="card-title">
            {{ __('Themes') }}
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
                        <tr @if ($theme->is_default == 1) class="table-light" @endif>
                            <td>
                                <div class="float-end">
                                    @if ($theme->is_default == 0)
                                        <a href="{{ route('admin.themes.set-default', ['slug' => $theme->slug]) }}" class="btn btn-primary btn-lg ms-2"><i class="bi bi-check-square"></i>
                                            {{ __('Set default') }}</a>
                                    @endif

                                    <a class="btn btn-secondary btn-lg ms-2" target="_blank" href="{{ route('home', ['preview_theme' => $theme->slug]) }}"><i class="bi bi-box-arrow-up-right"></i>
                                        {{ __('Preview') }}</a>

                                    <a href="{{ route('admin.themes.show', ['slug' => $theme->slug]) }}" class="btn btn-success btn-lg ms-2"><i class="bi bi-pencil-square"></i>
                                        {{ __('Edit theme') }}</a>
                                </div>

                                <div class="fw-bold fs-5">
                                    {{ $theme->label }}
                                    @if ($theme->is_default == 1)
                                    <span class="badge bg-success fs-6 fw-normal">{{ __('Active theme') }}</span>
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

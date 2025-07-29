<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.templates.index') }}">{{ __('Website templates') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-header">

        <div class="mb-3">
            @include('admin.template.includes.menu-template')
        </div>


        <h4 class="card-title">{{ __('Website templates') }}</h4>


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
                    {{ __('Error. This button exists') }}
                @endif
            </div>
        @endif

        <div class="table-responsive-md">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="40">{{ __('ID') }}</th>
                        <th>{{ __('Label') }}</th>
                        <th width="180">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>

                        <td>
                            @if ($active_theme == 'builder')
                                <div class="badge bg-light text-success fs-6 float-end ms-2"></i> {{ __('Active thene') }}</div>
                            @endif

                            <div class="fs-6 fw-bold">
                                {{ __('Pivlu Template Builder') }}
                            </div>

                            <div class="small text-muted mt-2">
                                {{ __('Pivlu Template Builder is a tool that allows users to visually design and customize website layouts without needing to write code.') }}
                            </div>
                        </td>

                        <td>
                            <div class="d-grid gap-2">
                                <a class="btn btn-gear btn-sm mb-2" href="{{ route('admin.template-builder.index') }}">{{ __('Edit template') }}</a>
                            </div>

                        </td>
                    </tr>


                    @foreach ($themes as $theme)
                        <tr>                            
                            <td>
                                @if (($theme->active ?? null) == 1)
                                    <div class="badge bg-light text-success fs-6 float-end ms-2"></i> {{ __('Active template') }}</div>
                                @endif

                                <div class="fs-6 fw-bold">
                                    {{ $theme['name'] }}
                                </div>

                                @if ($theme['description'])
                                    <div class="small text-muted mt-2">
                                        {{ $theme['description'] }}
                                    </div>
                                @endif

                                @if ($theme['version'])
                                    <div class="small text-muted mt-2">
                                        {{ __('Version') }}{{ $theme['version'] }}
                                    </div>
                                @endif

                            </td>

                            <td>
                                <div class="d-grid gap-2">

                                    <a class="btn btn-gear btn-sm mb-2" href="{{ route('admin.templates.show', ['slug' => $theme['theme']]) }}">{{ __('Edit template') }}</a>
                                    {{--
                                    @if ($template->active == 0)
                                        <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $template->id }}" class="btn btn-danger btn-sm">{{ __('Delete template') }}</a>
                                        <div class="modal fade confirm-{{ $button->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('Are you sure you want to delete this template?') }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('admin.templates.show', ['id' => $template->id]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    --}}
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <!-- end card-body -->

</div>

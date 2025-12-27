<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.forms') }}">{{ __('Forms') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Manage forms') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<section class="section">

    <div class="card">

        <div class="card-header">

            <div class="row">
                <div class="col-12 col-sm-5 col-md-6 order-md-1 order-first">
                    <h4 class="card-title">{{ __('All forms') }}</h4>
                </div>

                <div class="col-12 col-sm-7 col-md-6 order-md-2 order-last">
                    <div class="float-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-form"><i class="bi bi-plus-circle"></i> {{ __('Create new form') }}</button>
                        @include('pivlu::admin.forms.includes.modal-create-form')
                    </div>
                </div>

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
                        {{ __('Error. This form exists') }}
                    @endif
                    @if ($message == 'exists_data')
                        {{ __("Error. This form can't be deleted because there are items submited for this form") }}
                    @endif
                </div>
            @endif

            <div class="table-responsive-md">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Form') }}</th>
                            <th width="160">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($forms as $form)
                            <tr @if ($form->active == 0) class="bg-light" @endif>
                                <td>
                                    @if ($form->active == 0)
                                        <span class="badge bg-warning float-end ms-1">{{ __('Inactive') }}</span>
                                    @endif

                                    <div class="fw-bold mb-2 fs-5">{{ $form->label }}</div>


                                    <div class="text-muted small">{{ __('Created at') }}: {{ date_locale($form->created_at, 'datetime') }}</div>

                                </td>

                                <td>
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.forms.config.show', ['id' => $form->id]) }}">{{ __('Manage form') }}</a>


                                        <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $form->id }}" class="btn btn-danger btn-sm">{{ __('Delete form') }}</a>
                                        <div class="modal fade confirm-{{ $form->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('Are you sure you want to delete this form?') }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('admin.forms.config.show', ['id' => $form->id]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            {{ $forms->links() }}

        </div>
        <!-- end card-body -->

    </div>

</section>

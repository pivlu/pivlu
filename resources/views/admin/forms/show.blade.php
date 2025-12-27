@include('pivlu::admin.includes.ckeditor-assets')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.forms') }}">{{ __('Forms') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.forms.config') }}">{{ __('Manage forms') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $form->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card">

    <div class="card-body">

        <h4 class="card-title">{{ $form->label }}</h4>

        <form id="updateForm" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group col-lg-4 col-md-6">
                <label class="form-label" for="label">{{ __('Label') }} ({{ __('optional') }})</label>
                <input class="form-control" type="text" id="label" name="label" value="{{ $form->label }}">
                <div class="form-text">{{ __('Input a label to identify this block. Label is not visible in website') }}</div>
            </div>

            <div class="form-group">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="active" name="active" @if ($form->active ?? null) checked @endif>
                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
                </div>
                <div class="form-text">{{ __('Only active forms are displayed on website') }}</div>
            </div>

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>
        </form>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-5 col-md-6 order-md-1 order-first">
                <h4 class="card-title">{{ __('Manage form fields') }} - {{ $form->label }}</h4>
            </div>

            <div class="col-12 col-sm-7 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-form-field"><i class="bi bi-plus-circle"></i> {{ __('Create new field') }}</button>
                    @include('pivlu::admin.forms.includes.modal-create-form-field')
                </div>
            </div>
        </div>

    </div>


    <div class="card-body">

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover sortable">
                <thead>
                    <tr>
                        <th width="40"><i class="bi bi-arrow-down-up"></i></th>
                        <th>{{ __('Field details') }}</th>
                        <th width="220">{{ __('Field type') }}</th>
                        <th width="150">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody id="sortable">
                    @foreach ($fields as $field)
                        <tr @if ($field->active == 0) class="table-light" @endif id="item-{{ $field->id }}">

                            <td class="movable">
                                <i class="bi bi-arrow-down-up"></i>
                            </td>

                            <td>

                                @if ($field->active == 0)
                                    <div class="float-end ms-1 badge bg-warning fw-normal">{{ __('Inactive') }}</div>
                                @endif

                                @if ($field->required == 1)
                                    <div class="float-end ms-1 badge bg-secondary fw-normal">{{ __('Required') }}</div>
                                @endif

                                @if ($field->is_default_name)
                                    <div class="badge bg-info">{{ __('Name field') }}</div>
                                @endif
                                @if ($field->is_default_email)
                                    <div class="badge bg-info">{{ __('Email field') }}</div>
                                @endif
                                @if ($field->is_default_subject)
                                    <div class="badge bg-info">{{ __('Subject field') }}</div>
                                @endif
                                @if ($field->is_default_message)
                                    <div class="badge bg-info">{{ __('Message field') }}</div>
                                @endif

                                <div class="mb-1"></div>


                                {{--
                                    @foreach (admin_languages() as $lang)

                                        @if (count(admin_languages()) > 1)
                                        {!! flag($lang->code) !!} 
                                        @endif

                                        @if (!(form_field_lang($field->id, $lang->id)->label ?? null)) <span class="text-danger">{{ __('Label not set') }}</span>
                                        @else {{ __('Label') }}: <b>{{ form_field_lang($field->id, $lang->id)->label }}</b> @endif
                                        @if (count(admin_languages()) > 1) ({{ $lang->name }}) @endif

                                        @if ($field->type == 'select' || $field->type == 'checkbox')
                                            <div class="mb-1"></div>
                                            @if (!(form_field_lang($field->id, $lang->id)->dropdowns ?? null)) <span
                                                    class="text-danger">{{ __('Values not set') }}</span>
                                            @else
                                                {{ __('Values') }}: <b>{!! form_field_lang($field->id, $lang->id)->dropdowns !!}</b> @endif
                                            @if (count(admin_languages()) > 1) ({{ $lang->name }}) @endif
                                        @endif

                                        @if (form_field_lang($field->id, $lang->id)->info ?? null) <br>{{ __('Info') }}: <b>{{ form_field_lang($field->id, $lang->id)->info }}</b> @endif
                                       
                                        <div class="mb-2"></div>
                                    @endforeach
                                    --}}
                            </td>

                            <td>
                                @switch($field->type)
                                    @case('text')
                                        {{ __('Text (one row)') }}
                                    @break

                                    @case('textarea')
                                        {{ __('Textarea (multiple rows)') }}
                                    @break

                                    @case('select')
                                        {{ __('Select from dropdown values (one selection)') }}
                                    @break

                                    @case('checkbox')
                                        {{ __('Select multiple values') }}
                                    @break

                                    @case('file')
                                        {{ __('Upload file') }}
                                    @break

                                    @case('email')
                                        {{ __('Email') }}
                                    @break

                                    @case('number')
                                        {{ __('Number (integer)') }}
                                    @break

                                    @case('month')
                                        {{ __('Month') }}
                                    @break

                                    @case('date')
                                        {{ __('Date (day / month / year)') }}
                                    @break

                                    @case('time')
                                        {{ __('Time (hour / minute)') }}
                                    @break

                                    @case('datetime')
                                        {{ __('Date and time') }}
                                    @break

                                    @case('color')
                                        {{ __('Color') }}
                                    @break

                                    @default
                                        {{ $field->type }}
                                @endswitch
                            </td>

                            <td>
                                <div class="d-grid gap-2">

                                    <button data-bs-toggle="modal" data-bs-target="#update-form-field-{{ $field->id }}" class="btn btn-primary btn-sm mb-2">{{ __('Update field') }}</button>
                                    @include('pivlu::admin.forms.includes.modal-update-form-field')

                                    @if ($field->protected != 1)
                                        <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $field->id }}" class="btn btn-danger  btn-sm">{{ __('Delete field') }}</a>
                                        <div class="modal fade confirm-{{ $field->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('Are you sure you want to delete this field?') }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('admin.forms.config.delete_field', ['id' => $form->id, 'field_id' => $field->id]) }}">
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

                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

</div>



<div class="card">

    <div class="card-body">

        <h4 class="card-title">{{ __('Settings') }}</h4>

        <form id="updateForm" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3 col-lg-4 col-md-6">
                <label class="form-label" for="confirmation">{{ __('Fields size') }}</label>
                <select class="form-select" name="fields_size">
                    <option value="normal">{{ __('Normal') }}</option>
                    <option value="lg">{{ __('Large') }}</option>
                    <option value="sm">{{ __('Small') }}</option>
                </select>
            </div>

            <div class="form-group mb-3 col-lg-4 col-md-6">
                <label class="form-label" for="confirmation">{{ __('Confirmation type') }}</label>
                <select class="form-select" name="confirmation_type">
                    <option value="reload">{{ __('Reload page and display an confirmation message') }}</option>
                    <option value="url">{{ __('Redirects to a custom URL') }}</option>
                    <option value="modal">{{ __('Display confirmation message in modal (popup)') }}</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="confirmation">{{ __('Confirmation title') }}</label>
                <input class="form-control" name="confirmation_title" value="{{ $confirmation_title ?? null }}">
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="confirmation">{{ __('Confirmation message') }}</label>
                <textarea name="confirmation_message" id="ckeditor">
			        {!! $confirmation_message ?? null !!}
		        </textarea>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="confirmation">{{ __('Confirmation CSS class') }}</label>
                <input class="form-control" name="confirmation_css_class" value="{{ $confirmation_css_class ?? null }}">
            </div>


            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

            <input type="hidden" name="label" value="{{ $form->label ?? null }}">
        </form>

    </div>

</div>



<div class="card">

    <div class="card-body">

        <h4 class="card-title">{{ __('Antispam') }}</h4>

        <form id="updateForm" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3 mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="googleRecaptcha" name="google_recaptcha" @if (($google_recaptcha ?? null) == 1) checked @endif>
                    <label class="form-check-label" for="googleRecaptcha">{{ __('Enable Google Recaptcha antispam') }}</label>
                </div>
            </div>

            <div class="form-group mb-3 col-xl-3 col-lg-4 col-md-6">
                <label class="form-label">{{ __('Honeypot field name') }}</label>
                <input class="form-control" name="honeypot_name" value="{{ $honeypot_name ?? null }}">
            </div>

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

            <input type="hidden" name="label" value="{{ $form->label ?? null }}">
        </form>

    </div>

</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#sortable").sortable({
            revert: true,
            axis: 'y',
            opacity: 0.5,
            revert: true,
            handle: ".movable",

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '{{ route('admin.forms.config.sortable', ['id' => $form->id]) }}',
                });
            }
        });

        $("ul, li, .actions").disableSelection();
    });
</script>

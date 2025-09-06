@include('admin.includes.trumbowyg-assets')
@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.block-components') }}">{{ __('Block components') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.block-components.type', ['type' => $type]) }}">{{ ucfirst($type) }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $block->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    @include('admin.blocks.includes.menu-blocks')


    <div class="card-body">

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


        <form id="updateBlock" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group col-lg-4 col-md-6">
                <label class="form-label" for="blockLabel">{{ __('Label') }} ({{ __('optional') }})</label>
                <input class="form-control" type="text" id="blockLabel" name="label" value="{{ $block->label }}">
                <div class="form-text">{{ __('Input a label to identify this block. Label is not visible in website') }}</div>
            </div>

            <div class="form-group">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="active" name="active" @if ($block->active ?? null) checked @endif>
                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
                </div>
                <div class="form-text">{{ __('Only active blocks are displayed on website') }}</div>
            </div>           

            <div class="form-group">
                <input type="hidden" name="type" value="{{ $type }}">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

        </form>
    </div>

    <hr class="my-0">

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-5 col-md-6 order-md-1 order-first">
                <h4 class="card-title">{{ __('Manage form fields') }} - {{ $block->label }}</h4>
            </div>

            <div class="col-12 col-sm-7 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-form-field"><i class="bi bi-plus-circle"></i> {{ __('Create new field') }}</button>
                    @include('admin.blocks.components.form.includes.modal-create-form-field')
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
                        <th width="160">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody id="sortable">
                    @foreach ($form_fields as $field)
                        <tr @if ($field->active == 0) class="bg-light" @endif id="item-{{ $field->id }}">

                            <td class="movable">
                                <i class="bi bi-arrow-down-up"></i>
                            </td>

                            <td>

                                @if ($field->active == 0)
                                    <span class="float-end"><button class="btn btn-warning btn-sm">{{ __('Inactive') }}</button></span>
                                @endif

                                <h6>{{ __('Field type') }}: <b>
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
                                    </b>

                                    @if ($field->is_default_name)
                                        <span class="badge bg-info">{{ __('Name field') }}</span>
                                    @endif
                                    @if ($field->is_default_email)
                                        <span class="badge bg-info">{{ __('Email field') }}</span>
                                    @endif
                                    @if ($field->is_default_subject)
                                        <span class="badge bg-info">{{ __('Subject field') }}</span>
                                    @endif
                                    @if ($field->is_default_message)
                                        <span class="badge bg-info">{{ __('Message field') }}</span>
                                    @endif
                                </h6>

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

                                @if ($field->required)
                                    <div class="text-info fw-bold">{{ __('Required field') }}</div>
                                @endif
                            </td>

                            <td>
                                <div class="d-grid gap-2">

                                    <button data-bs-toggle="modal" data-bs-target="#update-form-field-{{ $field->id }}" class="btn btn-primary btn-sm mb-2">{{ __('Update field') }}</button>
                                    @include('admin.blocks.components.form.includes.modal-update-form-field')

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
                                                        <form method="POST" action="{{ route('admin.forms.config.delete_field', ['id' => $block->id, 'field_id' => $field->id]) }}">
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
                    url: '{{ route('admin.forms.config.sortable', ['id' => $block->id]) }}',
                });
            }
        });

        $("ul, li, .actions").disableSelection();
    });
</script>

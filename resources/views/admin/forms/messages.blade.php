<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.forms') }}">{{ __('Forms') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-6 order-md-1 order-first">
                <h4 class="card-title">{{ __('Forms messages') }} ({{ $count_messages_unread ?? 0 }} {{ __('unread') }}, {{ $messages->total() ?? 0 }} {{ __('total') }})</h4>
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.trash.module', ['module' => 'forms']) }}" class="btn btn-secondary me-2"><i class="bi bi-trash"></i> {{ __('Trash') }}</a>

                        <a href="{{ route('admin.forms.config') }}" class="btn btn-primary me-1"><i class="bi bi-gear"></i> {{ __('Manage forms') }}</a>
                    @endif
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
                @if ($message == 'replied')
                    {{ __('Reply sent') }}
                @endif
                @if ($message == 'deleted')
                    {{ __('Deleted') }}
                @endif
                @if ($message == 'moved_to_trash')
                    {{ __('Message moved to trash') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif

        <section>
            <form action="{{ route('admin.forms') }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">

                <div class="col-12">
                    <input type="text" name="search_terms" placeholder="{{ __('Search sender name or email') }}" class="form-control me-2 mb-2 @if ($search_terms) is-valid @endif"
                        value="<?= $search_terms ?>" />
                </div>

                <div class="col-12">
                    <select name="search_status" class="form-select me-2 mb-2 @if ($search_status) is-valid @endif">
                        <option value="">- {{ __('Any status') }} -</option>
                        <option @if ($search_status == 'unread') selected="selected" @endif value="unread">{{ __('Unread messages') }}</option>
                        <option @if ($search_status == 'read') selected="selected" @endif value="read">{{ __('Read messages') }}</option>
                    </select>
                </div>

                <div class="col-12">
                    <select class="form-select me-2 mb-2 @if ($search_replied) is-valid @endif" name="search_replied">
                        <option name="search_replied" selected="selected" value="">- {{ __('All messages') }} -</option>
                        <option @if ($search_replied == 'no') selected="selected" @endif value="no">{{ __('Without reply') }}</option>
                        <option @if ($search_replied == 'yes') selected="selected" @endif value="yes">{{ __('With reply') }}</option>
                    </select>
                </div>

                <div class="col-12">
                    <select class="form-select me-2 mb-2 @if ($search_important) is-valid @endif" name="search_important">
                        <option name="search_important" selected="selected" value="">- {{ __('All messages') }} -</option>
                        <option @if ($search_important == '1') selected="selected" @endif value="1">{{ __('Important messages') }}</option>
                    </select>
                </div>

                <div class="col-12">
                    <button class="btn btn-secondary me-2 mb-2" type="submit"><i class="bi bi-check2"></i> {{ __('Apply') }}</button>
                    <a class="btn btn-light  mb-2" href="{{ route('admin.forms') }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                </div>

            </form>
        </section>

        <div class="mb-2"></div>

        @if ($messages->total() == 0)
            {{ __('No message') }}
        @else
            <form method="POST" action="{{ route('admin.forms.multiple_action') }}">
                @csrf

                <div class="table-responsive-md">
                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th width="20">
                                    <input type="checkbox" name="select-all" id="select-all" />
                                </th>
                                <th>{{ __('Details') }}</th>
                                <th width="220">{{ __('Form') }}</th>
                                <th width="360">{{ __('Sender') }}</th>
                                <th width="50"> </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($messages as $message)
                                <tr>
                                    <td>
                                        <input name='messages_checkbox[]' type='checkbox' id='messages_checkbox_{{ $message->id }}[]' value='{{ $message->id }}'>
                                    </td>
                                    <td>
                                        @if ($message->responded_at ?? null)
                                            <span class="float-end ms-2 badge bg-success">{{ __('Replied') }}</span>
                                        @endif
                                        @if ($message->is_important == 1)
                                            <span class="float-end ms-2 badge bg-warning"><i class="bi bi-star-fill"></i> {{ __('Important') }}</span>
                                        @endif

                                        <div class="fs-6">
                                            @if (!$message->read_at)
                                                <span class="text-danger">[{{ __('Unread') }}]</span>: <a class="text-bold" href="{{ route('admin.forms.show', ['id' => $message->id]) }}"><b>{{ $message->subject }}
                                                        ({{ $message->name }})
                                                    </b></a>
                                            @else
                                                <a href="{{ route('admin.forms.show', ['id' => $message->id]) }}">{{ $message->name }} ({{ $message->email }})</a>
                                            @endif
                                        </div>

                                        <div class="text-muted small">
                                            {{ date_locale($message->created_at, 'datetime') }}
                                            <br>
                                            IP: {{ $message->ip }}
                                        </div>
                                    </td>

                                    <td>
                                        <b>{{ $message->form->label ?? null }}</b>
                                    </td>

                                    <td>
                                        @if ($message->name)
                                            <b>{{ $message->name }}</b>
                                        @else
                                            <span class="text-danger">{{ __('No name') }}</span>
                                        @endif
                                        <div class="mb-1"></div>
                                        @if ($message->email)
                                            {{ $message->email }}
                                        @else
                                            <span class="text-danger">{{ __('No email') }}</span>
                                        @endif

                                        @if ($message->geo_data->country_code ?? null)
                                            <div class="mt-2 text-muted small">
                                                <img class="me-1" style="width: 20px; height: 20px;" src="{{ asset('assets//img/flags/circle/' . strtolower($message->geo_data->country_code) . '.svg') }}"
                                                    alt="{{ $message->geo_data->country }}"> {{ $message->geo_data->city }},
                                                {{ $message->geo_data->region_name }},
                                                {{ $message->geo_data->country }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>

                                        @can('delete_forms_messages', Pivlu\Models\FormData::class)
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('admin.forms.to_trash', ['id' => $message->id]) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                            </div>
                                        @endcan

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>


                <div class="row row-cols-lg-auto g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <select name="action" class="form-select" required>
                                <option value="">- {{ __('With selected:') }} -</option>
                                <option value="read">{{ __('Mark as read') }}</option>
                                <option value="unread">{{ __('Mark as unread') }}</option>
                                @can('delete_forms_messages', Pivlu\Models\FormData::class)
                                    <option value="trash">{{ __('Move to trash') }}</option>
                                @endcan
                                <option value="important">{{ __('Mask as important') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="hidden" name="section" value="messages">
                        <button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
                    </div>
                </div>
            </form>

            {{ $messages->appends(['search_terms' => $search_terms, 'search_status' => $search_status, 'search_replied' => $search_replied, 'search_important' => $search_important])->links() }}

        @endif
    </div>
    <!-- end card-body -->

</div>

<script language="JavaScript">
    $('#select-all').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
</script>

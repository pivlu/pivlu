<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.forms') }}">{{ __('Forms messages') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Trash') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    <div class="card-header">

        <div class="row">

            <div class="col-12 col-sm-12 col-md-6 order-md-1 order-first">
                <h4 class="card-title">{{ __('Trash') }} ({{ $messages->total() ?? 0 }} {{ __('messages') }})</h4>
            </div>

            <div class="col-12 col-sm-12 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <a href="{{ route('admin.forms') }}" class="btn btn-primary me-2"><i class="bi bi-envelope"></i> {{ __('Forms messages') }}</a>

                    <a href="#" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#empty-trash"><i class="bi bi-trash"></i> {{ __('Empty trash') }}</a>
                    @include('admin.forms.modals.empty-trash')
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
                    {{ __('Message permanently deleted') }}
                @endif
                @if ($message == 'moved_to_trash')
                    {{ __('Message moved to trash') }}
                @endif
                @if ($message == 'empty_trash')
                    {{ __('Trash is empty') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif

        @if ($messages->total() == 0)
            {{ __('Trash is empty') }}
        @else
            <section>
                <form action="{{ route('admin.forms.trash') }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">

                    <div class="col-12">
                        <input type="text" name="search_terms" placeholder="{{ __('Search sender name or email') }}" class="form-control me-2 mb-2 @if ($search_terms) is-valid @endif"
                            value="<?= $search_terms ?>" />
                    </div>

                    <div class="col-12">
                        <select name="search_status" class="form-select me-2 mb-2 @if ($search_status) is-valid @endif">
                            <option value="">- {{ __('Any status') }} -</option>
                            <option @if ($search_status == 'unread') selected="selected" @endif value="unread">{{ __('Only unread messages') }}</option>
                            <option @if ($search_status == 'read') selected="selected" @endif value="read">{{ __('Only read messages') }}</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <select class="form-select me-2 mb-2 @if ($search_replied) is-valid @endif" name="search_replied">
                            <option name="search_replied" selected="selected" value="">- {{ __('All messages') }} -</option>
                            <option @if ($search_replied == 'no') selected="selected" @endif value="no">{{ __('Only messages without reply') }}</option>
                            <option @if ($search_replied == 'yes') selected="selected" @endif value="yes">{{ __('Only messages with reply') }}</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <select class="form-select me-2 mb-2 @if ($search_important) is-valid @endif" name="search_important">
                            <option name="search_important" selected="selected" value="">- {{ __('All messages') }} -</option>
                            <option @if ($search_important == '1') selected="selected" @endif value="1">{{ __('Only important messages') }}</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-secondary me-2 mb-2" type="submit"><i class="bi bi-check2"></i> {{ __('Apply') }}</button>
                        <a class="btn btn-light  mb-2" href="{{ route('admin.forms.trash') }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                    </div>

                </form>
            </section>

            <div class="mb-2"></div>


            <form method="POST" action="{{ route('admin.forms.multiple_action') }}">
                @csrf

                <div class="table-responsive-md">
                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th width="20"></th>
                                <th>{{ __('Details') }}</th>
                                <th width="220">{{ __('Form') }}</th>
                                <th width="320">{{ __('Sender') }}</th>
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

                                        @if ($message->task_id)
                                            @if ($message->task_closed_at)
                                                <a class="btn btn-success btn-sm mb-2" href="{{ route('admin.tasks.show', ['id' => $message->task_id]) }}">{{ __('Task closed') }}</a>
                                            @else<a class="btn btn-danger btn-sm mb-2" href="{{ route('admin.tasks.show', ['id' => $message->task_id]) }}">{{ __('Task not closed') }}</a>
                                            @endif
                                        @endif

                                        <div class="text-muted small">
                                            {{ date_locale($message->created_at, 'datetime') }}
                                            <br>
                                            IP: {{ $message->ip }}
                                            @if ($message->referer)
                                                <br>{{ __('Referer') }}: <a target="_blank" href="{{ $message->referer }}">{{ $message->referer }}</a>
                                            @endif
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
                                    </td>

                                    <td>

                                        <div class="d-grid gap-2">
                                            <a href="{{ route('admin.forms.delete', ['id' => $message->id]) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                        </div>

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
                                <option value="delete">{{ __('Permanently delete') }}</option>
                                <option value="restore">{{ __('Restore (remove from trash)') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="hidden" name="section" value="trash">
                        <button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
                    </div>
                </div>
            </form>

            {{ $messages->appends(['search_terms' => $search_terms, 'search_status' => $search_status, 'search_replied' => $search_replied, 'search_important' => $search_important])->links() }}

        @endif

    </div>
    <!-- end card-body -->

</div>

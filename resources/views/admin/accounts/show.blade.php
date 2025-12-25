<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">{{ __('Accounts') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Manage account') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    <div class="card-header">
        <h4 class="card-title">{{ $account->name }} ({{ $account->email }})</h4>
    </div>

    <div class="card-body">

        @include('pivlu::admin.accounts.includes.menu-account')
        <div class="mb-3"></div>

        @if ($account->deleted_at)
            <div class='alert alert-danger mt-3'>{{ __('This account is deleted') }}. <a href="{{ route('admin.trash.module', ['module' => 'accounts']) }} ">{{ __('View deleted accounts') }}</a></div>
        @endif
        @if ($account->blocked_at)
            <div class='alert alert-danger mt-3'>{{ __('This account is blocked') }}.</div>
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

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                @if ($message == 'duplicate')
                    {{ __('Error. This email exist') }}
                @endif
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-12">
                @if ($account->avatar_media_id)
                    <span class="float-start me-2"><img style="max-height:100px; width:auto;" src="{{ $account->getFirstMediaUrl('avatars') }}" /></span>
                @endif
                {{ __('ID') }}: {{ strtoupper($account->id) }} | {{ __('Code') }}: {{ $account->code }} <br>
                {{ __('Registered') }}: {{ date_locale($account->created_at, 'datetime') }} <br>
                {{ __('Last activity') }}: @if ($account->last_activity_at)
                    {{ date_locale($account->last_activity_at, 'datetime') }}
                @else
                    {{ __('never') }}
                @endif
            </div>
        </div>

        <form action="{{ route('admin.accounts.show', ['id' => $account->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label>{{ __('Full name') }}</label>
                        <input class="form-control" name="name" type="text" required value="{{ $account->name }}" />
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <input class="form-control" name="email" type="email" required value="{{ $account->email }}" />
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label>{{ __('Username') }}</label>
                        <input class="form-control" name="username" type="text" minlength="3" maxlength="50" required value="{{ $account->username }}" />
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label>{{ __('Change password') }} ({{ __('optional') }})</label>
                        <input class="form-control" name="password" type="password" />
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="formFile" class="form-label">{{ __('Avatar image') }} ({{ __('optional') }})</label>
                        <input class="form-control" type="file" id="formFile" name="avatar">
                    </div>
                </div>
            </div>

            <div class="row">
                @if (Auth::user()->hasRole('admin') && Auth::user()->id != $account->id)
                    <div class="col-lg-4 col-12">
                        <div class="form-group mb-3">
                            <label>{{ __('Role group') }}</label>
                            <select name="role_group" id="role_group" class="form-select" required>
                                <option value="">- {{ __('select') }} -</option>
                                <option @if ($account->role_group == 'internal') selected @endif value="internal">{{ __('Internal user') }}</option>
                                <option @if ($account->role_group == 'registered') selected @endif value="registered">{{ __('Registered user') }}</option>
                                <option @if ($account->role_group == 'admin') selected @endif value="admin">{{ __('Administrator') }}</option>
                            </select>
                        </div>
                    </div>

                    <script>
                        $('#role_group').change(function() {
                            selected_group = $(this).val();
                            if (selected_group == 'internal')
                                document.getElementById('div_roles').style.display = 'block';
                            else
                                document.getElementById('div_roles').style.display = 'none';
                        })
                    </script>

                    <div class="col-lg-4 col-12">
                        <div id="div_roles" @if ($account->role_group == 'internal') style="display: visible" @else style="display: none" @endif>
                            <div class="form-group mb-3">
                                <label>{{ __('Roles') }}</label>
                                <select name="roles[]" class="form-select selectpicker" multiple>
                                    <option value="">- {{ __('select') }} -</option>
                                    @foreach ($internal_roles as $internal_role_name => $internal_role_label)
                                        <option @if (in_array($internal_role_name, $account_roles)) selected @endif value="{{ $internal_role_name }}"> {{ $internal_role_label ?? $internal_role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="role_group" value="{{ $account->role_group }}">
                    <input type="hidden" name="roles" value="">
                @endif
            </div>

            @if ($account->id != Auth::user()->id)
                <div class="col-12">
                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="SwitchBlock" name="blocked_at" @if ($account->blocked_at) checked @endif>
                            <label class="form-check-label" for="SwitchBlock">{{ __('Block account') }}</label>
                        </div>
                        <div class="text-muted small">{{ __('Blocked users can not login into their accounts.') }}</div>
                    </div>

                    <script>
                        $('#SwitchBlock').change(function() {
                            select = $(this).prop('checked');
                            if (select)
                                document.getElementById('hidden_div').style.display = 'block';
                            else
                                document.getElementById('hidden_div').style.display = 'none';
                        })
                    </script>

                    <div id="hidden_div" @if ($account->blocked_at) style="display: visible" @else style="display: none" @endif>
                        <div class="form-group col-12">
                            <label>{{ __('Block reason') }} </label>
                            <textarea name="block_reason" class="form-control" rows="5">{!! $block_reason ?? null !!}</textarea>
                            <div class="text-muted small">{{ __('This text will be visible to user.') }}</div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="customSwitch2" name="email_verified_at" @if ($account->email_verified_at) checked @endif>
                            <label class="form-check-label" for="customSwitch2">{{ __('Email verified') }}</label>
                        </div>
                        <div class="text-muted small">{{ __('Users can not use their accounts until email is verified.') }}</div>
                    </div>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>

        </form>

    </div>
    <!-- end card-body -->

</div>

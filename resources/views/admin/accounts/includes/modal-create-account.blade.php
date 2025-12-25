<div class="modal fade custom-modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" id="create-account">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data" id="createAccountForm">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{ __('Create account') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('Role group') }}</label>
                            <select name="role_group" class="form-select" required onchange="showDiv(this)">
                                <option value="">- {{ __('select') }} -</option>
                                <option value="internal">{{ __('Internal account') }}</option>
                                <option value="registered">{{ __('Registered user') }}</option>
                                @if (Auth::user()->hasRole('admin'))
                                    <option value="admin">{{ __('Administrator') }}</option>
                                @endif
                            </select>
                        </div>

                        <script>
                            function showDiv(element) {
                                var option = element.value;
                                if (option == 'internal') {
                                    document.getElementById('div_internal').style.display = 'block';
                                }
                                if (option != 'internal') {
                                    document.getElementById('div_internal').style.display = 'none';
                                }
                            }
                        </script>
                    </div>

                    <div id="div_internal" style="display: none">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('Select role / roles') }}</label>
                                <select name="roles[]" class="form-select selectpicker" multiple>
                                    <option value="">- {{ __('select') }} -</option>
                                    @foreach ($internal_roles as $internal_role_name => $internal_role_label)
                                        <option value="{{ $internal_role_name }}"> {{ $internal_role_label ?? $internal_role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="small mb-2">
                            @foreach ($internal_roles_descriptions as $internal_role_description => $internal_role_label)
                                <b>{{ $internal_role_label }}</b> - {{ $internal_role_description }}
                                <br>
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Full name') }}</label>
                                <input class="form-control" name="name" type="text" required />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input class="form-control" name="email" type="email" required />
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input class="form-control password_class" name="password" type="text" required />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="formFile" class="form-label">{{ __('Avatar image') }} ({{ __('optional') }})</label>
                                <input class="form-control" type="file" id="formFile" name="avatar">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitch2" name="email_verified_at">
                                <label class="form-check-label" for="customSwitch2">{{ __('Email verified') }}</label>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

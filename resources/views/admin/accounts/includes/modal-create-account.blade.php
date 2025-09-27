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
                            <label class="form-label">{{ __('Account type (role)') }}</label>
                            <select name="role" class="form-select" required onchange="showDiv(this)">
                                <option value="">- {{ __('select') }} -</option>
                                @foreach ($roles as $role)
                                    @if (!($role->role == 'admin' && Auth::user()->role != 'admin'))
                                        <option value="{{ $role->role }}"> {{ $role->label ?? $role->role }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <script>
                            function showDiv(element) {
                                var option = element.value;
                                if (option == 'contact') {
                                    document.getElementById('account_data').style.display = 'none';
                                    document.getElementsByClassName("password_class")[0].removeAttribute("required");
                                }
                                if (option != 'contact') {
                                    document.getElementById('account_data').style.display = 'block';
                                }
                            }
                        </script>
                    </div>

                    <div class="small mb-2">
                        @foreach ($roles as $role)
                            @if (!($role->role == 'admin' && Auth::user()->role != 'admin'))
                                <b>{{ $role->label ?? $role->role }}</b> - {{ $role->description }}
                            @endif
                            <br>
                        @endforeach
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

                    <div id="account_data">

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

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

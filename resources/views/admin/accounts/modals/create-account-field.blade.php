<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true" id="create-account-field">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addLabel">{{ __('Create field') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>{{ __('Field name') }}</label>
                                    <input class="form-control" name="name" type="text" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('Field type') }}</label>
                                    <select name="type" class="form-select" required>
                                        <option value="text">{{ __('Text input (one line)') }}</option>
                                        <option value="textarea">{{ __('Textarea (multiple lines)') }}</option>
                                        <option value="date">{{ __('Date') }}</option>
                                        <option value="numeric">{{ __('Numeric') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="fieldRequired" name="required">
                                        <label class="form-check-label" for="fieldRequired">{{ __('Required field') }}</label>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create field') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

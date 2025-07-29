<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="addGroupLabel" aria-hidden="true" id="create-permissions-group">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupLabel">{{ __('Create permissions group') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{ __('Group name') }}</label>
                        <input class="form-control" name="label" type="text" required>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Description') }} ({{ __('optional') }})</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create permissions group') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

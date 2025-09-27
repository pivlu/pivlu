<div class="modal fade custom-modal" tabindex="-1" aria-labelledby="modalRoleLabel" aria-hidden="true" id="create-role">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data" id="createRoleForm">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalRoleLabel">{{ __('Create role') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('Role name') }}</label>
                        <input class="form-control" name="label" type="text" required maxlength="25" />
                        <div class="text-muted small">{{ __('Display name') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('Role identificator') }}</label>
                        <input class="form-control" name="role" type="text" required maxlength="25" />
                        <div class="text-muted small">{{ __('Lowercases. No spaces or special characters.') }}</div>
                        <div class="text-muted small">{{ __('Examples: "developer", "content_manager" ...') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('Description') }} ({{ __('optional') }})</label>
                        <textarea class="form-control" name="description" rows="2"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create role') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

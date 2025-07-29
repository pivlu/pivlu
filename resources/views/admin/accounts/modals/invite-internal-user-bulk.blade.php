<div class="modal fade custom-modal" tabindex="-1" aria-labelledby="inviteBulkEmailLabel" aria-hidden="true" id="invite-internal-user-bulk">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" id="inviteInternalUserBulk" action="{{ route('admin.accounts.send_invitation') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="inviteBulkEmailLabel">{{ __('Invite multiple internal users') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label class="form-label">{{ __('Enter email addresses of persons you want to invite. Separate multiple persons by comma or new line') }}</label>
                        <textarea class="form-control" name="persons" rows="10"></textarea>
                        <div class="text-muted small form-text">{{ __('Example: person1@yahoo.com, person2@gmail.com, .... (or each email on a new line)') }}</div>

                        <div class="text-muted form-text"><i class="bi bi-info-circle"></i> {{ __('Duplicate emails will be ignored. Existing emails will be ignored.') }}</div>
                        <div class="text-info form-text"><i class="bi bi-exclamation-circle"></i> {{ __('Maximum 100 valid emails are processed. If you have more persons to add, you must repeat the process.') }}</div>
                    </div>                    
                    
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="role" value="internal">
                    <input type="hidden" name="method" value="bulk">
                    <button type="submit" class="btn btn-primary">{{ __('Invite') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>

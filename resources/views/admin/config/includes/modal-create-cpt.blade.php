<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="ModalCptLabel" aria-hidden="true" id="create-cpt">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">{{ __('Create') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <input class="form-control" name="name" type="text" required />
                            </div>
                        </div>                        
                                                
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('URL slug') }}</label>
                                <input class="form-control" name="slug" type="text" />
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Icon code (admin)') }} ({{ __('optional') }})</label>
                                <input class="form-control" name="admin_menu_icon" type="text" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label singular') }}</label>
                                <input class="form-control" name="label_singular" type="text" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label plural') }}</label>
                                <input class="form-control" name="label_plural" type="text" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label create') }}</label>
                                <input class="form-control" name="label_create" type="text" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label update') }}</label>
                                <input class="form-control" name="label_update" type="text" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label delete') }}</label>
                                <input class="form-control" name="label_delete" type="text" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label all') }}</label>
                                <input class="form-control" name="label_all" type="text" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label search') }}</label>
                                <input class="form-control" name="label_search" type="text" />
                            </div>
                        </div>




                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>{{ __('Description') }} ({{ __('optional') }})</label>
                                <textarea class="form-control" name="description" rows="2"></textarea>
                            </div>
                        </div>
                    </div>                                                         

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchShowAdmin" name="show_in_admin_menu" checked>
                                <label class="form-check-label" for="customSwitchShowAdmin">{{ __('Show in admin menu') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchShowSite" name="internal_only">
                                <label class="form-check-label" for="customSwitchShowSite">{{ __('Internal only') }}</label>
                            </div>
                        </div>
                    </div>                    

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitch" name="active" checked>
                                <label class="form-check-label" for="customSwitch">{{ __('Active') }}</label>
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

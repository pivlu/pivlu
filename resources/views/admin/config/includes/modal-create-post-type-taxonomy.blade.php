<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="create-taxonomy" aria-hidden="true" id="create-taxonomy">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="create-taxonomy">{{ __('Create') }}</h5>
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
                                <label>{{ __('Position') }}</label>
                                <input class="form-control" name="position" type="number" min="0" step="1" />
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
                    </div>                  

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchHierarchical" name="hierarchical">
                                <label class="form-check-label" for="customSwitchHierarchical">{{ __('Hierarchical') }}</label>
                            </div>
                        </div>
                    </div>                   

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchFilter" name="admin_filter" checked>
                                <label class="form-check-label" for="customSwitchFilter">{{ __('Admin filter') }}</label>
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

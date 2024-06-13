<div aria-live="polite" aria-atomic="true" class="bg-body-secondary position-relative bd-example-toasts rounded-3">
    <div class="toast-container position-fixed top-0 end-0 p-3 m-3 mt-4">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Lifeline</strong>
                <small></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <div class="row">
                    <div class="col ll-toast-label type-inserted"></div>
                    <div class="col ll-toast-label value-inserted"></div>
                </div>
                <div class="row">
                    <div class="col ll-toast-label type-updated"></div>
                    <div class="col ll-toast-label value-updated"></div>
                </div>
                <div class="row">
                    <div class="col ll-toast-label type-deleted"></div>
                    <div class="col ll-toast-label value-deleted"></div>
                </div>
                <div class="row mt-3">
                    <strong class="col ll-toast-label value-logs"></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row p-3">
    <div class="col">
        <p class="h3 mt-3 mb-2 text-black-50">Manual synchronization</p>

        <div class="row">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    This process takes a bit of time to be executed completely and depends on the validity of the <a href="<?php echo admin_url('/admin.php?page=lifeline'); ?>">settings</a> of the plugin. 
                </div>

                <div class="row mb-3 mt-3">
                    <div class="col">
                        <button class="btn btn-success" id="manual_sync" type="button">Manual synchronization</button>

                        <div class="progress mt-3 ll-sync-progress-bar">
                            <div class="progress-bar progress-bar-striped progress-bar-animated ll-sync-progress bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="h3 mt-5 mb-2 text-black-50">Old data restore</p>
        <?php if ($old_data_exists) { ?>
        <div class="alert alert-warning" role="alert">
            This process should be executed only once if the full database data has been synchronized and it takes a bit of time until all previous data is processed.<br /><br />
            Upon restoring the old data from the <strong>wc.csv</strong> file it will be deleted since it will be no longer needed. <br />
        </div>

        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-success" id="old_data_restore" type="button">Restore old data</button>

                <div class="progress mt-3 ll-restore-progress-bar">
                <div class="progress-bar progress-bar-striped progress-bar-animated ll-restore-progress bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
            </div>
            </div>
        </div>
        <?php } ?>
        <?php if (count($restore_logs)) { ?>
            <div class="alert alert-success" role="alert">
            Old data restoration executed at 
            <?php 
                $timestamp = strtotime($restore_logs[0]->execution);
                echo date('l, dS F Y - H:i', $timestamp); 
            ?>
            </div>
        <?php } ?>
    </div>
</div>

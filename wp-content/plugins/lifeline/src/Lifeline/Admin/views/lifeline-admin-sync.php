<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
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

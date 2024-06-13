<div class="row p-3">
    <div class="col">
        <p class="h3 mt-3 mb-2 text-black-50">Synchronization logs <small>(last 10)</small></p>
        <table class="table table-hover table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Inserted</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Deleted</th>
                    <th scope="col">Message</th>
                    <th scope="col">Type</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php if (count($sync_logs)) { ?>
                <?php foreach ($sync_logs as $log) { ?>
                <tr>
                    <td scope="row">
                        <?php 
                            $timestamp = strtotime($log->execution);
                            echo date('l, dS F Y - H:i', $timestamp); 
                        ?>
                    </td>
                    <td scope="row"><?php echo $log->inserted; ?></td>
                    <td scope="row"><?php echo $log->updated; ?></td>
                    <td scope="row"><?php echo $log->deleted; ?></td>
                    <td scope="row" title="<?php echo $log->logs; ?>"><?php echo mb_substr($log->logs, 0, 90); ?>...</td>
                    <td scope="row"><?php echo $this->sync_types[$log->sync_type]; ?></td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td scope="row" colspan="5">No synchronizations has been executed yet.</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <p class="h3 mt-5 mb-2 text-black-50">Old data restoration logs <small>(last 10)</small></p>
        <table class="table table-hover table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Untouched</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Not found</th>
                    <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php if (count($restore_logs)) { ?>
                <?php foreach ($restore_logs as $log) { ?>
                <tr>
                    <td scope="row">
                        <?php 
                            $timestamp = strtotime($log->execution);
                            echo date('l, dS F Y - H:i', $timestamp); 
                        ?>
                    </td>
                    <td scope="row"><?php echo $log->inserted; ?></td>
                    <td scope="row"><?php echo $log->updated; ?></td>
                    <td scope="row"><?php echo $log->deleted; ?></td>
                    <td scope="row"><?php echo $log->logs; ?></td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td scope="row" colspan="5">Old data has not been restored yet.</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
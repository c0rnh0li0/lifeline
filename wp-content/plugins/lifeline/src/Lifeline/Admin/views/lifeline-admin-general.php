<div class="row p-3">
    <div class="col">
        <p class="h3 mt-3 mb-2 text-black-50">General settings</p>

        <form method="POST" class="p-3 border rounded-lg" action="#" id="settings_form">
            <input type="hidden" id="id" name="id" value="<?php echo isset($settings_result->id) ? $settings_result->id : 0; ?>">
            <input type="hidden" name="action" value="save_settings">
                    
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="mklek_db_host">MK Lek Host</label>
                    <input type="text" class="form-control" id="mklek_db_host" name="mklek_db_host" value="<?php echo isset($settings_result->mklek_db_host) ? $settings_result->mklek_db_host : ''; ?>" required>
                </div>

                <div class="col">
                    <label class="form-label" for="mklek_db_view">MK Lek DB View</label>
                    <input type="text" class="form-control" id="mklek_db_view" name="mklek_db_view" value="<?php echo isset($settings_result->mklek_db_view) ? $settings_result->mklek_db_view : ''; ?>" required>
                </div>        
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="mklek_db_user">MK Lek DB User</label>
                    <input type="text" class="form-control" id="mklek_db_user" name="mklek_db_user" value="<?php echo isset($settings_result->mklek_db_user) ? $settings_result->mklek_db_user : ''; ?>" required>
                </div>

                <div class="col">
                    <label class="form-label" for="mklek_db_pass">MK Lek DB Password</label>
                    <input type="password" class="form-control" id="mklek_db_pass" name="mklek_db_pass" value="<?php echo isset($settings_result->mklek_db_pass) ? $settings_result->mklek_db_pass : ''; ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="mklek_db_dbname">MK Lek DB Name</label>
                    <input type="text" class="form-control" id="mklek_db_dbname" name="mklek_db_dbname" value="<?php echo isset($settings_result->mklek_db_dbname) ? $settings_result->mklek_db_dbname : ''; ?>" required>
                </div>
                <div class="col">
                    <label class="form-label" for="mklek_db_port">MK Lek DB Port</label>
                    <input type="text" class="form-control" id="mklek_db_port" name="mklek_db_port" value="<?php echo isset($settings_result->mklek_db_port) ? $settings_result->mklek_db_port : ''; ?>" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col text-center">
                    <button type="submit" id="submit-key" class="integration-form-btn btn btn-success">Save settings</button>
                </div>
            </div>
        </form>
    </div>
</div>
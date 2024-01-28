<form method="POST" class="propel-admin-form p-3 border rounded-lg" action="#" id="propel_settings_form">
    <input type="hidden" id="id" name="id" value="<?php echo isset($settings_result->id) ? $settings_result->id : 0; ?>">
    <input type="hidden" name="action" value="save_settings">
            
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="text-secondary" for="mklek_db_host">MK Lek Host</label>
            <input type="text" class="border form-control" id="mklek_db_host" name="mklek_db_host" value="<?php echo isset($settings_result->mklek_db_host) ? $settings_result->mklek_db_host : ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label class="text-secondary" for="mklek_db_view">MK Lek DB View</label>
            <input type="text" class="border form-control" id="mklek_db_view" name="mklek_db_view" value="<?php echo isset($settings_result->mklek_db_view) ? $settings_result->mklek_db_view : ''; ?>" required>
        </div>        
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="text-secondary" for="mklek_db_user">MK Lek DB User</label>
            <input type="text" class="border form-control" id="mklek_db_user" name="mklek_db_user" value="<?php echo isset($settings_result->mklek_db_user) ? $settings_result->mklek_db_user : ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label class="text-secondary" for="mklek_db_pass">MK Lek DB Password</label>
            <input type="password" class="border form-control" id="mklek_db_pass" name="mklek_db_pass" value="<?php echo isset($settings_result->mklek_db_pass) ? $settings_result->mklek_db_pass : ''; ?>" required>
        </div>
    </div>
    
    <div class="row">
        <div class="col text-center">
            <button type="submit" id="submit-key" class="integration-form-btn btn btn-success">Save settings</button>
        </div>
    </div>
</form>
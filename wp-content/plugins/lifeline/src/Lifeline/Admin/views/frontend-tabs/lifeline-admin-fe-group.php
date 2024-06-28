<?php 
    // var_dump($group); 
    // var_dump(json_decode($group->products)); 
    // var_dump(json_encode($group->products)); 

    $group->products = wp_unslash($group->products);

    $starts_at = "";
    $ends_at = "";

    if (!empty($group->starts_at)) {
        $starts_at = strtotime($group->starts_at);
        $starts_at = date('d.m.Y', $starts_at);
    }

    if (!empty($group->ends_at)) {
        $ends_at = strtotime($group->ends_at);
        $ends_at = date('d.m.Y', $ends_at);
    }
?>
<div class="col-6">
    <div class="border p-3 ll-fe-group rounded group-<?php echo $group->id; ?>">
        <?php if ($group->id > 0) { ?>
            <div class="row mb-3">
                <div class="col text-secondary">
                    <small>
                        Shortcode: <strong>[product-group id="<?php echo $group->id; ?>"]</strong>
                    </small>
                </div>
            </div>        
        <?php } ?>

        <form name="save_group" class="groups-forms" action="#" data-id="<?php echo $group->id; ?>" method="POST">
            <input type="hidden" name="action" value="ll_save_group" />
            <input type="hidden" name="id" value="<?php echo $group->id; ?>" />

            <div class="form-group mb-1">
                <label for="group_name_<?php echo $group->id; ?>">Group name</label>
                <input type="text" class="form-control" id="group_name_<?php echo $group->id; ?>" name="group_name" value="<?php echo $group->group_name; ?>">
            </div>

            <div class="form-group">
                <label>Products</label>
                <textarea class="ll-group" id="group_<?php echo $group->id; ?>" data-id="<?php echo $group->id; ?>"><?php echo $group->products; ?></textarea>
            </div>

            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="promo_<?php echo $group->id; ?>" name="promo" value="1" <?php echo $group->promo == 1 ? "checked" : ""; ?>>
                <label class="form-check-label" for="promo_<?php echo $group->id; ?>">Promotion</label>
            </div>

            <div class="form-check mt-2 datepickers-container">
                <div class="row">
                    <div class="col">
                        <input type="text" name="starts_at" class="form-control datepicker start" placeholder="Starts at" value="<?php echo $starts_at; ?>">
                    </div>
                    -
                    <div class="col">
                        <input type="text" name="ends_at" class="form-control datepicker end" placeholder="Ends at" value="<?php echo $ends_at; ?>">
                    </div>
                </div>
            </div>

            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="is_bestseller_<?php echo $group->id; ?>" name="is_bestseller" value="1" <?php echo $group->is_bestseller == 1 ? "checked" : ""; ?>>
                <label class="form-check-label" for="is_bestseller_<?php echo $group->id; ?>">Bestsellers</label>
            </div>

            <div class="form-check mt-2 bestseller-container">
                <input type="checkbox" class="form-check-input" id="use_bestseller_cookie_<?php echo $group->id; ?>" name="use_bestseller_cookie" value="1" <?php echo $group->use_bestseller_cookie == 1 ? "checked" : ""; ?>>
                <label class="form-check-label" for="use_bestseller_cookie_<?php echo $group->id; ?>">Woo will display best selling producrs</label>
            </div>

            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="active_<?php echo $group->id; ?>" name="active" value="1" <?php echo $group->active == 1 ? "checked" : ""; ?>>
                <label class="form-check-label" for="active_<?php echo $group->id; ?>">Active</label>
            </div>

            <div class="row mt-3">
                <?php if ($group->id > 0) { ?>
                <div class="col text-start">
                    <button type="button" class="btn btn-danger btn-delete">Delete</button>
                </div>
                <?php } ?>

                <div class="col text-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                
            </div>        
        </form>
    </div>
</div>

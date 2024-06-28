<div class="container border border-top-0 p-3">
    <div class="text-end m-3">
        <button name="new_group" class="btn btn-success new-group-btn"><strong>+</strong></button>
    </div>

    <div class="row groups-container">
        <?php 
            if ($groups && is_array($groups) && count($groups)) {
                foreach ($groups as $group) {
                    require 'lifeline-admin-fe-group.php';
                }
            }
        ?>
    </div>
</div>
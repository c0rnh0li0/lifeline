<?php 
    $expired = false; 

    $now = strtotime(date_create('now', timezone_open('Europe/Belgrade'))->format('Y-m-d H:i:s'));

    if ($now > strtotime($group->ends_at))
        $expired = true;

    $display_title = isset($args['display_title']) && $args['display_title'] == '1';

    $columns = isset($args['columns']) && is_numeric($args['columns']) ? (int) $args['columns'] : 6;
?>

<?php // var_dump($args); ?>  

    <div class="row">            
        <?php if ($display_title) { ?>
        <div class="col h2">
            <?php if ($group->promo) { ?>
                <?php echo ($expired ? '<del>' : '') . $group->group_name . ($expired ? '</del>' : ''); ?>
                <?php echo ($expired ? ' - Истечена' : ''); ?>
            <?php } else { ?>
                <?php echo $group->group_name; ?>
            <?php } ?>
        </div>
        <?php } ?>

        <?php if (!empty($group->starts_at) && !empty($group->ends_at)) { ?>
            <div class="col h6 text-end">
                <?php echo $expired ? '<del>' : ''; ?>
                од <?php echo date('d.m.Y', strtotime($group->starts_at)); ?> 
                до <?php echo date('d.m.Y', strtotime($group->ends_at)); ?> 
                <?php echo $expired ? '</del>' : ''; ?>                
            </div>
        <?php } ?>
    </div>

    <div class="lifeline-product-group">
        <?php
            if ($group->is_bestseller && $group->use_bestseller_cookie)
                echo do_shortcode('[best_selling_products columns="' . $columns . '" limit="6"]');
            else
                echo do_shortcode('[products ids="' . implode(',', $product_ids) . '" columns="' . $columns . '"]');
        ?>
    </div>
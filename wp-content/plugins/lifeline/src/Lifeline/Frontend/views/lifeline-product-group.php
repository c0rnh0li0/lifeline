<?php 
    $expired = false; 

    $now = strtotime(date_create('now', timezone_open('Europe/Belgrade'))->format('Y-m-d H:i:s'));

    if ($now > strtotime($group->ends_at))
        $expired = true;
?>
<?php if ($group->promo) { ?>
    <div class="row">        
        <div class="col h2">
            <?php echo ($expired ? '<del>' : '') . $group->group_name . ($expired ? '</del>' : ''); ?>
            <?php echo ($expired ? ' - Истечена' : ''); ?>
        </div>
        
        <?php if (!empty($group->starts_at) && !empty($group->ends_at)) { ?>
            <div class="col h6 text-end">
                <?php echo $expired ? '<del>' : ''; ?>
                од <?php echo date('d.m.Y', strtotime($group->starts_at)); ?> 
                до <?php echo date('d.m.Y', strtotime($group->ends_at)); ?> 
                <?php echo $expired ? '</del>' : ''; ?>                
            </div>
        <?php } ?>            
    </h2>
<?php } ?>

<?php
    if ($group->is_bestseller && $group->use_bestseller_cookie)
        echo do_shortcode('[best_selling_products columns="6" limit="6"]');
    else
        echo do_shortcode('[products ids="' . implode(',', $product_ids) . '" columns="6" limit="6"]');
?>
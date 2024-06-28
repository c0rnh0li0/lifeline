<?php if ($group->promo) { ?>
    <h2>
        <span>Промоција: <?php echo $group->group_name; ?></span>
        
        <?php if (!empty($group->starts_at) && !empty($group->ends_at)) { ?>
            <span class="h6 justify-content-end">
                од <?php echo date('d.m.Y', strtotime($group->starts_at)); ?> 
                до <?php echo date('d.m.Y', strtotime($group->ends_at)); ?> 
            </span>
        <?php } ?>            
    </h2>
<?php } ?>

<?php
    if ($group->is_bestseller && $group->use_bestseller_cookie)
        echo do_shortcode('[best_selling_products columns="6" limit="6"]');
    else
        echo do_shortcode('[products ids="' . implode(',', $product_ids) . '" columns="6" limit="6"]');
?>
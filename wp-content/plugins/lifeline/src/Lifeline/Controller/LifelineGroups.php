<?php
namespace Lifeline\Controller;

use stdClass;
use WP_Query;

class LifelineGroups {
    public function __construct() {
        
    }

    public function product_group_shortcode($args) {
        global $table_prefix, $wpdb;

        $group_id = (int) $args['id'];

        $group = $wpdb->get_row("SELECT * FROM " . $table_prefix . LIFELINE_FE_GROUPS_DB . " WHERE id = $group_id");

        $products = $this->get_group_products(json_decode(wp_unslash($group->products)), $group->use_bestseller_cookie == 1 ? true : false);

        ob_start();

        require_once LIFELINE_TEMPLATES_DIR . 'lifeline-product-group.php';

        $content = ob_get_clean();

        return $content;
    }

    private function get_group_products($products_arr, $use_bestsellers) {
        $products = [];

        if ($use_bestsellers) {
            $query = new WP_Query( array(
                'posts_per_page' => 12,
                'post_type' => 'product',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'meta_key' => 'total_sales',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            ) );

            if($query->have_posts()) {
                while($query->have_posts()) : $query->the_post();
                    $products[] = wc_get_product(get_the_id());
                endwhile;
            }
        } else {
            foreach ($products_arr as $prod) {
                $products[] = wc_get_product($prod->id);
            }
        }
        
        return $products;
    }

    public function get_groups() {
        global $table_prefix, $wpdb;

        $groups = $wpdb->get_results("SELECT * FROM " . $table_prefix . LIFELINE_FE_GROUPS_DB);

        return $groups;
    }

    public function new_group() {
        $group = new stdClass();

        $group->id = 0;
        $group->group_name = "";
        $group->products = "";
        $group->promo = 0;
        $group->starts_at = "";
        $group->ends_at = "";
        $group->active = 0;

        ob_start();

        require_once LIFELINE_PLUGIN_DIR . "src/Lifeline/Admin/views/frontend-tabs/lifeline-admin-fe-group.php";

        $content = ob_get_clean();

        $response = new stdClass();
        $response->content = $content;

        die(json_encode($response));
    }

    public function get_group() {
        global $table_prefix, $wpdb;

        $group_id = (int) $_REQUEST['id'];

        if ($group_id == 0)
            $group = $this->new_group();
        else 
            $group = $wpdb->get_row("SELECT * FROM " . $table_prefix . LIFELINE_FE_GROUPS_DB . " WHERE id = $group_id");

        die(json_encode($group));
    }

    public function search() {
        $search_keyword = sanitize_text_field($_REQUEST['q']);
        // $product_visibility_term_ids = wc_get_product_visibility_term_ids();
        $ordering_args = WC()->query->get_catalog_ordering_args('title', 'asc' );
        $suggestions = [];

        $args = array(
            's'                   => $search_keyword,
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => 20,
            'orderby'             => $ordering_args['orderby'],
            'order'               => $ordering_args['order'],
            'suppress_filters'    => false,
            // 'tax_query'           => array(
            //     array(
            //         'taxonomy' => 'product_visibility',
            //         'field'    => 'term_taxonomy_id',
            //         'terms'    => $product_visibility_term_ids['exclude-from-search'],
            //         'operator' => 'NOT IN',
            //     ),
            // ),
        );

        $products = get_posts($args);

        if (!empty($products)) {
            foreach ($products as $post) {
                $product = wc_get_product( $post );
        
                $suggestions[] = array(
                    'id'        => $product->get_id(),
                    'name'     => wp_strip_all_tags($product->get_title()),
                    // 'url'       => $product->get_permalink(),
                    // 'thumbnail' => $product->get_image(),
                    // 'price'     => $product->get_price_html(),
                    // 'sku'       => $product->get_sku(),
                );
            }
        }

        die(json_encode($suggestions));
    }

    public function save() {
        global $table_prefix, $wpdb;

        $data = $_REQUEST;

        $starts_at = null;
        $ends_at = null;

        if (isset($data['starts_at']) && !empty($data['starts_at'])) {
            $starts_at = strtotime($data['starts_at']);
            $starts_at = date('Y-m-d 00:00:00', $starts_at);
        }

        if (isset($data['ends_at']) && !empty($data['ends_at'])) {
            $ends_at = strtotime($data['ends_at']);
            $ends_at = date('Y-m-d 00:00:00', $ends_at);
        }

        $vals_arr = array(
            'group_name' => $data['group_name'],
            'products' => $data['products'],
            'promo' => isset($data['promo']) ? 1 : 0,
            'starts_at' => $starts_at,
            'ends_at' => $ends_at,
            'active' => isset($data['active']) ? 1 : 0,
            'is_bestseller' => isset($data['is_bestseller']) ? 1 : 0,
            'use_bestseller_cookie' => isset($data['use_bestseller_cookie']) ? 1 : 0,
        );

        if ($data['id'] == '0')
            $wpdb->insert($table_prefix . LIFELINE_FE_GROUPS_DB, $vals_arr);
        else
            $wpdb->update($table_prefix . LIFELINE_FE_GROUPS_DB, $vals_arr,
                array(
                    'id' => $data['id']
                ));

        $response = new stdClass();

        $response->success = true;

        die(json_encode($response));
    }

    public function delete() {
        global $table_prefix, $wpdb;

        $wpdb->delete($table_prefix . LIFELINE_FE_GROUPS_DB, ['id' => $_REQUEST['id']]);

        $response = new stdClass();

        $response->success = true;

        die(json_encode($response));
    }
}
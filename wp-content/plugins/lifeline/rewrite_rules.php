<?php

add_filter('query_vars', 'lifeline_query_vars');

add_action('init', 'lifeline_rewrite_rules');

function lifeline_query_vars($query_vars) {
	$query_vars[] = 'manufacturer';

	return $query_vars;
}

function lifeline_rewrite_rules() {
	$lifeline_rw = [];

	flush_rewrite_rules();

	$lifeline_rw['brands/(.+?)/?$'] = 'index.php?pagename=brands&manufacturer=$matches[1]';
	// $lifeline_rw['brands-en/(.+?)/?$'] = 'index.php?pagename=brands-en&manufacturer=$matches[1]';

	$rules = get_option( 'rewrite_rules' );

    if (!isset($rules[array_key_first($lifeline_rw)]))
		flush_rewrite_rules();

	foreach ($lifeline_rw as $rule => $url)
		add_rewrite_rule($rule, $url, 'top');	
}

add_action('rest_api_init', function() {
	register_rest_route('lifeline/v1', '/groups', [
		'method' => 'GET',
		'callback' => 'lifeline_rest_route_groups',
		'permission_callback' => '__return_true'
	]);
});

function lifeline_rest_route_groups($data) {
	$groupsController = new \Lifeline\Controller\LifelineGroups();

	$groups = $groupsController->get_active_groups();

	return rest_ensure_response($groups);
}

function llog($msg) {
	$date = '[' . date('Y-m-d H:i:s') . ']';

	// ob_start();
	// var_dump($msg);
	// $log_data = ob_get_clean();
	// ob_end_clean();

	@error_log($date . $msg . "\r\n", 3, LIFELINE_ERROR_LOG);
}

function ts_hide_shipping_for_order_total( $rates ) {
	$free = array();
	$order_total = WC()->cart->get_subtotal();
	
	if( $order_total > 1500 ) {
	  foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->get_method_id() ) {
		  $free[ $rate_id ] = $rate;
		}
	  }
	} else {
		foreach ( $rates as $rate_id => $rate ) {
			if ( 'flat_rate' === $rate->get_method_id() ) {
			  $free[ $rate_id ] = $rate;
			}
		  }
	}
	return ! empty( $free ) ? $free : $rates;
  }
  add_filter( 'woocommerce_package_rates', 'ts_hide_shipping_for_order_total', 100 );
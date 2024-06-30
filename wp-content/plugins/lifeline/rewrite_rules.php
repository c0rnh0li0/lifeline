<?php

add_filter('query_vars', 'lifeline_query_vars');

add_action('init', 'lifeline_rewrite_rules');

function lifeline_query_vars($query_vars) {
	$query_vars[] = 'manufacturer';

	return $query_vars;
}

function lifeline_rewrite_rules() {
	$lifeline_rw = [];

	$lifeline_rw['brands/(.+?)/?$'] = 'index.php?pagename=brands&manufacturer=$matches[1]';

	$rules = get_option( 'rewrite_rules' );

    if (!isset($rules[array_key_first($lifeline_rw)]))
		flush_rewrite_rules();

	foreach ($lifeline_rw as $rule => $url)
		add_rewrite_rule($rule, $url, 'top');	
}
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
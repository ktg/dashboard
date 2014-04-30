<?php
function list_services($wpdb, $category)
{
	$services_table = $wpdb->prefix . "services";
	$user_services_table = $wpdb->prefix . "users_services";

	$current_user = wp_get_current_user();
	$user_id = isset($current_user->ID) ? $current_user->ID : 0;



	$query = $wpdb->prepare("SELECT * FROM $services_table WHERE category = %s", $category);
	return $wpdb->get_results($query);
}

?>
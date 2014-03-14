<?php
include "WP-ROOT-PATH/wp-config.php";

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Test the connection:
if (mysqli_connect_errno()){
	// Connection Error
	exit("Couldn't connect to the database: ".mysqli_connect_error());
}

$user_services_table = $db->prefix . "users_services";
$query = $db->prepare("SELECT * FROM $user_services_table WHERE user_id=%s AND service_key=%s", $user_id, "website");
$service = $db->get_results($query);
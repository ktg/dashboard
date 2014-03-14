<?php
function list_services($wpdb, $category)
{
	$services_table = $wpdb->prefix . "services";
	$user_services_table = $wpdb->prefix . "users_services";

	$current_user = wp_get_current_user();
	$user_id = isset($current_user->ID) ? $current_user->ID : 0;

	if (isset($_POST['wp-submit']) && $_POST['wp-submit'] == 'Add to Dashboard' && $user_id > 0)
	{
		$service_key = $_POST['service_key'];
		$service_title = $_POST['service_title'];

		/* Need to check what services a user has and to not allow them to add services that they already have in their dashboard */
		$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE service_key = %s AND user_id = %d", $service_key, $user_id);
		$user_services_check = $wpdb->get_results($query);

		if (empty($user_services_check))
		{
			//add the service to your dashboard
			$query = $wpdb->prepare("INSERT INTO $user_services_table (service_key, user_id) VALUES (%s, %d)", $service_key, $user_id);
			$result = $wpdb->query($query);

			if ($result)
			{

				?>
				<div id="notification">
					<?php echo "$service_title has been added to your dashboard"; ?>
				</div>
			<?php
			}
			else
			{
				?>
				<div id="notification">
					<?php echo "Failed to add $service_title"; ?>
				</div>
			<?php
			}
		}
	}

	$query = $wpdb->prepare("SELECT * FROM $services_table WHERE category = %s", $category);
	return $wpdb->get_results($query);
}

?>
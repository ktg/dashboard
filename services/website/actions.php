<?php
$icon = site_url('wp-content/themes/' . $theme . '/services/website/images/icon.png');

$user_services_table = $wpdb->prefix . "users_services";
$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE user_id=%s AND service_key=%s", $user_id, "website");
$service = $wpdb->get_results($query);

foreach ($service as $website)
{
	if (isset($_POST['website_id']) && $website->id == $_POST['website_id'])
	{
		$query = $wpdb->prepare("UPDATE $user_services_table SET token=%s WHERE id=%d", $_POST['website_url'], $website->id);
		$result = $wpdb->get_results($query);
		$website->token = $_POST['website_url'];
	}

	if (!empty($website->token))
	{
		$action = array('icon' => $icon,
		                'service' => 'website',
		                'title' => 'Update your Website',
		                'desc' => 'Regularly updates to your website stop it from feeling stale and out of date.',
		                'priority' => 10,
		                'items' => "<a href=\"$website->token\">Website</a>",);

		array_push($actions, $action);
	}
	else
	{
		$action = array('icon' => $icon,
		                'title' => 'Set URL',
		                'service' => 'website',
		                'desc' => 'The Dashboard needs to know the url of your site so it can track it.',
		                'priority' => 10,
		                'items' => "<form method='post'><input type='hidden' name='website_id' value='$website->id'/><input name='website_url'/><button>Set URL</button></form>",);

		array_push($actions, $action);
	}
}


?>
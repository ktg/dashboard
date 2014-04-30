<?php
get_header();

$current_user = wp_get_current_user();
$user_id = isset($current_user->ID) ? $current_user->ID : 0;

foreach ($_POST as $POST_KEY => $POST_VALUE)
{
	if (strpos($POST_KEY, 'business_') === 0)
	{
		update_user_meta($user_id, $POST_KEY, $POST_VALUE);
	}
}

if (isset($_GET['id']))
{
	$user_id = $_GET['id'];
	$edit = false;
}
else
{
	$current_user = wp_get_current_user();
	$user_id = isset($current_user->ID) ? $current_user->ID : 0;
	if (isset($_GET['edit']))
	{
		$edit = $_GET['edit'];
	}
	else
	{
		$edit = false;
	}
}

$business_name = get_user_meta($user_id, 'business_name', true);
$business_desc = get_user_meta($user_id, 'business_desc', true);
$business_address = get_user_meta($user_id, 'business_address', true);
$business_phone = get_user_meta($user_id, 'business_phone', true);
$business_email = get_user_meta($user_id, 'business_email', true);

if ($edit): ?>
	<form method="post">
		<div class="field">
			<div class="field_name">Business Name</div>
			<div class="field_item"><input class="field_input" placeholder="Business Name" required="true"
			                               name="business_name" value="<?php echo $business_name; ?>" /></div>
		</div>
		<div class="field">
			<div class="field_name">Description</div>
			<div class="field_item"><textarea class="field_input"
			                                  name="business_desc"><?php echo $business_desc; ?></textarea></div>
		</div>
		<!--<div class="field">
			<div class="field_name">Category</div>
			<div class="field_item"><select class="field_input"></select></div>
		</div>-->
		<div class="field">
			<div class="field_name">Address</div>
			<div class="field_item"><textarea class="field_input"
			                                  name="business_address"><?php echo $business_address; ?></textarea></div>
		</div>
		<div class="field">
			<div class="field_name">Phone Number</div>
			<div class="field_item"><input class="field_input" type="tel" placeholder="Phone Number"
			                               name="business_phone" value="<?php echo $business_phone; ?>" /></div>
		</div>
		<div class="field">
			<div class="field_name">Email Address</div>
			<div class="field_item"><input class="field_input" type="email" placeholder="Email Address"
			                               name="business_email" value="<?php echo $business_email; ?>" /></div>
		</div>
		<button class="field_button">Save</button>
	</form>
<?php else: ?>
	<div>
		<div><?php echo $business_name; ?></div>
		<div><?php echo $business_desc; ?></div>
		<div><?php echo $business_address; ?></div>
		<div><?php echo $business_phone; ?></div>
		<div><?php echo $business_email; ?></div>

	<?php
	$user_services_table = $wpdb->prefix . "users_services";
	$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE user_id=%s", $user_id);
	$services = $wpdb->get_results($query);

	$theme = get_template();
	$services_path = site_url('wp-content/themes/' . $theme . '/services/');
	$dashboard_view_path = site_url('wp-content/themes/' . $theme . '/images/dashboard_view/');

	$contacts = array();
	$interactions = array();

	if (isset($services))
	{
		foreach ($services as $service)
		{
			$service_path = $services_path . $service->service_key . "/";
			$icon = $service_path . "images/icon.png";
			$service_include = "wp-content/themes/$theme/services/" . $service->service_key . "/profile.php";
			if (is_file($service_include))
			{
				include $service_include;
			}
		}
	}

	foreach ($contacts as $contact)
	{
		echo "<div>$contact</div>";
	}


	?>
	</div>

<? endif; ?>
<?php get_footer(); ?>
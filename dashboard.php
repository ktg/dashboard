<?php
/**
 * Template Name: dashboard
 *
 * @package WordPress
 */
include_once "graphing.php";

get_header();

$current_user = wp_get_current_user();
$user_id = isset($current_user->ID) ? $current_user->ID : 0;

$services_table = $wpdb->prefix . "services";
$user_services_table = $wpdb->prefix . "users_services";

if (isset($_POST['service_key']))
{
	$service_key = $_POST['service_key'];

	/* Need to check what services a user has and to not allow them to add services that they already have in their dashboard */
	$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE service_key = %s AND user_id = %d", $service_key, $user_id);
	$user_services_check = $wpdb->get_results($query);

	if (empty($user_services_check))
	{
		$query = $wpdb->prepare("SELECT * FROM $services_table WHERE `key` = %s", $service_key);
		$services = $wpdb->get_results($query);
		$service = $services[0];

		//add the service to your dashboard
		$query = $wpdb->prepare("INSERT INTO $user_services_table (service_key, user_id) VALUES (%s, %d)", $service_key, $user_id);
		$result = $wpdb->query($query);

		if ($result)
		{

			?>
			<div id="notification">
				<?php echo "$service->title has been added to your dashboard"; ?>
			</div>
		<?php
		}
		else
		{
			?>
			<div id="notification">
				<?php echo "Failed to add $service->title"; ?>
			</div>
		<?php
		}
	}
}

$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE user_id=%s", $user_id);
$services = $wpdb->get_results($query);

$theme = get_template();
$services_path = site_url('wp-content/themes/' . $theme . '/services/');
$dashboard_view_path = site_url('wp-content/themes/' . $theme . '/images/dashboard_view/');

$actions = array();
$analytics = array();
$social = array();

if (isset($services))
{
	foreach ($services as $service)
	{
		$service_path = $services_path . $service->service_key . "/";
		$icon = $service_path . "images/icon.png";
		$service_page = $service_path . "page.php";
		$service_include = "wp-content/themes/$theme/services/" . $service->service_key . "/actions.php";
		if (is_file($service_include))
		{
			include $service_include;
		}
	}
}

if (!empty($analytics))
{
	$analytics_action = array('icon' => site_url('wp-content/themes/dashboard/services/google_analytics/images/icon.png'),
		'service' => 'analytics',
		'id' => 'analytics',
		'title' => "Analytics",
		'desc' => 'Regularly post content to Facebook in order to build a relationship with your customers. Keep posts as short and concise as possible and begin a dialogue with your audience by asking them a question.',
		'items' => graph('analytics_graph', 'Visits', $analytics));

	array_push($actions, $analytics_action);
}

if (!empty($social))
{
	$social_action = array('icon' => site_url('wp-content/themes/dashboard/services/google_analytics/images/icon.png'),
		'service' => 'social',
		'id' => 'social',
		'title' => "Social",
		'desc' => '',
		'items' => graph('social_graph', 'Followers', $social));

	array_push($actions, $social_action);
}
?>
	<div id="dashboard">
		<?php
		$menu_id = 0;
		foreach ($actions as $action)
		{
			$menu_id += 1;
			?>
			<div class="action">
				<img class="action_icon" src="<?php echo $action['icon'] ?>"
				     title="<?php echo $action['service']; ?>" />

				<div>
					<img class="action_menu_icon" />

					<div id="action_menu_<?php echo $menu_id; ?>" class="action_menu">
						<div><a href="">Remove <?php echo $action['service'] ?></a></div>
					</div>
					<div class="action_title"><?php echo $action['title'] ?></div>
					<div class="action_desc"><?php echo $action['desc'] ?></div>
					<div><?php echo $action['items']; ?></div>
				</div>
			</div>

		<?php
		}
		?>
	</div>
<?php get_footer(); ?>
<?php
/**
 * Template Name: dashboard
 *
 * @package WordPress
 */
function addAnalytics($actions, $name, $value, $service)
{
	$analytics_key = null;
	$analytics_action = null;
	foreach ($actions as $action)
	{
		if (isset($action['id']) && $action['id'] == 'analytics')
		{
			$analytics_key = array_search($action, $actions);
			$analytics_action = $action;
			break;
		}
	}

	if (!isset($analytics_action))
	{
		$analytics_action = array('icon' => site_url('wp-content/themes/dashboard/services/google_analytics/images/icon.png'),
		                          'service' => 'analytics',
		                          'id' => 'analytics',
		                          'title' => "Analytics",
		                          'desc' => 'Regularly post content to Facebook in order to build a relationship with your customers. Keep posts as short and concise as possible and begin a dialogue with your audience by asking them a question.',
		                          'items' => "<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type='text/javascript'>
	google.load('visualization', '1', {packages:['corechart']});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Site');
		data.addColumn('number', 'Visits');
		data.addColumn({type:'string', role:'style'});  // interval role col.
		data.addColumn({type:'string', role:'annotation'}); // annotation role col.

		// additions

		var options = {
			//title: 'Visits'
		};

		var chart = new google.visualization.BarChart(document.getElementById('analytics_chart'));
		chart.draw(data, options);
	}
</script><div id='analytics_chart' style='width: 800px;'></div>");
	}

	$analytics_action['items'] = str_replace("// additions", "data.addRow(['$name', $value, 'opacity: 0.8', '$service ($value)']);\n// additions", $analytics_action['items']);

	if (isset($analytics_key))
	{
		$actions[$analytics_key] = $analytics_action;
	}
	else
	{
		array_push($actions, $analytics_action);
	}
	return $actions;
}

$current_user = wp_get_current_user();
$user_id = isset($current_user->ID) ? $current_user->ID : 0;

get_header();

$user_services_table = $wpdb->prefix . "users_services";
$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE user_id=%s", $user_id);
$services = $wpdb->get_results($query);

$theme = get_template();
$services_path = site_url('wp-content/themes/' . $theme . '/services/');
$dashboard_view_path = site_url('wp-content/themes/' . $theme . '/images/dashboard_view/');

$actions = array();

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

?>
	<div id="dashboard">
		<?php
		foreach ($actions as $action)
		{
			?>
			<div class="action">
				<img class="action_icon" src="<?php echo $action['icon'] ?>" title="<?php echo $action['service']; ?>"/>

				<div>
					<div class="action_title"><?php echo $action['title'] ?></div>
					<div class="action_desc"><?php echo $action['desc'] ?></div>
					<div><?php echo $action['items']; ?></div>
				</div>
			</div>

		<?php
		}
		?>
	</div>

	<div id="turn_inside_out">

		<?php
		if (count($services) < 4)
		{
			?>
			<a href="#" onclick="return TurnInsideOut()"><img
					src="<?php echo $dashboard_view_path; ?>turn_into_webpage.png"/></a>
		<?php
		}
		else
		{
			?>
			<a href="#" onclick="return TurnInsideOutTwice()"><img
					src="<?php echo $dashboard_view_path; ?>turn_into_webpage.png"/></a>
		<?php
		}
		?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * Template Name: dashboard
 *
 * @package WordPress
 */
function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime();
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array('y' => 'year',
	                'm' => 'month',
	                'w' => 'week',
	                'd' => 'day',
	                'h' => 'hour',
	                'i' => 'minute',
	                's' => 'second',);
	foreach ($string as $k => &$v)
	{
		if ($diff->$k)
		{
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		}
		else
		{
			unset($string[$k]);
		}
	}

	if (!$full)
	{
		$string = array_slice($string, 0, 1);
	}
	return $string ? implode(', ', $string) : 'just now';
}

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
		data.addColumn({type:'string', role:'style'});
		data.addColumn({type:'string', role:'annotation'});

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

function addSocial($actions, $name, $value, $service)
{
	$analytics_key = null;
	$analytics_action = null;
	foreach ($actions as $action)
	{
		if (isset($action['id']) && $action['id'] == 'social')
		{
			$analytics_key = array_search($action, $actions);
			$analytics_action = $action;
			break;
		}
	}

	if (!isset($analytics_action))
	{
		$analytics_action = array('icon' => site_url('wp-content/themes/dashboard/services/google_analytics/images/icon.png'),
		                          'service' => 'social',
		                          'id' => 'social',
		                          'title' => "Social",
		                          'desc' => '',
		                          'items' => "<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type='text/javascript'>
	google.load('visualization', '1', {packages:['corechart']});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Site');
		data.addColumn('number', 'Followers');
		data.addColumn({type:'string', role:'style'});
		data.addColumn({type:'string', role:'annotation'});

		// additions

		var options = {
			//title: 'Visits'
		};

		var chart = new google.visualization.BarChart(document.getElementById('social_chart'));
		chart.draw(data, options);
	}
</script><div id='social_chart' style='width: 800px;'></div>");
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
<?php get_footer(); ?>
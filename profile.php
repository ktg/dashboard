<?php
$user_id = get_current_user_id();

foreach ($_POST as $POST_KEY => $POST_VALUE)
{
	if($_POST_KEY == 'business_image')
	{
		//error_log("Including " . ABSPATH . 'wp-admin/includes/admin.php');
		//require_once(ABSPATH . 'wp-admin/includes/admin.php');
		//$image_id = media_handle_upload('badge_image', $_POST['badge_id']);
		//update_post_meta($_POST['badge_id'], '_thumbnail_id', $image_id);
	}
	else if (strpos($POST_KEY, 'business_') === 0)
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
	if (isset($_GET['edit']))
	{
		$edit = $_GET['edit'];
	}
	else
	{
		$edit = false;
	}
}

if($user_id == 0)
{
	wp_redirect(esc_url(home_url()));
}

get_header();

$business_name = get_user_meta($user_id, 'business_name', true);
$business_desc = get_user_meta($user_id, 'business_desc', true);
$business_address = get_user_meta($user_id, 'business_address', true);
$business_phone = get_user_meta($user_id, 'business_phone', true);
$business_email = get_user_meta($user_id, 'business_email', true);

if (empty($business_name) && empty($_GET['id']))
{
	$edit = true;
}

if ($edit): ?>
	<form action="<?php echo get_page_link(get_page_by_title('profile')->ID); ?>" method="post" enctype='multipart/form-data'>
		<div class="field">
			<div class="field_name">Business Name</div>
			<input class="field_input" placeholder="Business Name" required="true"
			       name="business_name" value="<?php echo $business_name; ?>" />
		</div>
		<div class="field">
			<div class="field_name">Logo</div>
			<input type="file" class="field_input" name="business_image" />
		</div>
		<div class="field">
			<div class="field_name">Description</div>
			<textarea class="field_input"
			          name="business_desc"><?php echo $business_desc; ?></textarea>
		</div>
		<!--<div class="field">
			<div class="field_name">Category</div>
			<div class="field_item"><select class="field_input"></select></div>
		</div>-->
		<div class="field">
			<div class="field_name">Address</div>
			<textarea class="field_input"
			          name="business_address"><?php echo $business_address; ?></textarea>
		</div>
		<div class="field">
			<div class="field_name">Phone Number</div>
			<input class="field_input" type="tel" placeholder="Phone Number"
			       name="business_phone" value="<?php echo $business_phone; ?>" />
		</div>
		<div class="field">
			<div class="field_name">Email Address</div>
			<input class="field_input" type="email" placeholder="Email Address"
			       name="business_email" value="<?php echo $business_email; ?>" />
		</div>
		<div class="field_submit">
			<button class="field_button">Save</button>
		</div>
	</form>
<?php else: ?>
	<h1><?php echo $business_name; ?></h1>
	<div class="profile">
		<div class="profile_item">
			<?php
			if (!empty($business_address))
			{
				$encoded_address = urlencode($business_address);
				echo "<iframe class='map' scrolling='no'  marginheight='0' marginwidth='0' src='https://maps.google.com/maps?&amp;q=$encoded_address&amp;output=embed'></iframe>";
			}
			?>

			<div><?php echo $business_desc; ?></div>
			<div style="white-space: pre-wrap;"><?php echo $business_address; ?></div>
			<div><?php echo $business_phone; ?></div>
			<div><?php echo $business_email; ?></div>
			<?php

			$user_services_table = $wpdb->prefix . "users_services";
			$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE user_id=%s", $user_id);
			$services = $wpdb->get_results($query);

			$theme = get_template();
			$services_path = site_url("wp-content/themes/$theme/services/");
			$dashboard_view_path = site_url("wp-content/themes/$theme/images/dashboard_view/");

			$links = array();
			$activities = array();

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

			foreach ($links as $link)
			{
				echo "<div>$link</div>";
			}

			if (empty($_GET['id'])):
				?>
				<div><a href="<?php echo get_page_link(get_page_by_title('profile')->ID); ?>?edit=true">Edit</a></div>
			<?php
			endif;
			?>
		</div>
		<div class="profile_item">
			<?php

			$args = array(
				'post_type' => 'badge',
			);
			$loop = new WP_Query($args);

			echo "<div style='display: flex'>";
			while ($loop->have_posts())
			{
				$loop->the_post();
				$post_ID = get_the_ID();
				$members = get_post_meta($post_ID, 'members', true);
				$author_ID = get_the_author_meta("ID");

				if ((is_array($members) && array_key_exists($user_id, $members) && $members[$user_id]['status'] == 'member') || $author_ID == $user_id)
				{
					echo '<a href="' . get_permalink() . '" style="margin-right: 10px; margin-bottom: 10px; text-align: center;">';
					the_post_thumbnail(array(100, 100));
					echo '<div>';
					the_title();
					echo '</div>';
					echo "</a>";
				}

			}
			echo "</div>";
			wp_reset_query();

			uasort($activities, 'cmp');

			foreach ($activities as $activity)
			{
				?>
				<div class="action">
					<div>
						<div class="action_title"><?php echo $activity['text'] ?></div>
						<div class="action_desc">
							<img class="link_icon" src="<?php echo $activity['icon'] ?>"
							     title="<?php echo $activity['service']; ?>" />
							<?php
							$dt = $activity['time'];
							echo $activity['service'] . " &mdash; " . $dt->format("d M");
							?>
						</div>
					</div>
				</div>

			<?php
			}


			?>
		</div>
	</div>
<? endif;

function cmp($a, $b)
{
	if ($a == $b)
	{
		return 0;
	}

	return $b['time']->getTimestamp() - $a['time']->getTimestamp();
}

?>

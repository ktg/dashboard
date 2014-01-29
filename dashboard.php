<?php

/**
 * Template Name: dashboard
 *
 * @package WordPress
 */
$current_user = wp_get_current_user ();
$user_id = isset ( $current_user->ID ) ? $current_user->ID : 0;
if (! $user_id > 0)
{
	wp_redirect ( esc_url ( site_url ( 'home' ) ) );
}

get_header ();
add_filter ( 'show_admin_bar', '__return_false' );

$query = $wpdb->prepare ( "Select * From " . $wpdb->prefix . "services" );
// $results = $wpdb->query($query);
$services = $wpdb->get_results ( $query );

/* Check what services a user has in their dashboard and load them */
$query = $wpdb->prepare ( "Select * From " . $wpdb->prefix . "users_services WHERE user_id= $user_id" );
$user_services = $wpdb->get_results ( $query );

$theme = get_template ();
$icon_path = site_url ( 'wp-content/themes/' . $theme . '/images/dashboard_view/service_icons/' );
$service_page_path = site_url ( 'wp-content/themes/' . $theme . '/dashboard/display_view/services/' );
$dashboard_view_path = site_url ( 'wp-content/themes/' . $theme . '/images/dashboard_view/' );

?>

<!-- Navigation Bar -->
<div id="nav">
	<ul>
		<li><a href="<?php echo get_page_link( get_page_by_title(discover)->ID ); ?>">Getting Started</a></li>
		<li class="active"><a href="">Dashboard</a></li>
	</ul>
</div>

<div id="default_container">
	<div id="dashboard">
		<div id="turn_inside_out">

			<?php
			if (count ( $user_services ) < 4)
			{
				?>
            <a href="#" onclick="return TurnInsideOut()"><img src="<?php echo $dashboard_view_path;?>turn_into_webpage.png" /></a>
			<?php
			}
			else
			{
				?>	
			<a href="#" onclick="return TurnInsideOutTwice()"><img src="<?php echo $dashboard_view_path;?>turn_into_webpage.png" /></a>
			<?php
			}
			?>		 
    	</div>


		<div id="services_container">
			<?php
			if ($user_services)
			{
				foreach ( $user_services as $us )
				{
					foreach ( $services as $service )
					{
						if ($us->service_id == $service->id)
						{				
							$icon = $icon_path . $service->key . "icon.png";
							$service_page = $service_page_path . $service->key . "/page.php";
							?>

			<a href="#" id="dashboard_icon_a" onclick="return LoadIFrame('<?php echo $service_page; ?>')">
				<img class="dashboard_icon"	src="<?php echo $icon;?>" alt="<?php echo $service->title;?>" />
			</a>
 			<?php
						}
					}
				}
			}
			?>
		</div>


		<div id="display_view" style="margin: 0px; padding: 0px; overflow: hidden">
			<!--width="494px" marginwidth="0" marginheight="0" -->
			<iframe id="ifr" style="overflow: hidden; height: 100%; width: 100%" height="100%" width="100%" style="border-width:none; background:#eaeaea; "> </iframe>
		</div>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


<script type="text/javascript">
function LoadIFrame(pg)
{
	var ifr = document.getElementById("ifr");
    ifr.src = pg;
}

function TurnInsideOut()
{	
	var ifr;
    ifr = document.getElementById("ifr");
    ifr.style.display="block";
	ifr.src="<?php echo $service_page_path;?>dash-website/dash-website0.html";
}

function TurnInsideOutTwice()
{
	var ifr;
    ifr = document.getElementById("ifr");
    ifr.style.display="block";
	ifr.src="<?php echo $service_page_path;?>dash-website/dash-website.html";
}
</script>
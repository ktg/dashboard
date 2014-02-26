<?php
$current_user = wp_get_current_user ();
/**
 * @package WordPress
 * @subpackage Dashboard
 */

$user_id = isset($current_user->ID)?$current_user->ID:0;
if($user_id == 0)
{
	wp_redirect(esc_url( site_url('home')));
}

add_filter( 'show_admin_bar', '__return_false' );

?>
<!DOCTYPE html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title>Dashboard</title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="header">
		<div id="logo">
			<div style="font-size: 30px; font-family: Arial;">Dashboard</div>
			<div>{your online content all in one place}</div>
		</div>

		<div id="logout_section">logged in as &quot;<?php echo $current_user->display_name; ?>&quot;&nbsp;
			<a href="<?php echo wp_logout_url(home)?>" title="Logout">Logout</a>
		</div>
	</div>

	<div id="main" class="site-main">
	
		<div id="nav">
			<?php if(is_page(dashboard)): ?>
			<a href="<?php echo get_page_link(get_page_by_title(discover)->ID); ?>">Getting Started</a>
			<a class="active">Dashboard</a>		
			<?php elseif($post->post_parent): ?>
			<a class="active" href="<?php echo get_page_link(get_page_by_title(discover)->ID); ?>">Getting Started</a>
			<a href="<?php echo get_page_link(get_page_by_title(dashboard)->ID); ?>">Dashboard</a>
			<?php else: ?>				
			<a class="active">Getting Started</a>
			<a href="<?php echo get_page_link(get_page_by_title(dashboard)->ID); ?>">Dashboard</a>
			<?php endif; ?>
		</div>	

<?php
if(isset($_POST['wp-submit']) && $_POST['wp-submit']=='Add to Dashboard' && $user_id > 0)
{
	$service_id=$_POST['service_id'];
	$service_title=$_POST['service_title'];
	
	/* Need to check what services a user has and to not allow them to add services that they already have in their dashboard */
	$us_query = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."users_services WHERE user_id= $user_id AND service_id = $service_id");
	$user_services_check = $wpdb->get_results($us_query);	
		
	if(!$user_services_check)
	{
		//add the service to your dashboard
		$query = $wpdb->prepare("INSERT INTO ".$wpdb->prefix."users_services (service_id, user_id) VALUES ($service_id,$user_id)");
			
?>
		<div id="notification">
			<?php echo "$service_title has been added to your dashboard"; ?>
		</div>
<?php
	}	
	$results = $wpdb->query($query);
}
?>		

<?php if(!is_page(dashboard)): ?>
<div><?php echo $pagename ?></div>
<?php endif; ?>
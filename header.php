<?php
$current_user = wp_get_current_user ();
/**
 * @package WordPress
 * @subpackage Dashboard
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title>Dashboard</title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="header">
		<div id="logo">
			<div style="font-size: 30px; font-family: Arial;">Dashboard</div>
			<div>{your online content all in one place}</div>
		</div>

		<div id="logout_section">
			logged in as &quot;<?php echo $current_user->display_name; ?>&quot;&nbsp;
			<a href="<?php echo wp_logout_url(home)?>" title="Logout">Logout</a>
		</div>
	</div>

	<div id="main" class="site-main">
	
		<div id="nav">
			<ul>
				<?php if(is_page(dashboard)): ?>
				<li><a href="<?php echo get_page_link(get_page_by_title(discover)->ID); ?>">Getting Started</a></li>
				<li class="active"><a href="">Dashboard</a></li>		
				<?php elseif($post->post_parent): ?>
				<li class="active"><a href="<?php echo get_page_link(get_page_by_title(discover)->ID); ?>">Getting Started</a></li>
				<li class="active"><a href="<?php echo get_page_link(get_page_by_title(dashboard)->ID); ?>">Dashboard</a></li>
				<?php else: ?>				
				<li class="active"><a href="">Getting Started</a></li>
				<li class="active"><a href="<?php echo get_page_link(get_page_by_title(dashboard)->ID); ?>">Dashboard</a></li>
				<?php endif; ?>
			</ul>
		</div>		
<?php

$current_user = wp_get_current_user();

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
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
	<title>This is..{micro-businesses in your community}</title>	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    			
                <div id="header">	
                    <div id="logo">
                        <img src=<?php bloginfo('template_directory') ?>/images/logo.png  alt="This is.. logo" height="71px" width="292px" />
                    </div>
                                
    
                    <div id="logout_section">
               			 <?php
                        	echo "logged in as &quot;$current_user->display_name&quot;&nbsp;";
							echo '<a href="'.wp_logout_url(home).'" title="Logout">Logout</a>';
  						 ?>
                    </div>
                </div>
        
               

		<div id="main" class="site-main">

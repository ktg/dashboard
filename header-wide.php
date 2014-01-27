<?php
/**
 * The Header for our homepage.
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
	<title>Dashboard</title>	
	<link rel="stylesheet" href=<?php bloginfo('template_directory') ?>/css/homepage.css type="text/css"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<!--<body <?php body_class(); ?>>
	<div id="page" class="hfeed site"> -->
	
              <div id="container">
                <div id="header">	
                
                    <div id="login_section">
                            
                         <!--   
                            <form id="login_form" name="login_form" method="post" action="index.html">
                                Username: <input type="text" name="username">
                                Password: <input type="password" name="password">
                                <input type="button" value="Log in" class="login_button" />
                            </form>
                            -->
                             
           <?php
			
			 $current_user = wp_get_current_user();
			 //echo "<pre>";
			 //print_r($current_user);
			 if(!$current_user->ID){ 
			 
			 	$args = array( 'echo' => true,
						'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], // Default redirect is back to the current page
	 					'form_id' => 'loginform',
						'label_username' => __( 'Username:' ),
						'label_password' => __( 'Password:' ),
						'label_remember' => __( 'Remember Me' ),
						'label_log_in' => __( 'Log In' ),
						'id_username' => 'user_login',
						'id_password' => 'user_pass',
						'id_remember' => 'rememberme',
						'id_submit' => 'wp-submit',
						'remember' => false,
						'value_username' => '',
						'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
					);
				/*wp_login_form( $args ); */
				$forgot_password_link= '<a href="'.wp_lostpassword_url().'">forgot password?</a>';
			 ?>
			 
			 	<form method="post" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) );?>" id="loginform" name="loginform">
					<p class="login-username">
						<label for="user_login">Username:</label>
						<input type="text" size="15" value="" class="input p0 mr5" id="user_login" name="log">
					
						<label for="user_pass">Password:</label>
						<input type="password" size="15" value="" class="input p0 mr5" id="user_pass" name="pwd">
					
						<input type="submit" value="  Log In  " class="button-primary p0" id="submitLogin" name="wp-submit">
						<input type="hidden" value="<?php echo esc_url( $args['redirect'] );?>" name="redirect_to"> <b>|</b>
						<?php echo $forgot_password_link;?>
					</p>
					
				</form>
			 <?php
			 	 
			 }else{
			 	echo "logged in as &quot;$current_user->display_name&quot;&nbsp;";
				echo '<a href="'.wp_logout_url().'" title="Logout">Logout</a>';

			 }
			?>
		
                            
                            
                            
                            
                            
                            
                            
                    </div>
              </div>

		<div id="main" class="site-main">

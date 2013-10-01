<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
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
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<style>
	
.row{
	clear:both;
}
.cell{
	float:left;
}

.tac{
text-align: center;
}
.addSevicesContainer{
	width:900px;
	height:500px;
	/*border:1px #000000 solid;*/
	padding:20px;
	position:relative;
}
.addSevicesInfo{
	border: 1px solid #000000;
    height: 30px;
    margin-top: 50px;
    padding: 20px;
    width: 860px;
}

.sevicesBox{
	/*border: 1px solid #000000;*/
	/*padding: 2px;*/
    font-size: 22px;
    height: 122px;
    margin-top: 35px;
    text-align: center;
    vertical-align: middle;
    width: 178px;
}

.addSevicesHeading{
	width:auto;
	height:auto;
	font-size:22px;
}
.addSevicesLink{
	width:auto;
	height:auto;
}
.addSevicesLink a{
	font-size:16px;
	color:#000000;
}

.b{font-weight:bold;}
.fl{
	float:left;
}

.fr{
	float:right;
}

.pt5{
	padding-top:5px;
}
.pt10{
	padding-top:10px;
}
.pt15{
	padding-top:15px;
}
.pt20{
	padding-top:20px;
}

.pt50{
	padding-top:50px;
}

.pt100{
	padding-top:100px;
}

.pl5{
	padding-left:5px;
}
.pl10{
	padding-left:10px;
}

.pl20{
	padding-left:20px;
}

.pl35{
	padding-left:35px;
}

.pl50{
	padding-left:50px;
}

.pl67{
	padding-left:67px;
}
.pl100{
	padding-left:100px;
}
.pl85{
	padding-left: 85px;
}

.ml5{
	margin-left:5px;
}

.mr5{
	margin-right:5px;
}

.ml20{
	margin-left:20px;
}
.ml35{
	margin-left:35px;
}
.pb10{
	padding-bottom: 10px;
}
.pb20{
	padding-bottom: 20px;
}
.b{
	font-weight:bold;
}
.dn{
	display: none;
}

.ptr{
	cursor:pointer;
}
.f16{
	font-size:16px;
}
.pr{
	position:relative;
}

.pr20{
	padding-right:20px;
}

.p0{
	padding:0px !important;
}
.pa{
	position:absolute;
}

.width130px{
	width:130px;
}

.width100px{
	width:100px;
}

.deleteServices{
    cursor: pointer;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    right: 4px;
    top: -7px;
}
.grey{
	color: #B1B1B1 !important;
}
.white{
	color: #FFFFFF !important;
}
.loginBox{
	border: 1px solid #000000;
    margin-right: 20px;
    padding: 10px;
}
.login-password{
	padding-top:10px;
	padding-left:5px;
}
.login-remember{
	padding-top:10px;
	padding-left:50px;
}
.login-submit{
	padding-left: 73px;
    padding-top: 10px;
}
.tbl_bordr{
	border: 1px solid #000000;
    height: auto;
    padding: 20px;
    width: 900px;
}
/* AnythingPopup CSS*/
.AnythingPopup_BoxContainer{width:400px;height:400px;background:#FFFFFF;border:1px solid #4D4D4D;padding:0;position:fixed;z-index:99999;cursor:default;-moz-border-radius: 10px;-webkit-border-radius: 10px;-khtml-border-radius: 10px;border-radius: 10px;   display:none;
top: 50px; left: 493px;
}
.AnythingPopup_BoxContainerHeader {height:30px;background:#4D4D4D;border-top-right-radius:10px;-moz-border-radius-topright:10px;-webkit-border-top-right-radius:10px;-khtml-border-top-right-radius: 10px;border-top-left-radius:10px;-moz-border-radius-topleft:10px;-webkit-border-top-left-radius:10px;-khtml-border-top-left-radius: 10px;} .AnythingPopup_BoxContainerHeader a {color:#FFFFFF;font-family:Verdana,Arial;font-size:10pt;font-weight:bold;} 
.AnythingPopup_BoxTitle {float:left; margin:5px;color:#FFFFFF;font-family:Verdana,Arial;font-size:12pt;font-weight:bold;} 
.AnythingPopup_BoxClose {float:right;width:50px;margin:5px;} 
.AnythingPopup_BoxContainerBody {margin:15px;overflow:auto;height:335px;} 
.AnythingPopup_BoxContainerFooter {position: fixed;top:0;left:0;bottom:0;right:0;background:#000000;opacity: .3;-moz-opacity: .3;filter: alpha(opacity=30);border:1px solid #4D4D4D;z-index:999;display:none;}

</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<span id="loginResult" class="pl5 dn "></span>
		<div style="float:left;">
			<hgroup>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<!--<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>-->
			</hgroup>
		</div>
		<div class="fr pr20 loginBox">
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
					
						<input type="submit" value="Log In" class="button-primary p0" id="submitLogin" name="wp-submit">
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
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php  //wp_nav_menu( array('theme_location' => 'primary', 'menu_class' => 'nav-menu') ); ?>
		</nav>    <!-- #site-navigation -->

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image )  && (!$current_user->ID > 0) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">

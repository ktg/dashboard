<?php
/**
 * @package WordPress
 * @subpackage Dashboard
 */
$current_user = wp_get_current_user();
$user_id = isset($current_user->ID) ? $current_user->ID : 0;
if ($user_id == 0)
{
	if (!is_front_page())
	{
		wp_redirect(esc_url(home_url()));
	}
}
else
{
	if (is_front_page())
	{
		wp_redirect(esc_url(site_url('discover')));
	}
}

add_filter('show_admin_bar', '__return_false');
?>
<!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title>Dashboard</title>
	<link rel='stylesheet' href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto' type='text/css'>
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Raleway:100' type='text/css'>
	<link rel='profile' href="http://gmpg.org/xfn/11">
	<link rel='pingback' href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="header">
	<?php if ($user_id == 0): ?>
		<div id="login_section">

			<?php
			$redirect = esc_url(site_url('discover'));

			$forgot_password_link = '<a href="' . wp_lostpassword_url() . '">forgot password?</a>';
			?>

			<form method="post" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>">
				<input type="text" size="25" name="log" class="login_input" placeholder="Username">
				<input type="password" size="25" name="pwd" class="login_input" placeholder="Password">
				<input type="submit" value="Login" class="login_button" id="submitLogin" name="wp-submit">
				<input type="hidden" value="<?php echo $redirect; ?>" name="redirect_to">
				<?php echo $forgot_password_link; ?>
			</form>

		</div>
	<?php else: ?>
		<div id="logout_section">logged in as &quot;<?php echo $current_user->display_name; ?>&quot;&nbsp;
			<a href="<?php echo wp_logout_url(get_option('siteurl')) ?>" title="Logout">Logout</a>
		</div>
	<?php endif; ?>
	<div id="site_title">Dashboard</div>
	<div id="site_subtitle">{your online content all in one place}</div>
</div>

<?php if ($user_id != 0): ?>
	<div id="nav">
		<?php if (is_page('dashboard')): ?>
			<a href="<?php echo get_page_link(get_page_by_title('discover')->ID); ?>">Getting Started</a>
			<a class="active">Dashboard</a>
			<a href="<?php echo get_page_link(get_page_by_title('profile')->ID); ?>">Profile</a>
		<?php elseif (is_page('profile')): ?>
			<a href="<?php echo get_page_link(get_page_by_title('discover')->ID); ?>">Getting Started</a>
			<a href="<?php echo get_page_link(get_page_by_title('dashboard')->ID); ?>">Dashboard</a>
			<a class="active">Profile</a>
		<?php
		elseif ($post->post_parent): ?>
			<a class="active" href="<?php echo get_page_link(get_page_by_title('discover')->ID); ?>">Getting Started</a>
			<a href="<?php echo get_page_link(get_page_by_title('dashboard')->ID); ?>">Dashboard</a>
			<a href="<?php echo get_page_link(get_page_by_title('profile')->ID); ?>">Profile</a>
		<?php
		else: ?>
			<a class="active">Getting Started</a>
			<a href="<?php echo get_page_link(get_page_by_title('dashboard')->ID); ?>">Dashboard</a>
			<a href="<?php echo get_page_link(get_page_by_title('profile')->ID); ?>">Profile</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<div id="container">


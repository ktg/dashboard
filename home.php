<?php
/**
 * Template Name: home
 *
 * @package WordPress
 */

global $wpdb;
the_post();
$err = '';
$success = '';

global $wpdb, $PasswordHash;

if (isset ($_POST ['task']) && $_POST ['task'] == 'register')
{
	$pwd1 = $wpdb->escape(trim($_POST ['pwd1_reg']));
	$pwd2 = $wpdb->escape(trim($_POST ['pwd2_reg']));
	$email = $wpdb->escape(trim($_POST ['email_reg']));
	$username = $wpdb->escape(trim($_POST ['username']));

	if ($email == "" || $pwd1 == "" || $pwd2 == "" || $username == "")
	{
		$err = 'Please don\'t leave the required fields.';
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$err = 'Invalid email address.';
	}
	else if (email_exists($email))
	{
		$err = 'Email already exist.';
	}
	else if ($pwd1 != $pwd2)
	{
		$err = 'Password do not match.';
	}
	else
	{

		$user_id = wp_insert_user(array('user_pass' => apply_filters('pre_user_user_pass', $pwd1),
		                                'user_login' => apply_filters('pre_user_user_login', $username),
		                                'user_email' => apply_filters('pre_user_user_email', $email),
		                                'role' => 'subscriber'));
		if (is_wp_error($user_id))
		{
			$err = 'Error on user creation.';
		}
		else
		{
			do_action('user_register', $user_id);

			$success = 'You\'re successfully register';
			wp_set_current_user($user_ID, $current_user);

			do_action('set_current_user');
			$redirect_to = site_url('discover');

			wp_safe_redirect($redirect_to);

			exit ();
		}
	}
}

get_header('login');
?>

			<div id="signup_text">
				<h1>It's free to sign up</h1>

				<p>The Dashboard is a prototype developed by the University of Nottingham for the RCUK funded project
					'Scaling the Rural Divide'.</p>

				<p>Sign up to the Dashboard for <b>free</b> and connect your business to the world wide web.</p>
			</div>

			<div id="signup" class="signup_form">
				<form name="register" method="post">
					<div><label for="userLogin">Username</label>
					<input type="text" name="username" size="20" placeholder="Username" required="true"/></div>
					<div><label for="userEmail">Email</label>
					<input type="email" name="email_reg" size="20" placeholder="Email" required="true"/></div>
					<div><label for="userPassword">Password</label>
					<input type="password" name="pwd1_reg" required="true"/></div>
					<div><label for="userPasswordReenter">Confirm Password</label>
					<input type="password" name="pwd2_reg" required="true"/></div>

					<div class=err>
						<?php if ($success != "")
						{
							echo $success;
						} ?> <?php if ($err != "")
						{
							echo $err;
						} ?>
					</div>


					<!-- <span class="pass"> (A password will be emailed to you) </span> -->
					<!--   <input type="hidden" name="redirect_to" value="" /> -->
					<!--<button type="submit" >Sign up</button>-->
					<button type="submit" name="btnregister">Create My Account</button>
					<input type="hidden" name="task" value="register"/>

					<div class="spacer"></div>
				</form>
			</div>
<?php get_footer(); ?>
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

			<div style="text-align: center; margin-bottom: 20px;">
				<h1>It's free to sign up</h1>

				<div>The Dashboard is a prototype developed by the University of Nottingham for the RCUK funded project
					'Scaling the Rural Divide'.</div>

				<div>Sign up to the Dashboard for <b>free</b> and connect your business to the world wide web.</div>
			</div>

				<form name="register" method="post">
					<div class="field"><label class="field_name" for="userLogin">Username</label>
					<input class="field_input" type="text" name="username" size="20" placeholder="Username" required="true"/></div>
					<div class="field"><label class="field_name" for="userEmail">Email</label>
					<input class="field_input" type="email" name="email_reg" size="20" placeholder="Email" required="true"/></div>
					<div class="field"><label class="field_name" for="userPassword">Password</label>
					<input class="field_input" type="password" name="pwd1_reg" required="true"/></div>
					<div class="field"><label class="field_name" for="userPasswordReenter">Confirm Password</label>
					<input class="field_input" type="password" name="pwd2_reg" required="true"/></div>

					<div class="err">
						<?php if ($success != "")
						{
							echo $success;
						} ?> <?php if ($err != "")
						{
							echo $err;
						} ?>
					</div>

					<div class="field_submit"><button class="field_button" type="submit">Create Account</button></div>
					<input type="hidden" name="task" value="register"/>
				</form>
<?php get_footer(); ?>
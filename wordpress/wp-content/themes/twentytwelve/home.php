<?php /* Template Name: Home */
$current_user = wp_get_current_user();
$user_id = isset($current_user->ID)?$current_user->ID:0;
if($user_id >0){
	wp_redirect(esc_url( site_url('add-services')));
}
require(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php' );
$theame=get_template();
$icon_loading=site_url('wp-content/themes/'.$theame.'/images/icons/loading.gif');

if(isset($_POST['ajax_set']) && $_POST['ajax_set']==1 && isset($_POST['user_login'])){

		//We shall SQL escape all inputs
		$user_login = $wpdb->escape($_REQUEST['user_login']);
		if(empty($user_login)) {
			echo "User name should not be empty.";
			exit();
		}
		$user_email = $wpdb->escape($_REQUEST['user_email']);
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $user_email)) {
			echo "Please enter a valid email.";
			exit();
		}

		$random_password = wp_generate_password( 12, false );
		$status = wp_create_user( $user_login, $random_password, $user_email );
		if ( is_wp_error($status) )
			echo "Username already exists. Please try another one.";
		else {
			$from = get_option('admin_email');
					$headers = 'From: '.$from . "\r\n";
					$subject = "Registration successful";
					$msg = "Registration successful.\nYour login details\nUsername: $user_login\nPassword: $random_password";
					wp_mail( $user_email, $subject, $msg, $headers );
			echo "Please check your email for login details.";
		}
		exit();
		die;
}
if(isset($_POST['ajax_set']) && $_POST['ajax_set']==1 && isset($_POST['log']) && isset($_POST['pwd'])){

		//We shall SQL escape all inputs
    $username = $wpdb->escape($_REQUEST['log']);
    $password = $wpdb->escape($_REQUEST['pwd']);
    $remember = false;

    if($remember) $remember = "true";
    else $remember = "false";
    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    $login_data['remember'] = $remember;
    $user_verify = wp_signon( $login_data, false ); 
    //wp_signon is a wordpress function which authenticates a user. It accepts user info parameters as an array.

    if ( is_wp_error($user_verify) ) 
    {
       echo "Invalid username or password. Please try again!";
       exit();
     } else 
     {  
      //wp_redirect(esc_url( site_url('add-services')));
	/*echo "<script type='text/javascript'>window.location='". esc_url(site_url('add-services')) ."'</script>";*/
	echo 1;
        exit();
      }
		die;
}
get_header(); 
wp_enqueue_script("jquery");
wp_head();

?>
<div class="tbl_bordr">
	<table width="100%"cellpadding="10" cellspacing="10">
	<tr>
		<td width="60%" class="pb20 b f16">
			 Welcome
		</td>
		<?php
		if(!$current_user->ID){ ?>
			<td  width="10%">&nbsp;
					
			</td>
			<td class="pb20 b f16">
					Register
			</td>
			<?php
		}?>
	</tr>	
	<tr>
		<td>
				Welcome to the Dashboard for Scaling the Rural Enterprise. The dashboard is aimed to help small business owners to discover online tools and to teach them how to set up an online presence to help market themselves digitally. Create an account for free and create 'your own' personalised dashboard for your business. Link third-party services to your dashboard and find out which services can benefit your business the most.
		</td>
		
			<?php
				 if(!$current_user->ID){ ?>
				 <td>&nbsp;</td>
				<td>
					<div id="result" class="pb10 pl5 dn"></div>
					<form name="wp_signup_form" id="wp_signup_form" action="<?php echo esc_url( site_url('wp-login.php?action=register', 'login_post') ); ?>" method="post">
					<p>
						<label for="userLogin"><?php _e('Username:') ?> &nbsp;
						<input type="text" name="user_login" id="userLogin" class="input" value="" size="20" /></label>
					</p>
					<p class="pt10">
						<label for="userEmail">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Email:') ?>&nbsp;
						<input type="text" name="user_email" id="userEmail" class="input" value="" size="20" /></label>
					</p>
					
					<?php do_action('register_form'); ?>
						<p class="pt5 pl20" id="reg_passmail "><?php _e('A password will be emailed to you.') ?></p>
						
						<input type="hidden" name="redirect_to" value="" />
						<p class="submit pt10 pl85"><input type="submit" name="wp-submit" id="submitbtn" class="button button-primary button-large" value="<?php esc_attr_e('Register'); ?>" /></p>
					</form>
				</td>
				 <?php
				 }
			?>
		
	</tr>
	</table>
</div>
<?php get_footer(); ?>

<script type="text/javascript">
var $ = jQuery.noConflict();
$("#submitbtn").click(function() {
	$('#result').html('<img src="<?php echo $icon_loading; ?>" class="loader" />').fadeIn();
		var input_data = $('#wp_signup_form').serialize();
		input_data = input_data+'&ajax_set=1';
		$.ajax({
			type: "POST",
			url: "<?php echo site_url( 'home', 'form_post' )?>",
			data: input_data,
		}).done(function( data ) {
			$('.loader').remove();
			$('<div>').html(data).appendTo('div#result').hide().fadeIn('slow');
		});
		
		return false;
});

$("#submitLogin").click(function() {
	$('#loginResult').html('<img src="<?php echo $icon_loading; ?>" class="loader" />').fadeIn();
		var input_data = $('#loginform').serialize();
		input_data = input_data+'&ajax_set=1';
		$.ajax({
			type: "POST",
			url: "<?php echo site_url( 'home', 'form_post' )?>",
			data: input_data,
		}).done(function( data ) {
			$('.loader').remove();
			if(data==1 || data=='1'){
				window.location='<?php echo  esc_url(site_url('add-services')); ?>'
			}else{
				alert(data);
			}
			//$('<div>').html(data).appendTo('div#loginResult').hide().fadeIn('slow');
		});
		
		return false;
});
</script>

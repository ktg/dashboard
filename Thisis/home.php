<?php
/**
 * Template Name: home
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
 
$current_user = wp_get_current_user();
$user_id = isset($current_user->ID)?$current_user->ID:0;
if($user_id >0){
	wp_redirect(esc_url( site_url('discover')));
}
 
 $redirect = $_GET['redirect'];
 
global $wpdb;       
the_post();
$err = '';
$success = '';
 
global $wpdb, $PasswordHash;
 
if(isset($_POST['task']) && $_POST['task'] == 'register' ) {
    $pwd1 = $wpdb->escape(trim($_POST['pwd1_reg']));
    $pwd2 = $wpdb->escape(trim($_POST['pwd2_reg']));
    $email = $wpdb->escape(trim($_POST['email_reg']));
    $username = $wpdb->escape(trim($_POST['username']));
 
    if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "") {
        $err = 'Please don\'t leave the required fields.';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = 'Invalid email address.';
    } else if(email_exists($email) ) {
        $err = 'Email already exist.';
    } else if($pwd1 <> $pwd2 ){
        $err = 'Password do not match.';        
    } else {
 
 
        $user_id = wp_insert_user( array ('user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );
        if( is_wp_error($user_id) ) {
            $err = 'Error on user creation.';
        } else {
            do_action('user_register', $user_id);
 
 
            $success  = 'You\'re successfully register';
			 wp_set_current_user( $user_ID, $current_user );
 
			  do_action('set_current_user');
    $redirect_to = site_url('discover');
 
    wp_safe_redirect($redirect_to);
 
 
    exit();
        }        
    }    
} 
 
 
get_header( 'wide' ); 
?>



  <div id="container">
         
          <img src=<?php bloginfo('template_directory') ?>/images/homepage/homepage_logo.png  alt="Dashboard" height="68px" width="263px" />
           
       
      
          <div id="sign_up_container">
                    
                    <div id="signup_text">
                    <h1>It's free to sign up</h1>
                        <p>
						'Dashboard' is a prototype developed by the University of Nottingham for the
RCUK funded project 'Scaling the Rural Divide'. 
                        </p>
                        <p>
                        Sign up to the 'Dashboard' for <b> free </b> and connect your business to the world wide web.
                        </p>
                        </div>
                        
                        <div id="center">
							<hr />                        
                 		</div>
                 
                        <div id="signup" class"signup_form">                                  
                 
						<form name="register" method="post">
                           
                     
                                <label for="userLogin"><?php _e('Username*') ?>
                                <span class="small">Create a username</span>
                                </label>
                                <input type="text" name="username" id="username" value="" size="20" />
                                
                                <label for="userEmail"><?php _e('Email*') ?>
                                <span class="small">Add a valid email address</span>
                                </label>
                                <input type="text" name="email_reg" id="email_reg" value="" size="20"/>
                               
                                
                                
                                <label for="userPassword"><?php _e('Password*') ?>
                                <span class="small">Choose a password</span>
                                </label>
                                <input type="password" name="pwd1_reg" id="pwd1_reg" value=""/>
                                
                                <label for="userPasswordReenter"><?php _e('Confirm Password*') ?>
                                <span class="small">Re-enter password</span>
                                </label>
                                <input type="password" name="pwd2_reg" id="pwd2_reg" value=""/>
                                
                                <div class=err>
                                	<?php if($success != "") { echo $success; } ?> <?php if($err != "") { echo $err; } ?>
        						</div>

                            
                         <!-- <span class="pass"> (A password will be emailed to you) </span> -->
						<!--   <input type="hidden" name="redirect_to" value="" /> -->
                            <!--<button type="submit" >Sign up</button>-->
                            <button type="submit" name="btnregister"> Create My Account </button>
                            <input type="hidden" name="task" value="register" />
                                <div class="spacer"></div>    
                            </form>
                        </div>                                                   
  
          
         
  </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


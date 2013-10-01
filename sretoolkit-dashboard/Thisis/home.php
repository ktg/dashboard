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
	wp_redirect(esc_url( site_url('dashboard')));
}
 
 $redirect = $_GET['redirect'];
 
global $wpdb;       
the_post();
$err = '';
$success = '';
 
global $wpdb, $PasswordHash;
 
if(isset($_POST['task']) && $_POST['task'] == 'register' ) {
    $pwd1 = $wpdb->escape(trim($_POST['pwd1']));
    $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
    $email = $wpdb->escape(trim($_POST['email']));
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
    $redirect_to = site_url('dashboard');
 
    wp_safe_redirect($redirect_to);
 
 
    exit();
        }        
    }    
} 
 
 
get_header( 'wide' ); 
?>



  <div id="container">
          <div id="homepage_banner">
                <img src=<?php bloginfo('template_directory') ?>/images/homepage/banner_homepage.png  alt="Homepage banner" />
          </div>
            
            
            
          
                    
          <div id="sign_up_container">
                    <div class="business">
                        <p>
                            Sign up <b> for free </b> to 'This is' and make your business a part of your community.
                        </p>
                        
                        
                        
                 
                        <div id="signup" class"signup_form">                                  
                 
						<form name="register" method="post">
                           
                     
                                <label for="userLogin"><?php _e('Username*') ?>
                                <span class="small">Create a username</span>
                                </label>
                                <input type="text" name="username" id="username" value="" size="20" />
                                
                                <label for="userEmail"><?php _e('Email*') ?>
                                <span class="small">Add a valid email address</span>
                                </label>
                                <input type="text" name="email" id="email" value="" size="20"/>
                                
                                <label for="userPassword"><?php _e('Password*') ?>
                                <span class="small">Choose a password</span>
                                </label>
                                <input type="password" name="pwd1" id="pwd1" value=""/>
                                
                                <label for="userPasswordReenter"><?php _e('Confirm Password*') ?>
                                <span class="small">Re-enter password</span>
                                </label>
                                <input type="password" name="pwd2" id="pwd2" value=""/>
                                
                                <div class=err>
                                	<?php if($success != "") { echo $success; } ?> <?php if($err != "") { echo $err; } ?>
        						</div>



                         <!-- <span class="pass"> (A password will be emailed to you) </span> -->
						<!--   <input type="hidden" name="redirect_to" value="" /> -->
                            <!--<button type="submit" >Sign up</button>-->
                            
                            <button type="submit" name="btnregister"> Sign up </button>
                            <input type="hidden" name="task" value="register" />
                                <div class="spacer"></div>    
                            </form>
                        </div>                                                   
  
                      <!--  <p>Not sure about signing up? Take a <a href="">tour </a> to find out more. </p>  -->            
          </div>
          
          
               
          
          
          <div class="consumer">
              <p>Search for a business in a community by postcode or by your current location.</p>
              <a href=""> <img src=<?php bloginfo('template_directory') ?>/images/homepage/btn_search_postcode.png alt="search by postcode" /></a>
              <a href=""> <img src=<?php bloginfo('template_directory') ?>/images/homepage/btn_search_current.png alt="search by location" /> </a>
          </div>
  </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


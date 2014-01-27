<?php 

/**
 * Template Name: setup-online-payment
 *
 * @package WordPress
 */

$current_user = wp_get_current_user();
$user_id = isset($current_user->ID)?$current_user->ID:0;
if(!$user_id >0){
	wp_redirect(esc_url( site_url('home')));
}

add_filter( 'show_admin_bar', '__return_false' );



 if(isset($_POST['wp-submit']) && $_POST['wp-submit']=='Add to Dashboard' && $user_id > 0){
		$service_id=$_POST['service_id'];
		$service_title=$_POST['service_title'];
	
		/* Need to check what services a user has and to not allow them to add services that they already have in their dashboard */
		$us_query = $wpdb->prepare("Select * From ".$wpdb->prefix."users_services WHERE user_id= $user_id AND service_id = $service_id");
		$user_services_check = $wpdb->get_results($us_query);	
		//echo "wp-submit post loop";
		//echo " service id =  $service_id";
		//echo " user id = $user_id";
		
		if($user_services_check){
			//already got the service added into your dashboard
			//echo " You already have the service: $service_id in your dashboard!" ;
		}else{
			//add the service to your dashboard
			$query = $wpdb->prepare("
			INSERT INTO ".$wpdb->prefix."users_services 
			(service_id, user_id)
			VALUES ($service_id,$user_id)
			");
			
			?>
			<div id="notification">
			<?php echo "$service_title has been added to your dashboard"; ?>
			</div>
            <?php
		}	
		$results = $wpdb->query($query);
		//echo "the result =   $results";

        
 }

get_header(); 


$query = $wpdb->prepare("Select * From ".$wpdb->prefix."services WHERE category = 'payment'");
//$results = $wpdb->query($query);
$services = $wpdb->get_results($query);


/*Check what services a user has in their dashboard and load them */
$query = $wpdb->prepare("Select * From ".$wpdb->prefix."users_services WHERE user_id= $user_id");
$user_services = $wpdb->get_results($query);

$theme=get_template();
$image_path=site_url('wp-content/themes/'.$theme.'/images/discover/payment/');

?>

<!-- Navigation Bar -->
<div id="nav">
 <ul>
   <li class="active"><a href="">1. Getting Started</a></li>
   <li><a href="<?php echo get_page_link( get_page_by_title(dashboard)->ID ); ?>">2. Dashboard</a></li>
  
 </ul>
</div>

    <div id="default_container3">

			
              <img class="service_title" src="<?php echo $image_path; ?>title.png" />
            
       <div id="service_area">

              
              <?php
			if($services){
				foreach($services as $service){
					?> 
                    
               <form name="loginform" id="loginform" action="" method="post">
            
            <!--<div id ="service_window"> -->
                <div id="service_box">
                    <img class="service_icon" src="<?php echo $image_path.$service->list_icon ?>" />
                    <!--<h1>
                    //<?php echo $service->title;?>
                    </h1>-->
                    <p>
                    <?php echo $service->list_description; ?>
                    </p>
                    
                    <a target="_blank" href="<?php echo $service->tutorial_url; ?>">
                    	<button class="btn_service_tutorial">Tutorial </button>
                    </a>
                    
                   
                    <input type="hidden" name="service_id" id="service_id"  value='<?php echo $service->id;?>' />
                    <input type="hidden" name="service_title" id="service_title"  value='<?php echo $service->title;?>' />
                    <input type="submit" name="wp-submit" id="wp-submit" class="btn_service_add" value="Add to Dashboard" />
                    
                </div>
             
                
            <!--</div>-->
            
            
               </form> 

            
            <?php
				}
			}
				?>
            
         </div>   
        
		     
    
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

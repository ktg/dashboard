<?php 

/**
 * Template Name: services
 *
 * @package WordPress
 */

$current_user = wp_get_current_user();
$user_id = isset($current_user->ID)?$current_user->ID:0;
if(!$user_id >0){
	wp_redirect(esc_url( site_url('home')));
}
require( dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php' );
global $wpdb, $current_site, $current_user;

add_filter( 'show_admin_bar', '__return_false' );


 if(isset($_POST['wp-submit']) && $_POST['wp-submit']=='Add' && $user_id > 0){
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
			<div id="service_added_notification">
			<?php echo "$service_title has been added to your dashboard"; ?>
			</div>
            <?php
		}	
		$results = $wpdb->query($query);
		//echo "the result =   $results";

        
 }

$theme=get_template();
$list_icon_path=site_url('wp-content/themes/'.$theme.'/images/services/');

$query = $wpdb->prepare("Select * From ".$wpdb->prefix."services"); 
/*$query = $wpdb->prepare("SELECT * FROM wp_services WHERE id = %d", $id);*/
$services = $wpdb->get_results($query);


/*
$query = $wpdb->prepare("Select * From ".$wpdb->prefix."users_services WHERE user_id= $user_id");
$user_services = $wpdb->get_results($query);
*/
/*
if(isset($_POST['ajax_set']) && $_POST['ajax_set']==1 && $_POST['Action']=='added' && $_POST['service_id']>0 && $user_id >0){
	$service_id=$_POST['service_id'];
	echo $query = $wpdb->prepare("INSERT INTO ".$wpdb->prefix."users_services  WHERE user_id= $user_id AND service_id = $service_id LIMIT 1 ");
	$wpdb->query($query);
	//exit;
	//die; 
	}*/


get_header(); 
	
?>

<!-- Navigation Bar -->
<div id="nav">
 <ul>
   <li><a href="<?php echo get_page_link( get_page_by_title(dashboard)->ID ); ?>">Dashboard</a></li>
    <li><a href="<?php echo get_page_link(get_page_by_title(discover)->ID ); ?>">Discover</a></li>
   <li class="active"><a href="">Services</a></li>
  
 </ul>
</div>

    <div id="default_container">
		<div id="listofservices_container">
        
        	<div id="information_bar">
            <p> Browse through the list of suggested digital services that can help your business. Add the ones you like to your dashboard. </p>
            </div>
            
            
            <div id="list_of_services">
            	<!-- List all of the services. Retrieve the list from the database and display it dynamically e.g loop through, append "add" buttons -->
               
               
           <ul>
 
                <?php
			if($services){
				foreach($services as $service){
					?> 
            <!--      	<li> <?php echo $service->title;?> - <a href="" onclick="addService('<?php echo $service->id;?>');"> Add to Dashboard </a></li> -->


					<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'services') ); ?>" method="post">

						<li> 
                          <?php $list_icon=trim($service->list_icon); ?>
						  <img src="<?php echo $list_icon_path.$list_icon;?>" />
						  <?php echo $service->title;?> -
                          
                          <p> <?php echo $service->list_description; ?> </p>

                          <a target="_blank" href="<?php echo $service->tutorial_url; ?>">Tutorial</a>  
                          <input type="hidden" name="service_id" id="service_id"  value='<?php echo $service->id;?>' />
                          <input type="hidden" name="service_title" id="service_title"  value='<?php echo $service->title;?>' />
                          <input type="submit" name="wp-submit" id="wp-submit" value="Add" />
                        
                       </li>
                    </form> 
 
                    
					<?php
				}
			}
				?>
                
           
            </ul>
            
            </div>
        
        
		</div>
		  
		     
    
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


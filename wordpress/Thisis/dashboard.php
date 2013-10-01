<?php 

/**
 * Template Name: dashboard
 *
 * @package WordPress
 */

$current_user = wp_get_current_user();
$user_id = isset($current_user->ID)?$current_user->ID:0;
if(!$user_id >0){
	wp_redirect(esc_url( site_url('home')));
}

get_header(); 
add_filter( 'show_admin_bar', '__return_false' );


$query = $wpdb->prepare("Select * From ".$wpdb->prefix."services");
//$results = $wpdb->query($query);
$services = $wpdb->get_results($query);

/*Check what services a user has in their dashboard and load them */
$query = $wpdb->prepare("Select * From ".$wpdb->prefix."users_services WHERE user_id= $user_id");
$user_services = $wpdb->get_results($query);

$theme=get_template();
$icon_path=site_url('wp-content/themes/'.$theme.'/images/dashboard_view/service_icons/');
$service_page_path=site_url('wp-content/themes/'.$theme.'/dashboard/display_view/services/');

?>

<!-- Navigation Bar -->
<div id="nav">
 <ul>
   <li class="active"><a href="">Dashboard</a></li>
   <li><a href="<?php echo get_page_link( get_page_by_title(discover)->ID ); ?>">Discover</a></li>
  
 </ul>
</div>

    <div id="default_container">

		  <!-- Dashboard -->

		<div id="dashboard">
        
            <!-- Service Container -->
            <div id="services_container">
            
            	<!-- By default users will get a profile icon in their dashboard -->
                
                <?php
			if($user_services){
				foreach($user_services as $us){
				foreach($services as $service){
					if($us->service_id==$service->id){
						$icon_inactive=trim($service->icon_offline);
						$icon_active=trim($service->icon_online);
						//echo "icon name = " .$icon_name;					
						$icon_in=$icon_path.$icon_inactive;
						$icon_ac=$icon_path.$icon_active;
						?>
                        <!-- the onClick method will be an ajax call to load each service html page in the container window -->
                        <!-- id="iconImg" -->
                        <a href="#" id="dashboard_icon_a" onclick="return LoadIFrame('<?php echo $service->id; ?>')" cursor="pointer" text-decoration="none" border="0">
				<img class="dashboard_icon" src="<?php echo $icon_in;?>" alt="<?php echo $service->title;?>" onmouseover="this.src='<?php echo $icon_ac ?>'" onmouseout="this.src='<?php echo $icon_in ?>'" onclick="this.src='<?php echo $icon_ac ?>'" />
                        </a>
 						<?php
	
					}
				}
				}
				
			}
				?>
                
                
                
                
                                                              

                
            
            </div>
            
            
            
        	<!-- Display View -->
            <div id="display_view">
            
            <iframe id="ifr" width="494px" marginwidth="0" marginheight="0" frameborder="no" scrolling="no" style="border-width:none; background:#eaeaea; ">

			 </iframe>

            
            
            </div>
        
        
        
        </div>
		     
    
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


<script type="text/javascript">
var page=0;

function LoadIFrame(pg)
{
    var ifr;
    ifr = document.getElementById("ifr");
    ifr.style.display="block";
    if(pg == 1)
        ifr.src="<?php echo $service_page_path;?>website/service-website.html";
	else if(pg == 2)
        ifr.src="<?php echo $service_page_path;?>google_places/service-googleplaces.html";
    else if(pg == 3)
        ifr.src="<?php echo $service_page_path;?>facebook_page/service-facebook.html";
	else if(pg == 4)
        ifr.src="<?php echo $service_page_path;?>twitter/service-twitter.html";
	else if(pg == 5)
        ifr.src="<?php echo $service_page_path;?>yell/service-yell.html";
	else if(pg == 6)
        ifr.src="<?php echo $service_page_path;?>trip_advisor/service-tripadvisor.html";
	else if(pg == 7)
        ifr.src="<?php echo $service_page_path;?>youtube/service-youtube.html";
	else if(pg == 8)
	     ifr.src="<?php echo $service_page_path;?>instagram/service-instagram.html";
	else if(pg == 9)
        ifr.src="<?php echo $service_page_path;?>flickr/service-flickr.html";
	else if(pg == 10)
        ifr.src="<?php echo $service_page_path;?>ebay/service-ebay.html";
	else if(pg == 11)
        ifr.src="<?php echo $service_page_path;?>etsy/service-etsy.html";				
	page = pg;
    return false;
}


</script>
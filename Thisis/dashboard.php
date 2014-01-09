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
$dashboard_view_path=site_url('wp-content/themes/'.$theme.'/images/dashboard_view/');

?>

<!-- Navigation Bar -->
<div id="nav">
 <ul>
   <li><a href="<?php echo get_page_link( get_page_by_title(discover)->ID ); ?>">1. Getting Started</a></li>
   <li class="active"><a href="">2. Dashboard</a></li>
  
 </ul>
</div>



    <div id="default_container">


			
                
		  <!-- Dashboard -->
                   
		<div id="dashboard">
        
        <div id="turn_inside_out" >
        
        <!-- Check the users services. If google+trip advisor - load 0 otherwise load full website concept --> 
        
        <?php
        	if (count($user_services) < 4){
			?>
             <a href="#" onclick="return TurnInsideOut()"> 
             
             	<img src="<?php echo $dashboard_view_path;?>turn_into_webpage.png"/>
             
             </a>
			<?php 
			} else {
			?>	
			<a href="#" onclick="return TurnInsideOutTwice()"> 
             
             	<img src="<?php echo $dashboard_view_path;?>turn_into_webpage.png"/>
             
             </a>
			
            
			<?php
            }
			 ?>
			 
			 
			 
    	</div>
            
        
              			   	                  
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
            <div id="display_view" style="margin:0px;padding:0px;overflow:hidden">
            <!--width="494px" marginwidth="0" marginheight="0" -->
            <iframe id="ifr" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" frameborder="no" scrolling="no" style="border-width:none; background:#eaeaea; ">

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
        ifr.src="<?php echo $service_page_path;?>facebook/service-facebook.php";
	else if(pg == 4)
        ifr.src="<?php echo $service_page_path;?>twitter/connect.php";
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
	else if(pg == 12)
        ifr.src="<?php echo $service_page_path;?>paypal/service-paypal.html";
	else if(pg == 13)
        ifr.src="<?php echo $service_page_path;?>collectplus/service-collectplus.html";
	else if(pg == 14)
        ifr.src="<?php echo $service_page_path;?>email/service-email.html";	
	else if(pg == 15)
        ifr.src="<?php echo $service_page_path;?>analytics/service-analytics.html";
	else if(pg == 16)
        ifr.src="<?php echo $service_page_path;?>credly/service-credly.html";
	else if(pg == 17)
        ifr.src="<?php echo $service_page_path;?>customer_base/service-customerbase.html";
	else if(pg == 18)
        ifr.src="<?php echo $service_page_path;?>facebook_page/service-facebook_page.php";	
	page = pg;
    return false;
}


function TurnInsideOut(){
	
	var ifr;
    ifr = document.getElementById("ifr");
    ifr.style.display="block";
	ifr.src="<?php echo $service_page_path;?>dash-website/dash-website0.html";

}

function TurnInsideOutTwice(){
	
	var ifr;
    ifr = document.getElementById("ifr");
    ifr.style.display="block";
	ifr.src="<?php echo $service_page_path;?>dash-website/dash-website.html";

}


function onLoad(){
	
		
	
	
}

/*
$('.dashboard_icon').click(function(){
	reset_icons();
	var service = $(this).attr('src');
	service = 
	$(this).attr('src','active_icon');
	});
*/

</script>
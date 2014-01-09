<?php 

/**
 * Template Name: discover
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
$title_path=site_url('wp-content/themes/'.$theme.'/images/discover/');

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
   <li class="active"><a href="">1. Getting Started</a></li>
   <li><a href="<?php echo get_page_link( get_page_by_title(dashboard)->ID ); ?>">2. Dashboard</a></li>  
 </ul>
</div>

<!-- <div id="default_container2">  -->
		<div id="discover_container">
        
        <img class="discover_title" src="<?php echo $title_path; ?>title.png" />
        
        <div id="steps_container">
        
                <div id="step">
                 <a href="<?php bloginfo('url'); ?>/discover/market-your-business">
                   <img width='365px' height='53px' src="<?php echo $title_path; ?>1.png"> 
                 </a>
                 <div id="step_detail">
                     <img width='112px' height='112px' src="<?php echo $title_path; ?>10.png">
                        <p>
                       Market your business on the web and reach out to more customers. A business website can help you get noticed more. It is like having a shop window on the Internet, where customers can find you every day of the year. Also, if you are locally based, having a web presence will open your business up to new markets and customers outside your local area.
                        </p>
                        <p>
                        <a href="<?php bloginfo('url'); ?>/discover/market-your-business"><img class="learnmore_button" src="<?php echo $title_path; ?>button.png" /></a>
						</p>
                 </div>
                 
                        
                </div> 
                
                
                
                
                
                
                 <div id="step">
                 <a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>4.png"></a>
                  <div id="step_detail">
                      <img float='left' width='112px' height='112px' src="<?php echo $title_path; ?>40.png">
                        <p>
                        Your business might be a part of a community or under a head organisation, institute or company. It might even be sponsored, labelled or badged, which can give your business a higher quality of genuineness and professionalism. Learn about some of the online badging and branding services, which can give your business for customers to see.
                        </p>
                  <p>
                    <a href="<?php bloginfo('url'); ?>/discover/business-community"><img class="learnmore_button" src="<?php echo $title_path; ?>button.png" /></a>
                  </p>
                  
                  </div>
                
                </div>
                
                
                           
                <div id="step">
                 <a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>2.png"></a>
                 
                    <div id="step_detail">
                     <img float='left' width='112px' height='112px' src="<?php echo $title_path; ?>20.png">
                        <p>
                        Communication with customers is important for your business. The Internet has a range of website services, which makes communication with customers simpler. These services can help you deliver news to your customers, allow you to listen to what customers have to say and let you answer customer questions.
                        </p>
                        <p>
                        <a href="<?php bloginfo('url'); ?>/discover/communicate-with-customers"><img class="learnmore_button" src="<?php echo $title_path; ?>button.png" /></a>
						</p>
                     </div>
               
                </div>
                
                <div id="step">
                 <a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>3.png"></a>
                  <div id="step_detail"> 
                   <img float='left' width='112px' height='112px' src="<?php echo $title_path; ?>30.png">
                    <p>
                    Would you like to know who visits your website? or what your customers are most interested in? Understanding your customer base can help you run a better business and can allow you to see what areas gain you the most amount of profit. You can also get customer statistics on the website services you use.
                    </p>
                    <p>
             	       <a href="<?php bloginfo('url'); ?>/discover/know-who-your-customers-are"><img class="learnmore_button" src="<?php echo $title_path; ?>button.png" /></a>
                    </p>
                  </div>
    
                </div>
                
               
                
                <div id="step">
                 <a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>5.png"></a>
                   <div id="step_detail">
                   <img float='left' width='112px' height='112px' src="<?php echo $title_path; ?>50.png">
                    <p>
                    If your business sells items or products, you could expand your reach and have a 24-7 shop on the Internet. Popular websites such as Ebay and Etsy allow anyone to sell items on the Internet. 
                    </p>
						<p>
                      		 <a href="<?php bloginfo('url'); ?>/discover/sell-online"><img class="learnmore_button" src="<?php echo $title_path; ?>button.png" /></a>
                        </p>
                    </div>
                </div>
                
                <div id="step">
                 <a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>6.png"></a>
                   <div id="step_detail">
                   <img float='left' width='112px' height='112px' src="<?php echo $title_path; ?>60.png">
                    <p>
                    If you sell items online or want to send packages to destinations on a regular basis, you might want to take a look at some of the services that can help you do this. There are delivery services that can make it sending/receiving parcels easy. 
                    </p>
                    <p>
                     <a href="<?php bloginfo('url'); ?>/discover/send-packages"><img class="learnmore_button" src="<?php echo $title_path; ?>button.png" /></a>
                    </p>
                    </div>
                </div>
                
               
               
                <div id="step">
                 <a href=""><img width='365px' height='53px' src="<?php echo $title_path; ?>7.png"></a>
                   <div id="step_detail">
                   <img float='left' width='112px' height='112px' src="<?php echo $title_path; ?>70.png">
                    <p>
                    If you buy or sell on the Internet, you might want to think of online payment. This can be external to your bank account and can manage all of your online business transactions. 
                    </p>
                     <p>
                      <a href="<?php bloginfo('url'); ?>/discover/online-payment"><img class="learnmore_button" src="<?php echo $title_path; ?>button.png" /></a>          
                     </p>
                    </div>  
               </div>   
          
          </div> <!-- steps container -->  
      
        
        
		</div>
		  
		     
    
  <!--  </div> -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


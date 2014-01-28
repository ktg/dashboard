<?php  
/*
 * Template Name:  facebook-page
 *
 * @package WordPress
 */

//$current_user = wp_get_current_user();

echo '<html><head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link href="css/service-facebook.css" type="text/css" rel="stylesheet"/>
</head>

<body>';

/* 
echo '<p>';
echo '<h1>Facebook</h1>';
echo '</p>';*/

echo '<div id="fb-root"></div>';
echo '<div id="container">';

		echo '<div id="header">';
			echo '<img id="heading" />'; 	
		
			echo '<div id="delete">';
			echo '</div>';
			
		echo '</div>'; //end of header
		
		
		
		
//check if the user has a facebook_page url stored (wp_users_services ->url null). If they do not, then allow them to add a url..
//otherwise display the content of the facebook page
/*$query = $wpdb->prepare("Select * From ".$wpdb->prefix."users_services");
$user_services = $wpdb->get_results($query);


	if($user_services){
		foreach($user_services as $us){
			if($us->service_id=='18' && $us->url!=''){
			
					$request_url =$us->url;
					$requests = file_get_contents($request_url);
					
					$array = json_decode($requests, true);
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo $array['name'];
						echo '</p>';
					}
					if( !empty( $array ) )
					{
						echo '<p>';
						echo $array['category'];
						echo '</p>';
					}
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo $array['description'];
						echo '</p>';
					}
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo $array['location'];
						echo '</p>';
					}
					
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Visits";
						echo $array['visits'];
						echo '</p>';
					}
					
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Likes";
						echo $array['likes'];
						echo '</p>';
					}
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Talking about this";
						echo $array['talking_about_count'];
						echo '</p>';
					}		
			
			
			}
		
		}
	}
	*/
	
	//Take the URL of the Facebook Page from the User	


?>

<!--service-facebook_page_content.php-->
<form action="service-facebook_page_content.php" method="post">		
<p>Enter the NAME of your Facebook Page: <input type="text" name="pagename" id="pagename" />
</p>
<p>
(This is the name that appears after the '/' in the Facebook URL e.g www.facebook.com/<b>pagename</b>
</p>

<p><input type="submit" value="Display my Facebook Page" /></p>
</form>





<?php
/*
$request_url ="https://graph.facebook.com/CardiganProduceMarket";
$requests = file_get_contents($request_url);

$array = json_decode($requests, true);
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo $array['name'];
						echo '</p>';
					}
					if( !empty( $array ) )
					{
						echo '<p>';
						echo $array['category'];
						echo '</p>';
					}
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo $array['description'];
						echo '</p>';
					}
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo $array['location'];
						echo '</p>';
					}
					
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Visits";
						echo $array['visits'];
						echo '</p>';
					}
					
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Likes";
						echo $array['likes'];
						echo '</p>';
					}
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Talking about this";
						echo $array['talking_about_count'];
						echo '</p>';
					}		
			

*/

echo '</div>'; //end of container




echo '</body></html>';
?>





<div id="fb-root"></div>


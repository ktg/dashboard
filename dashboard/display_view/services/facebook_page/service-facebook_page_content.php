<?php  
/*
 * Template Name:  facebook-page-content
 *
 * @package WordPress
 */


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
	
	
	$pagename=$_POST['pagename'];
	$fUrl = "https://graph.facebook.com/";
	$url= $fUrl.$pagename;
	//$url = $fUrl.htmlspecialchars($_POST["pagename"]);
	//echo $url;
	
	//if( isset($result) ) echo $result;
	//else echo 'Error with URL';
	


//Get the URL of the Facebook Page and decode the json contents	
$requests = @file_get_contents($url);



if ($requests === false) {
    echo "Error fetching URL";
	echo "<p><a href=\"service-facebook_page.php\">Try Again? </a></p>";
} else {
    $array = json_decode($requests, true);
	if( !empty( $array ) )
					{
						echo '<div id=\'name_section\'>';
						echo $array['name'];
						echo '</div>';
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
						echo "Description: ";
						echo $array['description'];
						echo '</p>';
					}
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Location: ";
						
						foreach($array['location'] as $key => $value)
						{
							$street = $value->{'street'};
							echo $street;
							$city = $value->{'city'};
							echo $city;
							$country = $value->{'county'};
							echo $country;
							$postcode = $value->{'postcode'};
							echo $postcode;
						}
						
						
						echo '</p>';

					}
					
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Checkins: ";
						echo $array['checkins'];
						echo '</p>';
					}
					
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Likes: ";
						echo $array['likes'];
						echo '</p>';
					}
					
					if( !empty( $array ) )
					{
						echo '<p>';
						echo "Talking about this: ";
						echo $array['talking_about_count'];
						echo '</p>';
					}		
	
	}

					
					
			

echo '</div>'; //end of container




echo '</body></html>';
?>





<div id="fb-root"></div>


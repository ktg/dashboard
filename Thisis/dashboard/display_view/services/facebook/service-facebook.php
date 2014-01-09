<?php session_start(); 
/*
 Template Name:  facebook
 */
include('include/webzone.php');


echo '<html><head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link href="css/service-facebook.css" type="text/css" rel="stylesheet"/>
</head>

<body>';


/* 
echo '<p>';
echo '<h1>Facebook</h1>';
echo '</p>';*/
echo '<div id="container">';
		echo '<div id="header">';
			echo '<img id="heading" />'; 	
		


$f1 = new Fb_ypbox();
$f1->loadJsSDK();
$f1->load_js_functions();

$user_data = $f1->getUserData();

$_SESSION['redirect'] = $f1->currentPageURL();

if(count($user_data)>0) {
		echo '<a href="#" id="fb_box_fb_logout_btn">';
			echo '<div id="delete">';	
			echo '</div>';
		echo '</a>';
		
		echo '</div>';	//end header

		echo'<div id="content">';
			
			echo '<div id="profile_pic">';
			echo '<img src="'.$user_data['picture_large'].'" width=120px />';	//style="padding-right:10px; vertical-align:middle;
			echo '</div>';
			
			echo '<div id="about_section">';
				//display user's information
				echo '<h3>My Facebook information</h3>';
				echo '<p>';
				echo '<b>Name</b>: '.$user_data['name'].'<br>';
				echo '<b>Email</b>: '.$user_data['email'].'<br>';
				echo '<b>Profile URL</b>: <a href="'.$user_data['link'].'" target="_blank">'.$user_data['link'].'</a><br>';
				echo '<b>Username</b>: '.$user_data['username'].'<br>';
				echo '</p>';
				
				//display user's friends
				$fb_friends = $f1->get_fb_api_results(array('object'=>'me', 'connection'=>'friends'));
				$fb_friends = formatFacebookUsers($fb_friends);
				
				echo '<h3>My Facebook friends <small>(limited to 24 in this example)</small></h3>';
				$fb_friends_display = displayUsersIcons(array('users'=>$fb_friends, 'nb_display'=>24));
				echo '<p style="width:420px;">'.$fb_friends_display.'</p>';
				
				
				//display user's pages or applications
				echo '<h3>My Facebook pages and/or applications</h3>';
				echo '<p>';
				$pages = $f1->getFacebookPages();
				for($i=0; $i<count($pages); $i++) {
					echo $pages[$i]['name'].' - ';
				}
				echo '</p>';
			
			echo '</div>';			
			echo '<div id="post_section">';
			
				//update status
				echo '<form method=get action="account/post_status.php">';
				echo '<h3><b>Update my Facebook status</b></h3>';
				echo '<p><textarea id="status" name="status" style="width:360px; height:60px;"></textarea></p>';
				echo '<p><input type="submit" value="Update status" class="btn"></p>';
				echo '</form>';
			
			echo '</div>';
			
			echo '<div id="last_post">';
			//user's last status
				echo '<h3>My last Facebook status</h3>';
				echo '<p>';
				$f1 = new Fb_ypbox();
				$data = $f1->get_fb_api_results(array('object'=>$user_data['id'], 'connection'=>'posts'));
				for($i=0; $i<count($data['data']); $i++) {
					if($data['data'][$i]['message']!='') {
						$status = $data['data'][$i]['message'];
						$i=count($data['data']);
					}
				}
				echo $status.'<br>';
				echo '<small>'.$data['data'][0]['created_time'].'</small>';
				echo '</p>';
			echo '</div>';
				
			
		echo '</div>'; //end of content


}

else {
			echo '</div>'; //end header div
			echo '<div id="content">';
				echo '<p>Please click on the button below to connect with your Facebook account</p>';
				echo '<p>';
				echo '<a href="account/fb_connect.php" target="_top">Facebook connect</a>';
				//echo '<a href="account/fb_connect.php">';
				//	echo '<div id="connect_with_facebook">';
				//	echo '</div>';
				//echo '</a>';
				echo '</p>';
			echo '</div>';

}
echo '</div>'; //end of container




echo '</body></html>';
?>


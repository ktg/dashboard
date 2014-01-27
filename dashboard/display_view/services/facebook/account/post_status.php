<?php 
include('../include/webzone.php');

$status = $_GET['status'];

if($status!='') {
	$f1 = new Fb_ypbox();
	$user_data = $f1->getUserData();
	
	if(count($user_data)>0) {
		$redirect = $_SESSION['redirect'];
		unset($_SESSION['redirect']);
		if($redirect=='') $redirect = '../';
		
		$f1->updateFacebookStatus(array('message'=>$status), $user_data['token']);
		echo '<b>Your status has been posted</b><br><a href="'.$redirect.'">Click here to go back.</a>';		
	}
}

?>
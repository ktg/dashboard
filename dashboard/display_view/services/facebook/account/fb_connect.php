<?php  
//echo '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">';

//header('X-Frame-Options: GOFORIT'); 
include('../include/webzone.php');

$f1 = new Fb_ypbox();
$result = $f1->fb_connect_flow();
echo "loading..";
if($result) {
	$redirect = $_SESSION['redirect'];
	unset($_SESSION['redirect']);
	
	if($redirect!='') echo '<script>window.location="'.$redirect.'";</script>';
	else echo '<script>window.location="../";</script>';	
}
else{
	echo "error";
	}

//echo '</html>';
?>
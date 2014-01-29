<?php  
include('../include/webzone.php');

$redirect = $_SESSION['redirect'];
unset($_SESSION['redirect']);

unset($_SESSION['ygp_fb_box']);

if($redirect!='') echo '<script>window.location="'.$redirect.'";</script>';
else echo '<script>window.location="../";</script>';
?>
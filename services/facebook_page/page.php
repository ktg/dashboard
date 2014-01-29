<?php
/*
 * Template Name: facebook-page @package WordPress
 */
// $current_user = wp_get_current_user();

require 'facebook/facebook.php';

$facebook = new Facebook(array(
		'appId'  => '342794992525201',
		'secret' => 'e69e8a79972fe7330a40d8ab1d68994f',
));

// Get User ID
$user = $facebook->getUser();

?>

<html>
<head>
<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>

	<div id="fb-root"></div>
	<div id="container">

		<div id="header">
			<img id="heading" />

			<div id="delete"></div>

		</div>

	</div>
</body>
</html>
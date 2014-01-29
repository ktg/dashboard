<?php
/*
 * Template Name: facebook-page @package WordPress
 */
?>

// $current_user = wp_get_current_user();
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link href="css/service-facebook.css" type="text/css" rel="stylesheet" />
</head>

<body>

	<div id="fb-root"></div>
	<div id="container">

		<div id="header">
			<img id="heading" />

			<div id="delete"></div>

		</div>
		
		<!--service-facebook_page_content.php-->
		<form action="service-facebook_page_content.php" method="post">
			<p>
				Enter the NAME of your Facebook Page: <input type="text" name="pagename" id="pagename" />
			</p>
			<p>
				(This is the name that appears after the '/' in the Facebook URL e.g www.facebook.com/<b>pagename</b>
			</p>

			<p>
				<input type="submit" value="Display my Facebook Page" />
			</p>
		</form>

	</div>
</body>
</html>
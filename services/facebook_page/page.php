<?php
/*
 * Template Name: facebook-page
 *
 * @package WordPress
 */
session_start();

require 'facebook/facebook.php';

$app_id = '342794992525201';
$app_secret = 'e69e8a79972fe7330a40d8ab1d68994f';

$facebook = new Facebook(array(
        'appId'  => $app_id,
        'secret' => $app_secret,
        'fileUpload' => false,
        'allowSignedRequest' => false,
));

$access_token = $facebook->getAccessToken();

echo $access_token;

// Get User ID
$user = $facebook->getUser();

echo $user;

$user_profile = $facebook->api('/me','GET');

echo $user_profile;

//$ret = $facebook->api("/$user/permissions", "GET", $params);

if(!$user)
{
    $params = array(
        'scope' => 'read_stream, friends_likes, manage_pages',
        //'redirect_uri' => 'http://www.wornchaos.org/dash/dashboard/'
    );

    $loginURL = $facebook->getLoginUrl($params);
}



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

            <div>Facebook Page</div>

			<div id="delete"></div>

		</div>

        <?php
            if(!$user)
            {
                ?><div><a href="<?php echo $loginURL ?>">Login to Facebook</a></div><?php
            }
        ?>

	</div>
</body>
</html>
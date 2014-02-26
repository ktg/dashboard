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

//$access_token = $facebook->getAccessToken();
//$appsecret_proof = hash_hmac('sha256', $access_token, $app_secret);

// Get User ID
$user = $facebook->getUser();

//$facebook->api("/$user/permissions");

// TODO log user result

if(!$user)
{
    $params = array(
        'scope' => 'read_stream, friends_likes',
        //'redirect_uri' => site_url('/callback.php')
    );

    $loginURL = $facebook->getLoginUrl($params);
}



?>

<html>
<head>
<link href="css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
    if(!$user)
    {
        ?><div><a href="<?php echo $loginURL ?>">Login to Facebook</a></div><?php
    }
?>
	<div id="fb-root"></div>
	<div id="container">

		<div id="header">
			<img id="heading" />

			<div id="delete"></div>

		</div>

	</div>
</body>
</html>
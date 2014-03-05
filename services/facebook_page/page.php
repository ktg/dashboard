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
        'secret' => $app_secret
));

$user = $facebook->getUser();
?>
<div id="header">
    <div>Facebook Page</div>

    <div id="delete"></div>
</div>

<?php
    if(!$user)
    {
        $params = array(
            'scope' => 'read_stream, friends_likes, manage_pages',
            'redirect_uri' => 'http://www.wornchaos.org/dash/dashboard?page=facebook_page'
        );

        $loginURL = $facebook->getLoginUrl($params);

        ?><div><a href="<?php echo $loginURL ?>">Login to Facebook</a></div><?php
    }
    else
    {
        $user_profile = $facebook->api('/me','GET');

        print_r($user_profile);
    }
?>
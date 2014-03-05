<?php
require 'facebook/facebook.php';

$facebook = new Facebook(array(
        'appId'  => '342794992525201',
        'secret' => 'e69e8a79972fe7330a40d8ab1d68994f'
));

$user = $facebook->getUser();

echo $user;
echo $facebook->getAccessToken();
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
//            'redirect_uri' => 'http://www.wornchaos.org/dash/dashboard'
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
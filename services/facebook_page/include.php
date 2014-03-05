<?php
require 'facebook/facebook.php';

$app_id = '342794992525201';
$app_secret = 'e69e8a79972fe7330a40d8ab1d68994f';

$facebook = new Facebook(array(
        'appId'  => $app_id,
        'secret' => $app_secret
));

$user = $facebook->getUser();

echo $user;
echo $facebook->getAccessToken();
?>

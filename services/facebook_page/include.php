<?php
require 'facebook/facebook.php';

$facebook = new Facebook(array(
        'appId'  => '342794992525201',
        'secret' => 'e69e8a79972fe7330a40d8ab1d68994f'
));

$user = $facebook->getUser();

?>
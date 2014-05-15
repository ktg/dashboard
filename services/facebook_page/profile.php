<?php
require 'facebook/facebook.php';

$facebook = new Facebook(array('appId' => '342794992525201', 'secret' => 'e69e8a79972fe7330a40d8ab1d68994f'));

$icon = site_url('wp-content/themes/' . $theme . '/services/facebook_page/images/link.png');


$user = $facebook->getUser();

if (!empty($service->token))
{
	$facebook->setAccessToken($service->token);

	$user_accounts = $facebook->api('/me/accounts', 'GET');
	foreach ($user_accounts['data'] as $page)
	{
		$page_details = $facebook->api("/$page[id]");

		array_push($links, "<a href=\"$page_details[link]\"><img class=\"link_icon\" src=\"$icon\" />$page_details[name]</a>");

		$feed = $facebook->api("/$page[id]/posts");

		foreach($feed['data'] as $feed_item)
		{
			if(!empty($feed_item['message']))
			{
				$activity = array('icon' => $icon,
					'service' => 'Facebook',
					'text' => $feed_item['message'],
					'time' => new DateTime($feed_item['updated_time']),);

				array_push($activities, $activity);
			}
		}
	}
}
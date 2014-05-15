<?php
require 'twitter/twitter.php';
require 'twitter/config.php';

$icon = site_url("wp-content/themes/$theme/services/twitter/images/link.png");

$token = json_decode($service->token);
$twitter = new TwitterOAuth($API_key, $API_secret, $token->oauth_token, $token->oauth_token_secret);
$user = $twitter->get('account/verify_credentials');
if (!empty($user))
{
	array_push($links, "<a href=\"http://twitter.com/{$user->screen_name}\"><img class=\"link_icon\" src=\"$icon\" />{$user->name}</a>");

	$statuses = $twitter->get('statuses/user_timeline', array('exclude_replies'=>true, 'include_rts' => false));

	foreach($statuses as $status)
	{
		$activity = array('icon' => $icon,
			'service' => 'Twitter',
			'text' => $status->text,
			'time' => new DateTime($status->created_at));

		array_push($activities, $activity);
	}
}
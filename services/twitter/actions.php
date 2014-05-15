<?php
require 'twitter/twitter.php';
require 'twitter/config.php';

if (isset($_REQUEST['oauth_token']) && isset($_SESSION['twitter_token'])) // $_SESSION['twitter_token'] !== $_REQUEST['oauth_token'])
{
	/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
	$twitter = new TwitterOAuth($API_key, $API_secret, $_SESSION['twitter_token'], $_SESSION['twitter_token_secret']);

	/* Request access tokens from twitter */
	$access_token = $twitter->getAccessToken($_REQUEST['oauth_verifier']);

	/* If HTTP response is 200 continue otherwise send to connect page to retry */
	if (200 == $twitter->http_code)
	{
		/* Save the access tokens */
		$service->token = json_encode($access_token);
		$query = $wpdb->prepare("UPDATE $user_services_table SET token=%s WHERE id=%d", $service->token, $service->id);
		$result = $wpdb->get_results($query);

		/* Remove no longer needed request tokens */
		unset($_SESSION['twitter_token']);
		unset($_SESSION['twitter_token_secret']);
	}
}

if (empty($service->token))
{
	$twitter = new TwitterOAuth($API_key, $API_secret);
	$request_token = $twitter->getRequestToken('');

	$_SESSION['twitter_token'] = $token = $request_token['oauth_token'];
	$_SESSION['twitter_token_secret'] = $request_token['oauth_token_secret'];

	/* If last connection failed don't display authorization link. */
	switch ($twitter->http_code)
	{
		case 200:
			/* Build authorize URL and redirect user to Twitter. */
			$url = $twitter->getAuthorizeURL($token);
			$action = array('icon' => $icon,
				'service' => 'twitter',
				'title' => 'Connect the Dashboard to your Twitter',
				'desc' => 'In order for the Dashboard to help you manage your Twitter, you need to give Twitter permission for it to access your information.',
				'priority' => 10,
				'items' => "<a href=\"$url\">Connect to Twitter</a>",);

			array_push($actions, $action);
			break;
		default:
			/* Show notification if something went wrong. */
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
	}
}
else
{
	$token = json_decode($service->token);
	$twitter = new TwitterOAuth($API_key, $API_secret, $token->oauth_token, $token->oauth_token_secret);
	$user = $twitter->get('account/verify_credentials');

	if (empty($user) || !empty($user->errors))
	{
		$twitter = new TwitterOAuth($API_key, $API_secret);
		$request_token = $twitter->getRequestToken('');

		$_SESSION['twitter_token'] = $token = $request_token['oauth_token'];
		$_SESSION['twitter_token_secret'] = $request_token['oauth_token_secret'];
		$url = $twitter->getAuthorizeURL($token);
		$action = array('icon' => $icon,
			'service' => 'twitter',
			'title' => 'Connect the Dashboard to your Twitter',
			'desc' => 'In order for the Dashboard to help you manage your Twitter, you need to give Twitter permission for it to access your information.',
			'priority' => 10,
			'items' => "<a href=\"$url\">Connect to Twitter</a>",);

		array_push($actions, $action);
	}
	else
	{

		$icon = site_url('wp-content/themes/' . $theme . '/services/twitter/images/icon.png');

		if (isset($_POST['twitter_post']))
		{
			$twitter->post('statuses/update', array('status' => $_POST['twitter_post']));
			echo $twitter->http_code;
			//$twitter->send($_POST['twitter_post']);
		}

		if (!isset($user->status))
		{
			$action = array('icon' => $icon,
				'service' => 'twitter',
				'title' => "Post about PlaceBooks",
				'desc' => "Regularly post content to twitter in order to build a relationship with your customers. Keep posts as short and concise as possible and begin a dialogue with your audience by asking them a question.",
				'items' => "<form action='' method='post'><input name='twitter_post' placeholder='What have you been up to?' size='60' /><input type='submit' value='Post' /></form>",);

			array_push($actions, $action);
		}
		else
		{
			$last_post_time = time_elapsed_string($user->status->created_at);
			$action = array('icon' => $icon,
				'service' => 'twitter',
				'title' => "Post about PlaceBooks",
				'desc' => "You haven't posted in $last_post_time. Regularly post content to twitter in order to build a relationship with your customers. Keep posts as short and concise as possible and begin a dialogue with your audience by asking them a question.",
				'items' => "<form action='' method='post'><input name='twitter_post' placeholder='What have you been up to?' size='60' /><input type='submit' value='Post' /></form>",);

			array_push($actions, $action);
		}

		array_push($social, array('name' => "Twitter", 'value' => $user->followers_count, 'service' => ''));
	}
}


?>
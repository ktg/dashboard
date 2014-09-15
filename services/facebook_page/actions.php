<?php
require 'facebook_old/facebook.php';

$facebook = new Facebook(array('appId' => '342794992525201', 'secret' => 'e69e8a79972fe7330a40d8ab1d68994f'));

//FacebookSession::setDefaultApplication('342794992525201', 'e69e8a79972fe7330a40d8ab1d68994f');

$icon = site_url("wp-content/themes/$theme/services/facebook_page/images/icon.png");

$user = $facebook->getUser();
if(empty($service->token) && $user != null)
{
	$service->token = $facebook->getAccessToken();
	$query = $wpdb->prepare("UPDATE $user_services_table SET token=%s WHERE id=%d", $service->token, $service->id);
	$result = $wpdb->get_results($query);
}

if (empty($service->token))
{
	$loginURL = $facebook->getLoginUrl( array('scope' => 'read_stream, friends_likes, manage_pages, publish_actions')); //,'redirect_uri' => 'http://www.wornchaos.org/dash/dashboard'));

	$action = array('icon' => $icon,
	                'service' => 'facebook',
	                'title' => 'Connect the Dashboard to your Facebook Page',
	                'desc' => 'In order for the Dashboard to help you manage your Facebook pages, you need to give Facebook permission for it to access your information.',
	                'priority' => 10,
	                'items' => "<a href=\"$loginURL\">Connect to Facebook</a>",);

	array_push($actions, $action);
}
else
{
	try
	{
		$facebook->setAccessToken($service->token);

		if (!empty($_POST['facebook_post']))
		{
			/* make the API call */
			$response = $facebook->api(
				"/$_POST[facebook_page]/feed",
				"POST",
				array(
					'message' => $_POST['facebook_post'],
				)
			);
		}

		$user_accounts = $facebook->api('/me/accounts', 'GET');
		if (empty($user_accounts['data'])) // there are no pages
		{
			$action = array('icon' => $icon,
				'service' => 'facebook',
				'title' => 'Create a Page for Your Business',
				'desc' => 'Create a Facebook Page to build a closer relationship with your audience and customers.',
				'items' => "<a href=\"https://www.facebook.com/pages/create.php\">Create a Page</a>",);

			array_push($actions, $action);
		}
		else
		{
			foreach ($user_accounts['data'] as $page)
			{
				$page_details = $facebook->api("/" . $page['id']);

				if ($page_details['unread_message_count'] > 0)
				{
					$action = array('icon' => $icon,
						'service' => 'facebook',
						'title' => 'Reply to Messages',
						'desc' => "You have $page_details[unread_message_count] unread messages. Reply to messages to build relationships with your customers.",
						'items' => "<a href=\"https://www.facebook.com/pages/create.php\">Reply to Messages</a>",);

					array_push($actions, $action);
				}

				$post_details = $facebook->api("/$page[id]/posts");
				//$current_page = the_permalink();
				if (empty($post_details['data']))
				{
					$action = array('icon' => $icon,
						'service' => 'facebook',
						'title' => "Post about $page_details[name]",
						'desc' => "Regularly post content to Facebook in order to build a relationship with your customers. Keep posts as short and concise as possible and begin a dialogue with your audience by asking them a question.",
						'items' => "<form action='' method='post'><input type='hidden' name='facebook_page' value='$page[id]'><input name='facebook_post' placeholder='What have you been up to?' size='60' /><input type='submit' value='Post' /></form>",);

					array_push($actions, $action);
				}
				else
				{
					$last_post_create = "";
					foreach($post_details['data'] as $post)
					{
						if(array_key_exists('message', $post))
						{
							$last_post_create = $post['created_time'];
							break;
						}
					}

					if($last_post_create == "")
					{
						$action = array('icon' => $icon,
							'service' => 'facebook',
							'title' => "Post about $page_details[name]",
							'desc' => "You haven't posted to Facebook yet. Regularly post content to Facebook in order to build a relationship with your customers. Keep posts as short and concise as possible and begin a dialogue with your audience by asking them a question.",
							'items' => "<form action='' method='post'><input type='hidden' name='facebook_page' value='$page[id]'><input name='facebook_post' placeholder='What have you been up to?' size='60' /><input type='submit' value='Post' /></form>",);

						array_push($actions, $action);
					}
					else
					{
						$datetime = new DateTime($last_post_create);
						$time = time() - $datetime->getTimestamp();

						if ($time > 576000)
						{

							$last_post_time = time_elapsed_string($last_post_create);

							$action = array('icon' => $icon,
								'service' => 'facebook',
								'title' => "Post about $page_details[name]",
								'desc' => "You haven't posted in $last_post_time. Regularly post content to Facebook in order to build a relationship with your customers. Keep posts as short and concise as possible and begin a dialogue with your audience by asking them a question.",
								'items' => "<form action='' method='post'><input type='hidden' name='facebook_page' value='$page[id]'><input name='facebook_post' placeholder='What have you been up to?' size='60' /><input type='submit' value='Post' /></form>",);

							array_push($actions, $action);
						}
					}
				}

				array_push($analytics, array('name' => $page_details['name'], 'value' => $page_details['were_here_count'], 'service' => 'Facebook Page'));
				array_push($social, array('name' => "FaceBook", 'value' => $page_details['likes'], ''));
			}
		}
	}
	catch(FacebookApiException $e)
	{
		if($e->getType() == 'OAuthException')
		{
			$loginURL = $facebook->getLoginUrl(array('scope' => 'read_stream, friends_likes, manage_pages, publish_actions')); //,'redirect_uri' => 'http://www.wornchaos.org/dash/dashboard'));

			$action = array('icon' => $icon,
				'service' => 'facebook',
				'title' => 'Connect the Dashboard to your Facebook Page',
				'desc' => 'In order for the Dashboard to help you manage your Facebook pages, you need to give Facebook permission for it to access your information.',
				'priority' => 10,
				'items' => "<a href=\"$loginURL\">Connect to Facebook</a>",);

			$query = $wpdb->prepare("UPDATE $user_services_table SET token=%s WHERE id=%d", "", $service->id);
			$result = $wpdb->get_results($query);

			array_push($actions, $action);
		}
	}
}
?>
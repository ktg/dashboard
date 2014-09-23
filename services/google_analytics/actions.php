<?php

require_once 'google-api/Google_Client.php';
require_once 'google-api/contrib/Google_AnalyticsService.php';

function getResults(&$analytics, $profileId)
{
}

function printResults(&$results)
{
	if (count($results->getRows()) > 0)
	{
		$profileName = $results->getProfileInfo()->getProfileName();
		$rows = $results->getRows();
		$visits = $rows[0][0];

		print "<p>First view (profile) found: $profileName</p>";
		print "<p>Total visits: $visits</p>";
	}
	else
	{
		print '<p>No results found.</p>';
	}
}

$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE user_id=%s AND service_key=%s", $user_id, "website");
$service = $wpdb->get_results($query);
foreach($service as $website)
{
	$client = new Google_Client();
	$client->setApplicationName('Dashboard');

	$client->setClientId('177436514987-gljpkaj3j7p1nn7sd4n35natp68mua2d.apps.googleusercontent.com');
	$client->setClientSecret('PlW_sc2XG3NDCEIdDtqfOaUq');
	$client->setRedirectUri('http://www.wornchaos.org/dash/dashboard');
	$client->setScopes(array('https://www.googleapis.com/auth/analytics.readonly'));
	$client->setUseObjects(true);

	$google_analytics = new Google_AnalyticsService($client);

	if (isset($_SESSION['ga_token']))
	{
		$client->setAccessToken($_SESSION['ga_token']);
	}
	else if (isset($_GET['code']))
	{
		$client->authenticate();
		$_SESSION['ga_token'] = $client->getAccessToken();
	}

	if (!$client->getAccessToken())
	{
		$authUrl = $client->createAuthUrl();
		$action = array('icon' => $icon,
		                'service' => 'Google Analytics',
		                'title' => 'Connect the Dashboard to your Google Analytics',
		                'desc' => 'In order for the Dashboard to help you manage your analytics pages, you need to give Google permission for it to access your information.',
		                'priority' => 10,
		                'items' => "<a href=\"$authUrl\">Connect to Google Analytics</a>",);

		array_push($actions, $action);
	}
	else if(!empty($website->token))
	{
		try
		{
			$accounts = $google_analytics->management_accounts->listManagementAccounts();

			$found = false;

			foreach ($accounts->getItems() as $account)
			{
				$webproperties = $google_analytics->management_webproperties->listManagementWebproperties($account->getId());
				foreach ($webproperties->getItems() as $webProperty)
				{
					if($webProperty->getWebsiteUrl() == $website->token)
					{
						$found = true;
						$profiles = $google_analytics->management_profiles->listManagementProfiles($account->getId(), $webProperty->getId());

						foreach ($profiles->getItems() as $profile)
						{
							$results = $google_analytics->data_ga->get('ga:' . $profile->getId(), '2013-03-10', '2014-03-10', 'ga:visits');

							$profileName = $results->getProfileInfo()->getProfileName();
							$url = $webProperty->getWebsiteUrl();
							$rows = $results->getRows();
							$visits = $rows[0][0];
							if (!isset($visits))
							{
								$visits = 0;
							}

							array_push($analytics, array('name' => 'Website', 'value' => $visits, 'service' => ''));
						}
					}
				}
			}

			if(!$found)
			{
				$authUrl = $client->createAuthUrl();
				$action = array('icon' => $icon,
					'service' => 'Google Analytics',
					'title' => 'Add Google Analytics to your Website',
					'desc' => 'Create an analytics account for ' + $website->token,
					'priority' => 10,
					'items' => "<a href=\"$authUrl\">Connect to Google Analytics</a>",);

				array_push($actions, $action);
			}
		}
		catch(Google_ServiceException $e)
		{
			$action = array('icon' => $icon,
				'service' => 'Google Analytics',
				'title' => 'No Google Analytics account',
				'desc' => 'In order for the Dashboard to help you manage your analytics pages, you need to create a Google Analytics account.',
				'priority' => 10,
				'items' => "<a href=\"https://www.google.com/analytics/web/?hl=en\">Create Google Analytics Account</a>",);

			array_push($actions, $action);
		}
	}
}
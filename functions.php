<?php

add_theme_support( 'post-thumbnails' );
add_action('init', 'badge_create_post_type');
add_action('after_switch_theme', 'theme_installation');

// on action 'init', create custom post types
function badge_create_post_type()
{
	// initial Scheme type.
	register_post_type('badge',
		array(
			'label' => __('Badge'),
			'labels' => array(
				'name' => __('Badges'),
				'singular_name' => __('Badge'),
				'add_new_item' => __('Add New Badge'),
				'edit_item' => __('Edit Badge'),
				'new_item' => __('New Badge'),
				'view_item' => __('View Badge'),
				'search_item' => __('Search Badges'),
				'not_found' => __('No badge found'),
				'not_found_in_trash' => __('No badge found in Trash')
			),
			'description' => __('A badge or label that shows you recognise specific websites'),
			'public' => true,
			'menu_position' => 40, // at the top, 5=Posts
			'hierarchical' => false, // default
			'supports' => array(
				'title',
				'editor', // i.e. content
				'thumbnail', // i.e. featured image
			),
			'has_archive' => true,
		)
	);
}

function theme_installation()
{
	global $wpdb;

	$services_table = $wpdb->prefix . "services";
	$user_services_table = $wpdb->prefix . "users_services";

	$wpdb->query("CREATE TABLE IF NOT EXISTS $services_table (
			`key` varchar(255) NOT NULL,
			`title` varchar(255) NOT NULL,
			`list_description` varchar(255) NOT NULL,
			`tutorial_url` varchar(255) NOT NULL,
			`category` varchar(255) NOT NULL,
			PRIMARY KEY  (`key`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

		CREATE TABLE IF NOT EXISTS $user_services_table (
  			`id` int(11) NOT NULL auto_increment,
  			`service_key` varchar(255) NOT NULL,
  			`user_id` int(11) NOT NULL default '0',
  			`date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  			`status` tinyint(1) NOT NULL default '1',
  			`token` varchar(255) NOT NULL,
  			PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

	$services = $wpdb->query("SELECT * FROM $services_table");
	if (empty($services))
	{
		$wpdb->query("INSERT INTO $services_table (`key`, `title`, `list_description`, `tutorial_url`, `category`) VALUES
			('my_website', 'My Website', 'Add and manage your own website with the dashboard or if you have not got a website, you might be interested in viewing a tutorial on how to build one.', 'http://www.thesitewizard.com/gettingstarted/startwebsite.shtml', 'market'),
			('google_places', 'Google places', 'Google Places gets your business on Google Search, Maps, Google+ and mobile. This service is very useful for allowing customers to find you.', 'http://www.youtube.com/watch?v=S3v_EVhfPAA', 'market'),
			('facebook', 'Facebook', 'Facebook is a very popular and well used website. It allows people to create profiles and communicate with each other.', 'https://www.facebook.com/', 'communicating'),
			('twitter ', 'Twitter', 'Twitter allows fast communication with your audience through 140 characters.', 'http://www.youtube.com/watch?v=gcjvIgGGMnA', 'communicating'),
			('yell', 'Yell', 'Yell is a popular online business directory, allowing customers to search and find you through the Yell search engine.', 'http://www.yell.com/help/yourbusiness/optimise1.html', 'market'),
			('trip_advisor', 'Trip Advisor', 'Trip Advisor is a very popular service, which lists businesses by customer reviews and location. It allows customers to find, review and recommend your businesses.', 'http://www.tripadvisor.co.uk/Owners', 'market'),
			('youtube', 'Youtube', 'YouTube is the most popular video sharing service on the Internet, allowing you to upload and share videos within communities and people in the world.', 'http://www.teachertrainingvideos.com/youTube/', 'multimedia'),
			('instagram', 'Instagram', 'Instagram is a mobile application for taking and sharing photos. It is also a social network allowing you to create photo communities.', 'http://www.wikihow.com/Use-Instagram', 'multimedia'),
			('flickr', 'Flickr', 'Flickr is an online photo management and photo sharing service. It also allows you to build an online photo sharing community.', 'http://www.youtube.com/watch?v=dVeZhYhmLzc', 'multimedia'),
			('ebay', 'Ebay', 'Ebay is an e-commerce website, allowing you to sell and buy items online.', 'http://pages.ebay.com/help/account/gettingstarted.html', 'sell'),
			('etsy', 'Etsy', 'Etsy is an e-commerce website, allowing you to sell and buy hand-made and vintage items online.', 'http://www.grovo.com/etsy', 'sell'),
			('paypal', 'Paypal', 'Paypal is a quick and safe way of sending and receive money online.', 'http://www.youtube.com/watch?v=HSQ7dl8Zgrk', 'payment'),
			('collect', 'Collect+', 'Parcels made easy. Send, collect and return parcels at your local corner shop, from early ''til late, 7 days a week.', 'http://www.collectplus.co.uk', 'packages'),
			('email', 'Email', 'Email is the most popular way of sending electronic messages on the Internet. It give you a way of being reached and allows you to get in contact with businesses that are online.', 'http://dawn.thot.net/cd/1.html', 'communicating'),
			('google_analytics', 'Google Analytics', 'Google Analytics allows you to find out who looks at your web pages.', 'http://www.youtube.com/watch?v=mm78xlsADgc', 'who'),
			('credly', 'Credly', 'Credly offers a service for verifying, sharing and managing digital badges and credentials.', 'https://credly.com', 'business_community'),
			('customer_base', 'Customer Base', 'Customer base allows you to find out about your customers and who visits your online web pages. It gives you a statistical analysis of your customers for each web service that you use.', 'http://www.google.com', 'who'),
			('facebook_page', 'Facebook Page', 'A Facebook Page is for a business, organisation or brand to share their stories and connect with people. ', 'http://www.facebook.com/pages', 'communicating');");
	}

	$pages = array(
		array(
			'title' => "Dashboard",
			'template' => 'dashboard.php'
		),
		array(
			'title' => "Discover",
			'template' => 'discover.php',
			'posts' => array (
				array(
					'title' => "Business Community",
					'template' => 'services.php',
					'meta'  => array(
						'category'  =>	'business_community',
						'colour'    =>  '#d94a53'
					)
				),
				array(
					'title' => "Communicate with Customers",
					'template' => 'services.php',
					'meta'  => array (
						'category'  =>	'communicating',
						'colour'    =>  '#729a9e'
					)
				),
				array(
					'title' => 'Know Who Your Customers Are',
					'template' => 'services.php',
					'meta'  => array (
						'category'  =>	'who',
						'colour'    =>  '#548cba'
					)
				),
				array(
					'title' => "Market Your Business",
					'template' => 'services.php',
					'meta'  => array(
						'category'  =>	'market',
						'colour'    =>  '#967dab'
					)
				),
				array(
					'title' => "Online Payment",
					'template' => 'services.php',
					'meta'  => array (
						'category'  =>	'payment',
						'colour'    =>  '#6e7475'
					)
				),
				array(
					'title' => 'Sell Online',
					'template' => 'services.php',
					'meta'  => array (
						'category'  =>	'sell',
						'colour'    =>  '#ccc760'
					)
				),
				array(
					'title' => 'Send Packages',
					'template' => 'services.php',
					'meta'  => array (
						'category'  =>	'packages',
						'colour'    =>  '#d1773b'
					)
				),
			)
		),
		array(
			'title' => 'Profile',
			'template' => 'profile.php'
		)
	);

	createPages($pages);
}

function createPages($pages, $parent = 0)
{
	foreach($pages as $page)
	{
		$id = get_page_by_title($page['title']);
		if (!isset($id))
		{

			$post = array(
				'post_name'      => strtolower(str_replace(' ','-', $page['title'])),
                'post_title'     => $page['title'],
                'post_status'    => 'publish',
				'post_type'      => 'page',
                'post_author'    => 1,
                'post_parent'    => $parent,
				'page_template'  => $page['template']
			);

			$id = wp_insert_post($post);
		}

		if(array_key_exists('meta', $page))
		{
			foreach($pages['meta'] as $meta_key => $meta_value)
			{
				update_post_meta($id, $meta_key, $meta_value);
			}
		}

		if(array_key_exists('posts', $page))
		{
			createPages($page['posts'], $id);
		}
	}
}
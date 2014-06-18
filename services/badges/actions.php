<?php
$icon = site_url("wp-content/themes/$theme/services/facebook_page/images/icon.png");
$user_id = get_current_user_id();
$loop = new WP_Query(array('post_type' => 'badge'));

if (isset($_POST['action']))
{
	if ($_POST['action'] == 'add_badge' && isset($_POST['badge_name']))
	{
		$post = array(
			'comment_status' => 'closed',
			'post_author' => $user_id,
			'post_date' => date('Y-m-d H:i:s'),
			'post_status' => 'publish',
			'post_title' => $_POST['badge_name'],
			'post_type' => 'badge'
		);

		wp_insert_post($post);
	}
	else if($_POST['action'] == 'add_badge_image' && isset($_POST['badge_image_url']) && isset($_POST['badge']))
	{


		$wp_filetype = wp_check_filetype(basename($filename), null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
		// you must first include the image.php file
		// for the function wp_generate_attachment_metadata() to work
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		if (wp_update_attachment_metadata( $attach_id,  $attach_data )) {
			// set as featured image
			return update_post_meta($post_id, '_thumbnail_id', $attach_id);
		}


	}
}



while ($loop->have_posts())
{
	$loop->the_post();
	$post_ID = get_the_ID();
	$members = get_post_meta($post_ID, 'members', true);
	$owner = get_the_author_meta('ID');
	$title = get_the_title();
	$link = get_permalink();

	// Is part of badge - display on website action
	if (array_key_exists($user_id, $members))
	{
		if($members[$user_id]["status"] == "member")
		{
			$query = $wpdb->prepare("SELECT * FROM $user_services_table WHERE user_id=%s AND service_key=%s", $user_id, "website");
			$service = $wpdb->get_results($query);
			if(!empty($service))
			{
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_ID ), 'single-post-thumbnail' );

				$action = array('icon' => $icon,
					'service' => 'badge',
					'title' => "Display $title badge on your website",
					'desc' => 'Copy and paste the information below into your website.',
					'priority' => 10,
					'items' => "<textarea><a href='$link?member_id=$user_id'><img src='$image[0]'/><div>$title</div></a></textarea>");

				array_push($actions, $action);
			}
		}
	}

	if($owner == $user_id)
	{
		foreach ($members as $user => $member)
		{
			if($member['status'] == 'pending')
			{
				$business_name = get_user_meta($user, 'business_name', true);
				$action = array('icon' => $icon,
					'service' => 'badge',
					'title' => "$business_name wants to be able to use your $title badge",
					'desc' => 'In order for the Dashboard to help you manage your Facebook pages, you need to give Facebook permission for it to access your information.',
					'priority' => 10,
					'items' => "<a href=\"$link?action=accept&member_id=$user_id\">Accept $business_name</a>. <a href=\"$link?action=remove&member_id=$user_id\">Remove</a>",);

				array_push($actions, $action);
			}
		}

		if(!has_post_thumbnail())
		{
			$action = array('icon' => $icon,
				'service' => 'badge',
				'title' => "Add image to $title",
				'desc' => 'In order for the Dashboard to help you manage your Facebook pages, you need to give Facebook permission for it to access your information.',
				'priority' => 10,
				'items' => "<form action='' method='post'><input type='hidden' name='action' value='add_badge_image'><input type='hidden' name='badge' value='$post_ID'><input name='badge_image_url' /><input type='submit' value='Post' /></form>",);

			array_push($actions, $action);
		}
	}
}

$action = array('icon' => $icon,
	'service' => 'badge',
	'title' => "Create a Badge",
	'desc' => 'In order for the Dashboard to help you manage your Facebook pages, you need to give Facebook permission for it to access your information.',
	'priority' => 10,
	'items' => "<form action='' method='post'><input type='hidden' name='action' value='add_badge'><input name='badge_name' placeholder='Badge Name' size='60' /><input type='submit' value='Post' /></form>",);

array_push($actions, $action);

<?php
$icon = site_url("wp-content/themes/$theme/services/badges/images/icon.png");
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
			'post_type' => 'badge',
			'post_content' => $_POST['badge_content']
		);

		$post_id = wp_insert_post($post);

		if(isset( $_POST['badge_image_nonce'], $_FILES['badge_image']) && $_FILES['badge_image']['error'] == 0 && wp_verify_nonce( $_POST['badge_image_nonce'], 'badge_image' ))
		{
			error_log("Including " . ABSPATH . 'wp-admin/includes/admin.php');
			require_once(ABSPATH . 'wp-admin/includes/admin.php');
			$image_id = media_handle_upload('badge_image', $post_id);
			update_post_meta($post_id, '_thumbnail_id', $image_id);
		}

		$permalink = get_permalink( $post_id );

		wp_redirect( $permalink );
		exit;
	}
	else if($_POST['action'] == 'add_badge_image' && isset( $_POST['badge_image_nonce'], $_POST['badge_id'] )
		&& wp_verify_nonce( $_POST['badge_image_nonce'], 'badge_image' ))
	{
		error_log("Including " . ABSPATH . 'wp-admin/includes/admin.php');
		require_once(ABSPATH . 'wp-admin/includes/admin.php');
		$image_id = media_handle_upload('badge_image', $_POST['badge_id']);
		update_post_meta($_POST['badge_id'], '_thumbnail_id', $image_id);
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
					'desc' => 'Copy and paste the information below into your website to add this badge to your website.',
					'priority' => 10,
					'items' => "<textarea style='width:100%'><a href='$link?member_id=$user_id'><img src='$image[0]'/><div>$title</div></a></textarea>");

				array_push($actions, $action);
			}
		}
	}

	if($owner == $user_id)
	{
		foreach ($members as $user => $member)
		{
			$profile_link = get_page_link(get_page_by_title('profile')->ID);
			$badge_link = get_permalink();
			if($member['status'] == 'pending')
			{
				$business_name = get_user_meta($user, 'business_name', true);
				$action = array('icon' => $icon,
					'service' => 'badge',
					'title' => "$business_name wants to be able to use your $title badge",
					'desc' => "<a href='$profile_link?id=$user'>$business_name</a> wants to join your badge scheme, <a href='$badge_link'>$title</a>. If order for them to use it, you need to give them permission.",
					'priority' => 10,
					'items' => "<a href=\"$link?action=accept&member_id=$user\">Accept $business_name</a>. <a href=\"$link?action=remove&member_id=$user_id\">Remove</a>",);

				array_push($actions, $action);
			}
		}

		if(!has_post_thumbnail())
		{
			$nonce = wp_nonce_field( 'badge_image', 'badge_image_nonce', true, false );
			$action = array('icon' => $icon,
				'service' => 'badge',
				'title' => "Add image to $title",
				//'desc' => 'In order for the Dashboard to help you manage your Facebook pages, you need to give Facebook permission for it to access your information.',
				'priority' => 10,
				'items' => "<form action='' method='post' enctype='multipart/form-data'>$nonce<input type='hidden' name='action' value='add_badge_image'><input type='hidden' name='badge_id' value='$post_ID'><input type='file' name='badge_image' multiple='false' /><input type='submit' value='Add Image' /></form>",);

			array_push($actions, $action);
		}
	}
}

$nonce = wp_nonce_field( 'badge_image', 'badge_image_nonce', true, false );

$action = array('icon' => $icon,
	'service' => 'badge',
	'title' => "Create a Badge",
	//'desc' => 'In order for the Dashboard to help you manage your Facebook pages, you need to give Facebook permission for it to access your information.',
	'priority' => 10,
	'items' => "<form action='#' method='post' enctype='multipart/form-data'><div><input type='hidden' name='action' value='add_badge'>$nonce<input name='badge_name' placeholder='Badge Name' size='60' /></div><div><span style='font-size: 8pt;margin: 4px;color: #777;'>Badge icon</span> <input type='file' name='badge_image' multiple='false' /></div><div><input name='badge_content' placeholder='Badge Description' size='60' /></div><input type='submit' value='Post' /></form>",);

array_push($actions, $action);

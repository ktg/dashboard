<?php get_header();

$user_id = get_current_user_id();
if (isset($_GET['member_id']))
{
	$member_id = $_GET['member_id'];
}

while (have_posts()):
	the_post();
	$post_ID = get_the_ID();

	if (array_key_exists('action', $_POST) && $_POST['action'] == 'edit_badge')
	{
		wp_update_post(array(
			'ID'           => $post_ID,
			'post_title'   => $_POST['badge_title'],
			'post_content' => $_POST['badge_content']
		));

		$post_title = $_POST['badge_title'];
		$post_content = $_POST['badge_content'];

		if(isset( $_POST['badge_image_nonce'], $_FILES['badge_image']) && $_FILES['badge_image']['error'] == 0 && wp_verify_nonce( $_POST['badge_image_nonce'], 'badge_image' ))
		{
			require_once(ABSPATH . 'wp-admin/includes/admin.php');
			$image_id = media_handle_upload('badge_image', $post_ID);
			update_post_meta($post_ID, '_thumbnail_id', $image_id);
		}
	}
	else
	{
		$post_title = get_the_title();
		$post_content = get_the_content();
	}

	$owner = get_the_author_meta('ID');
	$members = get_post_meta($post_ID, 'members', true);
	if (array_key_exists('action', $_GET))
	{
		if ($_GET["action"] == "join" && $user_id != 0)
		{
			if (!$members)
			{
				$members = array();
			}

			$members[$user_id] = array('status' => 'pending');

			update_post_meta($post_ID, 'members', $members);
		}
		else if ($_GET["action"] == "accept" && isset($member_id))
		{
			if ($owner == $user_id)
			{
				$members[$member_id] = array('status' => 'member');
				update_post_meta($post_ID, 'members', $members);
			}
		}
		else if ($_GET["action"] == "remove")
		{
			if ($owner == $user_id && isset($member_id))
			{
				unset($members[$member_id]);
				update_post_meta($post_ID, 'members', $members);
			}
			else if ($user_id != 0)
			{
				unset($members[$user_id]);
				update_post_meta($post_ID, 'members', $members);
			}
		}
	}

	?>

	<article id="post-<?php echo $post_ID; ?>">
		<div style="float: left; margin-right: 10px;"><?php the_post_thumbnail(array(100, 100)); ?></div>
		<?php
		$owner_id = get_the_author_meta("ID");
		if ($owner_id == $user_id && array_key_exists('edit', $_GET) && $_GET['edit'] == 'true' && !isset($_POST['action']))
		{

			?>
			<form action="<?php the_permalink() ?>" method="post" enctype="multipart/form-data">
				<input type='hidden' name='action' value='edit_badge'>

				<div><input type="text" style="font-size: 18px; font-weight: bold" name='badge_title'
				            value="<?php echo $post_title ?>"></div>
				<div style="margin-top: 10px;">Change icon: <input type='file' name='badge_image' multiple='false' />
				</div>
				<?php
				wp_nonce_field( 'badge_image', 'badge_image_nonce' );
				wp_editor($post_content, 'badge_content');
				?>
				<input type="submit" value="Submit" />
			</form>
		<?php
		}
		else
		{
			?>
			<header style="font-size: 18px; font-weight: bold" class="entry-header"><?php echo $post_title; ?></header>
			<div class="entry-content"><?php echo $post_content; ?></div>
			<?php

			if ($owner_id == $user_id)
			{
				?>
				<div style="float: right"><a href="?edit=true">Edit</a></div>
			<?php
			}
		}
		?>
	</article>

	<div style="clear: left; padding-top:15px; padding-bottom:3px; font-size:15px">Owner</div>
	<?php
	$link = get_page_link(get_page_by_title('profile')->ID);
	$business_name = get_user_meta($owner_id, 'business_name', true);
	echo "<a href='$link?id=$owner_id'>$business_name</a>";

	if ($members)
	{
		// TODO Display member first if linked
		if (isset($member_id) && array_key_exists($user_id, $member_id))
		{

		}

		?>
		<div style="padding-top:15px; padding-bottom:3px; font-size:15px">Members</div>
		<?php

		foreach ($members as $user => $member)
		{
			$business_name = get_user_meta($user, 'business_name', true);
			echo "<div>";
			if ($member['status'] == 'pending')
			{
				echo "<a href='$link?id=$user'>$business_name</a> - Membership pending";
			}
			else
			{
				echo "<a href='$link?id=$user'>$business_name</a>";
			}

			if ($owner == $user_id)
			{
				echo " - ";
				if ($member['status'] == 'pending')
				{
					echo "<a href='?action=accept&member_id=$user'>Accept</a> ";
				}

				echo "<a href='?action=remove&member_id=$user'>Remove</a>";
			}

			echo "</div>";
		}

		if (array_key_exists($user_id, $members))
		{
			//
		}
		else if ($user_id != 0)
		{
			?><div><a href="?action=join">Join</a></div><?php
		}
	}
	else
	{
		?><div><a href="?action=join">Join</a></div><?php
	}


endwhile; ?>
<?php get_footer(); ?>
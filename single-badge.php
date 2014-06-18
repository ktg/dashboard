<?php get_header();

$user_id = get_current_user_id();
if(isset($_GET['member_id']))
{
	$member_id = $_GET['member_id'];
}

?>

<?php while (have_posts()) : the_post(); ?>
	<?php $post_ID = get_the_ID();

	$owner = get_the_author_meta('ID');
	$members = get_post_meta($post_ID, 'members', true);
	if (isset($_GET["action"]))
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

	<article id="post-<?php echo $post_ID; ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div style="float: left; margin: 10px">
				<?php the_post_thumbnail(array(100, 100)); ?>
			</div>

			<h1><?php the_title(); ?></h1>
		</header>

		<div class="entry-content"><?php the_content(); ?></div>
	</article>
	<?php
	if ($members)
	{
		// TODO Display member first if linked
		if(isset($member_id) && array_key_exists($user_id, $member_id))
		{

		}


		if (array_key_exists($user_id, $members))
		{
			//
		}
		else if ($user_id != 0)
		{
			?><a href="?action=join">Join</a><?php
		}

		?>Members

		<?php
		$link = get_page_link(get_page_by_title('profile')->ID);
		foreach ($members as $user => $member)
		{
			$business_name = get_user_meta($user, 'business_name', true);
			echo "<div>";
			if($member['status'] == 'pending')
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
	}
	else
	{
		?><a href="?action=join">Join</a><?php
	}


endwhile; ?>
<?php get_footer(); ?>
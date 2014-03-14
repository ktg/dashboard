<?php
/**
 * Template Name: communicate-with-customers
 *
 * @package WordPress
 */
add_filter('show_admin_bar', '__return_false');

include "list_services.php";

get_header();

$theme = get_template();
$image_path = site_url("wp-content/themes/$theme/");

$services = list_services($wpdb, 'communicating');
?>

<div id="discover_container">
	<img class="service_title" src="<?php echo $image_path; ?>/images/discover/communicating.png"/>

	<div class="service_list">
		<?php
		if ($services)
		{
			foreach ($services as $service)
			{
				?>
				<form name="loginform" action="" method="post">
					<div class="service_box">
						<img class="service_icon" src="<?php echo $image_path ."services/" . $service->key . "/images/discover.png"; ?>"/>
						<p>
							<?php echo $service->list_description; ?>
						</p>

						<a target="_blank" href="<?php echo $service->tutorial_url; ?>">
							<button class="btn_service_tutorial">Tutorial</button>
						</a>

						<input type="hidden" name="service_key" value='<?php echo $service->key; ?>'/>
						<input type="hidden" name="service_title" value='<?php echo $service->title; ?>'/>
						<input type="submit" name="wp-submit" id="wp-submit" class="btn_service_add"
						       value="Add to Dashboard"/>

					</div>
				</form>
			<?php
			}
		}
		?>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
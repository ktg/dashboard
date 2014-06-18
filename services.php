<?php
/**
 * Template Name: services
 *
 * @package WordPress
 */
get_header("private");

$theme = get_template();
$image_path = site_url("wp-content/themes/$theme/");

$category = get_the_title();
$colour = '#999';

$services_table = $wpdb->prefix. "services";

$metadata = get_post_custom();

if(array_key_exists('category', $metadata))
{
	$category = $metadata['category'][0];
}

if(array_key_exists('colour', $metadata))
{
	$colour = $metadata['colour'][0];
}

$query = $wpdb->prepare("SELECT * FROM $services_table WHERE category = %s", $category);
$services = $wpdb->get_results($query);
?>

	<div id="discover_container">
		<div class="service_title" style="background: <?php echo $colour; ?>;"><?php echo get_the_title(); ?></div>
		<div class="service_list">
			<?php
			if ($services)
			{
				foreach ($services as $service)
				{
					?>
					<form name="loginform" action="<?php echo get_page_link(get_page_by_title('dashboard')->ID); ?>" method="post">
						<div class="service_box">
							<img class="service_icon"
							     src="<?php echo $image_path . "services/" . $service->key . "/images/discover.png"; ?>" />

							<p>
								<?php echo $service->list_description; ?>
							</p>

							<div class="service_buttons">
								<a class="service_button" href="<?php echo $service->tutorial_url; ?>">Tutorial</a>
								<input type="hidden" name="service_key" value='<?php echo $service->key; ?>' />
								<input type="submit" class="service_button" value="Add to Dashboard" />
							</div>
						</div>
					</form>
				<?php
				}
			}
			?>
		</div>
	</div>

<?php get_footer(); ?>
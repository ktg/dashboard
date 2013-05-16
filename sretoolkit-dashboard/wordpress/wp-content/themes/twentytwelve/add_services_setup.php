<?php 
/*
 Template Name:  Add Services Setup
 */
$current_user = wp_get_current_user();
$user_id = isset($current_user->ID)?$current_user->ID:0;
if(!$user_id >0){
	wp_redirect(esc_url( site_url()));
}
require( dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php' );
get_header();		
 ?>


<div class="addSevicesContainer">
	<div class="row">
		<div class="cell fl addSevicesHeading">
			Add Services Setup
		</div>
		
		<div class="cell fr addSevicesLink">
			<a href="<?php echo esc_url( site_url('add-services'));?>">< Back to Add Services </a>
		</div>
	</div>
	<div class="row">
		
		<div class="cell fl pt50">
		<p class="b pb20">Learn how to set one up</p>
		<p>
			Need to add tutorials for each service..
			
		</p>
		</div>
	</div>
	
</div>
<?php
get_footer();
?>
	
  

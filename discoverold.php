<?php 

/**
 * Template Name: discover
 *
 * @package WordPress
 */

$current_user = wp_get_current_user();
$user_id = isset($current_user->ID)?$current_user->ID:0;
if(!$user_id >0){
	wp_redirect(esc_url( site_url('home')));
}

get_header(); 
add_filter( 'show_admin_bar', '__return_false' );

?>
<!-- Navigation Bar -->
<div id="nav">
 <ul>
   <li><a href="<?php echo get_page_link( get_page_by_title(dashboard)->ID ); ?>">Dashboard</a></li>
   <li class="active"><a href="">Discover</a></li>
  
 </ul>
</div>

    <div id="default_container">

		  <!-- Discover -->
<!--
		<div id="discover_container">
        
            <div id="information_bar">
            
                           
            </div>
            

        
        
        
        </div>
	-->	     
    
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
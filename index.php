<?php
/**
 * Template Name: index
 *
 * @package WordPress
 */
define('WP_USE_THEMES', true);

get_header(); ?>

<div id="default_container">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

                    <?php if(has_post_thumbnail()){ ?>
                <?php the_post_thumbnail('home'); ?>
            <?php } ?>

            <div id="content">
                <?php the_content(); ?>
            </div>

    <?php endwhile; // end of the loop. ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
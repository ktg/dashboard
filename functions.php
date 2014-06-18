<?php

add_theme_support( 'post-thumbnails' );
add_action('init', 'badge_create_post_type');

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
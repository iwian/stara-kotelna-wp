<?php
if ( function_exists( 'add_theme_support' ) ) {
	// Setup thumbnail support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array( 'link', 'quote' ) );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'gallery_grid', 705, 529, true );
	add_image_size( 'gallery_masonry', 705, 9999, false );
	add_image_size( 'tg_grid', 400, 400, true );
	add_image_size( 'blog', 960, 365, true );
	
	//Setup image blog classic dimensions
	$pp_blog_image_width = get_theme_mod('grandrestaurant_blog_classic_width', 960);
	$pp_blog_image_height = get_theme_mod('grandrestaurant_blog_classic_height', 500);

	$image_crop = true;
	if($pp_blog_image_height == 9999)
	{
		$image_crop = false;
	}
	add_image_size( 'grandrestaurant-blog', intval($pp_blog_image_width), intval($pp_blog_image_height), $image_crop );
	
	
	//Setup image blog grid dimensions
	$pp_blog_grid_image_width = get_theme_mod('grandrestaurant_blog_grid_width', 480);
	$pp_blog_grid_image_height = get_theme_mod('grandrestaurant_blog_grid_height', 302);

	$image_crop = true;
	if($pp_blog_grid_image_height == 9999)
	{
		$image_crop = false;
	}
	add_image_size( 'grandrestaurant-blog-grid', intval($pp_blog_grid_image_width), intval($pp_blog_grid_image_height), $image_crop );
	
	//Setup image grid dimensions
	$pp_gallery_grid_image_width = get_theme_mod('grandrestaurant_gallery_grid_width', 700);
	$pp_gallery_grid_image_height = get_theme_mod('grandrestaurant_gallery_grid_height', 466);

	$image_crop = true;
	if($pp_gallery_grid_image_height == 9999)
	{
		$image_crop = false;
	}
	add_image_size( 'grandrestaurant-gallery-grid', intval($pp_gallery_grid_image_width), intval($pp_gallery_grid_image_height), $image_crop );
	
	//Setup image masonry dimensions
	$pp_gallery_masonry_image_width = get_theme_mod('grandrestaurant_gallery_masonry_width', 440);
	$pp_gallery_masonry_image_height = get_theme_mod('grandrestaurant_gallery_masonry_height', 9999);

	$image_crop = true;
	if($pp_gallery_masonry_image_height == 9999)
	{
		$image_crop = false;
	}
	add_image_size( 'grandrestaurant-gallery-masonry', intval($pp_gallery_masonry_image_width), intval($pp_gallery_masonry_image_height), $image_crop );

	
	//Setup image grid list dimensions
	$pp_gallery_list_image_width = get_theme_mod('grandrestaurant_gallery_list_width', 610);
	$pp_gallery_list_image_height = get_theme_mod('grandrestaurant_gallery_list_height', 610);

	$image_crop = true;
	if($pp_gallery_list_image_height == 9999)
	{
		$image_crop = false;
	}
	add_image_size( 'grandrestaurant-gallery-list', intval($pp_gallery_list_image_width), intval($pp_gallery_list_image_height), $image_crop );

	add_image_size( 'grandrestaurant-album-grid', 660, 740, true );
}

add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
    	add_theme_support( 'woocommerce' );
}

add_filter('wp_get_attachment_image_attributes', 'grandrestaurant_responsive_image_fix');

function grandrestaurant_responsive_image_fix($attr) {
    if (isset($attr['sizes'])) unset($attr['sizes']);
    if (isset($attr['srcset'])) unset($attr['srcset']);
    return $attr;
}

add_filter('wp_calculate_image_sizes', '__return_false', PHP_INT_MAX);
add_filter('wp_calculate_image_srcset', '__return_false', PHP_INT_MAX);
remove_filter('the_content', 'wp_make_content_images_responsive');

/* Flush rewrite rules for custom post types. */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
?>
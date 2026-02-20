<?php

//Check if using normal or transparent header
if(is_page() OR is_single() OR (class_exists('Woocommerce') && grandrestaurant_is_woocommerce_page()))
{
	//Check if Woocommerce is installed	
	if(class_exists('Woocommerce') && grandrestaurant_is_woocommerce_page())
	{
		$current_page_id = get_option('woocommerce_shop_page_id');
		$page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);
	}
	else
	{
		$current_page_id = $post->ID;
	}	

	//Check if page
	if(is_page())
	{
		$page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);
		
		//Check if Woocommerce is installed	
		if(class_exists('Woocommerce') && grandrestaurant_is_woocommerce_page())
		{
			$shop_page_id = get_option( 'woocommerce_shop_page_id' );
			
			if(empty($shop_page_id)) 
			{
				$page_menu_transparent = 0;
			}
			else 
			{
				$page_menu_transparent = get_post_meta($shop_page_id, 'page_menu_transparent', true);
			}
		}
	}
	
	// This is a 404 not found page
	if( is_404() ) {
		$tg_pages_template_404 = get_theme_mod('tg_pages_template_404');
		
		if(!empty($tg_pages_template_404)) {
			$page_menu_transparent = get_post_meta($tg_pages_template_404, 'page_menu_transparent', true);
		}
	}
	
	//If single post page
	if(is_single() && !is_page())
	{
		$tg_blog_header_bg = get_theme_mod('tg_blog_header_bg', 1);
		
		if(!empty($tg_blog_header_bg))
		{
			$page_menu_transparent = 1;
		}
	}
	
	//If single product page
	if(function_exists('is_product') && is_product() && !is_page())
	{
		$page_menu_transparent = 0;
	}
	
	//If normal header
	if(empty($page_menu_transparent))
	{
		$grandrestaurant_header_content_default = get_post_meta($current_page_id, 'page_header', true);

		if(empty($grandrestaurant_header_content_default))
		{
			$grandrestaurant_header_content_default = get_theme_mod('grandrestaurant_header_content_default');
		}
		else
		{
			$grandrestaurant_header_content_default = $grandrestaurant_header_content_default;
		}
	}
	//if transparent header
	else
	{
		$grandrestaurant_transparent_header_content_default = get_post_meta($current_page_id, 'page_transparent_header', true);

		if(empty($grandrestaurant_transparent_header_content_default))
		{
			$grandrestaurant_header_content_default = get_theme_mod('grandrestaurant_transparent_header_content_default');
		}
		else
		{
			$grandrestaurant_header_content_default = $grandrestaurant_transparent_header_content_default;
		}
	}
}
else
{
	$page_menu_transparent = 0;
	
	//If normal header
	if(empty($page_menu_transparent))
	{
		$grandrestaurant_header_content_default = get_theme_mod('grandrestaurant_header_content_default');
	}
	//if transparent header
	else
	{
		$grandrestaurant_header_content_default = get_theme_mod('grandrestaurant_transparent_header_content_default');
	}
}

if(!empty($grandrestaurant_header_content_default))
{
	//Add Polylang plugin support
	if (function_exists('pll_get_post')) {
		$grandrestaurant_header_content_default = pll_get_post($grandrestaurant_header_content_default);
	}
	
	//Add WPML plugin support
	if (function_exists('icl_object_id')) {
		$grandrestaurant_header_content_default = icl_object_id($grandrestaurant_header_content_default, 'page', false, ICL_LANGUAGE_CODE);
	}
?>
<div id="elementor-header" class="main-menu-wrapper">
	<?php 
		if (class_exists("\\Elementor\\Plugin")) {
			echo grandrestaurant_get_elementor_content($grandrestaurant_header_content_default);
		}
	?>
</div>
<?php
}

//Check if sticky menu
$grandrestaurant_fixed_menu = get_theme_mod('tg_fixed_menu', true);

if(!empty($grandrestaurant_fixed_menu))
{
	//Check if using normal or transparent header
	if(is_page() OR is_single())
	{
		$grandrestaurant_header_content_default = get_post_meta($post->ID, 'page_sticky_header', true);
	
		if(empty($grandrestaurant_header_content_default))
		{
			$grandrestaurant_header_content_default = get_theme_mod('grandrestaurant_sticky_header_content_default');
		}
	}
	else
	{
		$grandrestaurant_header_content_default = get_theme_mod('grandrestaurant_sticky_header_content_default');
	}
	
	//Add Polylang plugin support
	if (function_exists('pll_get_post')) {
		$grandrestaurant_header_content_default = pll_get_post($grandrestaurant_header_content_default);
	}
	
	//Add WPML plugin support
	if (function_exists('icl_object_id')) {
		$grandrestaurant_header_content_default = icl_object_id($grandrestaurant_header_content_default, 'page', false, ICL_LANGUAGE_CODE);
	}
?>
<div id="elementor-sticky-header" class="main-menu-wrapper">
	<?php 
		if (class_exists("\\Elementor\\Plugin")) {
			echo grandrestaurant_get_elementor_content($grandrestaurant_header_content_default);
		}
	?>
</div>
<?php
}
?>
<?php
//Add more CURL timeout if purchase code is not registered
$is_verified_envato_purchase_code = grandrestaurant_is_registered();

//Check if registered purchase code valid
if(empty($is_verified_envato_purchase_code)) {
	add_filter('http_request_args', 'grandrestaurant_http_request_args', 100, 1);
	function grandrestaurant_http_request_args($r) 
	{
		$r['timeout'] = 30;
		return $r;
	}
	 
	add_action('http_api_curl', 'grandrestaurant_http_api_curl', 100, 1);
	function grandrestaurant_http_api_curl($handle) 
	{
		curl_setopt( $handle, CURLOPT_CONNECTTIMEOUT, 30 );
		curl_setopt( $handle, CURLOPT_TIMEOUT, 30 );
	}
}

//Prevent error when try to import demo contents
if(!DEMO_GENERATE_THUMB) {
	add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
}

add_filter('woocommerce_dropdown_variation_attribute_options_args', 'grandrestaurant_woocommerce_product_add_to_cart_text', 10, 2);
function grandrestaurant_woocommerce_product_add_to_cart_text($args){
 	$args['show_option_none'] = __( 'Options', 'woocommerce' ); 
     return $args;
}

// Hide License Tab. add to function.php
add_filter( 'mpa_use_edd_license', 'grandrestaurant_mpa_use_edd_license' );
function grandrestaurant_mpa_use_edd_license(){
  return false;
}

/**
 * This function runs when WordPress completes its upgrade process
 * It iterates through each plugin updated to see if ours is included
 * @param $upgrader_object Array
 * @param $options Array
 */
function grandrestaurant_upgrade_completed( $upgrader_object, $hook_extra ) { 
	
	if ($hook_extra['type'] = 'theme' && !THEMEDEMO) {
		//Get verified purchase code data
		$is_verified_envato_purchase_code = grandrestaurant_is_registered();
		
		//Check if registered purchase code valid
		if(!empty($is_verified_envato_purchase_code)) {
			$site_domain = grandrestaurant_get_site_domain();
			
			if($site_domain != 'localhost') {
				$url = THEMEGOODS_API.'/check-purchase-domain';
				//var_dump($url);
				$data = array(
					'purchase_code' => $is_verified_envato_purchase_code, 
					'domain' => $site_domain,
				);
				$data = wp_json_encode( $data );
				$args = array( 
					'method'   	=> 'POST',
					'body'		=> $data,
				);
				//print '<pre>'; var_dump($args); print '</pre>';
				
				$response = wp_remote_post( $url, $args );
				$response_body = wp_remote_retrieve_body( $response );
				$response_obj = json_decode($response_body);
				
				$response_json = urlencode($response_body);
				
				//If no data then unregister theme
				if(!empty($response_body)) {
					$response_body_obj = json_decode($response_body);
					
					if(!$response_body_obj->response[0]->domain) {
						
					}
					else {
						/*print '<pre>'; var_dump($response_body_obj->response[0]->domain); print '</pre>';
						die;*/
						if(!empty($response_body_obj->response[0]->domain) && $response_body_obj->response[0]->domain != $site_domain) {
							grandrestaurant_unregister_theme();
						}
					}
				}
			}
		}
	}
}
add_action( 'upgrader_process_complete', 'grandrestaurant_upgrade_completed', 10, 2 );

if(THEMEDEMO) {
	add_action( 'wp_enqueue_scripts', 'grandrestaurant_juice_cleanse', 200 );
	function grandrestaurant_juice_cleanse() {
	
		wp_dequeue_style('wp-block-library');
	
		// This also removes some inline CSS variables for colors since 5.9 - global-styles-inline-css
		wp_dequeue_style('global-styles');
	
		// WooCommerce - you can remove the following if you don't use Woocommerce
		wp_dequeue_style('wc-block-style');
		wp_dequeue_style('wc-blocks-vendors-style');
		wp_dequeue_style('wc-blocks-style'); 
	}
}

$is_verified_envato_purchase_code = false;

//Get verified purchase code data
$is_verified_envato_purchase_code = grandrestaurant_is_registered();

if($is_verified_envato_purchase_code)
{
	function grandrestaurant_import_files() {
			$theme_demos = array(
				array(
				  'import_file_name'             => 'Main Demo',
				  'categories'                 => [ 'Modern' ],
				  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo1/demo.jpg',
				  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo1/demo.xml',
				  'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo1/demo.wie',
				  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo1/demo.dat',
				  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6',
				),
				array(
				  'import_file_name'             => 'Chinese Restaurant',
				  'categories'                 => [ 'Traditional Restaurant' ],
				  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo2/demo.jpg',
				  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo2/demo.xml',
				  'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo2/demo.wie',
				  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo2/demo.dat',
				  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo2',
				),
				array(
				  'import_file_name'             => 'Healthy Food',
				  'categories'                 => [ 'Fusion Restaurant', 'Modern' ],
				  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo3/demo.jpg',
				  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo3/demo.xml',
				  'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo3/demo.wie',
				  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo3/demo.dat',
				  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo3',
				),
				array(
				  'import_file_name'             => 'Left Menu Layout',
				  'categories'                 => [ 'Fusion Restaurant', 'Modern' ],
				  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo4/demo.jpg',
				  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo4/demo.xml',
				  'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo4/demo.wie',
				  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo4/demo.dat',
				  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo4',
				),
				array(
				  'import_file_name'             => 'Cafe & Bakery',
				  'categories'                 => [ 'Fastfood' ],
				  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo5/demo.jpg',
				  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo5/demo.xml',
				  'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo5/demo.wie',
				  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo5/demo.dat',
				  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo5',
				),
				array(
				  'import_file_name'             => 'Luxury Restaurant',
				  'categories'                 => [ 'Fusion Restaurant', 'Traditional Restaurant' ],
				  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo6/demo.jpg',
				  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo6/demo.xml',
				  'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo6/demo.wie',
				  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo6/demo.dat',
				  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo6',
				),
				array(
				  'import_file_name'             => 'Italian Restaurant',
				  'categories'                 => [ 'Modern', 'Traditional Restaurant' ],
				 'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo7/demo.jpg',
				   'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo7/demo.xml',
				   'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo7/demo.wie',
				   'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo7/demo.dat',
				  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo7',
				),
				array(
					'import_file_name'             => 'Traditional Restaurant',
					'categories'                 => [ 'Traditional Restaurant' ],
					 'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo8/demo.jpg',
					'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo8/demo.xml',
					'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo8/demo.wie',
					'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo8/demo.dat',
					  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo8',
				),
				array(
					  'import_file_name'             => 'Fast Food & Burger',
					  'categories'                 => [ 'Fast Food', 'Modern' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo9/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo9/demo.xml',
					  'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo9/demo.wie',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo9/demo.dat',
					  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo9',
				),
				array(
					  'import_file_name'             => 'Asian Fusion',
					  'categories'                 => [ 'Fusion Restaurant' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo10/demo.jpg',
						'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo10/demo.xml',
						'import_widget_file_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo10/demo.wie',
						'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo10/demo.dat',
					  'preview_url'                  => 'https://themes.themegoods.com/grandrestaurantv6/demo10',
				),
				array(
					  'import_file_name'             => 'Fusion Restaurant',
					  'categories'                 => [ 'Fusion Restaurant', 'Modern' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo11/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo11/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo11/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv6-7.themegoods.com',
				),
				array(
					  'import_file_name'             => 'Clean Food',
					  'categories'                 => [ 'Fast Food', 'Modern' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo12/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo12/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo12/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv6-7.themegoods.com/clean',
				),
				array(
					  'import_file_name'             => 'Pizza Restaurant',
					  'categories'                 => [ 'Fast Food', 'Modern' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo13/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo13/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo13/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv6-7.themegoods.com/pizza',
				),
				array(
					  'import_file_name'             => 'Elegant Restaurant',
					  'categories'                 => [ 'Fusion Restaurant', 'Modern' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo14/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo14/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo14/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv6-8.themegoods.com',
				),
				array(
					  'import_file_name'             => 'Steakhouse',
					  'categories'                 => [ 'Fast Food', 'Traditional Restaurant' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo15/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo15/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo15/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv6-8.themegoods.com/steak',
				),
				array(
					  'import_file_name'             => 'Asian Restaurant',
					  'categories'                 => [ 'Traditional Restaurant' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo16/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo16/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo16/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv6-8.themegoods.com/asian',
				),
				array(
					  'import_file_name'             => 'Sushi Restaurant',
					  'categories'                 => [ 'Traditional Restaurant', 'Modern' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo17/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo17/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo17/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv7-0.themegoods.com',
				),
				array(
					  'import_file_name'             => 'Cocktail & Bar',
					  'categories'                 => [ 'Fusion Restaurant', 'Modern' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo18/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo18/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo18/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv6-8.themegoods.com/bar',
				),
				array(
					  'import_file_name'             => 'Bistro',
					  'categories'                 => [ 'Fusion Restaurant', 'Modern', 'Fast Food' ],
					  'import_preview_image_url'     => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo19/demo.jpg',
					  'import_file_url'            => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo19/demo.xml',
					  'import_customizer_file_url' => 'https://assets.themegoods.com/demo/grandrestaurant/importer/demo19/demo.dat',
					  'preview_url'                  => 'https://grandrestaurantv6-8.themegoods.com/bistro',
				),
			  );
		
			$theme_demos = array_reverse($theme_demos, true);
		
		  return $theme_demos;
		}
		add_filter( 'pt-ocdi/import_files', 'grandrestaurant_import_files' );
		
		function grandrestaurant_menu_page_removing() {
			remove_submenu_page( 'themes.php', 'tg-one-click-demo-import' );
		}
		add_action( 'admin_menu', 'grandrestaurant_menu_page_removing', 99 );
		
		function ocdi_plugin_intro_text( $default_text ) {
			$default_text .= '<div class="themegoods-demo-import-desc notice notice-warning"><p>If you have any issue regarding import demo process. Please follow instruction for workaround and support <a href="https://docs.themegoods.com/docs/grand-restaurant/demos/import-demo-issue/" target="_blank">here</a>.</p></div>';
		
			return $default_text;
		}
		add_filter( 'pt-ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );
		
		function grandrestaurant_confirmation_dialog_options ( $options ) {
			return array_merge( $options, array(
				'width'       => 300,
				'dialogClass' => 'wp-dialog',
				'resizable'   => false,
				'height'      => 'auto',
				'modal'       => true,
			) );
		}
		add_filter( 'pt-ocdi/confirmation_dialog_options', 'grandrestaurant_confirmation_dialog_options', 10, 1 );
		
		function grandrestaurant_before_widgets_import( $selected_import ) {
			// 'Hello World!' post
			wp_delete_post( 4, true );
		
			// 'Sample page' page
			wp_delete_post( 5, true );
		}
		add_action( 'pt-ocdi/before_widgets_import', 'grandrestaurant_before_widgets_import' );
		
		function grandrestaurant_after_import( $selected_import ) {
			switch($selected_import['import_file_name'])
			{
				case 'Main Demo':
					// Assign menus to their locations.
					$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
				
					set_theme_mod( 'nav_menu_locations', array(
							'primary-menu' => $main_menu->term_id,
							'side-menu' => $main_menu->term_id,
						)
					);
					
				break;
				
				case 'Steakhouse':
					// Assign menus to their locations.
					$mobile_menu = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
				
					set_theme_mod( 'nav_menu_locations', array(
							'side-menu' => $mobile_menu->term_id,
						)
					);
					
				break;
				
				case 'Chinese Restaurant':
				case 'Healthy Food':
				case 'Left Menu Layout':
				case 'Cafe & Bakery':
				case 'Luxury Restaurant':
				case 'Italian Restaurant':
				case 'Traditional Restaurant':
				case 'Asian Fusion':
				case 'Fusion Restaurant':
				case 'Clean Food':
				case 'Pizza Restaurant':
				case 'Cocktail & Bar':
					// Assign menus to their locations.
					$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
				
					set_theme_mod( 'nav_menu_locations', array(
							'primary-menu' => $main_menu->term_id,
							'side-menu' => $main_menu->term_id,
						)
					);
				
				break;
				
				default:
					wp_delete_nav_menu('Main Menu');
				break;
			}
			
			// Assign front page
			switch($selected_import['import_file_name'])
			{
				case 'Main Demo':
					$front_page_id = get_page_by_title( 'Home 1' );
				break;
				
				case 'Chinese Restaurant':
				case 'Healthy Food':
				case 'Left Menu Layout':
				case 'Cafe & Bakery':
				case 'Luxury Restaurant':
				case 'Italian Restaurant':
				case 'Traditional Restaurant':
				case 'Fast Food & Burger':
				case 'Asian Fusion':
				case 'Fusion Restaurant':
				case 'Clean Food':
				case 'Pizza Restaurant':
				case 'Elegant Restaurant':
				case 'Steakhouse':
				case 'Asian Restaurant':
				default:
					$front_page_id = get_page_by_title( 'Home' );
				break;
			}
			
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
			
			switch($selected_import['import_file_name'])
			{
				case 'Main Demo':
				case 'Pizza Restaurant':
					// Assign Woocommerce related page
					$shop_page_id = get_page_by_title( 'Shop' );
					$cart_page_id = get_page_by_title( 'Cart' );
					$checkout_page_id = get_page_by_title( 'Checkout' );
					$myaccount_page_id = get_page_by_title( 'My account' );
				break;
				
				case 'Fast Food & Burger':
					// Assign Woocommerce related page
					$shop_page_id = get_page_by_title( 'Order Online' );
					$cart_page_id = get_page_by_title( 'Cart' );
					$checkout_page_id = get_page_by_title( 'Checkout' );
					$myaccount_page_id = get_page_by_title( 'My account' );
					
				break;
			}
			
			if(isset($shop_page_id)) {
				update_option( 'woocommerce_shop_page_id', $shop_page_id->ID );
				update_option( 'woocommerce_cart_page_id', $cart_page_id->ID );
				update_option( 'woocommerce_checkout_page_id', $checkout_page_id->ID );
				update_option( 'woocommerce_myaccount_page_id', $myaccount_page_id->ID );
			}
			
			//Set permalink
			global $wp_rewrite;
			$wp_rewrite->set_permalink_structure('/%postname%/');
			
			//Set the option
			update_option( "rewrite_rules", FALSE ); 
			
			//Flush the rules and tell it to write htaccess
			$wp_rewrite->flush_rules( true );
			
			//Update all Elementor URLs
			grandrestaurant_elementor_replace_urls($selected_import['preview_url'], home_url());
			
			switch($selected_import['import_file_name'])
			{
				case 'Fusion Restaurant':
					grandrestaurant_elementor_replace_urls(home_url().'wp-content/uploads', home_url().'/wp-content/uploads');
				break;
			}
			
			switch($selected_import['import_file_name'])
			{
				case 'Chinese Restaurant':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/2', home_url().'/wp-content/uploads');
				break;
				
				case 'Healthy Food':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/3', home_url().'/wp-content/uploads');
				break;
				
				case 'Left Menu Layout':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/4', home_url().'/wp-content/uploads');
				break;
				
				case 'Cafe & Bakery':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/5', home_url().'/wp-content/uploads');
				break;
				
				case 'Luxury Restaurant':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/6', home_url().'/wp-content/uploads');
				break;
				
				case 'Italian Restaurant':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/7', home_url().'/wp-content/uploads');
				break;
				
				case 'Traditional Restaurant':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/8', home_url().'/wp-content/uploads');
				break;
				
				case 'Fast Food & Burger':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/9', home_url().'/wp-content/uploads');
				break;
				
				case 'Asian Fusion':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/10', home_url().'/wp-content/uploads');
				break;
				
				case 'Clean Food':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/2', home_url().'/wp-content/uploads');
				break;
				
				case 'Pizza Restaurant':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/3', home_url().'/wp-content/uploads');
				break;
				
				case 'Steakhouse':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/2', home_url().'/wp-content/uploads');
				break;
				
				case 'Asian Restaurant':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/3', home_url().'/wp-content/uploads');
				break;
				
				case 'Cocktail & Bar':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/2', home_url().'/wp-content/uploads');
				break;
				
				case 'Bistro':
					grandrestaurant_elementor_replace_urls(home_url().'/wp-content/uploads/sites/3', home_url().'/wp-content/uploads');
				break;
			}
			do_action( 'elementor/css-file/clear_cache' );
		}
		add_action( 'pt-ocdi/after_import', 'grandrestaurant_after_import' );
		
		function grandrestaurant_plugin_page_setup( $default_settings ) {
			$default_settings['parent_slug'] = 'themes.php';
			$default_settings['page_title']  = esc_html__( 'Demo Import' , 'kingo' );
			$default_settings['menu_title']  = esc_html__( 'Import Demo Content' , 'kingo' );
			$default_settings['capability']  = 'import';
			$default_settings['menu_slug']   = 'tg-one-click-demo-import';
		
			return $default_settings;
		}
		add_filter( 'pt-ocdi/plugin_page_setup', 'grandrestaurant_plugin_page_setup' );
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
	}
	
add_action( 'admin_init', 'grandrestaurant_gutenberg_init', 10 );

function grandrestaurant_gutenberg_init()
{
	if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
    
    global $pagenow;
    if($pagenow == 'post.php' && isset($_GET['post']))
    {
		if(current_user_can('edit_post', $_GET['post']));
		{
			if (!isset( $_GET['gutenberg-editor'] ) && (isset($_GET['action']) && $_GET['action'] == 'edit') && (function_exists( 'is_gutenberg_page' ) && !is_gutenberg_page())) {
			    // Disable Gutenberg
				add_filter( 'gutenberg_can_edit_post_type', '__return_false' );
				add_filter( 'use_block_editor_for_post_type', '__return_false' );
			}
			
			if (isset( $_GET['gutenberg-editor'] ))
			{
				if(isset($_GET['post']) && !empty($_GET['post']))
				{
					delete_post_meta($_GET['post'], 'ppb_enable');
					$ppb_enable = get_post_meta($_GET['post'], 'ppb_enable', true);
				}
			}
		
			if (isset( $_GET['classic-editor'] ))
			{
				// Disable Gutenberg
				add_filter( 'gutenberg_can_edit_post_type', '__return_false' );
				add_filter( 'use_block_editor_for_post_type', '__return_false' );
			}
			
			if (isset( $_GET['action'] ) && $_GET['action'] == 'edit' && !isset( $_GET['gutenberg-editor'] ))
			{
				$ppb_enable = get_post_meta($_GET['post'], 'ppb_enable', true);
				if(!empty($ppb_enable))
				{
					// Disable Gutenberg
					add_filter( 'gutenberg_can_edit_post_type', '__return_false' );
					add_filter( 'use_block_editor_for_post_type', '__return_false' );
				}
			}
		}
	}
}

//add_action( 'admin_footer', 'grandrestaurant_welcome_dashboard_widget' );
function grandrestaurant_welcome_dashboard_widget() {
 // Bail if not viewing the main dashboard page
 if ( get_current_screen()->base !== 'dashboard' ) {
  return;
 }
 ?>

 <div id="grandrestaurant-welcome-id" class="welcome-panel" style="display: none;">
  <div class="welcome-panel-content">
	  <div style="height:10px"></div>
   <h2>Welcome to <?php echo esc_html(THEMENAME); ?> Theme</h2>
   
   <div style="height:10px"></div>
   
   <p class="about-description">Welcome to <?php echo esc_html(THEMENAME); ?> theme. <?php echo esc_html(THEMENAME); ?> is now installed and ready to use! Please follow below steps to getting started.</p>
   
   <div style="height:20px"></div>
   
   <br style="clear:both;"/>
   
<?php

$is_verified_envato_purchase_code = false;

//Get verified purchase code data
$pp_verified_envato = get_option("pp_verified_envato");
if(!empty($pp_verified_envato))
{
	$is_verified_envato_purchase_code = true;
}

if(!$is_verified_envato_purchase_code)
{
?>
	
	<div class="tg_notice">
			<span class="dashicons dashicons-warning" style="color:#FF3B30"></span> 
			Please visit <a href="<?php echo admin_url("admin.php?page=admin.lib.php#pp_panel_registration"); ?>">Product Registration page</a> and enter a valid Envato Token to import the full <?php echo THEMENAME; ?>'s demos.
	</div>
		
	<div style="height:40px"></div>
<?php
}
?>
   
   <div class="welcome-panel-column-container">
    
    <div class="one_half">
		<div class="step_icon">
			<a href="<?php echo admin_url("themes.php?page=install-required-plugins"); ?>">
				<div class="step_number">Step <div class="int_number">1</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Install the recommended plugins</h3>
			<?php echo esc_html(THEMENAME); ?> has required and recommended plugins in order to build your website using layouts you saw on our demo site. We recommend you to install recommended plugins.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="<?php echo admin_url("admin.php?page=admin.lib.php#pp_panel_demo-content"); ?>">
				<div class="step_number">Step <div class="int_number">2</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Import the demo data</h3>
			Here you can import the demo data to your site. Doing this will make your site look like the demo site. It helps you to understand better the theme and build something similar to our demo quicker.
		</div>
	</div>
	
	<div class="one_half">
		<div class="step_icon">
			<a href="<?php echo admin_url("customize.php"); ?>">
				<div class="step_number">Step <div class="int_number">3</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Customize theme elements and options</h3>
			Start customize theme's layouts, typography, elements colors using WordPress customize and see your changes in live preview instantly.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="<?php echo admin_url("post-new.php?post_type=page"); ?>">
				<div class="step_number">Step <div class="int_number">4</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Create pages</h3>
			<?php echo esc_html(THEMENAME); ?> support standard WordPress <a href="<?php echo admin_url("post-new.php?post_type=page"); ?>">page</a> option. Theme also has <a href="<?php echo admin_url("post-new.php?post_type=galleries"); ?>">gallery</a> and <a href="<?php echo admin_url("post-new.php?post_type=menus"); ?>">food menus</a> options. You can use theme content builder to create and organise page contents.
		</div>
	</div>

	<div class="one_half">
		<div class="step_icon">
			<a href="<?php echo admin_url("nav-menus.php"); ?>">
				<div class="step_number">Step <div class="int_number">5</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Setting up navigation menu</h3>
			Once you imported demo or created your own pages. You can setup navigation menu and assign to your website main header or any other places.
		</div>
	</div>
	
	<div class="one_half last">
		<div class="step_icon">
			<a href="<?php echo admin_url("options-permalink.php"); ?>">
				<div class="step_number">Step <div class="int_number">6</div></div>
			</a>
		</div>
		<div class="step_info">
			<h3>Permalinks structure</h3>
			You can change your website permalink structure to better SEO result. Click here to setup WordPress permalink options.
		</div>
	</div>
	
	<br style="clear:both;"/>
    
   </div>
  </div>
 </div>
 <script>
  jQuery(document).ready(function($) {
   	jQuery('#welcome-panel').after($('#grandrestaurant-welcome-id').show());
  });
 </script>

<?php }

function pp_tag_cloud_filter($args = array()) {
   $args['smallest'] = 13;
   $args['largest'] = 13;
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'pp_tag_cloud_filter', 90);

//Control post excerpt length
function tg_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'tg_excerpt_length', 200 );

/**
 * Change default fields, add placeholder and change type attributes.
 *
 * @param  array $fields
 * @return array
 */
add_filter( 'comment_form_default_fields', 'grandrestaurant_comment_placeholders' );
 
function grandrestaurant_comment_placeholders( $fields )
{
    $fields['author'] = str_replace('<input', '<input placeholder="'. __('Name', 'grandrestaurant'). '"',$fields['author']);
    $fields['email'] = str_replace('<input id="email" name="email" type="text"', '<input type="email" placeholder="'.__('Email', 'grandrestaurant').'"  id="email" name="email"',$fields['email']);
    $fields['url'] = str_replace('<input id="url" name="url" type="text"', '<input placeholder="'.__('Website', 'grandrestaurant').'" id="url" name="url" type="url"',$fields['url']);

    return $fields;
}

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

//Add upload form to page
if (is_admin()) {
  $current_admin_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);

  if ($current_admin_page == 'post' || $current_admin_page == 'post-new')
  {
 
    /** Need to force the form to have the correct enctype. */
    function add_post_enctype() {
      echo "<script type=\"text/javascript\">
        jQuery(document).ready(function(){
        jQuery('#post').attr('enctype','multipart/form-data');
        jQuery('#post').attr('encoding', 'multipart/form-data');
        });
        </script>";
    }
 
    add_action('admin_head', 'add_post_enctype');
  }
}

// remove version query string from scripts and stylesheets
function wcs_remove_script_styles_version( $src ){
    return remove_query_arg( 'ver', $src );
}
add_filter( 'script_loader_src', 'wcs_remove_script_styles_version' );
add_filter( 'style_loader_src', 'wcs_remove_script_styles_version' );

add_filter('redirect_canonical','custom_disable_redirect_canonical');
function custom_disable_redirect_canonical($redirect_url) {if (is_paged() && is_singular()) $redirect_url = false; return $redirect_url; }

add_action( 'edit_form_after_title', 'grandrestaurant_content_builder_enable');

function grandrestaurant_content_builder_enable ($post) 
{
	//Check if enable content builder
	$ppb_enable = get_post_meta($post->ID, 'ppb_enable');
	$enable_builder_class = '';
	$enable_classic_builder_class = '';
	
	if(!empty($ppb_enable))
	{
		$enable_builder_class = 'hidden';
		$enable_classic_builder_class = 'visible';
	}
	
	//Check if user edit page
	$page_id = '';
	
	if (isset($_GET['action']) && $_GET['action'] == 'edit')
	{
		$page_id = $post->ID;
	}

	//Display only on page and portfolio
	if($post->post_type == 'page' OR $post->post_type == 'portfolios')
	
    echo '<a href="javascript:;" id="enable_builder" class="'.esc_attr($enable_builder_class).'" data-page-id="'.esc_attr($page_id).'">'.esc_html__('Edit in Content Builder', 'grandrestaurant' ).'</a>';
    echo '<a href="javascript:;" id="enable_classic_builder" class="'.esc_attr($enable_classic_builder_class).'">'.esc_html__('Edit in Classic Editor', 'grandrestaurant' ).'</a>';
}

add_action( 'admin_enqueue_scripts', 'grandrestaurant_admin_pointers_header' );

function grandrestaurant_admin_pointers_header() {
   if ( grandrestaurant_admin_pointers_check() ) {
      add_action( 'admin_print_footer_scripts', 'grandrestaurant_admin_pointers_footer' );

      wp_enqueue_script( 'wp-pointer' );
      wp_enqueue_style( 'wp-pointer' );
   }
}

function grandrestaurant_admin_pointers_check() {
   $admin_pointers = grandrestaurant_admin_pointers();
   foreach ( $admin_pointers as $pointer => $array ) {
      if ( $array['active'] )
         return true;
   }
}

function grandrestaurant_admin_pointers_footer() {
   $admin_pointers = grandrestaurant_admin_pointers();
   ?>
<script type="text/javascript">
/* <![CDATA[ */
( function($) {
   <?php
   foreach ( $admin_pointers as $pointer => $array ) {
      if ( $array['active'] ) {
         ?>
         $( '<?php echo $array['anchor_id']; ?>' ).pointer( {
            content: '<?php echo $array['content']; ?>',
            position: {
            edge: '<?php echo $array['edge']; ?>',
            align: '<?php echo $array['align']; ?>'
         },
            close: function() {
               $.post( ajaxurl, {
                  pointer: '<?php echo $pointer; ?>',
                  action: 'dismiss-wp-pointer'
               } );
            }
         } ).pointer( 'open' );
         <?php
      }
   }
   ?>
} )(jQuery);
/* ]]> */
</script>
   <?php
}

function grandrestaurant_admin_pointers() {
   $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
   $prefix = 'grandrestaurant_admin_pointers';

   //Page help pointers
   $content_builder_content = '<h3>Content Builder</h3>';
   $content_builder_content .= '<p>Basically you can use WordPress visual editor to create page content but theme also has another way to create page content. By using Content Builder, you would be ale to drag&drop each content block without coding knowledge. Click here to enable Content Builder.</p>';
   
   $page_options_content = '<h3>Page Options</h3>';
   $page_options_content .= '<p>You can customise various options for this page including menu styling, page templates etc.</p>';
   
   $page_featured_image_content = '<h3>Page Featured Image</h3>';
   $page_featured_image_content .= '<p>Upload or select featured image for this page to displays it as background header.</p>';
   
   //Post help pointers
   $post_options_content = '<h3>Post Options</h3>';
   $post_options_content .= '<p>You can customise various options for this post including its layout and featured content type.</p>';
   
   $post_featured_image_content = '<h3>Post Featured Image (*Required)</h3>';
   $post_featured_image_content .= '<p>Upload or select featured image for this post to displays it as post image on blog, archive, category, tag and search pages.</p>';
   
   //Gallery help pointers
   $gallery_images_content = '<h3>Gallery Images</h3>';
   $gallery_images_content .= '<p>Upload or select for this gallery. You can select multiple images to upload using SHIFT or CTRL keys.</p>';
   
   $gallery_options_content = '<h3>Gallery Options</h3>';
   $gallery_options_content .= '<p>You can customise various options for this gallery including gallery template, password and gallery images file.</p>';
   
   $gallery_featured_image_content = '<h3>Gallery Featured Image (*Required)</h3>';
   $gallery_featured_image_content .= '<p>Upload or select featured image for this gallery to displays it as gallery image on gallery archive pages. If featured image is not selected, this gallery will not display on gallery archive page.</p>';
   
   //Menus help pointers
   $food_menu_featured_image_content = '<h3>Menu Featured Image</h3>';
   $food_menu_featured_image_content .= '<p>Upload or select featured image for this portfolio to displays it as portfolio image on portfolio archive pages.</p>';
   
   //Event help pointers
   $event_options_content = '<h3>Event Options</h3>';
   $event_options_content .= '<p>You can customise various options for this event including date, time, location etc.</p>';
   
   $event_featured_image_content = '<h3>Event Featured Image</h3>';
   $event_featured_image_content .= '<p>Upload or select featured image for this event to displays it as background header and event image on event archive pages.</p>';
   
   //Testimonials help pointers
   $testimonials_options_content = '<h3>Testimonials Options</h3>';
   $testimonials_options_content .= '<p>You can customise various options for this testimonial including customer name, position, company etc.</p>';
   
   $testimonials_featured_image_content = '<h3>Testimonials Featured Image</h3>';
   $testimonials_featured_image_content .= '<p>Upload or select featured image for this testimonial to displays it as customer photo.</p>';
   
   //Client help pointers
   $clients_options_content = '<h3>Client Options</h3>';
   $clients_options_content .= '<p>You can customise various options for this client including password protected and client galleries.</p>';
   
   $clients_featured_image_content = '<h3>Client Featured Image</h3>';
   $clients_featured_image_content .= '<p>Upload or select featured image for this client to displays it as client photo.</p>';
   
   $clients_cover_image_content = '<h3>Client Cover Image</h3>';
   $clients_cover_image_content .= '<p>Upload or select cover image for this client to displays it as background header for client page.</p>';
   
   //Team Member help pointers
   $team_options_content = '<h3>Team Member Options</h3>';
   $team_options_content .= '<p>You can customise various options for this team member including position and social profiles URL.</p>';
   
   $team_featured_image_content = '<h3>Team Member Featured Image</h3>';
   $team_featured_image_content .= '<p>Upload or select featured image for this team member to displays it as team member photo.</p>';

   $tg_pointer_arr = array(
   
   	  //Page help pointers
      $prefix . '_content_builder' => array(
         'content' => $content_builder_content,
         'anchor_id' => '#enable_builder',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_content_builder', $dismissed ) )
      ),
      
      $prefix . '_page_options' => array(
         'content' => $page_options_content,
         'anchor_id' => 'body.post-type-page #page_option_page_menu_transparent',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_page_options', $dismissed ) )
      ),
      
      $prefix . '_page_featured_image' => array(
         'content' => $page_featured_image_content,
         'anchor_id' => 'body.post-type-page #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_page_featured_image', $dismissed ) )
      ),
      
      //Post help pointers
      $prefix . '_post_options' => array(
         'content' => $post_options_content,
         'anchor_id' => 'body.post-type-post #post_option_post_layout',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_post_options', $dismissed ) )
      ),
      
      $prefix . '_post_featured_image' => array(
         'content' => $post_featured_image_content,
         'anchor_id' => 'body.post-type-post #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_post_featured_image', $dismissed ) )
      ),
      
      //Gallery help pointers
      $prefix . '_gallery_images' => array(
         'content' => $gallery_images_content,
         'anchor_id' => 'body.post-type-galleries #wpsimplegallery_container',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_gallery_images', $dismissed ) )
      ),
      
      $prefix . '_gallery_options' => array(
         'content' => $gallery_options_content,
         'anchor_id' => 'body.post-type-galleries #metabox .inside',
         'edge' => 'left',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_gallery_options', $dismissed ) )
      ),
      
      $prefix . '_gallery_featured_image' => array(
         'content' => $gallery_featured_image_content,
         'anchor_id' => 'body.post-type-galleries #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_gallery_featured_image', $dismissed ) )
      ),
      
      //Menu help pointers
      $prefix . '_menus_featured_image' => array(
         'content' => $food_menu_featured_image_content,
         'anchor_id' => 'body.post-type-menus #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_menus_featured_image', $dismissed ) )
      ),
      
      //Event help pointers
      $prefix . '_event_options' => array(
         'content' => $event_options_content,
         'anchor_id' => 'body.post-type-events #metabox .inside',
         'edge' => 'left',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_event_options', $dismissed ) )
      ),
      
      $prefix . '_event_featured_image' => array(
         'content' => $event_featured_image_content,
         'anchor_id' => 'body.post-type-events #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_event_featured_image', $dismissed ) )
      ),
      
      //Testimonials help pointers
      $prefix . '_testimonials_options' => array(
         'content' => $testimonials_options_content,
         'anchor_id' => 'body.post-type-testimonials #metabox #post_option_testimonial_name',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_testimonials_options', $dismissed ) )
      ),
      
      $prefix . '_testimonials_featured_image' => array(
         'content' => $event_featured_image_content,
         'anchor_id' => 'body.post-type-testimonials #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_testimonials_featured_image', $dismissed ) )
      ),
      
      //Client help pointers
      $prefix . '_clients_options' => array(
         'content' => $clients_options_content,
         'anchor_id' => 'body.post-type-clients #metabox #post_option_client_password',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_clients_options', $dismissed ) )
      ),
      
      $prefix . '_clients_featured_image' => array(
         'content' => $event_featured_image_content,
         'anchor_id' => 'body.post-type-clients #set-post-thumbnail',
         'edge' => 'bottom',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_clients_featured_image', $dismissed ) )
      ),
      
      $prefix . '_clients_cover_image' => array(
         'content' => $clients_cover_image_content,
         'anchor_id' => 'body.post-type-clients #set-clients-cover-image-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_clients_cover_image', $dismissed ) )
      ),
      
      //Team Member help pointers
      $prefix . '_team_options' => array(
         'content' => $team_options_content,
         'anchor_id' => 'body.post-type-team #metabox #post_option_team_position',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_team_options', $dismissed ) )
      ),
      
      $prefix . '_team_featured_image' => array(
         'content' => $team_featured_image_content,
         'anchor_id' => 'body.post-type-team #set-post-thumbnail',
         'edge' => 'top',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . '_team_featured_image', $dismissed ) )
      ),
   );

   return $tg_pointer_arr;
}

add_filter( 'woocommerce_product_tabs', 'grandrestaurant_remove_product_tabs', 9999 );

function grandrestaurant_remove_product_tabs( $tabs ) {
	unset( $tabs['additional_information'] ); 
	return $tabs;
}

function grandrestaurant_create_admin_menu() {
	global $wp_admin_bar;

	$menu_id = 'grandrestaurant_admin';
	$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => esc_html__('Theme Setting', 'grandrestaurant'), 'href' => admin_url('admin.php?page=admin.lib.php')));
}
add_action('admin_bar_menu', 'grandrestaurant_create_admin_menu', 2000);

if( is_admin() ){
	add_action( 'wp_default_scripts', 'photome_default_custom_scripts' );
	function photome_default_custom_scripts( $scripts ){
		$scripts->add( 'wp-color-picker', "/wp-admin/js/color-picker.js", array( 'iris' ), false, 1 );
		did_action( 'init' ) && $scripts->localize(
			'wp-color-picker',
			'wpColorPickerL10n',
			array(
				'clear'            => __( 'Clear' ),
				'clearAriaLabel'   => __( 'Clear color' ),
				'defaultString'    => __( 'Default' ),
				'defaultAriaLabel' => __( 'Select default color' ),
				'pick'             => __( 'Select Color' ),
				'defaultLabel'     => __( 'Color value' ),
			)
		);
	}
}

//Disable Elementor getting started
add_action( 'admin_init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
	}
}, 1 );

//Allow upload custom font file
add_filter('upload_mimes', 'grandrestaurant_add_custom_upload_mimes');
function grandrestaurant_add_custom_upload_mimes($existing_mimes) 
{
  	$existing_mimes['woff'] = 'application/x-font-woff';
  	return $existing_mimes;
}

if ( ! function_exists( 'grandrestaurant_theme_kirki_update_url' ) ) {
    function grandrestaurant_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_template_directory_uri() . '/modules/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'grandrestaurant_theme_kirki_update_url' );

add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Title_Control extends Kirki_Control_Base {
		public $type = 'title';
		public function render_content() { 
			echo esc_html($this->label);
		}
	}
	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['title'] = 'Kirki_Controls_Title_Control';
		return $controls;
	} );

} );

function grandrestaurant_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	 
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'grandrestaurant_imagelink_setup', 10);

function grandrestaurant_body_class_names($classes) 
{
	$tg_lightbox_color_scheme = get_theme_mod('tg_lightbox_color_scheme', 'black');
	
	if(!empty($tg_lightbox_color_scheme))
	{
		$classes[] = esc_attr('tg_lightbox_'.$tg_lightbox_color_scheme);
	}
	
	$grandrestaurant_fullmenu_effect = get_theme_mod('grandrestaurant_fullmenu_effect', '');
	if(!empty($grandrestaurant_fullmenu_effect))
	{
		$classes[] = esc_attr('fullmenu-effect-'.$grandrestaurant_fullmenu_effect);
	}

	return $classes;
}

//Now add test class to the filter
add_filter('body_class','grandrestaurant_body_class_names');

if(THEMEDEMO) {
	add_action( 'wp', 'grandrestaurant_remove_lightbox', 99 );	 	 
	function grandrestaurant_remove_lightbox() {	 	 
   	remove_theme_support( 'wc-product-gallery-lightbox' );	 	 
	}
}
?>
<?php
include_once (get_template_directory() . "/modules/class-tgm-plugin-activation.php");
add_action( 'tgmpa_register', 'tg_require_plugins' );
 
function tg_require_plugins() {
 
    $plugins = array(
	    array(
	        'name'               => 'Grand Restaurant Theme Custom Post Type',
	        'slug'               => 'grandrestaurant-custom-post',
	        'source'             => 'https://themegoods-assets.b-cdn.net/grandrestaurant-custom-post/grandrestaurant-custom-post-v3.8.6.zip',
	        'required'           => true, 
	        'version'            => '3.8.6',
	    ),
	    array(
	        'name'               => 'Grand Restaurant Theme Elements for Elementor',
	        'slug'               => 'grandrestaurant-elementor',
	        'source'             => 'https://themegoods-assets.b-cdn.net/grandrestaurant-elementor/grandrestaurant-elementor-v2.1.2.zip',
	        'required'           => true, 
	        'version'            => '2.1.2',
	    ),
	    array(
	        'name'      		 => 'Elementor Page Builder',
	        'slug'      		 => 'elementor',
	        'required'  		 => true, 
	    ),
		array(
			'name'      		 => 'Advanced Product Fields (Product Addons) for WooCommerce',
			'slug'      		 => 'advanced-product-fields-for-woocommerce',
			'required'  		 => true, 
		),
	    array(
	        'name'               => 'One Click Demo Import',
	        'slug'      		 => 'one-click-demo-import',
	        'required'           => true, 
	    ),
	    array(
			'name'               => 'Revolution Slider',
			'slug'               => 'revslider',
			'source'             => 'https://themegoods-assets.b-cdn.net/revslider/revslider-v6.7.37.zip',
			'required'           => false, 
			'version'            => '6.7.37',
		),
		array(
			'name'               => 'WordPress Appointment Booking Plugin',
			'slug'      		 => 'motopress-appointment-lite',
			'required'           => false, 
		),
		/*array(
			'name'               => 'Appointment Booking',
			'slug'      		 => 'motopress-appointment',
			'source'             => 'https://themegoods-assets.b-cdn.net/motopress-appointment/motopress-appointment-v2.1.2.zip',
			'required'           => true, 
			'version'            => '2.1.2',
		),
		array(
			'name'               => 'Appointment Booking Checkout Fields',
			'slug'      		 => 'mpa-checkout-fields',
			'source'             => 'https://themegoods-assets.b-cdn.net/mpa-checkout-fields/mpa-checkout-fields-v1.1.1.zip',
			'required'           => false, 
			'version'            => '1.1.1',
		),
		array(
			'name'               => 'Appointment Booking PDF Invoices',
			'slug'      		 => 'mpa-invoices',
			'source'             => 'https://themegoods-assets.b-cdn.net/mpa-invoices/mpa-invoices-v1.0.1.zip',
			'required'           => false, 
			'version'            => '1.0.1',
		),
		array(
			'name'               => 'Appointment Booking WooCommerce Payments',
			'slug'      		 => 'mpa-woocommerce',
			'source'             => 'https://themegoods-assets.b-cdn.net/mpa-woocommerce/mpa-woocommerce-v1.2.0.zip',
			'required'           => false, 
			'version'            => '1.2.0',
		),
		array(
			'name'               => 'Google Analytics for Appointment Booking',
			'slug'      		 => 'mpa-google-analytics',
			'source'             => 'https://themegoods-assets.b-cdn.net/mpa-google-analytics/mpa-google-analytics-v1.0.1.zip',
			'required'           => false, 
			'version'            => '1.0.1',
		),
		array(
			'name'               => 'Appointment Booking Twilio SMS',
			'slug'      		 => 'mpa-twilio-sms',
			'source'             => 'https://themegoods-assets.b-cdn.net/mpa-twilio-sms/mpa-twilio-sms-v1.0.0.zip',
			'required'           => false, 
			'version'            => '1.0.0',
		),
		array(
			'name'               => 'Square Payments for Appointment Booking',
			'slug'      		 => 'mpa-square-payments',
			'source'             => 'https://themegoods-assets.b-cdn.net/mpa-square-payments/mpa-square-payments-v1.0.1.zip',
			'required'           => false, 
			'version'            => '1.0.1',
		),*/
	    array(
			'name'               => 'Envato Market',
			'slug'               => 'envato-market',
			'source'             => 'https://themegoods-assets.b-cdn.net/envato-market/envato-market-v2.0.12.zip',
			'required'           => true, 
			'version'            => '2.0.12',
		),
	    array(
	        'name'      => 'Custom Fonts',
	        'slug'      => 'custom-fonts',
	        'required'  => true, 
	    ),
	    array(
	        'name'      => 'Contact Form 7',
	        'slug'      => 'contact-form-7',
	        'required'  => true, 
	    ),
	    array(
	        'name'      => 'MailChimp for WordPress',
	        'slug'      => 'mailchimp-for-wp',
	        'required'  => false, 
	    ),
	    array(
	        'name'      => 'Woocommerce',
	        'slug'      => 'woocommerce',
	        'required'  => false, 
	    ),
	    array(
	        'name'      => 'LoftLoader',
	        'slug'      => 'loftloader',
	        'required'  => false, 
	    ),
	    array(
			'name'      => 'Extended Google Map for Elementor',
			'slug'      => 'extended-google-map-for-elementor',
			'required'  => false, 
			'source'    => 'https://themegoods-assets.b-cdn.net/extended-google-map-for-elementor/extended-google-map-for-elementor-v1.2.5.zip',
			'version'   => '1.2.5',
		),
	);
	
	$config = array(
		'domain'	=> 'grandrestaurant',
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'install-required-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'          => array(
	        'page_title'                      => __( 'Install Required Plugins', 'grandrestaurant' ),
	        'menu_title'                      => __( 'Install Plugins', 'grandrestaurant' ),
	        'installing'                      => __( 'Installing Plugin: %s', 'grandrestaurant' ),
	        'oops'                            => __( 'Something went wrong with the plugin API.', 'grandrestaurant' ),
	        'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
	        'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
	        'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
	        'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
	        'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
	        'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
	        'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
	        'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
	        'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
	        'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
	        'return'                          => __( 'Return to Required Plugins Installer', 'grandrestaurant' ),
	        'plugin_activated'                => __( 'Plugin activated successfully.', 'grandrestaurant' ),
	        'complete'                        => __( 'All plugins installed and activated successfully. %s', 'grandrestaurant' ),
	        'nag_type'                        => 'update-nag'
	    )
    );
 
    tgmpa( $plugins, $config );
 
}
?>
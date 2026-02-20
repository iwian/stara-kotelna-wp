<?php
/**
* Custom Sanitize Functions
**/
function tg_sanitize_checkbox( $input ) {
	if(is_bool($input))
	{
		return $input;
	}
	else
	{
		return false;
	}
}

function tg_sanitize_slider( $input ) {
	if(is_numeric($input))
	{
		return $input;
	}
	else
	{
		return 0;
	}
}

function tg_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
* Configuration to disable default Wordpress customizer tabs
**/

add_action( 'customize_register', 'tg_customize_register' );
function tg_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}

/**
 * Configuration sample for the Kirki Customizer
 */
function kirki_demo_configuration_sample() {

    /**
     * If you need to include Kirki in your theme,
     * then you may want to consider adding the translations here
     * using your textdomain.
     * 
     * If you're using Kirki as a plugin then you can remove these.
     */

    $strings = array(
        'background-color' => __( 'Background Color', 'grandrestaurant' ),
        'background-image' => __( 'Background Image', 'grandrestaurant' ),
        'no-repeat' => __( 'No Repeat', 'grandrestaurant' ),
        'repeat-all' => __( 'Repeat All', 'grandrestaurant' ),
        'repeat-x' => __( 'Repeat Horizontally', 'grandrestaurant' ),
        'repeat-y' => __( 'Repeat Vertically', 'grandrestaurant' ),
        'inherit' => __( 'Inherit', 'grandrestaurant' ),
        'background-repeat' => __( 'Background Repeat', 'grandrestaurant' ),
        'cover' => __( 'Cover', 'grandrestaurant' ),
        'contain' => __( 'Contain', 'grandrestaurant' ),
        'background-size' => __( 'Background Size', 'grandrestaurant' ),
        'fixed' => __( 'Fixed', 'grandrestaurant' ),
        'scroll' => __( 'Scroll', 'grandrestaurant' ),
        'background-attachment' => __( 'Background Attachment', 'grandrestaurant' ),
        'left-top' => __( 'Left Top', 'grandrestaurant' ),
        'left-center' => __( 'Left Center', 'grandrestaurant' ),
        'left-bottom' => __( 'Left Bottom', 'grandrestaurant' ),
        'right-top' => __( 'Right Top', 'grandrestaurant' ),
        'right-center' => __( 'Right Center', 'grandrestaurant' ),
        'right-bottom' => __( 'Right Bottom', 'grandrestaurant' ),
        'center-top' => __( 'Center Top', 'grandrestaurant' ),
        'center-center' => __( 'Center Center', 'grandrestaurant' ),
        'center-bottom' => __( 'Center Bottom', 'grandrestaurant' ),
        'background-position' => __( 'Background Position', 'grandrestaurant' ),
        'background-opacity' => __( 'Background Opacity', 'grandrestaurant' ),
        'ON' => __( 'ON', 'grandrestaurant' ),
        'OFF' => __( 'OFF', 'grandrestaurant' ),
        'all' => __( 'All', 'grandrestaurant' ),
        'cyrillic' => __( 'Cyrillic', 'grandrestaurant' ),
        'cyrillic-ext' => __( 'Cyrillic Extended', 'grandrestaurant' ),
        'devanagari' => __( 'Devanagari', 'grandrestaurant' ),
        'greek' => __( 'Greek', 'grandrestaurant' ),
        'greek-ext' => __( 'Greek Extended', 'grandrestaurant' ),
        'khmer' => __( 'Khmer', 'grandrestaurant' ),
        'latin' => __( 'Latin', 'grandrestaurant' ),
        'latin-ext' => __( 'Latin Extended', 'grandrestaurant' ),
        'vietnamese' => __( 'Vietnamese', 'grandrestaurant' ),
        'serif' => _x( 'Serif', 'font style', 'grandrestaurant' ),
        'sans-serif' => _x( 'Sans Serif', 'font style', 'grandrestaurant' ),
        'monospace' => _x( 'Monospace', 'font style', 'grandrestaurant' ),
    );

    $args = array(
        'textdomain'   => 'grandrestaurant',
    );

    return $args;

}
add_filter( 'kirki/config', 'kirki_demo_configuration_sample' );

/**
 * Create the customizer panels and sections
 */
function tg_add_panels_and_sections( $wp_customize ) {

	/**
     * Add panels
     */
    $wp_customize->add_panel( 'general', array(
        'priority'    => 35,
        'title'       => __( 'General', 'grandrestaurant' ),
    ) ); 
    
    $wp_customize->add_panel( 'menu', array(
        'priority'    => 35,
        'title'       => __( 'Navigation', 'grandrestaurant' ),
    ) );
    
    $wp_customize->add_panel( 'header', array(
        'priority'    => 39,
        'title'       => __( 'Header', 'grandrestaurant' ),
    ) );
    
    $wp_customize->add_panel( 'sidebar', array(
        'priority'    => 43,
        'title'       => __( 'Sidebar', 'grandrestaurant' ),
    ) );
    
    $wp_customize->add_panel( 'footer', array(
        'priority'    => 44,
        'title'       => __( 'Footer', 'grandrestaurant' ),
    ) );
    
    $wp_customize->add_panel( 'gallery', array(
        'priority'    => 45,
        'title'       => __( 'Gallery', 'grandrestaurant' ),
    ) );
    
    $wp_customize->add_panel( 'blog', array(
        'priority'    => 47,
        'title'       => __( 'Blog', 'grandrestaurant' ),
    ) );
    
    $wp_customize->add_panel( 'pages', array(
        'priority'    => 49,
        'title'       => __( 'Pages', 'grandrestaurant' ),
    ) );
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		$wp_customize->add_panel( 'shop', array(
	        'priority'    => 48,
	        'title'       => __( 'Shop', 'grandrestaurant' ),
	    ) );
	}

    /**
     * Add sections
     */
	$wp_customize->add_section( 'logo_favicon', array(
        'title'       => __( 'Logo & Favicon', 'grandrestaurant' ),
        'priority'    => 34,

    ) );
    
    $wp_customize->add_section( 'general_image', array(
        'title'       => __( 'Image', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 46,

    ) );
    
    $wp_customize->add_section( 'general_fonts', array(
        'title'       => esc_html__('Fonts', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 46,

    ) );
    
    $wp_customize->add_section( 'general_typography', array(
        'title'       => __( 'Typography', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 47,

    ) );
    
    $wp_customize->add_section( 'general_color', array(
        'title'       => __( 'Background & Colors', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 48,

    ) );
    
    $wp_customize->add_section( 'general_input', array(
        'title'       => __( 'Input and Button Elements', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 49,

    ) );
    
    $wp_customize->add_section( 'general_sharing', array(
        'title'       => __( 'Sharing', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'general_mobile', array(
        'title'       => __( 'Mobile', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 50,

    ) );
    
    $wp_customize->add_section( 'general_boxed', array(
        'title'       => __( 'Boxed Layout', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 51,

    ) );
    
    $wp_customize->add_section( 'general_currency', array(
        'title'       => __( 'Currency', 'grandrestaurant' ),
        'panel'		  => 'general',
        'priority'    => 51,

    ) );

    $wp_customize->add_section( 'menu_general', array(
        'title'       => __( 'General', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 36,

    ) );
    
    $wp_customize->add_section( 'menu_typography', array(
        'title'       => __( 'Typography', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 36,

    ) );
    
    $wp_customize->add_section( 'menu_color', array(
        'title'       => __( 'Colors', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 37,

    ) );
    
    $wp_customize->add_section( 'menu_background', array(
        'title'       => __( 'Background', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_submenu', array(
        'title'       => __( 'Sub Menu', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_megamenu', array(
        'title'       => __( 'Mega Menu', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_topbar', array(
        'title'       => __( 'Top Bar', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 38,

    ) );
    
    $wp_customize->add_section( 'menu_contact', array(
        'title'       => __( 'Contact Info', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 39,

    ) );
    
    $wp_customize->add_section( 'menu_search', array(
        'title'       => __( 'Search', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 40,

    ) );
    
    $wp_customize->add_section( 'menu_sidemenu', array(
        'title'       => __( 'Side Menu', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'menu_fullmenu', array(
        'title'       => esc_html__('Fullscreen Menu', 'grandrestaurant' ),
        'panel'		  => 'menu',
        'priority'    => 42,
    
    ) );
    
    $wp_customize->add_section( 'header_background', array(
        'title'       => __( 'Background', 'grandrestaurant' ),
        'panel'		  => 'header',
        'priority'    => 40,

    ) );
    
    $wp_customize->add_section( 'header_title', array(
        'title'       => __( 'Page Title', 'grandrestaurant' ),
        'panel'		  => 'header',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'header_title_bg', array(
        'title'       => __( 'Page Title With Background Image', 'grandrestaurant' ),
        'panel'		  => 'header',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'header_builder_title', array(
        'title'       => __( 'Content Builder Header', 'grandrestaurant' ),
        'panel'		  => 'header',
        'priority'    => 41,

    ) );
    
    $wp_customize->add_section( 'header_tagline', array(
        'title'       => __( 'Page Tagline & Sub Title', 'grandrestaurant' ),
        'panel'		  => 'header',
        'priority'    => 42,

    ) );
    
    $wp_customize->add_section( 'sidebar_typography', array(
        'title'       => __( 'Typography', 'grandrestaurant' ),
        'panel'		  => 'sidebar',
        'priority'    => 43,

    ) );
    
    $wp_customize->add_section( 'sidebar_color', array(
        'title'       => __( 'Colors', 'grandrestaurant' ),
        'panel'		  => 'sidebar',
        'priority'    => 44,

    ) );
    
    $wp_customize->add_section( 'footer_general', array(
        'title'       => __( 'General', 'grandrestaurant' ),
        'panel'		  => 'footer',
        'priority'    => 45,

    ) );
    
    $wp_customize->add_section( 'footer_color', array(
        'title'       => __( 'Colors', 'grandrestaurant' ),
        'panel'		  => 'footer',
        'priority'    => 46,

    ) );
    
    $wp_customize->add_section( 'footer_copyright', array(
        'title'       => __( 'Copyright', 'grandrestaurant' ),
        'panel'		  => 'footer',
        'priority'    => 47,

    ) );
    
    $wp_customize->add_section( 'gallery_image', array(
        'title'       => esc_html__('Image', 'grandrestaurant' ),
        'panel'		  => 'gallery',
        'priority'    => 48,

    ) );
    
    $wp_customize->add_section( 'gallery_sorting', array(
        'title'       => __( 'Images Sorting', 'grandrestaurant' ),
        'panel'		  => 'gallery',
        'priority'    => 48,

    ) );
    
    $wp_customize->add_section( 'gallery_caption', array(
        'title'       => __( 'Caption', 'grandrestaurant' ),
        'panel'		  => 'gallery',
        'priority'    => 49,

    ) );
    
    $wp_customize->add_section( 'gallery_lightbox', array(
        'title'       => esc_html__('Lightbox', 'grandrestaurant' ),
        'panel'		  => 'gallery',
        'priority'    => 49,

    ) );
        
    $wp_customize->add_section( 'blog_general', array(
        'title'       => __( 'General', 'grandrestaurant' ),
        'panel'		  => 'blog',
        'priority'    => 53,

    ) );
    
    $wp_customize->add_section( 'blog_image', array(
        'title'       => esc_html__('Image', 'grandrestaurant' ),
        'panel'		  => 'blog',
        'priority'    => 53,

    ) );
    
    $wp_customize->add_section( 'blog_single', array(
        'title'       => __( 'Single Post', 'grandrestaurant' ),
        'panel'		  => 'blog',
        'priority'    => 54,

    ) );
    
    $wp_customize->add_section( 'blog_typography', array(
        'title'       => esc_html__('Typography', 'grandrestaurant' ),
        'panel'		  => 'blog',
        'priority'    => 56,

    ) );
    
    $wp_customize->add_section( 'pages_templates', array(
        'title'       => esc_html__('Templates', 'grandrestaurant' ),
        'panel'		  => 'pages',
        'priority'    => 57,
    
    ) );
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		$wp_customize->add_section( 'shop_layout', array(
	        'title'       => __( 'Layout', 'grandrestaurant' ),
	        'panel'		  => 'shop',
	        'priority'    => 55,
	
	    ) );
        
        $wp_customize->add_section( 'shop_typography', array(
            'title'       => __( 'Typography', 'grandrestaurant' ),
            'panel'		  => 'shop',
            'priority'    => 56,
        
        ) );
	    
	    $wp_customize->add_section( 'shop_single', array(
	        'title'       => __( 'Single Product', 'grandrestaurant' ),
	        'panel'		  => 'shop',
	        'priority'    => 57,
	
	    ) );
	}

}
add_action( 'customize_register', 'tg_add_panels_and_sections' );

/**
 * Register and setting to header section
 */
function tg_header_setting( $wp_customize ) {

	//Register Logo Tab Settings
	$wp_customize->add_setting( 'tg_favicon', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
	
    $wp_customize->add_setting( 'tg_retina_logo', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_setting( 'tg_retina_transparent_logo', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_setting( 'tg_retina_footer_logo', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    //End Logo Tab Settings
    
    //Register General Tab Settings
    $wp_customize->add_setting( 'tg_enable_right_click', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_enable_dragging', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_body_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_body_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
	$wp_customize->add_setting( 'tg_header_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_header_font_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h1_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h2_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h3_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h4_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h5_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_h6_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_content_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_hover_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_h1_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_hr_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_input_focus_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_button_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_button_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sharing_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sharing_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    //End General Tab Settings
    

    //Register Menu Tab Settings
    $wp_customize->add_setting( 'tg_menu_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_fixed_menu', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_hover_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_active_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_spacing', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_hover_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_hover_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_submenu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_megamenu_header_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_megamenu_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_social_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_topbar_social_link', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_contact_address', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_contact_hours', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_contact_number', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search_instant', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search_input_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_menu_search_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_sidemenu_font_hover_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    //End Menu Tab Settings
    
    //Register Header Tab Settings
	$wp_customize->add_setting( 'tg_page_header_bg_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_page_header_padding_top', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_header_padding_bottom', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_font_weight', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_bg_height', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_page_title_mixed_font', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_header_builder_font_mixed', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_header_builder_font_size', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_slider',
    ) );
    
    $wp_customize->add_setting( 'tg_header_builder_font_transform', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_header_builder_hr_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    //End Header Tab Settings
    
    //Register Copyright Tab Settings
	$wp_customize->add_setting( 'tg_footer_text', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_sidebar', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
	
	$wp_customize->add_setting( 'tg_footer_social_link', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
	$wp_customize->add_setting( 'tg_footer_font_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_hover_link_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_border_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_social_color', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_text', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_right_area', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_footer_copyright_totop', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    //End Copyright Tab Settings
    
    
    //Begin Gallery Tab Settings
    $wp_customize->add_setting( 'tg_gallery_sort', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_lightbox_enable_caption', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    //End Gallery Tab Settings
    
    
    //Begin Blog Tab Settings
    $wp_customize->add_setting( 'tg_blog_display_full', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_archive_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_category_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_tag_layout', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_html',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_header_bg', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_feat_content', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_tags', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_author', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    
    $wp_customize->add_setting( 'tg_blog_display_related', array(
        'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tg_sanitize_checkbox',
    ) );
    //End Blog Tab Settings
    
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
		//Begin Shop Tab Settings
		$wp_customize->add_setting( 'tg_shop_layout', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_html',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_items', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'tg_sanitize_slider',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_price_font_color', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    
	    $wp_customize->add_setting( 'tg_shop_related_products', array(
	        'type'           => 'theme_mod',
	        'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'tg_sanitize_checkbox',
	    ) );
		//End Shop Tab Settings
	}
    
    
    //Add Live preview
    if ( $wp_customize->is_preview() && ! is_admin() ) {
	    add_action( 'wp_footer', 'tg_customize_preview', 21);
	}
}
add_action( 'customize_register', 'tg_header_setting' );

/**
 * Create the setting
 */
function tg_custom_setting( $controls ) {

	//Default control choices
	$tg_text_transform = array(
	    'none' => 'None',
	    'capitalize' => 'Capitalize',
	    'uppercase' => 'Uppercase',
	    'lowercase' => 'Lowercase',
	);
	
	$tg_text_alignment = array(
	    'left' => 'Left',
	    'center' => 'Center',
	    'right' => 'Right',
	);
	
	$tg_vertical_alignment = array(
	    'baseline' => 'Baseline',
	    'middle' => 'Middle',
	);
	
	$tg_copyright_content = array(
	    'social' => 'Social Icons',
	    'menu' => 'Footer Menu',
	);
	
	$tg_copyright_text_alignment = array(
	    'classic' => 'Classic',
	    'center' => 'Center',
	);
	
	$tg_top_bar_content = array(
	    'contact' => 'Contact Info',
	    'menu' => 'Top Menu',
	);
	
	$tg_copyright_column = array(
	    1 => '1 Column',
	    2 => '2 Column',
	    3 => '3 Column',
	    4 => '4 Column',
	);
	
	$tg_gallery_sort = array(
		'drag' => 'By Drag&drop',
		'post_date' => 'By Newest',
		'post_date_old' => 'By Oldest',
		'rand' => 'By Random',
		'title' => 'By Title',
	);
	
	$tg_blog_layout = array(
		'blog_g' => 'Grid',
		'blog_gs' => 'Grid + Right Siebar',
		'blog_gls' => 'Grid + Left Siebar',
		'blog_r' => 'Right Sidebar',
		'blog_l' => 'Left Sidebar',
		'blog_f' => 'Fullwidth',
	);
	
	$tg_shop_layout = array(
		'fullwidth' => 'Fullwidth',
		'sidebar' => 'With Sidebar',
	);
    
    $tg_shop_column = array(
        2 => '2 Column',
        3 => '3 Column',
        4 => '4 Column',
    );
	
	$tg_menu_layout = array(
	    'classicmenu' => 'Classic',
	    'leftmenu' => 'Left Align',
	    'centermenu' => 'Center Align',
	);
    
    $tg_lightbox_skin = array(
        'white' => 'White',
        'black' => 'Black',
    );
	
	$grandrestaurant_footer_content = array(
	    'content' => 'Footer Content',
	    'sidebar' => 'Sidebar',
	    'hide' => 'Hide Footer Content',
	);
	
	$grandrestaurant_header_content = array(
	    'content' => 'Header Content',
	    'menu' => 'General Menu Layout',
	);
	
	//Get all footer posts
	$args = array(
		 'post_type'     => 'footer',
		 'post_status'   => array( 'publish' ),
		 'numberposts'   => -1,
		 'orderby'       => 'title',
		 'order'         => 'ASC',
		 'suppress_filters'   => false
	);
	$footers = get_posts($args);
	$grandrestaurant_footers_select = array();
	$grandrestaurant_footers_select[''] = '';
	
	if(!empty($footers))
	{
		foreach ($footers as $footer)
		{
			$grandrestaurant_footers_select[$footer->ID] = $footer->post_title;
		}
	}
	
	//Get all header posts
	$args = array(
		 'post_type'     => 'header',
		 'post_status'   => array( 'publish' ),
		 'numberposts'   => -1,
		 'orderby'       => 'title',
		 'order'         => 'ASC',
		 'suppress_filters'   => false
	);
	$headers = get_posts($args);
	$grandrestaurant_headers_select = array();
	$grandrestaurant_headers_select[''] = '';
	
	if(!empty($headers))
	{
		foreach ($headers as $header)
		{
			$grandrestaurant_headers_select[$header->ID] = $header->post_title;
		}
	}
    
    //Get all fullscreen menus
    $args = array(
        'numberposts' => -1,
        'post_type' => array('fullmenu'),
        'post_status'   => array( 'publish' ),
        'orderby'   => 'post_title',
        'order'     => 'ASC',
        'suppress_filters'   => false
    );
    
    $grandrestaurant_fullmenu_arr = get_posts($args);
    $grandrestaurant_footer_contentfullmenu_select = array();
    $grandrestaurant_fullmenu_select[''] = '';
    
    foreach($grandrestaurant_fullmenu_arr as $grandrestaurant_fullmenu)
    {
        $grandrestaurant_fullmenu_select[$grandrestaurant_fullmenu->ID] = $grandrestaurant_fullmenu->post_title;
    }
    
    $grandrestaurant_fullmenu_effect_select = array(
        ''              => esc_html__('Scale Up', 'grandrestaurant' ),
        'scale-down'    => esc_html__('Scale Down', 'grandrestaurant' ),
        'move-down'     => esc_html__('Move Down', 'grandrestaurant' ),
        'move-up'       => esc_html__('Move Up', 'grandrestaurant' ),
        'fade'          => esc_html__('Fade In', 'grandrestaurant' ),
    );
	
	//Register Logo Tab Settings
	
	$controls[] = array(
        'type'     => 'image',
        'settings'  => 'tg_retina_logo',
        'label'    => __( 'Retina Logo', 'grandrestaurant' ),
        'description' => __('Retina Ready Image logo. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px', 'grandrestaurant' ),
        'section'  => 'logo_favicon',
	    'default'  => get_template_directory_uri().'/images/logo@2x.png',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'image',
        'settings'  => 'tg_retina_transparent_logo',
        'label'    => __( 'Retina Transparent Logo', 'grandrestaurant' ),
        'description' => __('Retina Ready Image logo for menu transparent page. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px. Recommend logo color is white or bright color', 'grandrestaurant' ),
        'section'  => 'logo_favicon',
	    'default'  => get_template_directory_uri().'/images/logo@2x_white.png',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'image',
        'settings'  => 'tg_retina_footer_logo',
        'label'    => __( 'Retina Footer Logo (Optional)', 'grandrestaurant' ),
        'description' => __('Retina Ready Image logo for footer. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px.', 'grandrestaurant' ),
        'section'  => 'logo_favicon',
	    'default'  => '',
	    'priority' => 4,
    );
    //End Logo Tab Settings
    
    //Register General Tab Settings
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_enable_right_click',
        'label'    => __( 'Enable Right Click Protection', 'grandrestaurant' ),
        'description' => __('Check this to disable right click.', 'grandrestaurant' ),
        'section'  => 'general_image',
        'default'  => '',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_enable_dragging',
        'label'    => __( 'Enable Image Dragging Protection', 'grandrestaurant' ),
        'description' => __('Check this to disable dragging on all images.', 'grandrestaurant' ),
        'section'  => 'general_image',
        'default'  => '',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_body_typography_title',
        'label'    => esc_html__('Body and Content Settings', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'priority' => 0,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_body_typography',
        'label'    => esc_html__('Main Content Typography', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => 'regular',
            'font-size'      => '14px',
            'line-height'    => '1.8',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'body, input[type=text], input[type=password], input[type=email], input[type=url], input[type=date], input[type=tel], input.wpcf7-text, .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, select, textarea, .ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button, .ui-widget label, .ui-widget-header, .zm_alr_ul_container, .woocommerce .woocommerce-result-count, .woocommerce .woocommerce-ordering select',
            ),
        ),
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_header_typography_title',
        'label'    => esc_html__('Header Settings', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_header_typography',
        'label'    => esc_html__('Header Typography', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '400',
            'line-height'    => '1.8',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'h1, h2, h3, h4, h5, h6, h7, .post_quote_title, strong[itemprop="author"], #page_content_wrapper .posts.blog li a, .page_content_wrapper .posts.blog li a, #filter_selected, blockquote, .sidebar_widget li.widget_products, #footer ul.sidebar_widget li ul.posts.blog li a, .woocommerce-page table.cart th, table.shop_table thead tr th, .testimonial_slider_content, .pagination, .pagination_detail, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-cart .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-checkout .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-payment .mpa-shortcode-title, #respond.comment-respond .comment-reply-title',
            ),
        ),
        'priority' => 3
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h1_size',
        'label'    => __( 'H1 Font Size (px)', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => 34,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h1',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h2_size',
        'label'    => __( 'H2 Font Size (px)', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => 30,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h2',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h3_size',
        'label'    => __( 'H3 Font Size (px)', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => 26,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h3',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h4_size',
        'label'    => __( 'H4 Font Size (px)', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => 22,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h4',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h5_size',
        'label'    => __( 'H5 Font Size (px)', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => 18,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h5',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_h6_size',
        'label'    => __( 'H6 Font Size (px)', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => 16,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'h6',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_other_typography_title',
        'label'    => esc_html__('Other Settings', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_blockquote_size',
        'label'    => __( 'Blockquote Font Size (px)', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => 20,
        'choices' => array( 'min' => 13, 'max' => 60, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => 'blockquote',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'js_vars' => array(
	        array(
	            'element'  => 'blockquote',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_blockquote_line_height',
        'label'    => __( 'Blockquote Line Height (em)', 'grandrestaurant' ),
        'section'  => 'general_typography',
        'default'  => 1.8,
        'choices' => array( 'min' => 1, 'max' => 3, 'step' => 0.1 ),
        'output' => array(
	        array(
	            'element'  => 'blockquote',
	            'property' => 'line-height',
	        ),
	    ),
	    'js_var' => array(
	        array(
	            'element'  => 'blockquote',
	            'property' => 'line-height',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_content_bg_color',
        'label'    => __( 'Main Content Background', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'     => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'body',
	            'property' => 'background-color',
	        ),
	    ),
	    'priority' => 1,
    );
    
    /*$controls[] = array(
        'type'     => 'image',
        'settings'  => 'tg_content_bg_img',
        'label'    => __( 'Main Content Image (Optional)', 'grandrestaurant' ),
        'section'  => 'general_color',
	    'default'  => '',
	    'priority' => 1,
    );*/
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_font_color',
        'label'    => __( 'Page Content Font Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#333',
        'output' => array(
	        array(
	            'element'  => 'body, .pagination a, .slider_wrapper .gallery_image_caption h2, .post_info a',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '::selection',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_link_color',
        'label'    => __( 'Page Content Link Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => 'a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_hover_link_color',
        'label'    => __( 'Page Content Hover Link Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => 'a:hover, a:active, .post_info_comment a i',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_h1_font_color',
        'label'    => __( 'H1, H2, H3, H4, H5, H6 Font Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, .post_header.fullwidth h4 a, .post_header h5 a, blockquote, .site_loading_logo_item i, .menu_content_classic .menu_price',
	            'property' => 'color',
	        ),
	    ),
	    'js_vars' => array(
	        array(
	            'element'  => 'h1, h2, h3, h4, h5, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, .post_header.fullwidth h4 a, .post_header h5 a, blockquote, .site_loading_logo_item i, .menu_content_classic .menu_price',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 14,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_hr_color',
        'label'    => __( 'Horizontal Line Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => '#social_share_wrapper, hr, #social_share_wrapper, .post.type-post, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, .comment .right, .widget_tag_cloud div a, .meta-tags a, .tag_cloud a, #footer, #post_more_wrapper, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, #page_content_wrapper .inner .sidebar_content, #page_caption, #page_content_wrapper .inner .sidebar_content.left_sidebar, .ajax_close, .ajax_next, .ajax_prev, .portfolio_next, .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_next, .separated, .blog_next_prev_wrapper, #post_more_wrapper h5, #ajax_portfolio_wrapper.hidding, #ajax_portfolio_wrapper.visible, .tabs.vertical .ui-tabs-panel, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce table.shop_table, .woocommerce-page table.shop_table, table tr td, .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals, .woocommerce .cart-collaterals .shipping_calcuLator, .woocommerce-page .cart-collaterals .shipping_calcuLator, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, table tr th, .woocommerce #payment, .woocommerce-page #payment, .woocommerce #payment ul.payment_methods li, .woocommerce-page #payment ul.payment_methods li, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row, .ui-tabs li:first-child, .ui-tabs .ui-tabs-nav li, .ui-tabs.vertical .ui-tabs-nav li, .ui-tabs.vertical.right .ui-tabs-nav li.ui-state-active, .ui-tabs.vertical .ui-tabs-nav li:last-child, #page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .pricing_wrapper, .pricing_wrapper li, .ui-accordion .ui-accordion-header, .ui-accordion .ui-accordion-content, .woocommerce-page div.product .woocommerce-tabs',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 15,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_appointment_color_title',
        'label'    => esc_html__('Appointment Color Settings', 'grandrestaurant' ),
        'section'  => 'general_color',
        'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_appointment_font_color',
        'label'    => esc_html__('Appointment Font Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#000000',
        'output' => array(
            array(
                'element'  => '.appointment-form-shortcode label, .appointment-form-widget>.widget-body label',
                'property' => 'color',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 17,
        'js_vars'   => array(
            array(
                'element'  => '.appointment-form-shortcode label, .appointment-form-widget>.widget-body label',
                'function' => 'css',
                'property' => 'color',
            ),
        )
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_appointment_calendar_font_color',
        'label'    => esc_html__('Appointment Calendar Font Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#000000',
        'output' => array(
            array(
                'element'  => 'div.flatpickr-current-month, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-cart .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-checkout .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-service-form .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-payment .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-cart .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-checkout .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-service-form .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-payment .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-weekdays .flatpickr-weekday, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-weekdays .flatpickr-weekday, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-day, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-day',
                'property' => 'color',
            ),
            array(
                'element'  => '.appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months .flatpickr-next-month:hover svg, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months .flatpickr-prev-month:hover svg, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months .flatpickr-next-month:hover svg, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months .flatpickr-prev-month:hover svg',
                'property' => 'fill',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 17,
        'js_vars'   => array(
            array(
                'element'  => '.flatpickr-current-month, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-cart .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-checkout .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-service-form .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-payment .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-cart .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-checkout .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-service-form .mpa-shortcode-title, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-payment .mpa-shortcode-title, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-weekdays .flatpickr-weekday, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-weekdays .flatpickr-weekday, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-day, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-day',
                'function' => 'css',
                'property' => 'color',
            ),
            array(
                'element'  => '.appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months .flatpickr-next-month:hover svg, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months .flatpickr-prev-month:hover svg, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months .flatpickr-next-month:hover svg, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months .flatpickr-prev-month:hover svg',
                'property' => 'fill',
            ),
        )
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_appointment_date_month_bg_color',
        'label'    => esc_html__('Appointment Date/Month Background Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#f9f9f9',
        'output' => array(
            array(
                'element'  => '.appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-day:before, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-day:before, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-cart .mpa-cart .mpa-cart-item',
                'property' => 'background',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 17,
        'js_vars'   => array(
            array(
                'element'  => '.appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-months, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-day:before, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .flatpickr-calendar .flatpickr-day:before',
                'function' => 'css',
                'property' => 'background',
            ),
        )
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_appointment_reservation_bg_color',
        'label'    => esc_html__('Appointment Reservation Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#f9f9f9',
        'output' => array(
            array(
                'element'  => '.appointment-form-shortcode .mpa-booking-step.mpa-booking-step-cart .mpa-cart .mpa-cart-item, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-cart .mpa-cart .mpa-cart-item, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-booking, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-booking',
                'property' => 'background',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 17,
        'js_vars'   => array(
            array(
                'element'  => '.appointment-form-shortcode .mpa-booking-step.mpa-booking-step-cart .mpa-cart .mpa-cart-item, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-cart .mpa-cart .mpa-cart-item, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-booking, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-booking',
                'function' => 'css',
                'property' => 'background',
            ),
        )
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_food_menu_highlight_color',
        'label'    => __( 'Food Menu Highlight Color', 'grandrestaurant' ),
        'section'  => 'general_color',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => '.menu_content_classic .menu_highlight, .menu_content_classic .menu_order',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_label_title',
        'label'    => esc_html__('Label Settings', 'grandrestaurant' ),
        'section'  => 'general_input',
        'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_label_typography',
        'label'    => esc_html__('Label Typography', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => 'Jost',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '600',
            'font-size'      => '16px',
            'line-height'    => '1.8',
            'letter-spacing' => '0',
            'text-transform' => 'uppercase',
        ),
        'output' => array(
            array(
                'element'  => 'label',
            ),
        ),
        'priority' => 14,
    );

    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_label_font_color',
        'label'    => __( 'Label Font Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#444444',
        'output' => array(
            array(
                'element'  => 'label',
                'property' => 'color',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 14,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_input_title',
        'label'    => esc_html__('Input and Textarea Settings', 'grandrestaurant' ),
        'section'  => 'general_input',
        'priority' => 15,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_input_typography',
        'label'    => esc_html__('Input and Textarea Typography', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => 'Jost',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => 'regular',
            'font-size'      => '14px',
            'line-height'    => '1.8',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, body .ui-dialog[aria-describedby="ajax-login-register-login-dialog"] .form-wrapper input[type="submit"], body .ui-dialog[aria-describedby="ajax-login-register-dialog"] .form-wrapper input[type="submit"], input[type=search]',
            ),
        ),
        'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_input_border_radius',
        'label'    => esc_html__('Input and Textarea Border Radius (px)', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => 0,
        'choices' => array( 'min' => 0, 'max' => 25, 'step' => 1 ),
        'output' => array(
            array(
                'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select, input[type=search], .woocommerce #content .quantity input.qty, .woocommerce .quantity input.qty, .woocommerce-page #content .quantity input.qty, .woocommerce-page .quantity input.qty',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 16,
        'js_vars'   => array(
            array(
                'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=date], textarea, select, input[type=search], .woocommerce #content .quantity input.qty, .woocommerce .quantity input.qty, .woocommerce-page #content .quantity input.qty, .woocommerce-page .quantity input.qty',
                'function' => 'css',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        )
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_input_bg_color',
        'label'    => __( 'Input and Textarea Background Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea, .woocommerce .quantity input.qty, select, input[type=search]',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_input_font_color',
        'label'    => __( 'Input and Textarea Font Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#444444',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea, .woocommerce .quantity input.qty, select, input[type=search]',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 17,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_input_border_color',
        'label'    => __( 'Input and Textarea Border Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], textarea, .woocommerce .quantity input.qty, select, input[type=search]',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 18,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_input_focus_color',
        'label'    => __( 'Input and Textarea Focus State Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => 'input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=url]:focus, textarea:focus, .woocommerce .quantity input.qty:focus, input[type=tel]:focus',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 19,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_button_title',
        'label'    => esc_html__('Button Settings', 'grandrestaurant' ),
        'section'  => 'general_input',
        'priority' => 20,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_button_typography',
        'label'    => esc_html__('Button Typography', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => 'Jost',
        'default'  => array(
            'font-family'    => 'Jost',
            'variant'        => '700',
            'font-size'      => '13px',
            'line-height'    => '1.7',
            'letter-spacing' => '1px',
            'text-transform' => 'uppercase',
        ),
        'output' => array(
            array(
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, body .ui-dialog[aria-describedby="ajax-login-register-login-dialog"] .form-wrapper input[type="submit"], body .ui-dialog[aria-describedby="ajax-login-register-dialog"] .form-wrapper input[type="submit"], button[type=submit], .wp-block-search .wp-block-search__button, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period',
            ),
        ),
        'priority' => 21,
    );
    
    $controls[] = array(
        'type'     => 'dimensions',
        'settings'  => 'tg_button_padding',
        'label'    => __( 'Button Padding', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'     => [
            'padding-top'    => '1em',
            'padding-right' => '1.7em',
            'padding-bottom'   => '1em',
            'padding-left'  => '1.7em',
        ],
        'choices'     => [
            'labels' => [
                'padding-top'  => esc_html__( 'Padding Top', 'grandrestaurant' ),
                'padding-right'  => esc_html__( 'Padding Right', 'grandrestaurant' ),
                'padding-bottom' => esc_html__( 'Padding Bottom', 'grandrestaurant' ),
                'padding-left' => esc_html__( 'Padding Left', 'grandrestaurant' ),
            ],
        ],
        'output' => array(
            array(
                  'choice'      => 'padding-top',
                  'element'     => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #toTop, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
                  'property'    => 'padding-top',
            ),
           array(
                 'choice'      => 'padding-right',
                 'element'     => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #toTop, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
                 'property'    => 'padding-right',
           ),
           array(
                'choice'      => 'padding-bottom',
                'element'     => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #toTop, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
                'property'    => 'padding-bottom',
            ),
            array(
                'choice'      => 'padding-left',
                'element'     => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #toTop, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
                'property'    => 'padding-left',
            ),
        ),
        'transport' => 'postMessage',
        'priority' => 22,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_button_border-radius',
        'label'    => __( 'Button Border Radius', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => 0,
        'choices' => array( 'min' => 0, 'max' => 25, 'step' => 1 ),
        'output' => array(
            array(
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #toTop, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        ),
        'js_vars' => array(
            array(
                'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #toTop, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period',
                'property' => 'border-radius',
                'units'    => 'px',
            ),
        ),
        'transport' => 'postMessage',
        'priority' => 22,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_bg_color',
        'label'    => __( 'Button Background Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination span, .pagination a:hover, .woocommerce .footer_bar .button, .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
	            'property' => 'background-color',
	        ),
	        array(
	            'element'  => '.pagination span, .pagination a:hover',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 23,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_font_color',
        'label'    => __( 'Button Font Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce .cart .button',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 23,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_border_color',
        'label'    => __( 'Button Border Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => 'input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce .footer_bar .button , .woocommerce .footer_bar .button:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, #reservation_submit_btn, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a, .woocommerce #page_content_wrapper a.button, .woocommerce #respond input#submit, .woocommerce .cart .button',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 23,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_hover_bg_color',
        'label'    => esc_html__('Button Hover Background Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#ffffff',
        'output' => array(
            array(
                'element'  => 'input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active, .black_bg input[type=submit], .learnpress-page #page_content_wrapper .lp-button:hover, .learnpress-page #learn-press-profile-basic-information button:hover, .learnpress-page #profile-content-settings form button[type=submit]:hover, body #checkout-payment #checkout-order-action button:hover, button[type=submit]:hover, .wp-block-search .wp-block-search__button:hover, #learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button:hover, body .comment-respond .comment-form input[type=submit]:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-cart .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-checkout .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-service-form .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-payment .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-cart .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-checkout .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-service-form .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-payment .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a:hover, .woocommerce #page_content_wrapper a.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover',
                'property' => 'background-color',
            ),
        ),
        'js_vars'   => array(
            array(
                'element'  => 'input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active, .black_bg input[type=submit], .learnpress-page #page_content_wrapper .lp-button:hover, .learnpress-page #learn-press-profile-basic-information button:hover, .learnpress-page #profile-content-settings form button[type=submit]:hover, body #checkout-payment #checkout-order-action button:hover, button[type=submit]:hover, .wp-block-search .wp-block-search__button:hover, #learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button:hover, body .comment-respond .comment-form input[type=submit]:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-cart .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-checkout .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-service-form .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-payment .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-cart .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-checkout .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-service-form .button-secondary:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-payment .button-secondary:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a:hover, .woocommerce #page_content_wrapper a.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover',
                'function' => 'css',
                'property' => 'background-color',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 30,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_hover_font_color',
        'label'    => esc_html__('Button Hover Font Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#cfa670',
        'output' => array(
            array(
                'element'  => 'input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active, .black_bg input[type=submit], body.learnpress-page #page_content_wrapper .lp-button:hover, .learnpress-page #learn-press-profile-basic-information button:hover, .learnpress-page #profile-content-settings form button[type=submit]:hover, body #checkout-payment #checkout-order-action button:hover, button[type=submit]:hover, .wp-block-search .wp-block-search__button:hover, #learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button:hover, body .comment-respond .comment-form input[type=submit]:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .button-secondary:hover, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a:hover, .woocommerce #page_content_wrapper a.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover',
                'property' => 'color',
            ),
        ),
        'js_vars'   => array(
            array(
                'element'  => 'input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active, .black_bg input[type=submit], body.learnpress-page #page_content_wrapper .lp-button:hover, .learnpress-page #learn-press-profile-basic-information button:hover, .learnpress-page #profile-content-settings form button[type=submit]:hover, button[type=submit]:hover, .wp-block-search .wp-block-search__button:hover, #learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button:hover, body .comment-respond .comment-form input[type=submit]:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period:hover, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .button-secondary:hover, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a:hover, .woocommerce #page_content_wrapper a.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover',
                'function' => 'css',
                'property' => 'color',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_button_hover_border_color',
        'label'    => esc_html__('Button Hover Border Color', 'grandrestaurant' ),
        'section'  => 'general_input',
        'default'  => '#cfa670',
        'output' => array(
            array(
                'element'  => 'input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active, .black_bg input[type=submit], .learnpress-page #learn-press-profile-basic-information button:hover, .learnpress-page #profile-content-settings form button[type=submit]:hover, button[type=submit]:hover, .wp-block-search .wp-block-search__button:hover, #learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button:hover, body .comment-respond .comment-form input[type=submit]:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .button-secondary:hover, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a:hover, .woocommerce #page_content_wrapper a.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover',
                'property' => 'border-color',
            ),
        ),
        'js_vars'   => array(
            array(
                'element'  => 'input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover, .button.submit, a.button.white:hover, .button.white:hover, a.button.white:active, .button.white:active, .black_bg input[type=submit], .learnpress-page #learn-press-profile-basic-information button:hover, .learnpress-page #profile-content-settings form button[type=submit]:hover, button[type=submit]:hover, .wp-block-search .wp-block-search__button:hover, #learn-press-course .course-summary-sidebar .course-sidebar-preview .lp-course-buttons button:hover, body .comment-respond .comment-form input[type=submit]:hover, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-widget > .widget-body .mpa-booking-step.mpa-booking-step-period .mpa-time-wrapper .mpa-times .mpa-time-period.mpa-time-period-selected, .appointment-form-shortcode .mpa-booking-step.mpa-booking-step-period .button-secondary:hover, #woocommerce-mini-cart-flyout .woocommerce-mini-cart__buttons a:hover, .woocommerce #page_content_wrapper a.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover',
                'function' => 'css',
                'property' => 'border-color',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 32,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sharing_bg_color',
        'label'    => __( 'Sharing Button Background Color', 'grandrestaurant' ),
        'section'  => 'general_sharing',
        'default'  => '#f0f0f0',
        'output' => array(
	        array(
	            'element'  => '.social_share_bubble',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 23,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sharing_color',
        'label'    => __( 'Sharing Button Icon Color', 'grandrestaurant' ),
        'section'  => 'general_sharing',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '.post_share_bubble a.post_share',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 24,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_boxed',
        'label'    => __( 'Enable Boxed Layout', 'grandrestaurant' ),
        'description' => __('Check this to enable boxed layout for site layout', 'grandrestaurant' ),
        'section'  => 'general_boxed',
        'default'  => 0,
	    'priority' => 26,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_default_currency',
        'label'    => __( 'Default Food Menu Currency', 'grandrestaurant' ),
        'description' => __('Enter default currency for each food menu', 'grandrestaurant' ),
        'section'  => 'general_currency',
        'default'  => '$',
        'transport' 	 => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'radio-buttonset',
        'settings'  => 'tg_currency_display',
        'label'    => esc_html__('Currency Display', 'grandtour' ),
        'description' => esc_html__('Select how currency display between tour price', 'grandrestaurant' ),
        'section'  => 'general_currency',
        'default'  => 'before',
        'choices'  => array(
	        'before' => 'Before price',
	        'after' => 'After price',
        ),
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_currency_thousand_sep',
        'label'    => esc_html__('Thousand Separator', 'grandrestaurant' ),
        'description' => esc_html__('Enter thousand separator of displayed price.', 'grandrestaurant' ),
        'section'  => 'general_currency',
        'default'  => ',',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_currency_decimal_sep',
        'label'    => esc_html__('Decimal Separator', 'grandrestaurant' ),
        'description' => esc_html__('Enter decimal separator of displayed price.', 'grandrestaurant' ),
        'section'  => 'general_currency',
        'default'  => '.',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_currency_decimal_number',
        'label'    => esc_html__('Number of Separator', 'grandrestaurant' ),
        'description' => esc_html__('Enter number of decimal points for displayed price.', 'grandrestaurant' ),
        'section'  => 'general_currency',
        'default'  => 1,
	    'priority' => 1,
    );
    //End General Tab Settings

	//Register Menu Tab Settings
	
	$controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_header_content_title',
        'label'    => esc_html__('Header Content Settings', 'grandrestaurant' ),
        'section'  => 'menu_general',
	    'priority' => 0,
    );
	
	$controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_fixed_menu',
        'label'    => __( 'Enable Sticky Header', 'grandrestaurant' ),
        'description' => __('Enable this to display main menu fixed when scrolling.', 'grandrestaurant' ),
        'section'  => 'menu_general',
        'default'  => '1',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'grandrestaurant_header_content',
        'label'    => esc_html__('Display Header Content From', 'grandrestaurant' ),
        'description' => esc_html__('Select how theme get main header & navigation content', 'grandrestaurant' ),
        'section'  => 'menu_general',
        'default'  => 'menu',
        'choices'  => $grandrestaurant_header_content,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_default_header_content_title',
        'label'    => esc_html__('Default Header Content Settings', 'grandrestaurant' ),
        'section'  => 'menu_general',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'grandrestaurant_header_content_default',
        'label'    => esc_html__('Default Header Content', 'grandrestaurant' ),
        'description' => esc_html__('Select default header content for general pages & posts', 'grandrestaurant' ),
        'section'  => 'menu_general',
        'default'  => '',
        'choices'  => $grandrestaurant_headers_select,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'grandrestaurant_sticky_header_content_default',
        'label'    => esc_html__('Default Sticky Header Content', 'grandrestaurant' ),
        'description' => esc_html__('Select default sticky header content for general pages & posts', 'grandrestaurant' ),
        'section'  => 'menu_general',
        'default'  => '',
        'choices'  => $grandrestaurant_headers_select,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'grandrestaurant_transparent_header_content_default',
        'label'    => esc_html__('Default Transparent Header Content', 'grandrestaurant' ),
        'description' => esc_html__('Select default transparent header content for general pages & posts', 'grandrestaurant' ),
        'section'  => 'menu_general',
        'default'  => '',
        'choices'  => $grandrestaurant_headers_select,
	    'priority' => 3,
    );
	
	$controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_menu_title',
        'label'    => esc_html__('General Menu Settings', 'grandrestaurant' ),
        'section'  => 'menu_general',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'tg_menu_layout',
        'label'    => __( 'Menu Layout', 'grandrestaurant' ),
        'section'  => 'menu_general',
        'default'  => 'classicmenu',
        'choices'  => $tg_menu_layout,
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_menu_typography',
        'label'    => esc_html__('Menu Font Typography', 'grandrestaurant' ),
        'section'  => 'menu_typography',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '700',
            'font-size'      => '14px',
            'line-height'    => '1.7',
            'letter-spacing' => '1px',
            'text-transform' => 'uppercase',
        ),
        'output' => array(
            array(
                'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_bg_color',
        'label'    => __( 'Menu Background', 'grandrestaurant' ),
        'section'  => 'menu_color',
        'default'  => '#ffffff',
        'output' => '.top_bar',
         'output' => array(
            array(
                'element'  => '.top_bar',
                'property' => 'background-color',
            ),
        ),
        'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_font_color',
        'label'    => __( 'Menu Font Color', 'grandrestaurant' ),
        'section'  => 'menu_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, #tg_reservation, #tg_reservation:hover, #tg_reservation:active, #mobile_nav_icon',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '#tg_reservation, #tg_reservation:hover, #tg_reservation:active, #mobile_nav_icon',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_hover_font_color',
        'label'    => __( 'Menu Hover State Font Color', 'grandrestaurant' ),
        'section'  => 'menu_color',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_active_font_color',
        'label'    => __( 'Menu Active State Font Color', 'grandrestaurant' ),
        'section'  => 'menu_color',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_border_color',
        'label'    => __( 'Menu Border Color', 'grandrestaurant' ),
        'section'  => 'menu_color',
        'default'  => '#e1e1e1',
        'output' => array(
	        array(
	            'element'  => '.top_bar',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_submenu_font_title',
        'label'    => esc_html__('Typography Settings', 'grandrestaurant' ),
        'section'  => 'menu_submenu',
        'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_submenu_typography',
        'label'    => esc_html__('Sub Menu Typography', 'grandrestaurant' ),
        'section'  => 'menu_submenu',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '700',
            'font-size'      => '13px',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a',
            ),
        ),
        'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_submenu_color_title',
        'label'    => esc_html__('Color Settings', 'grandrestaurant' ),
        'section'  => 'menu_submenu',
        'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_font_color',
        'label'    => __( 'Sub Menu Font Color', 'grandrestaurant' ),
        'section'  => 'menu_submenu',
        'default'  => '#cccccc',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_hover_font_color',
        'label'    => __( 'Sub Menu Hover State Font Color', 'grandrestaurant' ),
        'section'  => 'menu_submenu',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li > a, #menu_wrapper div .nav li.megamenu ul li > a:hover, #menu_wrapper div .nav li.megamenu ul li  > a:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 14,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_hover_bg_color',
        'label'    => __( 'Sub Menu Hover State Background Color', 'grandrestaurant' ),
        'section'  => 'menu_submenu',
        'default'  => '#333333',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 15,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_bg_color',
        'label'    => __( 'Sub Menu Background Color', 'grandrestaurant' ),
        'section'  => 'menu_submenu',
        'default'  => '#000000',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 16,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_submenu_border_color',
        'label'    => __( 'Sub Menu Border Color', 'grandrestaurant' ),
        'section'  => 'menu_submenu',
        'default'  => '#333333',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav li.megamenu ul li, #menu_wrapper .nav ul li ul li, #menu_wrapper div .nav li ul li',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 17,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_megamenu_header_font_size',
        'label'    => __( 'Mega Menu Header Font Size', 'grandrestaurant' ),
        'section'  => 'menu_megamenu',
        'default'  => 13,
        'choices' => array( 'min' => 11, 'max' => 40, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav li.megamenu ul li > a, #menu_wrapper div .nav li.megamenu ul li > a:hover, #menu_wrapper div .nav li.megamenu ul li > a:active',
	            'property' => 'font-size',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 19,
    );
    
	$controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_megamenu_border_color',
        'label'    => __( 'Mega Menu Border Color', 'grandrestaurant' ),
        'section'  => 'menu_megamenu',
        'default'  => '#333333',
        'output' => array(
	        array(
	            'element'  => '#menu_wrapper div .nav li.megamenu ul li',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 20,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_topbar_general_title',
        'label'    => esc_html__('General Settings', 'grandrestaurant' ),
        'section'  => 'menu_topbar',
        'priority' => 20,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_topbar',
        'label'    => __( 'Display Top Bar', 'grandrestaurant' ),
        'description' => __('Enable this option to display top bar above main menu', 'grandrestaurant' ),
        'section'  => 'menu_topbar',
        'default'  => 1,
	    'priority' => 21,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_topbar_social_link',
        'label'    => __( 'Open Top Bar Social Icons link in new window', 'grandrestaurant' ),
        'description' => __('Check this to open top bar social icons link in new window', 'grandrestaurant' ),
        'section'  => 'menu_topbar',
        'default'  => 1,
        'priority' => 22,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_topbar_color_title',
        'label'    => esc_html__('Color Settings', 'grandrestaurant' ),
        'section'  => 'menu_topbar',
        'priority' => 23,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_topbar_bg_color',
        'label'    => __( 'Top Bar Background Color', 'grandrestaurant' ),
        'section'  => 'menu_topbar',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => '.above_top_bar',
	            'property' => 'background',
	        ),
	    ),
	    'priority' => 24,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_topbar_font_color',
        'label'    => __( 'Top Bar Menu Font Color', 'grandrestaurant' ),
        'section'  => 'menu_topbar',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.above_top_bar, #top_menu li a, .top_contact_info i, .top_contact_info a, .top_contact_info',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 25,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_topbar_social_color',
        'label'    => __( 'Top Bar Social Icon Color', 'grandrestaurant' ),
        'section'  => 'menu_topbar',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.above_top_bar .social_wrapper ul li a, .above_top_bar .social_wrapper ul li a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 26,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_menu_contact_address',
        'label'    => __( 'Contact Address (Optional)', 'grandrestaurant' ),
        'description' => __('Enter your restaurant location address.', 'grandrestaurant' ),
        'section'  => 'menu_contact',
        'default'  => '732/21 Second Street, King Street, United Kingdom',
        'transport' 	 => 'postMessage',
	    'priority' => 26,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_menu_contact_hours',
        'label'    => __( 'Open Hours (Optional)', 'grandrestaurant' ),
        'description' => __('Enter your restaurant open hours.', 'grandrestaurant' ),
        'section'  => 'menu_contact',
        'default'  => '',
        'transport' 	 => 'postMessage',
	    'priority' => 26,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'tg_menu_contact_number',
        'label'    => __( 'Contact Phone Number (Optional)', 'grandrestaurant' ),
        'description' => __('Enter your restaurant contact phone number.', 'grandrestaurant' ),
        'section'  => 'menu_contact',
        'default'  => '+65.4566743',
        'transport' => 'postMessage',
	    'priority' => 27,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_menu_search_general_title',
        'label'    => esc_html__('General Settings', 'grandrestaurant' ),
        'section'  => 'menu_search',
        'priority' => 28,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_menu_search',
        'label'    => __( 'Enable Search', 'grandrestaurant' ),
        'description' => __('Select to display search form in header of side menu', 'grandrestaurant' ),
        'section'  => 'menu_search',
        'default'  => 1,
	    'priority' => 29,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_menu_search_instant',
        'label'    => __( 'Enable Instant Search', 'grandrestaurant' ),
        'description' => __('Select to display search result instantly while typing', 'grandrestaurant' ),
        'section'  => 'menu_search',
        'default'  => 1,
	    'priority' => 30,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_menu_search_color_title',
        'label'    => esc_html__('Color Settings', 'grandrestaurant' ),
        'section'  => 'menu_search',
        'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_search_input_color',
        'label'    => __( 'Search Input Background Color', 'grandrestaurant' ),
        'section'  => 'menu_search',
        'default'  => '#333333',
        'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform',
	            'property' => 'background',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 32,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_menu_search_font_color',
        'label'    => __( 'Search Input Font Color', 'grandrestaurant' ),
        'section'  => 'menu_search',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.mobile_menu_wrapper #searchform input[type=text], .mobile_menu_wrapper #searchform button i, .mobile_menu_wrapper #close_mobile_menu i',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 33,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_sidemenu_general_title',
        'label'    => esc_html__('General Settings', 'grandrestaurant' ),
        'section'  => 'menu_sidemenu',
        'priority' => 30,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_sidemenu',
        'label'    => __( 'Enable Side Menu on Desktop', 'grandrestaurant' ),
        'description' => 'Check this option to enable side menu on desktop',
        'section'  => 'menu_sidemenu',
        'default'  => 1,
	    'priority' => 31,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_sidemenu_font_title',
        'label'    => esc_html__('Typography Settings', 'grandrestaurant' ),
        'section'  => 'menu_sidemenu',
        'priority' => 32,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_sidemenu_typography',
        'label'    => esc_html__('Side Menu Typography', 'grandrestaurant' ),
        'section'  => 'menu_sidemenu',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => 'regular',
            'font-size'      => '24px',
            'line-height'    => '2',
            'letter-spacing' => '0',
            'text-transform' => 'uppercase',
        ),
        'output' => array(
            array(
                'element'  => '.mobile_main_nav li a, #sub_menu li a',
            ),
        ),
        'priority' => 33
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_sidemenu_bg_title',
        'label'    => esc_html__('Color Settings', 'grandrestaurant' ),
        'section'  => 'menu_sidemenu',
        'priority' => 43,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidemenu_bg_color',
        'label'    => __( 'Side Menu Background', 'grandrestaurant' ),
        'section'  => 'menu_sidemenu',
        'default'     => '#000000',
        'output' => '.mobile_menu_wrapper',
        'output' => array(
            array(
                'element'  => '.mobile_menu_wrapper',
                'property' => 'background-color',
            ),
        ),
        'priority' => 44,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidemenu_font_color',
        'label'    => __( 'Side Menu Font Color', 'grandrestaurant' ),
        'section'  => 'menu_sidemenu',
        'default'  => '#777777',
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a, #sub_menu li a, .mobile_menu_wrapper .sidebar_wrapper a, .mobile_menu_wrapper .sidebar_wrapper, #tg_sidemenu_reservation',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '#tg_sidemenu_reservation',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 45,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidemenu_hover_font_color',
        'label'    => __( 'Side Menu Hover State Font Color', 'grandrestaurant' ),
        'section'  => 'menu_sidemenu',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.mobile_main_nav li a:hover, .mobile_main_nav li a:active, #sub_menu li a:hover, #sub_menu li a:active, .mobile_menu_wrapper .sidebar_wrapper h2.widgettitle, .mobile_main_nav li.current-menu-item a, #tg_sidemenu_reservation:hover',
	            'property' => 'color',
	        ),
	        array(
	            'element'  => '#tg_sidemenu_reservation:hover',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 46,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_fullmenu_default',
        'label'    => esc_html__('Default Fullscreen Menu (Optional)', 'grandrestaurant' ),
        'description' => esc_html__('Select default fullscreen menu for all pages', 'grandrestaurant' ),
        'section'  => 'menu_fullmenu',
        'default'  => '',
        'choices'  => $grandrestaurant_fullmenu_select,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'grandrestaurant_fullmenu_effect',
        'label'    => esc_html__('Fullscreen Menu Effect', 'grandrestaurant' ),
        'description' => esc_html__('Select transition effect for fullscreen menu', 'grandrestaurant' ),
        'section'  => 'menu_fullmenu',
        'default'  => '',
        'choices'  => $grandrestaurant_fullmenu_effect_select,
        'priority' => 2,
    );
    //End Menu Tab Settings
    
    //Register Header Tab Settings
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_page_title_img_blur',
        'label'    => __( 'Add Blur Effect When Scroll', 'grandrestaurant' ),
        'description' => __('Enable this option to add blur effect to header background image when scrolling pass it', 'grandrestaurant' ),
        'section'  => 'header_background',
        'default'  => '1',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_page_header_bg_color',
        'label'    => __( 'Page Header Background Color', 'grandrestaurant' ),
        'section'  => 'header_background',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '#page_caption',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 18,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_page_title_layout_title',
        'label'    => esc_html__('Layout Settings', 'grandrestaurant' ),
        'section'  => 'header_title',
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_page_header_padding_top',
        'label'    => __( 'Page Header Padding Top', 'grandrestaurant' ),
        'section'  => 'header_title',
        'default'  => 5,
        'choices' => array( 'min' => 0, 'max' => 200, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption',
	            'property' => 'padding-top',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_page_header_padding_bottom',
        'label'    => __( 'Page Header Padding Bottom', 'grandrestaurant' ),
        'section'  => 'header_title',
        'default'  => 10,
        'choices' => array( 'min' => 0, 'max' => 200, 'step' => 1 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption',
	            'property' => 'padding-bottom',
	            'units'    => 'px',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_page_title_align',
        'label'    => __( 'Page Title Text Alignment', 'grandrestaurant' ),
        'section'  => 'header_title',
        'default'  => 'left',
        'choices'  => $tg_text_alignment,
        'transport' => 'postMessage',
        'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_page_title_typography_title',
        'label'    => esc_html__('Typography Settings', 'grandrestaurant' ),
        'section'  => 'header_title',
        'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_page_title_typography',
        'label'    => esc_html__('Page Title Typography', 'grandrestaurant' ),
        'section'  => 'header_title',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '700',
            'font-size'      => '60px',
            'line-height'    => '1.2',
            'letter-spacing' => '0',
            'text-transform' => 'none',
            'color'			 => '#222222',
        ),
        'output' => array(
            array(
                'element'  => '#page_caption h1, .ppb_title',
            ),
        ),
        'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_header_builder_typography_title',
        'label'    => esc_html__('Mixed Typography Settings', 'grandrestaurant' ),
        'section'  => 'header_title',
        'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_header_builder_font_mixed',
        'label'    => __( 'Enable Mixed Typography for Content Builder Header', 'grandrestaurant' ),
        'description' => __('Enable this option to add stylish italic typorgraphy for first work of content builder header', 'grandrestaurant' ),
        'section'  => 'header_title',
        'default'  => '1',
        'priority' => 10,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_page_title_mixed_typography',
        'label'    => esc_html__('Page Title Mixed Typography', 'grandrestaurant' ),
        'section'  => 'header_title',
        'default'  => array(
            'font-family'    => 'Kristi',
            'variant'        => '700',
            'font-size'      => '70px',
            'line-height'    => '1',
            'letter-spacing' => '0',
            'text-transform' => 'none',
            'color'			 => '#cfa670',
        ),
        'output' => array(
            array(
                'element'  => '.ppb_title_first',
            ),
        ),
        'priority' => 10,
    );
        
    $controls[] = array(
        'type'     => 'slider',
        'settings'  => 'tg_page_title_bg_height',
        'label'    => __( 'Page Title With Background Image Height (in %)', 'grandrestaurant' ),
        'section'  => 'header_title_bg',
        'default'  => 70,
        'choices' => array( 'min' => 10, 'max' => 100, 'step' => 5 ),
        'output' => array(
	        array(
	            'element'  => '#page_caption.hasbg',
	            'property' => 'height',
	            'units'    => 'vh',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_page_title_bg_align',
        'label'    => __( 'Page Title With Background Image Text Alignment', 'grandrestaurant' ),
        'section'  => 'header_title_bg',
        'default'  => 'baseline',
        'choices'  => $tg_vertical_alignment,
	    'transport' => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_header_builder_typography',
        'label'    => esc_html__('Content Builder Header Typography', 'grandrestaurant' ),
        'section'  => 'header_builder_title',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '700',
            'font-size'      => '60px',
            'line-height'    => '1',
            'letter-spacing' => '0',
            'text-transform' => 'uppercase',
            'color'			 => '#222222',
        ),
        'output' => array(
            array(
                'element'  => 'h2.ppb_title',
            ),
        ),
        'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_header_builder_hr_color',
        'label'    => __( 'Content Builder Header Line Separator Color', 'grandrestaurant' ),
        'section'  => 'header_builder_title',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => '.page_header_sep',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_page_tagline_typography',
        'label'    => esc_html__('Page Tagline Typography', 'grandrestaurant' ),
        'section'  => 'header_tagline',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '700',
            'font-size'      => '11px',
            'line-height'    => '1.8',
            'letter-spacing' => '2px',
            'text-transform' => 'uppercase',
            'color'			 => '#424242',
        ),
        'output' => array(
            array(
                'element'  => '#page_caption.hasbg .post_detail, #page_caption.hasbg .post_detail a, #page_caption.hasbg .post_detail a:hover, #page_caption.hasbg .post_detail a:active, .page_tagline',
            ),
        ),
        'priority' => 6,
    );
    //End Header Tab Settings
    
    //Register Sidebar Tab Settings
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_widget_title_typography',
        'label'    => esc_html__('Widget Title Typography', 'grandrestaurant' ),
        'section'  => 'sidebar_typography',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '700',
            'font-size'      => '12px',
            'line-height'    => '1.8',
            'letter-spacing' => '2px',
            'text-transform' => 'uppercase',
            'color'			 => '#222222',
        ),
        'output' => array(
            array(
                'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, h5.related_post, .fullwidth_comment_wrapper h5.comment_header, .author_label, #respond h3, .about_author, .related.products h2, .cart_totals h2, .shipping_calcuLator h2, .upsells.products h2, .cross-sells h2, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .sidebar .content .sidebar_widget li.widget_block h2',
            ),
        ),
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidebar_font_color',
        'label'    => __( 'Sidebar Font Color', 'grandrestaurant' ),
        'section'  => 'sidebar_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper .sidebar .content, .page_content_wrapper .inner .sidebar_wrapper .sidebar .content, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a',
	            'property' => 'color',
	        ),
            array(
                'element'  => '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a',
                'property' => 'border-color',
            ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidebar_link_color',
        'label'    => __( 'Sidebar Link Color', 'grandrestaurant' ),
        'section'  => 'sidebar_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper a, .page_content_wrapper .inner .sidebar_wrapper a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidebar_hover_link_color',
        'label'    => __( 'Sidebar Hover Link Color', 'grandrestaurant' ),
        'section'  => 'sidebar_color',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active, .page_content_wrapper .inner .sidebar_wrapper a:hover, .page_content_wrapper .inner .sidebar_wrapper a:active',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_sidebar_title_color',
        'label'    => __( 'Sidebar Widget Title Font Color', 'grandrestaurant' ),
        'section'  => 'sidebar_color',
        'default'  => '#222222',
        'output' => array(
	        array(
	            'element'  => '#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, h5.related_post, .fullwidth_comment_wrapper h5.comment_header, .author_label, #respond h3, .about_author',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 9,
    );
    //End Sidebar Tab Settings
    
    //Register Footer Tab Settings
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_footer_content_title',
        'label'    => esc_html__('Footer Content Settings', 'grandrestaurant' ),
        'section'  => 'footer_general',
	    'priority' => 0,
    );
    
    $controls[] = array(
        'type'     => 'radio',
        'settings'  => 'grandrestaurant_footer_content',
        'label'    => esc_html__('Display Footer Content From', 'grandrestaurant' ),
        'description' => esc_html__('Select how theme get main footer content', 'grandrestaurant' ),
        'section'  => 'footer_general',
        'default'  => 'sidebar',
        'choices'  => $grandrestaurant_footer_content,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'grandrestaurant_footer_content_default',
        'label'    => esc_html__('Default Footer Content', 'grandrestaurant' ),
        'description' => esc_html__('Select default footer content for general pages & posts', 'grandrestaurant' ),
        'section'  => 'footer_general',
        'default'  => '',
        'choices'  => $grandrestaurant_footers_select,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_footer_default_title',
        'label'    => esc_html__('Footer Sidebar Settings', 'grandrestaurant' ),
        'section'  => 'footer_general',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'textarea',
        'settings'  => 'tg_footer_text',
        'label'    => __( 'Footer Text (Optional)', 'grandrestaurant' ),
        'description' => __('Enter footer text. it displays under footer logo, above footer sidebar (HTML support)', 'grandrestaurant' ),
        'section'  => 'footer_general',
        'default'  => '',
        'transport' 	 => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_footer_sidebar',
        'label'    => __( 'Footer Sidebar Columns', 'grandrestaurant' ),
        'section'  => 'footer_general',
        'default'  => 4,
        'choices'  => $tg_copyright_column,
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_footer_social_link',
        'label'    => __( 'Open Footer Social Icons link in new window', 'grandrestaurant' ),
        'description' => __('Check this to open footer social icons link in new window', 'grandrestaurant' ),
        'section'  => 'footer_general',
        'default'  => 1,
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_bg_color',
        'label'    => __( 'Footer Background', 'grandrestaurant' ),
        'section'  => 'footer_color',
	    'default'     => '#262626',
	    'output' => array(
	        array(
	            'element'  => '.footer_bar',
	            'property' => 'background-color',
	        ),
	    ),
	    'transport' => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_font_color',
        'label'    => __( 'Footer Font Color', 'grandrestaurant' ),
        'section'  => 'footer_color',
        'default'  => '#999999',
        'output' => array(
	        array(
	            'element'  => '#footer, #copyright',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 10,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_link_color',
        'label'    => __( 'Footer Link Color', 'grandrestaurant' ),
        'section'  => 'footer_color',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '#copyright a, #copyright a:active, .social_wrapper ul li a, #footer a, #footer a:active, #footer_before_widget_text a, #footer_before_widget_text a:active, #footer .sidebar_widget li h2.widgettitle',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 11,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_hover_link_color',
        'label'    => __( 'Footer Hover Link Color', 'grandrestaurant' ),
        'section'  => 'footer_color',
        'default'  => '#cfa670',
        'output' => array(
	        array(
	            'element'  => '#copyright a:hover, #footer a:hover, .social_wrapper ul li a:hover, #footer_before_widget_text a:hover',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 12,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_border_color',
        'label'    => __( 'Footer Border Color', 'grandrestaurant' ),
        'section'  => 'footer_color',
        'default'  => '#444444',
        'output' => array(
	        array(
	            'element'  => '.footer_bar_wrapper',
	            'property' => 'border-color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_social_color',
        'label'    => __( 'Footer Social Icon Color', 'grandrestaurant' ),
        'section'  => 'footer_color',
        'default'  => '#ffffff',
        'output' => array(
	        array(
	            'element'  => '.footer_bar_wrapper .social_wrapper ul li a',
	            'property' => 'color',
	        ),
	    ),
	    'transport' 	 => 'postMessage',
	    'priority' => 13,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_footer_copyright_title',
        'label'    => esc_html__('Copyright Content Settings', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'textarea',
        'settings'  => 'tg_footer_copyright_text',
        'label'    => __( 'Copyright Text', 'grandrestaurant' ),
        'description' => __('Enter your copyright text.', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'default'  => '© Copyright Grand Restaurant Theme Demo - Theme by ThemeGoods',
        'transport' 	 => 'postMessage',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_footer_copyright_typography',
        'label'    => esc_html__('Copyright Typography', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '400',
            'font-size'      => '12px',
            'line-height'    => '1.8',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
            'color'			 => '#999999',
        ),
        'output' => array(
            array(
                'element'  => '#copyright, #footer_menu li a',
            ),
        ),
        'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_footer_copyright_right_area',
        'label'    => __( 'Copyright Right Area Content', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'default'  => 'menu',
        'choices'  => $tg_copyright_content,
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_footer_copyright_alignment',
        'label'    => __( 'Copyright Content Alignment', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'default'  => 'menu',
        'choices'  => $tg_copyright_text_alignment,
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_copyright_bg',
        'label'    => __( 'Copyright Background Color', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'default'  => '#1b1b1b',
        'output' => array(
            array(
                'element'  => '.footer_bar_wrapper',
                'property' => 'background',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'tg_footer_copyright_totop_title',
        'label'    => esc_html__('Go To Top Settings', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_footer_copyright_totop',
        'label'    => __( 'Go To Top Button', 'grandrestaurant' ),
        'description' => 'Check this option to enable go to top button at the bottom of page when scrolling',
        'section'  => 'footer_copyright',
        'default'  => 1,
        'priority' => 9,
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_copyright_totop_bg',
        'label'    => esc_html__('Go To Top Button Background', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'priority' => 10,
        'default'  => 'rgba(0,0,0,0.1)',
        'output' => array(
            array(
                'element'  => 'a#toTop',
                'property' => 'background',
            ),
        ),
        'js_vars'   => array(
            array(
                'element'  => 'a#toTop',
                'function' => 'css',
                'property' => 'background',
            ),
        ),
    );
    
    $controls[] = array(
        'type'     => 'color',
        'settings'  => 'tg_footer_copyright_totop_font_color',
        'label'    => esc_html__('Go To Top Button Font Color', 'grandrestaurant' ),
        'section'  => 'footer_copyright',
        'default'  => '#ffffff',
        'output' => array(
            array(
                'element'  => 'a#toTop',
                'property' => 'color',
            ),
        ),
        'transport' 	 => 'postMessage',
        'priority' => 10,
        'js_vars'   => array(
            array(
                'element'  => 'a#toTop',
                'function' => 'css',
                'property' => 'color',
            ),
        ),
    );
    //End Footer Tab Settings
    
    
    //Begin Gallery Tab Settings
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_gallery_sort',
        'label'    => __( 'Gallery Images Sorting', 'grandrestaurant' ),
        'section'  => 'gallery_sorting',
        'default'  => 'drag',
        'choices'  => $tg_gallery_sort,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_gallery_grid_dimensions_title',
        'label'    => esc_html__('Gallery Grid Image Dimensions', 'grandrestaurant' ),
        'section'  => 'gallery_image',
	    'priority' => 0,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_gallery_grid_width',
        'label'    => esc_html__('Image Width', 'grandrestaurant' ),
        'description' => esc_html__('Enter gallery grid image width(in pixels).', 'grandrestaurant' ),
        'section'  => 'gallery_image',
        'default'  => 700,
        'transport' 	 => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_gallery_grid_height',
        'label'    => esc_html__('Image Height', 'grandrestaurant' ),
        'description' => esc_html__('Enter gallery grid image height(in pixels). Please enter 9999 for auto height.', 'grandrestaurant' ),
        'section'  => 'gallery_image',
        'default'  => 466,
        'transport' 	 => 'postMessage',
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_gallery_masonry_dimensions_title',
        'label'    => esc_html__('Gallery Masonry Image Dimensions', 'grandrestaurant' ),
        'section'  => 'gallery_image',
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_gallery_masonry_width',
        'label'    => esc_html__('Image Width', 'grandrestaurant' ),
        'description' => esc_html__('Enter gallery masonry image width(in pixels).', 'grandrestaurant' ),
        'section'  => 'gallery_image',
        'default'  => 440,
        'transport' 	 => 'postMessage',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_gallery_masonry_height',
        'label'    => esc_html__('Image Height', 'grandrestaurant' ),
        'description' => esc_html__('Enter gallery masonry image height(in pixels). Please enter 9999 for auto height.', 'grandrestaurant' ),
        'section'  => 'gallery_image',
        'default'  => 9999,
        'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_gallery_list_dimensions_title',
        'label'    => esc_html__('Gallery List Image Dimensions', 'grandrestaurant' ),
        'section'  => 'gallery_image',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_gallery_list_width',
        'label'    => esc_html__('Image Width', 'grandrestaurant' ),
        'description' => esc_html__('Enter gallery list image width(in pixels).', 'grandrestaurant' ),
        'section'  => 'gallery_image',
        'default'  => 610,
        'transport' 	 => 'postMessage',
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_gallery_list_height',
        'label'    => esc_html__('Image Height', 'grandrestaurant' ),
        'description' => esc_html__('Enter gallery list image height(in pixels). Please enter 9999 for auto height.', 'grandrestaurant' ),
        'section'  => 'gallery_image',
        'default'  => 610,
        'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_enable_theme_lightbox',
        'label'    => esc_html__('Enable Theme Lightbox', 'grandrestaurant' ),
        'description' => esc_html__('Check this to enable theme default lightbox option.', 'grandrestaurant' ),
        'section'  => 'gallery_lightbox',
        'default'  => 1,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'radio-buttonset',
        'settings'  => 'tg_lightbox_color_scheme',
        'label'    => esc_html__('Select lightbox color scheme', 'grandrestaurant' ),
        'description' => esc_html__('Select which alignment you want to use for lightbox thumbnails', 'grandrestaurant' ),
        'section'  => 'gallery_lightbox',
        'default'  => 'black',
        'choices'  => $tg_lightbox_skin,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_lightbox_enable_title',
        'label'    => esc_html__('Display image title in lightbox', 'grandrestaurant' ),
        'description' => esc_html__('Check if you want to display image title under the image in lightbox mode', 'grandrestaurant' ),
        'section'  => 'gallery_lightbox',
        'default'  => 1,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_lightbox_enable_caption',
        'label'    => __( 'Display image caption in lightbox', 'grandrestaurant' ),
        'description' => __('Check if you want to display image caption under the image in lightbox mode', 'grandrestaurant' ),
        'section'  => 'gallery_lightbox',
        'default'  => 1,
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_lightbox_thumbnails',
        'label'    => esc_html__('Display thumbnails', 'grandrestaurant' ),
        'description' => esc_html__('Check if you want to display gallery thumbnail under the main image in lightbox mode', 'grandrestaurant' ),
        'section'  => 'gallery_lightbox',
        'default'  => 1,
        'priority' => 1,
    );
    //End Gallery Tab Settings
        
    //Begin Blog Tab Settings
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_full',
        'label'    => __( 'Display Full Blog Post Content', 'grandrestaurant' ),
        'description' => __('Check this option to display post full content in blog page (excerpt blog grid layout)', 'grandrestaurant' ),
        'section'  => 'blog_general',
        'default'  => 0,
	    'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_blog_archive_layout',
        'label'    => __( 'Archive Page Layout', 'grandrestaurant' ),
        'description' => __('Select page layout for displaying archive page', 'grandrestaurant' ),
        'section'  => 'blog_general',
        'default'  => 'blog_g',
        'choices'  => $tg_blog_layout,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_blog_category_layout',
        'label'    => __( 'Category Page Layout', 'grandrestaurant' ),
        'description' => __('Select page layout for displaying category page', 'grandrestaurant' ),
        'section'  => 'blog_general',
        'default'  => 'blog_g',
        'choices'  => $tg_blog_layout,
	    'priority' => 2,
    );
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_blog_tag_layout',
        'label'    => __( 'Tag Page Layout', 'grandrestaurant' ),
        'description' => __('Select page layout for displaying tag page', 'grandrestaurant' ),
        'section'  => 'blog_general',
        'default'  => 'blog_g',
        'choices'  => $tg_blog_layout,
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_blog_classic_dimensions_title',
        'label'    => esc_html__('Blog Classic Image Dimensions', 'grandrestaurant' ),
        'section'  => 'blog_image',
	    'priority' => 3,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_blog_classic_width',
        'label'    => esc_html__('Image Width', 'grandrestaurant' ),
        'description' => esc_html__('Enter blog classic featured image width(in pixels).', 'grandrestaurant' ),
        'section'  => 'blog_image',
        'default'  => 960,
        'transport' 	 => 'postMessage',
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_blog_classic_height',
        'label'    => esc_html__('Image Height', 'grandrestaurant' ),
        'description' => esc_html__('Enter blog classic featured image height(in pixels). Please enter 9999 for auto height.', 'grandrestaurant' ),
        'section'  => 'blog_image',
        'default'  => 500,
        'transport' 	 => 'postMessage',
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'title',
        'settings'  => 'grandrestaurant_blog_grid_dimensions_title',
        'label'    => esc_html__('Blog Grid Image Dimensions', 'grandrestaurant' ),
        'section'  => 'blog_image',
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_blog_grid_width',
        'label'    => esc_html__('Image Width', 'grandrestaurant' ),
        'description' => esc_html__('Enter blog grid featured image width(in pixels).', 'grandrestaurant' ),
        'section'  => 'blog_image',
        'default'  => 480,
        'transport' 	 => 'postMessage',
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'grandrestaurant_blog_grid_height',
        'label'    => esc_html__('Image Height', 'grandrestaurant' ),
        'description' => esc_html__('Enter blog grid featured image height(in pixels). Please enter 9999 for auto height.', 'grandrestaurant' ),
        'section'  => 'blog_image',
        'default'  => 302,
        'transport' 	 => 'postMessage',
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_blog_single_title_typography',
        'label'    => esc_html__('Single Post Title Typography', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '600',
            'font-size'      => '40px',
            'line-height'    => '1.3',
            'letter-spacing' => '0',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => 'body.single-post #page_caption h1',
            ),
        ),
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_blog_single_detail_typography',
        'label'    => esc_html__('Single Post Detail Typography', 'grandconference' ),
        'section'  => 'blog_single',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '400',
            'font-size'      => '13px',
            'line-height'    => '1.5',
            'letter-spacing' => '3px',
            'text-transform' => 'uppercase',
        ),
        'output' => array(
            array(
                'element'  => 'body.single-post #page_caption .post_detail',
            ),
        ),
        'priority' => 1,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_header_bg',
        'label'    => __( 'Display Post Header', 'grandrestaurant' ),
        'description' => __('Check this to display featured image as post header background', 'grandrestaurant' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 4,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_feat_content',
        'label'    => __( 'Display Post Featured Content', 'grandrestaurant' ),
        'description' => __('Check this to display featured content (image or gallery) in single post page', 'grandrestaurant' ),
        'section'  => 'blog_single',
        'default'  => 0,
	    'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_date',
        'label'    => __( 'Display Post Date', 'grandrestaurant' ),
        'description' => __('Check this to display post date in single post page', 'grandrestaurant' ),
        'section'  => 'blog_single',
        'default'  => 1,
        'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_cat',
        'label'    => __( 'Display Post Categories', 'grandrestaurant' ),
        'description' => __('Check this to display post categories in single post page', 'grandrestaurant' ),
        'section'  => 'blog_single',
        'default'  => 1,
        'priority' => 5,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_tags',
        'label'    => __( 'Display Post Tags', 'grandrestaurant' ),
        'description' => __('Check this option to display post tags on single post page', 'grandrestaurant' ),
        'section'  => 'blog_single',
        'default'  => 0,
	    'priority' => 6,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_author',
        'label'    => __( 'Display About Author', 'grandrestaurant' ),
        'description' => __('Check this option to display about author on single post page', 'grandrestaurant' ),
        'section'  => 'blog_single',
        'default'  => 1,
	    'priority' => 7,
    );
    
    $controls[] = array(
        'type'     => 'toggle',
        'settings'  => 'tg_blog_display_related',
        'label'    => __( 'Display Related Posts', 'grandrestaurant' ),
        'description' => __('Check this option to display related posts on single post page', 'grandrestaurant' ),
        'section'  => 'blog_single',
        'default'  => 0,
	    'priority' => 8,
    );
    
    $controls[] = array(
        'type'     => 'typography',
        'settings'  => 'tg_blog_title_typography',
        'label'    => esc_html__('Post Title Typography', 'grandrestaurant' ),
        'section'  => 'blog_typography',
        'default'  => array(
            'font-family'    => 'Lato',
            'variant'        => '700',
            'letter-spacing' => '0px',
            'text-transform' => 'none',
        ),
        'output' => array(
            array(
                'element'  => '.post_header:not(.single) h5, body.single-post .post_header_title h1, #post_featured_slider li .slider_image .slide_post h2, #autocomplete li strong, .post_related strong, #footer ul.sidebar_widget .posts.blog li a, body.single-post #page_caption h1',
            ),
        ),
        'priority' => 8,
    );
    //End Blog Tab Settings
    
    $controls[] = array(
        'type'     => 'select',
        'settings'  => 'tg_pages_template_404',
        'label'    => esc_html__('Default 404 Page', 'grandrestaurant' ),
        'description' => esc_html__('Select a page template for 404 not found page', 'grandrestaurant' ),
        'section'  => 'pages_templates',
        'default'  => '',
        'choices'  => grandrestaurant_get_published_pages(),
        'priority' => 1,
    );
    
    //Check if Woocommerce is installed	
	if(class_exists('Woocommerce'))
	{
        $controls[] = array(
            'type'     => 'title',
            'settings'  => 'tg_shop_title',
            'label'    => esc_html__('Shop Settings', 'grandrestaurant' ),
            'section'  => 'shop_layout',
            'priority' => 0,
        );
        
		//Begin Shop Tab Settings
		$controls[] = array(
	        'type'     => 'radio-buttonset',
	        'settings'  => 'tg_shop_layout',
	        'label'    => __( 'Shop Main Page Layout', 'grandrestaurant' ),
	        'description' => __('Select page layout for displaying shop\'s products page', 'grandrestaurant' ),
	        'section'  => 'shop_layout',
	        'default'  => 'fullwidth',
	        'choices'  => $tg_shop_layout,
		    'priority' => 1,
	    );
        
        $controls[] = array(
            'type'     => 'radio',
            'settings'  => 'tg_shop_columns',
            'label'    => esc_html__('Shop Page Columns', 'grandrestaurant' ),
            'section'  => 'shop_layout',
            'default'  => '3',
            'choices'  => $tg_shop_column,
            'priority' => 1,
        );
	    
	    $controls[] = array(
	        'type'     => 'slider',
	        'settings'  => 'tg_shop_items',
	        'label'    => __( 'Products Page Show At Most', 'grandrestaurant' ),
	        'description' => __('Select number of product items you want to display per page', 'grandrestaurant' ),
	        'section'  => 'shop_layout',
	        'default'  => 16,
	        'choices' => array( 'min' => 1, 'max' => 100, 'step' => 1 ),
		    'priority' => 2,
	    );
        
        $controls[] = array(
            'type'     => 'title',
            'settings'  => 'tg_shop_mini_cart_title',
            'label'    => esc_html__('Mini Cart Settings', 'grandrestaurant' ),
            'section'  => 'shop_layout',
            'priority' => 3,
        );
        
        $controls[] = array(
            'type'     => 'toggle',
            'settings'  => 'tg_mini_cart',
            'label'    => esc_html__('Display Mini Cart When added new item to cart', 'grandrestaurant' ),
            'description' => esc_html__('Check this option to display fly-out mini cart when item has been added to the cart', 'grandrestaurant' ),
            'section'  => 'shop_layout',
            'default'  => 1,
            'priority' => 4,
        );
	    
	    $controls[] = array(
            'type'     => 'typography',
            'settings'  => 'tg_shop_single_product_title_typography',
            'label'    => esc_html__('Single Product Title Typography', 'grandrestaurant' ),
            'section'  => 'shop_single',
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '600',
                'font-size'      => '40px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'color'          => '#444444'
            ),
            'output' => array(
                array(
                    'element'  => 'h1.product_title',
                ),
            ),
            'priority' => 4,
        );
        
        $controls[] = array(
            'type'     => 'typography',
            'settings'  => 'tg_shop_single_product_pricing_typography',
            'label'    => esc_html__('Single Product Pricing Typography', 'grandrestaurant' ),
            'section'  => 'shop_single',
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => 'regular',
                'font-size'      => '22px',
                'line-height'    => '1.8',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'color'          => '#444444'
            ),
            'output' => array(
                array(
                    'element'  => '.single-product.woocommerce-page div.product p.price span.amount',
                ),
            ),
            'priority' => 4,
        );
        
        $controls[] = array(
            'type'     => 'color',
            'settings'  => 'tg_shop_price_font_color',
            'label'    => __( 'Product Price Font Color', 'grandrestaurant' ),
            'section'  => 'shop_single',
            'default'  => '#cfa670',
            'output' => array(
                array(
                    'element'  => '.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, p.price ins span.amount, p.price span.amount, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price',
                    'property' => 'color',
                ),
            ),
            'transport' 	 => 'postMessage',
            'priority' => 5,
        );
	    
	    $controls[] = array(
	        'type'     => 'toggle',
	        'settings'  => 'tg_shop_related_products',
	        'label'    => __( 'Display Related Products', 'grandrestaurant' ),
	        'description' => __('Check this option to display related products on single product page', 'grandrestaurant' ),
	        'section'  => 'shop_single',
	        'default'  => 1,
		    'priority' => 5,
	    );
        
        $controls[] = array(
            'type'     => 'title',
            'settings'  => 'tg_shop_product_grid_title',
            'label'    => esc_html__('Product Grid Settings', 'grandrestaurant' ),
            'section'  => 'shop_typography',
            'priority' => 1,
        );
        
        $controls[] = array(
            'type'     => 'typography',
            'settings'  => 'tg_shop_product_grid_title_typography',
            'label'    => esc_html__('Product Grid Title Typography', 'grandrestaurant' ),
            'section'  => 'shop_typography',
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '600',
                'font-size'      => '22px',
                'line-height'    => '1.8',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'color'          => '#444444'
            ),
            'output' => array(
                array(
                    'element'  => '.woocommerce ul.products li.product h2.woocommerce-loop-product__title, .woocommerce-page ul.products li.product h2.woocommerce-loop-product__title',
                ),
            ),
            'priority' => 2,
        );
        
        $controls[] = array(
            'type'     => 'typography',
            'settings'  => 'tg_shop_product_grid_pricing_typography',
            'label'    => esc_html__('Product Grid Pricing Typography', 'grandrestaurant' ),
            'section'  => 'shop_typography',
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => 'regular',
                'font-size'      => '18px',
                'line-height'    => '1.8',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'color'          => '#444444'
            ),
            'output' => array(
                array(
                    'element'  => '.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price',
                ),
            ),
            'priority' => 3,
        );
        
        $controls[] = array(
            'type'     => 'title',
            'settings'  => 'tg_shop_checkout_title',
            'label'    => esc_html__('Checkout Settings', 'grandrestaurant' ),
            'section'  => 'shop_typography',
            'priority' => 4,
        );
        
        $controls[] = array(
            'type'     => 'typography',
            'settings'  => 'tg_shop_checkout_title_typography',
            'label'    => esc_html__('Checkout Title Typography', 'grandrestaurant' ),
            'section'  => 'shop_typography',
            'default'  => array(
                'font-family'    => 'Lato',
                'variant'        => '600',
                'font-size'      => '26px',
                'line-height'    => '1.8',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'color'          => '#444444'
            ),
            'output' => array(
                array(
                    'element'  => '.checkout h3',
                ),
            ),
            'priority' => 5,
        );
		//End Shop Tab Settings
	}

    return $controls;
}
add_filter( 'kirki/controls', 'tg_custom_setting' );


function tg_customize_preview()
{
?>
    <script type="text/javascript">
        ( function( $ ) {
        	//Register Logo Tab Settings
        	wp.customize('tg_retina_logo',function( value ) {
                value.bind(function(to) {
                    jQuery('#custom_logo img').attr('src', to );
                });
            });
        	//End Logo Tab Settings
        
			//Register General Tab Settings
            wp.customize('tg_body_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'https://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('body, input[type=text], input[type=email], input[type=url], input[type=password], textarea').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_body_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('body').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_header_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'https://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('h1, h2, h3, h4, h5, h6, h7, input[type=submit], input[type=button], a.button, .button, blockquote, #autocomplete li strong, #autocomplete li.view_all, .post_quote_title, label, .portfolio_filter_dropdown, .woocommerce ul.products li.product .price, .woocommerce ul.products li.product .button, .woocommerce ul.products li.product a.add_to_cart_button.loading, .woocommerce-page ul.products li.product a.add_to_cart_button.loading, .woocommerce ul.products li.product a.add_to_cart_button:hover, .woocommerce-page ul.products li.product a.add_to_cart_button:hover, .woocommerce #page_content_wrapper a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page  #page_content_wrapper a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page input.button:active, .woocommerce #page_content_wrapper a.button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button, .woocommerce.columns-4 ul.products li.product a.add_to_cart_button:hover, strong[itemprop="author"], #footer_before_widget_text').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_header_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('h1, h2, h3, h4, h5, h6, h7').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_h1_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h1').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_h2_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h2').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_h3_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h3').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_h4_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h4').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_h5_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h5').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_h6_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h6').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('body, .pagination a, .slider_wrapper .gallery_image_caption h2, .post_info a').css('color', to );
                    jQuery('::selection').css('background-color', to );
                });
            });
            
            wp.customize('tg_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('a').css('color', to );
                });
            });
            
            wp.customize('tg_hover_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('a:hover, a:active, .post_info_comment a i').css('color', to );
                });
            });
            
            wp.customize('tg_hr_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#social_share_wrapper, hr, #social_share_wrapper, .post.type-post, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, .comment .right, .widget_tag_cloud div a, .meta-tags a, .tag_cloud a, #footer, #post_more_wrapper, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, #page_content_wrapper .inner .sidebar_content, #page_caption, #page_content_wrapper .inner .sidebar_content.left_sidebar, .ajax_close, .ajax_next, .ajax_prev, .portfolio_next, .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_next, .separated, .blog_next_prev_wrapper, #post_more_wrapper h5, #ajax_portfolio_wrapper.hidding, #ajax_portfolio_wrapper.visible, .tabs.vertical .ui-tabs-panel, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce table.shop_table, .woocommerce-page table.shop_table, table tr td, .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals, .woocommerce .cart-collaterals .shipping_calcuLator, .woocommerce-page .cart-collaterals .shipping_calcuLator, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, table tr th, .woocommerce #payment, .woocommerce-page #payment, .woocommerce #payment ul.payment_methods li, .woocommerce-page #payment ul.payment_methods li, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row, .ui-tabs li:first-child, .ui-tabs .ui-tabs-nav li, .ui-tabs.vertical .ui-tabs-nav li, .ui-tabs.vertical.right .ui-tabs-nav li.ui-state-active, .ui-tabs.vertical .ui-tabs-nav li:last-child, #page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .page_content_wrapper .inner .sidebar_wrapper ul.sidebar_widget li.widget_nav_menu ul.menu li.current-menu-item a, .pricing_wrapper, .pricing_wrapper li, , .ui-accordion .ui-accordion-header, .ui-accordion .ui-accordion-content').css('border-color', to );
                });
            });
            
            wp.customize('tg_food_menu_highlight_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.menu_content_classic .menu_highlight, .menu_content_classic .menu_order').css('background-color', to );
                });
            });
            
            wp.customize('tg_input_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('input[type=text], input[type=password], input[type=email], input[type=url], textarea').css('background-color', to );
                });
            });
            
            wp.customize('tg_input_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('input[type=text], input[type=password], input[type=email], input[type=url], textarea').css('color', to );
                });
            });
            
            wp.customize('tg_input_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('input[type=text], input[type=password], input[type=email], input[type=url], textarea').css('border-color', to );
                });
            });
            
            wp.customize('tg_input_focus_color',function( value ) {
                value.bind(function(to) {
                    jQuery('input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=url]:focus, textarea:focus').css('border-color', to );
                });
            });
            
            wp.customize('tg_button_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'https://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_button_bg_color',function( value ) {
                value.bind(function(to) {
                	jQuery('input[type=submit], input[type=button], a.button, .button, .pagination span, .pagination a:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('background-color', to );
                    jQuery('.pagination span, .pagination a:hover').css('border-color', to );
                });
            });
            
            wp.customize('tg_button_font_color',function( value ) {
                value.bind(function(to) {
                	jQuery('input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('color', to );
                });
            });
            
            wp.customize('tg_button_border_color',function( value ) {
                value.bind(function(to) {
                	jQuery('input[type=submit], input[type=button], a.button, .button, .pagination a:hover, .woocommerce-page div.product form.cart .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('border-color', to );
                });
            });
            
            wp.customize('tg_sharing_bg_color',function( value ) {
                value.bind(function(to) {
                	jQuery('.post_share_bubble a.post_share').css('background-color', to );
                });
            });
            
            wp.customize('tg_sharing_color',function( value ) {
                value.bind(function(to) {
                	jQuery('.post_share_bubble a.post_share').css('color', to );
                });
            });
            //End General Tab Settings
        
        	//Register Menu Tab Settings
        	wp.customize('tg_menu_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'https://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_menu_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_menu_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_menu_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a').css('letterSpacing', to+'px' );
                });
            });
            
            wp.customize('tg_menu_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a').css('textTransform', to );
                });
            });
            
            wp.customize('tg_menu_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a, #tg_reservation').css('color', to );
                    jQuery('#tg_reservation').css('borderColor', to );
                });
            });
            
            wp.customize('tg_menu_hover_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover').css('color', to );
                });
            });
            
            wp.customize('tg_menu_active_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a').css('color', to );
                });
            });
            
            wp.customize('tg_menu_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.top_bar').css('borderColor', to );
                });
            });
            
            wp.customize('tg_submenu_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_submenu_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_submenu_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('letterSpacing', to+'px' );
                });
            });
            
            wp.customize('tg_submenu_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('textTransform', to );
                });
            });
            
            wp.customize('tg_submenu_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a').css('color', to );
                });
            });
            
            wp.customize('tg_submenu_hover_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li > a, #menu_wrapper div .nav li.megamenu ul li > a:hover, #menu_wrapper div .nav li.megamenu ul li  > a:active').css('color', to );
                });
            });
            
            wp.customize('tg_submenu_hover_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:hover, #menu_wrapper div .nav li.megamenu ul li ul li a:hover, #menu_wrapper .nav ul li.megamenu ul li ul li a:active, #menu_wrapper div .nav li.megamenu ul li ul li a:active').css('background', to );
                });
            });
            
            wp.customize('tg_submenu_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul').css('background', to );
                });
            });
            
            wp.customize('tg_megamenu_header_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('menu_wrapper div .nav li.megamenu ul li > a, #menu_wrapper div .nav li.megamenu ul li > a:hover, #menu_wrapper div .nav li.megamenu ul li > a:active').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_megamenu_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#menu_wrapper div .nav li.megamenu ul li').css('borderColor', to );
                });
            });
            
            wp.customize('tg_topbar_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.above_top_bar, #top_menu li a, .top_contact_info i, .top_contact_info a, .top_contact_info').css('color', to );
                });
            });
            
            wp.customize('tg_topbar_social_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.above_top_bar .social_wrapper ul li a, .above_top_bar .social_wrapper ul li a:hover').css('color', to );
                });
            });
            
            wp.customize('tg_menu_contact_hours',function( value ) {
                value.bind(function(to) {
                    jQuery('#top_contact_hours').html('<i class="fa fa-clock-o"></i>'+to);
                });
            });
            
            wp.customize('tg_menu_contact_number',function( value ) {
                value.bind(function(to) {
                    jQuery('#top_contact_number').html('<i class="fa fa-phone"></i>'+to);
                });
            });
            
            wp.customize('tg_menu_search_input_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#searchform').css('background', to );
                });
            });
            
            wp.customize('tg_menu_search_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#searchform input[type=text], #searchform button i, #close_mobile_menu i').css('color', to );
                });
            });
            
            wp.customize('tg_sidemenu_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'https://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_sidemenu_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_sidemenu_font_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a, #sub_menu li a').css('textTransform', to );
                });
            });
            
            wp.customize('tg_sidemenu_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a, #sub_menu li a, .mobile_menu_wrapper .sidebar_wrapper a, .mobile_menu_wrapper .sidebar_wrapper, #tg_sidemenu_reservation').css('color', to );
                    
                    jQuery('#tg_sidemenu_reservation').css('borderColor', to );
                });
            });
            
            wp.customize('tg_submenu_hover_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.mobile_main_nav li a:hover, .mobile_main_nav li a:active, #sub_menu li a:hover, #sub_menu li a:active, .mobile_menu_wrapper .sidebar_wrapper h2.widgettitle, .mobile_main_nav li.current-menu-item a, #tg_sidemenu_reservation:hover').css('color', to );
                    
                    jQuery('#tg_sidemenu_reservation:hover').css('borderColor', to );
                });
            });
            //End Menu Tab Settings
            
            
            //Register Header Tab Settings 
        	wp.customize('tg_page_header_bg_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption, .page_caption_bg_content, .overlay_gallery_content').css('background-color', to );
                    jQuery('.page_caption_bg_border, .overlay_gallery_border').css('border-color', to );
                });
            });
            
            wp.customize('tg_page_header_padding_top',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption').css('paddingTop', to+'px' );
                });
            });
            
            wp.customize('tg_page_header_padding_bottom',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption').css('paddingBottom', to+'px' );
                });
            });
            
            wp.customize('tg_page_title_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title').css('color', to );
                });
            });
            
            wp.customize('tg_page_title_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_page_title_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_page_title_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption h1, .ppb_title').css('textTransform', to );
                });
            });
            
            wp.customize('tg_page_title_bg_height',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_caption.hasbg').css('height', to+'vh' );
                });
            });
            
            wp.customize('tg_page_title_mixed_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'https://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('.ppb_title_first').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_header_builder_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('h2.ppb_title').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_header_builder_font_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('h2.ppb_title').css('textTransform', to );
                });
            });
            
            wp.customize('tg_header_builder_hr_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.page_header_sep').css('borderColor', to );
                });
            });
            
            wp.customize('tg_page_tagline_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('color', to );
                });
            });
            
            wp.customize('tg_page_tagline_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_page_tagline_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_page_tagline_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('textTransform', to );
                });
            });
            
            wp.customize('tg_page_tagline_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company').css('letterSpacing', to+'px' );
                });
            });
        	//End Logo Header Settings
        	
        	//Register Sidebar Tab Settings
            wp.customize('tg_sidebar_title_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'https://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_sidebar_title_font_size',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('fontSize', to+'px' );
                });
            });
            
            wp.customize('tg_sidebar_title_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_sidebar_title_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('textTransform', to );
                });
            });
            
            wp.customize('tg_sidebar_title_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('letterSpacing', to+'px' );
                });
            });
            
            wp.customize('tg_sidebar_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .inner .sidebar_wrapper .sidebar .content, .page_content_wrapper .inner .sidebar_wrapper .sidebar .content').css('color', to );
                });
            });
            
            wp.customize('tg_sidebar_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .inner .sidebar_wrapper a, .page_content_wrapper .inner .sidebar_wrapper a').css('color', to );
                });
            });
            
            wp.customize('tg_sidebar_hover_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active, .page_content_wrapper .inner .sidebar_wrapper a:hover, .page_content_wrapper .inner .sidebar_wrapper a:active').css('color', to );
                });
            });
            
            wp.customize('tg_sidebar_title_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle').css('color', to );
                });
            });
            //End Sidebar Tab Settings
            
            //Register Footer Tab Settings
             wp.customize('tg_footer_text',function( value ) {
                value.bind(function(to) {
                    jQuery('#footer_before_widget_text').html( to );
                });
            });
            
            wp.customize('tg_footer_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#footer, #copyright').css('color', to );
                });
            });
            
            wp.customize('tg_footer_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#copyright a, #copyright a:active, .social_wrapper ul li a, #footer a, #footer a:active, #footer .sidebar_widget li h2.widgettitle').css('color', to );
                });
            });
            
            wp.customize('tg_footer_hover_link_color',function( value ) {
                value.bind(function(to) {
                    jQuery('#copyright a:hover, #footer a:hover, .social_wrapper ul li a:hover').css('color', to );
                });
            });
            
            wp.customize('tg_footer_border_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.footer_bar_wrapper').css('borderColor', to );
                });
            });
            
            wp.customize('tg_footer_social_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.footer_bar_wrapper .social_wrapper ul li a').css('color', to );
                });
            });
            
            wp.customize('tg_footer_copyright_bg',function( value ) {
                value.bind(function(to) {
                    jQuery('.footer_bar_wrapper').css('background', to );
                });
            });
            
            wp.customize('tg_footer_copyright_text',function( value ) {
                value.bind(function(to) {
                    jQuery('#copyright').html( to );
                });
            });
            //End Footer Tab Settings
            
            
            //Begin Blog Tab Settings
            wp.customize('tg_blog_title_font',function( value ) {
                value.bind(function(to) {
                	var ppGGFont = 'https://fonts.googleapis.com/css?family='+to;
                	if(jQuery('#google_fonts_'+to).length==0)
                	{
			    		jQuery('head').append('<link rel="stylesheet" id="google_fonts_'+to+'" href="'+ppGGFont+'" type="text/css" media="all">');
			    	}
                    jQuery('.post_header:not(.single) h5, body.single-post .post_header_title h1, #post_featured_slider li .slider_image .slide_post h2, #autocomplete li strong, .post_related strong, #footer ul.sidebar_widget .posts.blog li a, body.single-post #page_caption h1').css('fontFamily', to );
                });
            });
            
            wp.customize('tg_blog_title_font_transform',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header:not(.single) h5, body.single-post .post_header_title h1, #post_featured_slider li .slider_image .slide_post h2, #autocomplete li strong, .post_related strong, #footer ul.sidebar_widget .posts.blog li a, body.single-post #page_caption h1').css('textTransform', to );
                });
            });
            
            wp.customize('tg_blog_title_font_weight',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header:not(.single) h5, body.single-post .post_header_title h1, #post_featured_slider li .slider_image .slide_post h2, #autocomplete li strong, .post_related strong, #footer ul.sidebar_widget .posts.blog li a, body.single-post #page_caption h1').css('fontWeight', to );
                });
            });
            
            wp.customize('tg_blog_title_font_spacing',function( value ) {
                value.bind(function(to) {
                    jQuery('.post_header:not(.single) h5, body.single-post .post_header_title h1, #post_featured_slider li .slider_image .slide_post h2, #autocomplete li strong, .post_related strong, #footer ul.sidebar_widget .posts.blog li a, body.single-post #page_caption h1').css('letterSpacing', to+'px' );
                });
            });
            //End Blog Tab Settings
            
            
            //Register Shop Tab Settings
             wp.customize('tg_shop_price_font_color',function( value ) {
                value.bind(function(to) {
                    jQuery('.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, p.price ins span.amount, p.price span.amount, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price').css( 'color', to );
                });
            });
            //End Shop Tab Settings
        } )( jQuery )
    </script>
<?php	
}
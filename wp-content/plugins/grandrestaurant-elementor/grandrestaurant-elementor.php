<?php
/*
 * Plugin Name: Grand Restaurant Theme Elements for Elementor
 * Description: Custom elements for Elementor using Grand Restaurant theme
 * Plugin URI:  https://themegoods.com/
 * Version:     2.1.2
 * Author:      ThemGoods
 * Author URI:  https://themegoods.com/
 * Elementor tested up to: 3.34.2
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

if (!defined('ENVATOITEMID'))
{
    define("ENVATOITEMID", 11812117);
}

define( 'GRANDRESTAURANT_ELEMENTOR_PATH', plugin_dir_path( __FILE__ ));

if (!defined('GRANDRESTAURANT_THEMEDATEFORMAT'))
{
	define("GRANDRESTAURANT_THEMEDATEFORMAT", get_option('date_format'));
}

if (!defined('GRANDRESTAURANT_THEMETIMEFORMAT'))
{
	define("GRANDRESTAURANT_THEMETIMEFORMAT", get_option('time_format'));
}

if (!defined('GRANDRESTAURANT_UPLOAD'))
{
	$wp_upload_arr = wp_upload_dir();
	define("GRANDRESTAURANT_UPLOAD", $wp_upload_arr['basedir']."/".strtolower(sanitize_title('grandrestaurant-elementor'))."/");
	
	if(!is_dir(GRANDRESTAURANT_UPLOAD))
	{
		mkdir(GRANDRESTAURANT_UPLOAD);
	}
}

if(!function_exists('grandrestaurant_is_registered'))
{
    function grandrestaurant_is_registered() {
        $grandrestaurant_is_registered = get_option("envato_purchase_code_".ENVATOITEMID);
        
        if(!empty($grandrestaurant_is_registered)) {
            return $grandrestaurant_is_registered;
        }
        else {
            return false;
        }
    }
}

$is_verified_envato_purchase_code = false;

//Check if verified
$is_verified_envato_purchase_code = grandrestaurant_is_registered();

if($is_verified_envato_purchase_code) {
    /**
     * Load the plugin after Elementor (and other plugins) are loaded.
     *
     * @since 1.0.0
     */
    function grandrestaurant_elementor_load() {
	    // Require the main plugin file
	    require(GRANDRESTAURANT_ELEMENTOR_PATH.'/tools.php');
	    require(GRANDRESTAURANT_ELEMENTOR_PATH.'/actions.php');
	    require(GRANDRESTAURANT_ELEMENTOR_PATH.'/templates.php' );
	    require(GRANDRESTAURANT_ELEMENTOR_PATH.'/plugin.php' );
	    require(GRANDRESTAURANT_ELEMENTOR_PATH.'/shortcode.php');
	    require(GRANDRESTAURANT_ELEMENTOR_PATH.'/megamenu.php');
    }
    add_action( 'plugins_loaded', 'grandrestaurant_elementor_load' );
    
    
    function grandrestaurant_elementor_translation_load() {
        load_plugin_textdomain( 'grandrestaurant-elementor', FALSE, dirname( plugin_basename(__FILE__) ) . '/languages/' );
    }
    add_action( 'plugins_loaded', 'grandrestaurant_elementor_translation_load' );
    
    
    function grandrestaurant_post_type_header() {
	    $labels = array(
    	    'name' => _x('Headers', 'post type general name', 'grandrestaurant-elementor'),
    	    'singular_name' => _x('Header', 'post type singular name', 'grandrestaurant-elementor'),
    	    'add_new' => _x('Add New Header', 'grandrestaurant-elementor'),
    	    'add_new_item' => __('Add New Header', 'grandrestaurant-elementor'),
    	    'edit_item' => __('Edit Header', 'grandrestaurant-elementor'),
    	    'new_item' => __('New Header', 'grandrestaurant-elementor'),
    	    'view_item' => __('View Header', 'grandrestaurant-elementor'),
    	    'search_items' => __('Search Header', 'grandrestaurant-elementor'),
    	    'not_found' =>  __('No Header found', 'grandrestaurant-elementor'),
    	    'not_found_in_trash' => __('No Header found in Trash', 'grandrestaurant-elementor'), 
    	    'parent_item_colon' => ''
	    );		
	    $args = array(
    	    'labels' => $labels,
    	    'public' => true,
    	    'publicly_queryable' => true,
    	    'show_ui' => true, 
    	    'query_var' => true,
    	    'rewrite' => true,
    	    'capability_type' => 'post',
    	    'hierarchical' => false,
    	    'show_in_nav_menus' => false,
    	    'show_in_admin_bar' => true,
    	    'menu_position' => 20,
    	    'exclude_from_search' => true,
    	    'supports' => array('title', 'content'),
    	    'menu_icon' => 'dashicons-editor-insertmore'
	    ); 		
    
	    register_post_type( 'header', $args );
    } 
								      
    add_action('init', 'grandrestaurant_post_type_header');
    
    add_action('elementor/widgets/register', 'grandrestaurant_unregister_elementor_widgets');
    
    function grandrestaurant_unregister_elementor_widgets($obj){
	    $obj->unregister('sidebar');
    }
    
    function grandrestaurant_post_type_footer() {
	    $labels = array(
    	    'name' => _x('Footers', 'post type general name', 'grandrestaurant-elementor'),
    	    'singular_name' => _x('Footer', 'post type singular name', 'grandrestaurant-elementor'),
    	    'add_new' => _x('Add New Footer', 'grandrestaurant-elementor'),
    	    'add_new_item' => __('Add New Footer', 'grandrestaurant-elementor'),
    	    'edit_item' => __('Edit Footer', 'grandrestaurant-elementor'),
    	    'new_item' => __('New Footer', 'grandrestaurant-elementor'),
    	    'view_item' => __('View Footer', 'grandrestaurant-elementor'),
    	    'search_items' => __('Search Footer', 'grandrestaurant-elementor'),
    	    'not_found' =>  __('No Footer found', 'grandrestaurant-elementor'),
    	    'not_found_in_trash' => __('No Footer found in Trash', 'grandrestaurant-elementor'), 
    	    'parent_item_colon' => ''
	    );		
	    $args = array(
    	    'labels' => $labels,
    	    'public' => true,
    	    'publicly_queryable' => true,
    	    'show_ui' => true, 
    	    'query_var' => true,
    	    'rewrite' => true,
    	    'capability_type' => 'post',
    	    'hierarchical' => false,
    	    'show_in_nav_menus' => false,
    	    'show_in_admin_bar' => true,
    	    'menu_position' => 20,
    	    'exclude_from_search' => true,
    	    'supports' => array('title', 'content'),
    	    'menu_icon' => 'dashicons-editor-insertmore'
	    ); 		
    
	    register_post_type( 'footer', $args );
    } 
								      
    add_action('init', 'grandrestaurant_post_type_footer');
    
    
    function grandrestaurant_post_type_megamenu() {
	    $labels = array(
    	    'name' => _x('Mega Menus', 'post type general name', 'grandrestaurant-elementor'),
    	    'singular_name' => _x('Mega Menu', 'post type singular name', 'grandrestaurant-elementor'),
    	    'add_new' => _x('Add New Mega Menu', 'grandrestaurant-elementor'),
    	    'add_new_item' => __('Add New Mega Menu', 'grandrestaurant-elementor'),
    	    'edit_item' => __('Edit Mega Menu', 'grandrestaurant-elementor'),
    	    'new_item' => __('New Mega Menu', 'grandrestaurant-elementor'),
    	    'view_item' => __('View Mega Menu', 'grandrestaurant-elementor'),
    	    'search_items' => __('Search Mega Menu', 'grandrestaurant-elementor'),
    	    'not_found' =>  __('No Mega Menu found', 'grandrestaurant-elementor'),
    	    'not_found_in_trash' => __('No Mega Menu found in Trash', 'grandrestaurant-elementor'), 
    	    'parent_item_colon' => ''
	    );		
	    $args = array(
    	    'labels' => $labels,
    	    'public' => true,
    	    'publicly_queryable' => true,
    	    'show_ui' => true, 
    	    'query_var' => true,
    	    'rewrite' => true,
    	    'capability_type' => 'post',
    	    'hierarchical' => false,
    	    'show_in_nav_menus' => false,
    	    'show_in_admin_bar' => true,
    	    'menu_position' => 20,
    	    'exclude_from_search' => true,
    	    'supports' => array('title', 'content'),
    	    'menu_icon' => 'dashicons-welcome-widgets-menus'
	    ); 		
    
	    register_post_type( 'megamenu', $args );
    } 
								      
    add_action('init', 'grandrestaurant_post_type_megamenu');
    
    function grandrestaurant_post_type_fullscreen_menu() {
        $labels = array(
            'name' => _x('Fullscreen Menus', 'post type general name', 'grandrestaurant-elementor'),
            'singular_name' => _x('Fullscreen Menu', 'post type singular name', 'grandrestaurant-elementor'),
            'add_new' => _x('Add New Fullscreen Menu', 'grandrestaurant-elementor'),
            'add_new_item' => __('Add New Fullscreen Menu', 'grandrestaurant-elementor'),
            'edit_item' => __('Edit Fullscreen Menu', 'grandrestaurant-elementor'),
            'new_item' => __('New Fullscreen Menu', 'grandrestaurant-elementor'),
            'view_item' => __('View Fullscreen Menu', 'grandrestaurant-elementor'),
            'search_items' => __('Search Fullscreen Menu', 'grandrestaurant-elementor'),
            'not_found' =>  __('No Fullscreen Menu found', 'grandrestaurant-elementor'),
            'not_found_in_trash' => __('No Mega Menu found in Trash', 'grandrestaurant-elementor'), 
            'parent_item_colon' => ''
        );		
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => true,
            'menu_position' => 20,
            'exclude_from_search' => true,
            'supports' => array('title', 'content'),
            'menu_icon' => 'dashicons-format-aside'
        ); 		
    
        register_post_type( 'fullmenu', $args );
    } 
                                      
    add_action('init', 'grandrestaurant_post_type_fullscreen_menu');
    
    add_action('add_meta_boxes', function () {
	    global $post;
    
	    // Check if its a correct post type/types to apply template
	    if ( ! in_array( $post->post_type, [ 'header', 'footer', 'megamenu' ] ) ) {
		    return;
	    }
    
	    // Check that a template is not set already
	    if ( '' !== $post->page_template ) {
		    return;
	    }
    
	    //Finally set the page template
	    $post->page_template = 'elementor_canvas';
	    update_post_meta($post->ID, '_wp_page_template', 'elementor_canvas');
    }, 5 );
}
?>
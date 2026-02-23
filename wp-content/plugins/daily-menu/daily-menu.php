<?php
/*
Plugin Name: Denní menu
Plugin URI:
Description: Správa a zobrazení denního menu pro restauraci Stará Kotelna.
Version: 1.0.0
Author: Stará Kotelna
Author URI:
License: GPLv2
Text Domain: daily-menu
*/

if ( ! defined( 'WPINC' ) ) {
    die();
}

define( 'DAILY_MENU_VERSION', '1.0.0' );
define( 'DAILY_MENU_PATH', plugin_dir_path( __FILE__ ) );
define( 'DAILY_MENU_URL', plugin_dir_url( __FILE__ ) );
define( 'DAILY_MENU_OPTION_KEY', 'daily_menu_data' );

// Activation hook — set default data
register_activation_hook( __FILE__, 'daily_menu_activate' );

function daily_menu_activate() {
    $existing = get_option( DAILY_MENU_OPTION_KEY );
    if ( $existing === false ) {
        $default_data = array(
            'date'       => '',
            'categories' => array(
                array( 'name' => 'Polévky', 'items' => array() ),
                array( 'name' => 'Předkrmy', 'items' => array() ),
                array( 'name' => 'Hotová jídla', 'items' => array() ),
                array( 'name' => 'Doporučujeme', 'items' => array() ),
                array( 'name' => 'Saláty', 'items' => array() ),
                array( 'name' => 'Dezerty', 'items' => array() ),
            ),
        );
        update_option( DAILY_MENU_OPTION_KEY, $default_data );
    }
}

// Admin menu
add_action( 'admin_menu', 'daily_menu_admin_menu' );

function daily_menu_admin_menu() {
    add_menu_page(
        'Denní menu',
        'Denní menu',
        'edit_posts',
        'daily-menu',
        'daily_menu_render_admin_page',
        'dashicons-food',
        26
    );
}

// Enqueue admin assets (only on our page)
add_action( 'admin_enqueue_scripts', 'daily_menu_admin_enqueue' );

function daily_menu_admin_enqueue( $hook ) {
    if ( $hook !== 'toplevel_page_daily-menu' ) {
        return;
    }

    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'jquery-ui-sortable' );

    wp_enqueue_style(
        'jquery-ui-smoothness',
        'https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css',
        array(),
        '1.13.2'
    );

    wp_enqueue_style(
        'daily-menu-admin-style',
        DAILY_MENU_URL . 'admin/css/admin-style.css',
        array(),
        DAILY_MENU_VERSION
    );

    wp_enqueue_script(
        'daily-menu-admin-script',
        DAILY_MENU_URL . 'admin/js/admin-script.js',
        array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable' ),
        DAILY_MENU_VERSION,
        true
    );

    wp_localize_script( 'daily-menu-admin-script', 'dailyMenuAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'daily_menu_save_nonce' ),
    ) );
}

// Include files
if ( is_admin() ) {
    require_once DAILY_MENU_PATH . 'admin/admin-page.php';
    require_once DAILY_MENU_PATH . 'admin/admin-ajax.php';
}

require_once DAILY_MENU_PATH . 'public/shortcode.php';

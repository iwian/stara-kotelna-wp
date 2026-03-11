<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

// Logout handler
add_action( 'wp_ajax_daily_menu_logout', 'daily_menu_frontend_ajax_logout' );
add_action( 'wp_ajax_nopriv_daily_menu_logout', 'daily_menu_frontend_ajax_logout' );

function daily_menu_frontend_ajax_logout() {
    check_ajax_referer( 'daily_menu_logout', 'nonce' );
    daily_menu_clear_auth_cookie();
    wp_send_json_success();
}

// Frontend save handler
add_action( 'wp_ajax_daily_menu_frontend_save', 'daily_menu_frontend_ajax_save' );
add_action( 'wp_ajax_nopriv_daily_menu_frontend_save', 'daily_menu_frontend_ajax_save' );

function daily_menu_frontend_ajax_save() {
    check_ajax_referer( 'daily_menu_frontend_nonce', 'nonce' );

    if ( ! daily_menu_frontend_auth_check() ) {
        wp_send_json_error( array( 'message' => 'Přihlášení vypršelo. Přihlaste se znovu.', 'auth_error' => true ) );
    }

    $sanitized = daily_menu_sanitize_data( isset( $_POST['menu_data'] ) ? $_POST['menu_data'] : '' );

    if ( is_wp_error( $sanitized ) ) {
        wp_send_json_error( $sanitized->get_error_message() );
    }

    update_option( DAILY_MENU_OPTION_KEY, $sanitized );
    wp_send_json_success();
}

// Frontend print handler
add_action( 'wp_ajax_daily_menu_frontend_print', 'daily_menu_frontend_ajax_print' );
add_action( 'wp_ajax_nopriv_daily_menu_frontend_print', 'daily_menu_frontend_ajax_print' );

function daily_menu_frontend_ajax_print() {
    if ( ! daily_menu_frontend_auth_check() ) {
        wp_die( 'Neautorizovaný přístup.' );
    }

    require_once DAILY_MENU_PATH . 'print/print-template.php';
    exit;
}

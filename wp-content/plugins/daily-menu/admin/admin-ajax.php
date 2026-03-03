<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

// Save handler
add_action( 'wp_ajax_daily_menu_save', 'daily_menu_ajax_save' );

function daily_menu_ajax_save() {
    check_ajax_referer( 'daily_menu_save_nonce', 'nonce' );

    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( 'Nemáte oprávnění.' );
    }

    $sanitized = daily_menu_sanitize_data( isset( $_POST['menu_data'] ) ? $_POST['menu_data'] : '' );

    if ( is_wp_error( $sanitized ) ) {
        wp_send_json_error( $sanitized->get_error_message() );
    }

    update_option( DAILY_MENU_OPTION_KEY, $sanitized );
    wp_send_json_success();
}

// Print handler
add_action( 'wp_ajax_daily_menu_print', 'daily_menu_ajax_print' );

function daily_menu_ajax_print() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_die( 'Nemáte oprávnění.' );
    }

    require_once DAILY_MENU_PATH . 'print/print-template.php';
    exit;
}

// PIN regeneration (admin only)
add_action( 'wp_ajax_daily_menu_regenerate_pin', 'daily_menu_ajax_regenerate_pin' );

function daily_menu_ajax_regenerate_pin() {
    check_ajax_referer( 'daily_menu_save_nonce', 'nonce' );

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Nemáte oprávnění.' );
    }

    $pin = daily_menu_generate_pin();
    wp_send_json_success( array( 'pin' => $pin ) );
}

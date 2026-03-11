<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

// Frontend akce save handler
add_action( 'wp_ajax_daily_menu_akce_frontend_save', 'daily_menu_akce_frontend_ajax_save' );
add_action( 'wp_ajax_nopriv_daily_menu_akce_frontend_save', 'daily_menu_akce_frontend_ajax_save' );

function daily_menu_akce_frontend_ajax_save() {
    check_ajax_referer( 'daily_menu_akce_frontend_nonce', 'nonce' );

    if ( ! daily_menu_frontend_auth_check() ) {
        wp_send_json_error( array( 'message' => 'Přihlášení vypršelo. Přihlaste se znovu.', 'auth_error' => true ) );
    }

    $sanitized = daily_menu_akce_sanitize_data( isset( $_POST['akce_data'] ) ? $_POST['akce_data'] : '' );

    if ( is_wp_error( $sanitized ) ) {
        wp_send_json_error( $sanitized->get_error_message() );
    }

    update_option( DAILY_MENU_AKCE_OPTION_KEY, $sanitized );
    wp_send_json_success();
}

// Frontend akce image upload handler
add_action( 'wp_ajax_daily_menu_akce_frontend_upload', 'daily_menu_akce_frontend_ajax_upload' );
add_action( 'wp_ajax_nopriv_daily_menu_akce_frontend_upload', 'daily_menu_akce_frontend_ajax_upload' );

function daily_menu_akce_frontend_ajax_upload() {
    check_ajax_referer( 'daily_menu_akce_frontend_nonce', 'nonce' );

    if ( ! daily_menu_frontend_auth_check() ) {
        wp_send_json_error( array( 'message' => 'Přihlášení vypršelo. Přihlaste se znovu.', 'auth_error' => true ) );
    }

    if ( empty( $_FILES['image'] ) ) {
        wp_send_json_error( 'Žádný soubor nebyl nahrán.' );
    }

    // Validate file type
    $allowed_types = array( 'image/jpeg', 'image/png', 'image/gif', 'image/webp' );
    $file_type     = wp_check_filetype( $_FILES['image']['name'] );

    if ( ! in_array( $_FILES['image']['type'], $allowed_types, true ) ) {
        wp_send_json_error( 'Nepodporovaný formát obrázku. Použijte JPG, PNG, GIF nebo WebP.' );
    }

    // Max 5 MB
    if ( $_FILES['image']['size'] > 5 * 1024 * 1024 ) {
        wp_send_json_error( 'Obrázek je příliš velký. Maximální velikost je 5 MB.' );
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $attachment_id = media_handle_upload( 'image', 0 );

    if ( is_wp_error( $attachment_id ) ) {
        wp_send_json_error( $attachment_id->get_error_message() );
    }

    $url = wp_get_attachment_url( $attachment_id );
    wp_send_json_success( array( 'url' => $url ) );
}

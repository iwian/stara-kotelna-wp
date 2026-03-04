<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

// Save handler
add_action( 'wp_ajax_daily_menu_akce_save', 'daily_menu_akce_ajax_save' );

function daily_menu_akce_ajax_save() {
    check_ajax_referer( 'daily_menu_akce_nonce', 'nonce' );

    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( 'Nemáte oprávnění.' );
    }

    $sanitized = daily_menu_akce_sanitize_data( isset( $_POST['akce_data'] ) ? $_POST['akce_data'] : '' );

    if ( is_wp_error( $sanitized ) ) {
        wp_send_json_error( $sanitized->get_error_message() );
    }

    update_option( DAILY_MENU_AKCE_OPTION_KEY, $sanitized );
    wp_send_json_success();
}

// Image upload handler (admin)
add_action( 'wp_ajax_daily_menu_akce_upload_image', 'daily_menu_akce_ajax_upload_image' );

function daily_menu_akce_ajax_upload_image() {
    check_ajax_referer( 'daily_menu_akce_nonce', 'nonce' );

    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( 'Nemáte oprávnění.' );
    }

    if ( empty( $_FILES['image'] ) ) {
        wp_send_json_error( 'Žádný soubor nebyl nahrán.' );
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

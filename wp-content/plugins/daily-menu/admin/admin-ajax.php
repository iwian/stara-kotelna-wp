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

    $raw = isset( $_POST['menu_data'] ) ? wp_unslash( $_POST['menu_data'] ) : '';
    $menu_data = json_decode( $raw, true );

    if ( ! is_array( $menu_data ) ) {
        wp_send_json_error( 'Neplatná data.' );
    }

    // Sanitize
    $sanitized = array(
        'date'       => sanitize_text_field( $menu_data['date'] ),
        'categories' => array(),
    );

    if ( ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $sanitized['date'] ) ) {
        wp_send_json_error( 'Neplatný formát data.' );
    }

    if ( isset( $menu_data['categories'] ) && is_array( $menu_data['categories'] ) ) {
        foreach ( $menu_data['categories'] as $cat ) {
            $sanitized_cat = array(
                'name'  => sanitize_text_field( $cat['name'] ),
                'items' => array(),
            );

            if ( isset( $cat['items'] ) && is_array( $cat['items'] ) ) {
                foreach ( $cat['items'] as $item ) {
                    $sanitized_cat['items'][] = array(
                        'amount' => sanitize_text_field( $item['amount'] ),
                        'name'   => sanitize_text_field( $item['name'] ),
                        'price'  => sanitize_text_field( $item['price'] ),
                    );
                }
            }

            $sanitized['categories'][] = $sanitized_cat;
        }
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

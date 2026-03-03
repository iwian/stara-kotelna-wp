<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

/**
 * Sanitize incoming menu data from JSON string.
 *
 * @param string $raw_json Raw JSON string from POST.
 * @return array|WP_Error Sanitized data array or WP_Error on failure.
 */
function daily_menu_sanitize_data( $raw_json ) {
    $menu_data = json_decode( wp_unslash( $raw_json ), true );

    if ( ! is_array( $menu_data ) ) {
        return new WP_Error( 'invalid_data', 'Neplatná data.' );
    }

    $sanitized = array(
        'date'       => sanitize_text_field( $menu_data['date'] ?? '' ),
        'categories' => array(),
    );

    if ( ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $sanitized['date'] ) ) {
        return new WP_Error( 'invalid_date', 'Neplatný formát data.' );
    }

    if ( isset( $menu_data['categories'] ) && is_array( $menu_data['categories'] ) ) {
        foreach ( $menu_data['categories'] as $cat ) {
            $sanitized_cat = array(
                'name'  => sanitize_text_field( $cat['name'] ?? '' ),
                'items' => array(),
            );

            if ( isset( $cat['items'] ) && is_array( $cat['items'] ) ) {
                foreach ( $cat['items'] as $item ) {
                    $sanitized_cat['items'][] = array(
                        'amount' => sanitize_text_field( $item['amount'] ?? '' ),
                        'name'   => sanitize_text_field( $item['name'] ?? '' ),
                        'price'  => sanitize_text_field( $item['price'] ?? '' ),
                    );
                }
            }

            $sanitized['categories'][] = $sanitized_cat;
        }
    }

    return $sanitized;
}

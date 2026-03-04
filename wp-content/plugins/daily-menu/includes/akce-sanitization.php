<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

/**
 * Sanitize incoming akce (promotion) data from JSON string.
 *
 * @param string $raw_json Raw JSON string from POST.
 * @return array|WP_Error Sanitized data array or WP_Error on failure.
 */
function daily_menu_akce_sanitize_data( $raw_json ) {
    $data = json_decode( wp_unslash( $raw_json ), true );

    if ( ! is_array( $data ) ) {
        return new WP_Error( 'invalid_data', 'Neplatná data.' );
    }

    $sanitized = array(
        'image_url' => esc_url_raw( $data['image_url'] ?? '' ),
        'title'     => sanitize_text_field( $data['title'] ?? '' ),
        'text'      => wp_kses_post( $data['text'] ?? '' ),
        'date_from' => sanitize_text_field( $data['date_from'] ?? '' ),
        'date_to'   => sanitize_text_field( $data['date_to'] ?? '' ),
    );

    // Validate date formats
    if ( ! empty( $sanitized['date_from'] ) && ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $sanitized['date_from'] ) ) {
        return new WP_Error( 'invalid_date', 'Neplatný formát data "od".' );
    }

    if ( ! empty( $sanitized['date_to'] ) && ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $sanitized['date_to'] ) ) {
        return new WP_Error( 'invalid_date', 'Neplatný formát data "do".' );
    }

    return $sanitized;
}

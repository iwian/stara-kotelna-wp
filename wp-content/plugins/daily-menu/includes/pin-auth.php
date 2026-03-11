<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

/**
 * Generate a new 6-digit PIN, store its hash, return plain text.
 *
 * @return string The plain-text PIN.
 */
function daily_menu_generate_pin() {
    $pin = str_pad( wp_rand( 0, 999999 ), 6, '0', STR_PAD_LEFT );
    update_option( DAILY_MENU_PIN_OPTION, wp_hash( $pin ) );
    return $pin;
}

/**
 * Verify a PIN against the stored hash.
 * Uses wp_hash() (HMAC) instead of wp_hash_password() (phpass/bcrypt)
 * because a 6-digit PIN has limited entropy — rate limiting is the
 * primary brute-force protection, not hash cost.
 *
 * @param string $pin Plain-text PIN to verify.
 * @return bool True if the PIN is correct.
 */
function daily_menu_verify_pin( $pin ) {
    $hash = get_option( DAILY_MENU_PIN_OPTION );
    if ( ! $hash ) {
        return false;
    }
    return hash_equals( $hash, wp_hash( $pin ) );
}

/**
 * Check if the current IP is rate-limited.
 *
 * @return bool True if blocked (5+ failed attempts within 10 minutes).
 */
function daily_menu_is_rate_limited() {
    $key  = DAILY_MENU_RATE_LIMIT_PREFIX . md5( daily_menu_get_client_ip() );
    $data = get_transient( $key );
    if ( ! $data ) {
        return false;
    }
    return $data['count'] >= 5;
}

/**
 * Record a failed PIN attempt for the current IP.
 */
function daily_menu_record_failed_attempt() {
    $key  = DAILY_MENU_RATE_LIMIT_PREFIX . md5( daily_menu_get_client_ip() );
    $data = get_transient( $key );
    if ( ! $data ) {
        $data = array( 'count' => 0 );
    }
    $data['count']++;
    set_transient( $key, $data, 10 * MINUTE_IN_SECONDS );
}

/**
 * Clear rate limit for the current IP after successful login.
 */
function daily_menu_clear_rate_limit() {
    $key = DAILY_MENU_RATE_LIMIT_PREFIX . md5( daily_menu_get_client_ip() );
    delete_transient( $key );
}

/**
 * Get the client IP address.
 *
 * @return string Client IP.
 */
function daily_menu_get_client_ip() {
    if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ips = explode( ',', sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) );
        return trim( $ips[0] );
    }
    return isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '0.0.0.0';
}

/**
 * Set the authentication cookie after successful PIN entry.
 * Cookie is HMAC-signed and valid for 1 hour.
 */
function daily_menu_set_auth_cookie() {
    $expiry = time() + HOUR_IN_SECONDS;
    $token  = $expiry . '|' . wp_hash( $expiry . '|' . DAILY_MENU_COOKIE_NAME );

    setcookie(
        DAILY_MENU_COOKIE_NAME,
        $token,
        $expiry,
        '/',
        '',
        is_ssl(),
        true // httponly
    );

    // Make cookie immediately available in current request
    $_COOKIE[ DAILY_MENU_COOKIE_NAME ] = $token;
}

/**
 * Check if the current request has a valid authentication cookie.
 *
 * @return bool True if the cookie is valid and not expired.
 */
function daily_menu_check_auth_cookie() {
    if ( empty( $_COOKIE[ DAILY_MENU_COOKIE_NAME ] ) ) {
        return false;
    }

    $token = sanitize_text_field( wp_unslash( $_COOKIE[ DAILY_MENU_COOKIE_NAME ] ) );
    $parts = explode( '|', $token, 2 );

    if ( count( $parts ) !== 2 ) {
        return false;
    }

    list( $expiry, $hmac ) = $parts;

    // Check expiry
    if ( (int) $expiry < time() ) {
        return false;
    }

    // Verify HMAC
    $expected = wp_hash( $expiry . '|' . DAILY_MENU_COOKIE_NAME );
    return hash_equals( $expected, $hmac );
}

/**
 * Clear the authentication cookie (logout).
 */
function daily_menu_clear_auth_cookie() {
    setcookie( DAILY_MENU_COOKIE_NAME, '', time() - HOUR_IN_SECONDS, '/', '', is_ssl(), true );
    unset( $_COOKIE[ DAILY_MENU_COOKIE_NAME ] );
}

/**
 * Combined auth check: logged-in WP user with edit_posts OR valid PIN cookie.
 *
 * @return bool True if authorized.
 */
function daily_menu_frontend_auth_check() {
    if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
        return true;
    }
    return daily_menu_check_auth_cookie();
}

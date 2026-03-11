<?php
/*
Plugin Name: Denní menu
Plugin URI:
Description: Správa a zobrazení denního menu a akčních nabídek pro restauraci Stará Kotelna.
Version: 2.1.0
Author: Stará Kotelna
Author URI:
License: GPLv2
Text Domain: daily-menu
*/

if ( ! defined( 'WPINC' ) ) {
    die();
}

define( 'DAILY_MENU_VERSION', '2.2.0' );
define( 'DAILY_MENU_PATH', plugin_dir_path( __FILE__ ) );
define( 'DAILY_MENU_URL', plugin_dir_url( __FILE__ ) );
define( 'DAILY_MENU_OPTION_KEY', 'daily_menu_data' );
define( 'DAILY_MENU_AKCE_OPTION_KEY', 'daily_menu_akce_data' );

// Frontend editor constants
define( 'DAILY_MENU_PIN_OPTION', 'daily_menu_editor_pin_hash' );
define( 'DAILY_MENU_PIN_PLAIN_TRANSIENT', 'daily_menu_editor_pin_plain' );
define( 'DAILY_MENU_RATE_LIMIT_PREFIX', 'daily_menu_rate_' );
define( 'DAILY_MENU_FRONTEND_SLUG', 'upravy-menu' );
define( 'DAILY_MENU_AKCE_SLUG', 'upravy-akce' );
define( 'DAILY_MENU_COOKIE_NAME', 'daily_menu_auth' );

// ============================================================================
// Shared includes (always loaded)
// ============================================================================

require_once DAILY_MENU_PATH . 'includes/sanitization.php';
require_once DAILY_MENU_PATH . 'includes/akce-sanitization.php';
require_once DAILY_MENU_PATH . 'includes/form-renderer.php';
require_once DAILY_MENU_PATH . 'includes/akce-form-renderer.php';
require_once DAILY_MENU_PATH . 'includes/pin-auth.php';

// ============================================================================
// Admin includes
// ============================================================================

if ( is_admin() ) {
    require_once DAILY_MENU_PATH . 'admin/admin-page.php';
    require_once DAILY_MENU_PATH . 'admin/admin-ajax.php';
    require_once DAILY_MENU_PATH . 'admin/admin-akce-page.php';
    require_once DAILY_MENU_PATH . 'admin/admin-akce-ajax.php';
}

// ============================================================================
// Frontend includes (always loaded — AJAX nopriv handlers need to be available)
// ============================================================================

require_once DAILY_MENU_PATH . 'public/frontend-editor-ajax.php';
require_once DAILY_MENU_PATH . 'public/akce-frontend-editor-ajax.php';
require_once DAILY_MENU_PATH . 'public/shortcode.php';
require_once DAILY_MENU_PATH . 'public/akce-shortcode.php';

// ============================================================================
// Activation & Deactivation
// ============================================================================

register_activation_hook( __FILE__, 'daily_menu_activate' );

function daily_menu_activate() {
    // Default menu data
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

    // Generate PIN if none exists
    if ( false === get_option( DAILY_MENU_PIN_OPTION ) ) {
        $pin = daily_menu_generate_pin();
        // Store plain PIN temporarily (24h) so admin can see it once
        set_transient( DAILY_MENU_PIN_PLAIN_TRANSIENT, $pin, DAY_IN_SECONDS );
    }

    // Register rewrite rules and flush
    daily_menu_register_rewrite_rules();
    flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'daily_menu_deactivate' );

function daily_menu_deactivate() {
    flush_rewrite_rules();
}

// ============================================================================
// Rewrite Rules
// ============================================================================

add_action( 'init', 'daily_menu_register_rewrite_rules' );

function daily_menu_register_rewrite_rules() {
    add_rewrite_rule(
        '^' . DAILY_MENU_FRONTEND_SLUG . '/?$',
        'index.php?daily_menu_frontend=1',
        'top'
    );
    add_rewrite_rule(
        '^' . DAILY_MENU_AKCE_SLUG . '/?$',
        'index.php?daily_menu_akce_frontend=1',
        'top'
    );
}

add_filter( 'query_vars', 'daily_menu_query_vars' );

function daily_menu_query_vars( $vars ) {
    $vars[] = 'daily_menu_frontend';
    $vars[] = 'daily_menu_akce_frontend';
    return $vars;
}

// Flush rewrite rules once after plugin update (for existing installations)
add_action( 'init', 'daily_menu_maybe_flush_rules', 20 );

function daily_menu_maybe_flush_rules() {
    if ( get_option( 'daily_menu_rewrite_version' ) !== DAILY_MENU_VERSION ) {
        // Generate PIN if upgrading from v1 (no PIN exists yet)
        if ( false === get_option( DAILY_MENU_PIN_OPTION ) ) {
            $pin = daily_menu_generate_pin();
            set_transient( DAILY_MENU_PIN_PLAIN_TRANSIENT, $pin, DAY_IN_SECONDS );
        }

        flush_rewrite_rules();
        update_option( 'daily_menu_rewrite_version', DAILY_MENU_VERSION );
    }
}

// ============================================================================
// Frontend Template Redirect
// ============================================================================

add_action( 'template_redirect', 'daily_menu_frontend_template_redirect' );

function daily_menu_frontend_template_redirect() {
    if ( get_query_var( 'daily_menu_frontend' ) == '1' ) {
        require DAILY_MENU_PATH . 'public/frontend-editor.php';
        exit;
    }

    if ( get_query_var( 'daily_menu_akce_frontend' ) == '1' ) {
        require DAILY_MENU_PATH . 'public/akce-frontend-editor.php';
        exit;
    }
}

// ============================================================================
// Admin Menu & Assets
// ============================================================================

add_action( 'admin_menu', 'daily_menu_admin_menu' );

function daily_menu_admin_menu() {
    $menu_hook = add_menu_page(
        'Denní menu',
        'Denní menu',
        'edit_posts',
        'daily-menu',
        'daily_menu_render_admin_page',
        'dashicons-food',
        26
    );

    add_submenu_page(
        'daily-menu',
        'Denní menu',
        'Denní menu',
        'edit_posts',
        'daily-menu',
        'daily_menu_render_admin_page'
    );

    $akce_hook = add_submenu_page(
        'daily-menu',
        'Akce',
        'Akce',
        'edit_posts',
        'daily-menu-akce',
        'daily_menu_akce_render_admin_page'
    );

    // Store hooks for enqueue matching
    global $daily_menu_admin_hooks;
    $daily_menu_admin_hooks = array(
        'menu' => $menu_hook,
        'akce' => $akce_hook,
    );
}

add_action( 'admin_enqueue_scripts', 'daily_menu_admin_enqueue' );

function daily_menu_admin_enqueue( $hook ) {
    global $daily_menu_admin_hooks;

    // Daily menu page
    if ( isset( $daily_menu_admin_hooks['menu'] ) && $hook === $daily_menu_admin_hooks['menu'] ) {
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

    // Akce page
    if ( isset( $daily_menu_admin_hooks['akce'] ) && $hook === $daily_menu_admin_hooks['akce'] ) {
        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_media();

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
            'daily-menu-admin-akce-script',
            DAILY_MENU_URL . 'admin/js/admin-akce-script.js',
            array( 'jquery', 'jquery-ui-datepicker' ),
            DAILY_MENU_VERSION,
            true
        );

        wp_localize_script( 'daily-menu-admin-akce-script', 'dailyMenuAkceAjax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'daily_menu_akce_nonce' ),
        ) );
    }
}

// ============================================================================
// Admin Notice — Show PIN once after activation/generation
// ============================================================================

add_action( 'admin_notices', 'daily_menu_pin_admin_notice' );

function daily_menu_pin_admin_notice() {
    global $daily_menu_admin_hooks;
    $screen = get_current_screen();
    $allowed_screens = array();
    if ( isset( $daily_menu_admin_hooks['menu'] ) ) {
        $allowed_screens[] = $daily_menu_admin_hooks['menu'];
    }
    if ( ! $screen || ! in_array( $screen->id, $allowed_screens, true ) ) {
        return;
    }

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $plain_pin = get_transient( DAILY_MENU_PIN_PLAIN_TRANSIENT );
    if ( $plain_pin ) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <strong>PIN pro veřejnou editaci menu:</strong>
                <code style="font-size: 18px; padding: 5px 10px;"><?php echo esc_html( $plain_pin ); ?></code>
            </p>
            <p>Tento PIN je zobrazen pouze jednou. Poznamenejte si ho! Pokud ho ztratíte, vygenerujte nový níže.</p>
            <p>
                <a href="<?php echo esc_url( home_url( '/' . DAILY_MENU_FRONTEND_SLUG . '/' ) ); ?>" target="_blank">
                    Odkaz na veřejnou stránku editace
                </a>
            </p>
        </div>
        <?php
        delete_transient( DAILY_MENU_PIN_PLAIN_TRANSIENT );
    }
}

// ============================================================================
// SEO — Robots.txt filter
// ============================================================================

add_filter( 'robots_txt', 'daily_menu_robots_txt', 10, 2 );

function daily_menu_robots_txt( $output, $public ) {
    $output .= "\nDisallow: /" . DAILY_MENU_FRONTEND_SLUG . "/\n";
    $output .= "Disallow: /" . DAILY_MENU_AKCE_SLUG . "/\n";
    return $output;
}

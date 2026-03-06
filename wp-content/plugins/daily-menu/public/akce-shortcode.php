<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

add_shortcode( 'daily_akce', 'daily_menu_akce_shortcode_render' );

function daily_menu_akce_shortcode_render( $atts ) {
    $data = get_option( DAILY_MENU_AKCE_OPTION_KEY );

    if ( empty( $data ) || empty( $data['title'] ) ) {
        return '';
    }

    // Check date range — if now is outside date_from – date_to, show nothing
    $today = wp_date( 'Y-m-d' );

    if ( ! empty( $data['date_from'] ) && $today < $data['date_from'] ) {
        return '';
    }

    if ( ! empty( $data['date_to'] ) && $today > $data['date_to'] ) {
        return '';
    }

    wp_enqueue_style(
        'daily-menu-akce-shortcode-style',
        DAILY_MENU_URL . 'public/css/akce-shortcode-style.css',
        array(),
        DAILY_MENU_VERSION
    );

    $title     = $data['title'];
    $text      = $data['text'];
    $image_url = isset( $data['image_url'] ) ? $data['image_url'] : '';

    ob_start();
    ?>
    <div class="daily-menu-akce-wrapper">
        <?php if ( ! empty( $image_url ) ) : ?>
            <div class="daily-menu-akce-image">
                <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
            </div>
        <?php endif; ?>

        <div class="daily-menu-akce-title-text">
            <h3 class="elementor-heading-title food-menu-title"><?php echo esc_html( $title ); ?></h3>

            <?php if ( ! empty( $text ) ) : ?>
                <div class="daily-menu-akce-text">
                    <?php echo wp_kses_post( wpautop( $text ) ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

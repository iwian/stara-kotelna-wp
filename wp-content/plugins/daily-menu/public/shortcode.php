<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

add_shortcode( 'daily_menu', 'daily_menu_shortcode_render' );

function daily_menu_shortcode_render( $atts ) {
    $data = get_option( DAILY_MENU_OPTION_KEY );

    if ( empty( $data ) || empty( $data['categories'] ) ) {
        return '<p>Denní menu zatím nebylo nastaveno.</p>';
    }

    wp_enqueue_style(
        'daily-menu-shortcode-style',
        DAILY_MENU_URL . 'public/css/shortcode-style.css',
        array(),
        DAILY_MENU_VERSION
    );

    $date       = isset( $data['date'] ) ? $data['date'] : '';
    $categories = $data['categories'];

    $czech_days = array( 'neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota' );

    $date_display = '';
    if ( ! empty( $date ) ) {
        $timestamp    = strtotime( $date );
        $day_name     = mb_convert_case( $czech_days[ (int) date( 'w', $timestamp ) ], MB_CASE_TITLE, 'UTF-8' );
        $date_display = $day_name . ' ' . date( 'j.n.', $timestamp );
    }

    ob_start();
    ?>
    <div class="daily-menu-shortcode-wrapper">
        <?php if ( ! empty( $date_display ) ) : ?>
            <div class="daily-menu-date-section">
                <h2 class="elementor-heading-title"><?php echo esc_html( $date_display ); ?></h2>
            </div>
        <?php endif; ?>

        <?php foreach ( $categories as $category ) : ?>
            <?php if ( empty( $category['items'] ) ) { continue; } ?>

            <div class="daily-menu-category-section">
                <h3 class="elementor-heading-title"><?php echo esc_html( $category['name'] ); ?></h3>

                <div class="food-menu-container">
                    <div class="food-menu-content-wrapper food-menu">
                        <?php foreach ( $category['items'] as $item ) : ?>
                            <?php if ( empty( $item['name'] ) ) { continue; } ?>

                            <div class="food-menu-grid-wrapper">
                                <div class="food-menu-content no-food-img">
                                    <div class="food-menu-content-top-holder">
                                        <div class="food-menu-content-title-holder">
                                            <h3 class="food-menu-title"><?php echo esc_html( $item['name'] ); ?></h3>
                                        </div>
                                        <div class="food-menu-content-title-line"></div>
                                        <?php if ( ! empty( $item['price'] ) ) : ?>
                                        <div class="food-menu-content-price-holder">
                                            <span class="food-menu-content-price-normal"><?php echo esc_html( $item['price'] ); ?>,- Kč</span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ( ! empty( $item['amount'] ) ) : ?>
                                    <div class="food-menu-desc"><?php echo esc_html( $item['amount'] ); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}

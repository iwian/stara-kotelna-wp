<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

function daily_menu_akce_render_admin_page() {
    ?>
    <div class="wrap" id="daily-menu-akce-wrap">
        <h1>Akce</h1>

        <?php daily_menu_akce_render_editor_form( 'admin' ); ?>

        <?php if ( current_user_can( 'manage_options' ) ) : ?>
        <hr />
        <h2>Nastavení veřejné editace</h2>
        <p>
            Veřejná stránka pro editaci akce:
            <a href="<?php echo esc_url( home_url( '/' . DAILY_MENU_AKCE_SLUG . '/' ) ); ?>" target="_blank">
                <?php echo esc_html( home_url( '/' . DAILY_MENU_AKCE_SLUG . '/' ) ); ?>
            </a>
        </p>
        <p class="description">Přístup je chráněn stejným PINem jako editace denního menu.</p>
        <?php endif; ?>
    </div>
    <?php
}

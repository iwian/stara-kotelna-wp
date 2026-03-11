<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

// Handle PIN form submission
$is_authenticated = daily_menu_frontend_auth_check();
$pin_error        = '';

if ( ! $is_authenticated && isset( $_POST['daily_menu_pin'] ) ) {
    if ( ! wp_verify_nonce( isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '', 'daily_menu_pin_login' ) ) {
        $pin_error = 'Neplatný požadavek. Zkuste to znovu.';
    } elseif ( daily_menu_is_rate_limited() ) {
        $pin_error = 'Příliš mnoho pokusů. Zkuste to za 10 minut.';
    } else {
        $pin = sanitize_text_field( wp_unslash( $_POST['daily_menu_pin'] ) );
        if ( daily_menu_verify_pin( $pin ) ) {
            daily_menu_set_auth_cookie();
            daily_menu_clear_rate_limit();
            $is_authenticated = true;
        } else {
            daily_menu_record_failed_attempt();
            if ( daily_menu_is_rate_limited() ) {
                $pin_error = 'Příliš mnoho pokusů. Přístup zablokován na 10 minut.';
            } else {
                $pin_error = 'Nesprávný PIN.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Úpravy menu</title>

    <?php if ( $is_authenticated ) : ?>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <link rel="stylesheet"
              href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet"
              href="<?php echo esc_url( includes_url( 'css/dashicons.min.css' ) ); ?>" />
    <?php endif; ?>

    <link rel="stylesheet"
          href="<?php echo esc_url( DAILY_MENU_URL . 'public/css/frontend-editor-style.css' ); ?>?v=<?php echo esc_attr( DAILY_MENU_VERSION ); ?>" />
</head>
<body class="daily-menu-frontend-body">

    <?php if ( $is_authenticated ) : ?>

        <div class="wrap" id="daily-menu-wrap">
            <div class="daily-menu-header">
                <h1>Denní menu</h1>
                <button type="button" id="daily-menu-logout" class="button button-logout">Odhlásit se</button>
            </div>
            <?php daily_menu_render_editor_form(); ?>
        </div>

        <script>
            var dailyMenuAjax = {
                ajaxurl: '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>',
                nonce: '<?php echo esc_js( wp_create_nonce( 'daily_menu_frontend_nonce' ) ); ?>',
                logoutNonce: '<?php echo esc_js( wp_create_nonce( 'daily_menu_logout' ) ); ?>'
            };
        </script>
        <script src="<?php echo esc_url( DAILY_MENU_URL . 'public/js/frontend-editor-script.js' ); ?>?v=<?php echo esc_attr( DAILY_MENU_VERSION ); ?>"></script>

    <?php else : ?>

        <?php require DAILY_MENU_PATH . 'templates/pin-login-form.php'; ?>

    <?php endif; ?>

</body>
</html>

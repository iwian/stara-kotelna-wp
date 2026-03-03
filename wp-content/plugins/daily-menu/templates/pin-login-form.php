<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}
?>
<div class="daily-menu-pin-login">
    <div class="daily-menu-pin-box">
        <h2>Přihlášení k editaci menu</h2>
        <?php if ( ! empty( $pin_error ) ) : ?>
            <div class="daily-menu-pin-error"><?php echo esc_html( $pin_error ); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <?php wp_nonce_field( 'daily_menu_pin_login' ); ?>
            <label for="daily_menu_pin">Zadejte PIN:</label>
            <input type="text"
                   id="daily_menu_pin"
                   name="daily_menu_pin"
                   maxlength="6"
                   pattern="\d{6}"
                   inputmode="numeric"
                   autocomplete="off"
                   autofocus
                   required />
            <button type="submit">Přihlásit</button>
        </form>
    </div>
</div>

<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

function daily_menu_render_admin_page() {
    ?>
    <div class="wrap" id="daily-menu-wrap">
        <h1>Denní menu</h1>

        <?php daily_menu_render_editor_form(); ?>

        <?php if ( current_user_can( 'manage_options' ) ) : ?>
        <hr />
        <h2>Nastavení veřejné editace</h2>
        <p>
            Veřejná stránka pro editaci menu:
            <a href="<?php echo esc_url( home_url( '/' . DAILY_MENU_FRONTEND_SLUG . '/' ) ); ?>" target="_blank">
                <?php echo esc_html( home_url( '/' . DAILY_MENU_FRONTEND_SLUG . '/' ) ); ?>
            </a>
        </p>
        <p>
            <button type="button" class="button" id="daily-menu-regenerate-pin">
                Vygenerovat nový PIN
            </button>
            <span id="daily-menu-pin-result"></span>
        </p>
        <script>
        (function($) {
            $('#daily-menu-regenerate-pin').on('click', function() {
                if ( ! confirm('Vygenerovat nový PIN? Starý PIN přestane fungovat.') ) {
                    return;
                }
                var $btn = $(this);
                $btn.prop('disabled', true);
                $.post(dailyMenuAjax.ajaxurl, {
                    action: 'daily_menu_regenerate_pin',
                    nonce: dailyMenuAjax.nonce
                }, function(response) {
                    if (response.success) {
                        $('#daily-menu-pin-result').html(
                            '<strong>Nový PIN:</strong> <code style="font-size:18px;padding:5px 10px;">' +
                            response.data.pin + '</code> &mdash; poznamenejte si ho!'
                        );
                    } else {
                        $('#daily-menu-pin-result').text('Chyba při generování PINu.');
                    }
                    $btn.prop('disabled', false);
                });
            });
        })(jQuery);
        </script>
        <?php endif; ?>
    </div>
    <?php
}

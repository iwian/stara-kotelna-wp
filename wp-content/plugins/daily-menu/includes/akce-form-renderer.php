<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

/**
 * Render the akce (promotion) editor form.
 * Used by both the admin page and the frontend editor.
 *
 * @param string $context 'admin' or 'frontend' — controls image picker type.
 */
function daily_menu_akce_render_editor_form( $context = 'admin' ) {
    $data = get_option( DAILY_MENU_AKCE_OPTION_KEY, array() );

    $image_url = isset( $data['image_url'] ) ? $data['image_url'] : '';
    $title     = isset( $data['title'] ) ? $data['title'] : '';
    $text      = isset( $data['text'] ) ? $data['text'] : '';
    $date_from = isset( $data['date_from'] ) ? $data['date_from'] : '';
    $date_to   = isset( $data['date_to'] ) ? $data['date_to'] : '';
    ?>
    <div id="daily-menu-akce-messages"></div>

    <form id="daily-menu-akce-form" method="post">

        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="daily-menu-akce-title">Nadpis akce:</label>
                </th>
                <td>
                    <input type="text"
                           id="daily-menu-akce-title"
                           name="akce_title"
                           value="<?php echo esc_attr( $title ); ?>"
                           class="regular-text"
                           placeholder="Nadpis akce" />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="daily-menu-akce-text">Text akce:</label>
                </th>
                <td>
                    <textarea id="daily-menu-akce-text"
                              name="akce_text"
                              class="large-text"
                              rows="6"
                              placeholder="Popis akce..."><?php echo esc_textarea( $text ); ?></textarea>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label>Obrázek:</label>
                </th>
                <td>
                    <div id="daily-menu-akce-image-preview" style="margin-bottom: 10px;">
                        <?php if ( ! empty( $image_url ) ) : ?>
                            <img src="<?php echo esc_url( $image_url ); ?>" style="max-width: 300px; height: auto; display: block;" />
                        <?php endif; ?>
                    </div>
                    <input type="hidden" id="daily-menu-akce-image-url" value="<?php echo esc_attr( $image_url ); ?>" />

                    <?php if ( $context === 'admin' ) : ?>
                        <button type="button" class="button" id="daily-menu-akce-select-image">
                            <?php echo empty( $image_url ) ? 'Vybrat obrázek' : 'Změnit obrázek'; ?>
                        </button>
                    <?php else : ?>
                        <div id="daily-menu-akce-upload-wrap">
                            <input type="file" id="daily-menu-akce-file-input" accept="image/*" />
                            <p class="description">Vyberte obrázek z telefonu nebo počítače.</p>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $image_url ) ) : ?>
                        <button type="button" class="button" id="daily-menu-akce-remove-image" style="margin-left: 5px;">
                            Odebrat obrázek
                        </button>
                    <?php else : ?>
                        <button type="button" class="button" id="daily-menu-akce-remove-image" style="margin-left: 5px; display: none;">
                            Odebrat obrázek
                        </button>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="daily-menu-akce-date-from">Zobrazovat od:</label>
                </th>
                <td>
                    <input type="text"
                           id="daily-menu-akce-date-from"
                           name="akce_date_from"
                           value="<?php echo esc_attr( $date_from ); ?>"
                           class="regular-text"
                           placeholder="RRRR-MM-DD" />
                    <p class="description" id="daily-menu-akce-date-from-display"></p>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="daily-menu-akce-date-to">Zobrazovat do:</label>
                </th>
                <td>
                    <input type="text"
                           id="daily-menu-akce-date-to"
                           name="akce_date_to"
                           value="<?php echo esc_attr( $date_to ); ?>"
                           class="regular-text"
                           placeholder="RRRR-MM-DD" />
                    <p class="description" id="daily-menu-akce-date-to-display"></p>
                </td>
            </tr>
        </table>

        <hr />

        <p class="submit">
            <button type="button" class="button button-primary" id="daily-menu-akce-save">
                Uložit akci
            </button>
        </p>
    </form>
    <?php
}

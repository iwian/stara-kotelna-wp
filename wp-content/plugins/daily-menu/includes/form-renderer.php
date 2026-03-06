<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

/**
 * Render the daily menu editor form.
 * Used by both the admin page and the frontend editor.
 */
function daily_menu_render_editor_form() {
    $data        = get_option( DAILY_MENU_OPTION_KEY, array() );
    $stored_date = isset( $data['date'] ) ? $data['date'] : '';
    $tomorrow    = wp_date( 'Y-m-d', strtotime( '+1 day' ) );
    $categories  = isset( $data['categories'] ) ? $data['categories'] : array();

    // If stored date differs from tomorrow, pre-fill tomorrow (menu is entered evening before)
    $display_date = ( $stored_date === $tomorrow ) ? $stored_date : $tomorrow;
    ?>
    <div id="daily-menu-messages"></div>

    <form id="daily-menu-form" method="post">

        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="daily-menu-date">Denní menu pro den:</label>
                </th>
                <td>
                    <input type="text"
                           id="daily-menu-date"
                           name="menu_date"
                           value="<?php echo esc_attr( $display_date ); ?>"
                           class="regular-text"
                           readonly />
                    <p class="description" id="daily-menu-date-display"></p>
                </td>
            </tr>
        </table>

        <div id="daily-menu-categories">
            <?php foreach ( $categories as $cat_index => $category ) : ?>
                <?php daily_menu_render_category_block( $cat_index, $category ); ?>
            <?php endforeach; ?>
        </div>

        <p>
            <button type="button" class="button" id="daily-menu-add-category">
                + Přidat kategorii
            </button>
        </p>

        <hr />

        <p class="submit">
            <button type="button" class="button button-primary" id="daily-menu-save">
                Uložit menu
            </button>
            <button type="button" class="button" id="daily-menu-print">
                Vytisknout menu
            </button>
        </p>
    </form>
    <?php
}

/**
 * Render a single category block with its items.
 */
function daily_menu_render_category_block( $cat_index, $category ) {
    $name  = isset( $category['name'] ) ? $category['name'] : '';
    $items = isset( $category['items'] ) ? $category['items'] : array();
    ?>
    <div class="daily-menu-category" data-index="<?php echo esc_attr( $cat_index ); ?>">
        <div class="daily-menu-category-header">
            <input type="text"
                   class="daily-menu-category-name"
                   value="<?php echo esc_attr( $name ); ?>"
                   placeholder="Název kategorie" />
            <button type="button" class="button daily-menu-remove-category">
                <span class="dashicons dashicons-no-alt"></span> Odebrat kategorii
            </button>
        </div>

        <table class="widefat daily-menu-items-table">
            <thead>
                <tr>
                    <th class="col-amount">Množství</th>
                    <th class="col-name">Název</th>
                    <th class="col-price">Cena (Kč)</th>
                    <th class="col-actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $items as $item ) : ?>
                <tr class="daily-menu-item-row">
                    <td><input type="text" class="daily-menu-item-amount" value="<?php echo esc_attr( $item['amount'] ); ?>" placeholder="0,33l" /></td>
                    <td><textarea class="daily-menu-item-name widefat" rows="1" placeholder="Název jídla"><?php echo esc_html( $item['name'] ); ?></textarea></td>
                    <td><input type="text" class="daily-menu-item-price" value="<?php echo esc_attr( $item['price'] ); ?>" placeholder="89" /></td>
                    <td><button type="button" class="button daily-menu-remove-item"><span class="dashicons dashicons-no-alt"></span></button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p>
            <button type="button" class="button daily-menu-add-item">+ Přidat položku</button>
        </p>
    </div>
    <?php
}

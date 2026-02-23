# Plán implementace: Plugin "daily-menu"

## Kontext

Restaurace Stará Kotelna potřebuje správu denního menu přímo z WordPress administrace. Plugin umožní zadávat položky denního menu rozdělené do kategorií, zobrazit je na webu přes shortcode (se styly shodnými s Food Menu Elementor widgetem) a vytisknout na A4.

## Struktura pluginu

```
wp-content/plugins/daily-menu/
├── daily-menu.php              ← hlavní soubor (header, konstanty, hooks, includes, enqueue)
├── admin/
│   ├── admin-page.php          ← PHP renderování admin stránky
│   ├── admin-ajax.php          ← AJAX handler pro uložení + tisk
│   ├── css/admin-style.css     ← styly admin stránky
│   └── js/admin-script.js      ← datepicker, dynamický formulář, AJAX save, dirty tracking
├── public/
│   ├── shortcode.php           ← [daily_menu] shortcode
│   └── css/shortcode-style.css ← doplňkové styly (většinu řeší theme)
└── print/
    └── print-template.php      ← standalone HTML stránka pro tisk A4
```

## Uložení dat

Jeden WP option `daily_menu_data` (serializované pole):
```php
[
    'date' => '2026-02-23',
    'categories' => [
        ['name' => 'Polévky', 'items' => [
            ['amount' => '0,33l', 'name' => 'Bílá zelná polévka', 'price' => '89'],
        ]],
        // ...
    ]
]
```

## Implementační kroky

### 1. `daily-menu.php` — hlavní soubor pluginu

- Plugin header (Plugin Name: Denní menu, Text Domain: daily-menu)
- WPINC guard, konstanty (`DAILY_MENU_VERSION`, `DAILY_MENU_PATH`, `DAILY_MENU_URL`, `DAILY_MENU_OPTION_KEY`)
- `register_activation_hook` — uloží výchozí kategorie (Polévky, Předkrmy, Hotová jídla, Doporučujeme, Saláty, Dezerty) pokud option neexistuje
- `add_menu_page('Denní menu', ..., 'dashicons-food', pozice 26)` na `admin_menu` hook
- Enqueue na `admin_enqueue_scripts` — jen na `toplevel_page_daily-menu`:
  - WP bundled `jquery-ui-datepicker` + jQuery UI CSS z CDN
  - `admin-style.css`, `admin-script.js`
  - `wp_localize_script` s `ajaxurl` a `nonce`
- Include `admin/admin-page.php`, `admin/admin-ajax.php` (jen `is_admin()`), `public/shortcode.php` (vždy)

### 2. `admin/admin-page.php` — admin stránka

- Funkce `daily_menu_render_admin_page()`:
  - Načte `get_option(DAILY_MENU_OPTION_KEY)`
  - Pokud uložené datum ≠ dnes → předvyplní dnešní datum (jen v HTML, neukládá automaticky)
  - Řádek "Denní menu pro den:" + readonly input s datepickerem + pod ním český formát (pondělí 23.2.)
  - Kontejner kategorií — každá kategorie = box s:
    - Input pro název kategorie + tlačítko "Odebrat kategorii"
    - Tabulka (`widefat`) s hlavičkou: Množství | Název | Cena | akce
    - Řádky položek: 3 inputy + tlačítko smazat
    - Tlačítko "+ Přidat položku"
  - Tlačítko "+ Přidat kategorii"
  - Tlačítka "Uložit menu" (button-primary) a "Vytisknout menu"

### 3. `admin/admin-ajax.php` — AJAX handlery

**`wp_ajax_daily_menu_save`:**
- Ověření nonce (`daily_menu_save_nonce`)
- Ověření capability (`edit_posts`)
- JSON decode z `$_POST['menu_data']` (po `wp_unslash`)
- Sanitizace všech polí přes `sanitize_text_field()`
- Validace formátu data regex `/^\d{4}-\d{2}-\d{2}$/`
- `update_option(DAILY_MENU_OPTION_KEY, $sanitized)`
- `wp_send_json_success()` / `wp_send_json_error()`

**`wp_ajax_daily_menu_print`:**
- Ověření capability
- Require `print/print-template.php` + `exit`

### 4. `admin/js/admin-script.js` — klientská logika

- **Datepicker**: jQuery UI s českými názvy dnů/měsíců, `firstDay: 1`, formát `yy-mm-dd`
- **Český formát data**: funkce `formatCzechDate()` → "pondělí 23.2." zobrazený pod inputem
- **Dynamické kategorie**: delegované eventy pro přidání/odebrání kategorií (s `confirm()`)
- **Dynamické položky**: delegované eventy pro přidání/odebrání řádků v tabulce
- **Dirty tracking**: `isDirty` flag nastavený na `change`/`input` v `#daily-menu-form`, `beforeunload.daily-menu` handler
- **AJAX save**: `collectFormData()` sesbírá všechna data z DOM → POST na `admin-ajax.php`, po úspěchu `isDirty = false`
- **Tisk**: `window.open(ajaxurl + '?action=daily_menu_print', '_blank')`

### 5. `public/shortcode.php` — shortcode `[daily_menu]`

- Renderování repoužitím **existujících CSS tříd** z Grand Restaurant Food Menu widgetu:
  - `.food-menu-container` > `.food-menu-content-wrapper.food-menu` > `.food-menu-grid-wrapper` > `.food-menu-content.no-food-img`
  - Uvnitř: `.food-menu-content-top-holder` (display:table) → `.food-menu-content-title-holder` (název) + `.food-menu-content-title-line` (tečkovaná čára) + `.food-menu-content-price-holder` (cena + " Kč")
  - `.food-menu-desc` pro množství
- Referenční soubor: `wp-content/plugins/grandrestaurant-elementor/templates/food-menu/index.php`
- CSS z `grandrestaurant-elementor.css` (řádky 13043-13192) se načítá globálně přes Elementor
- Nadpis "Denní menu — pondělí 23.2." + sekce pro každou neprázdnou kategorii
- Prázdné kategorie a položky bez názvu se přeskočí

### 6. `public/css/shortcode-style.css` — doplňkové styly

Minimální — pouze wrapper (`max-width: 800px`), nadpisy kategorií, a fallback `display: table` na `.food-menu-content-top-holder` pro případ že Elementor CSS není načtené.

### 7. `print/print-template.php` — tisková šablona

- Standalone HTML (bez WP header/footer)
- Google Fonts Open Sans (400, 600, 700)
- Černý text na bílém pozadí
- `@page { size: A4; margin: 15mm; }`
- Layout: Nadpis "DENNÍ MENU" + datum + kategorie s položkami (display:table s tečkovanou čárou)
- Tlačítko "Vytisknout" viditelné na obrazovce, skryté v `@media print`
- Přístup pouze pro přihlášené uživatele (`wp_ajax_` bez `nopriv`)

## Klíčové referenční soubory

- `wp-content/plugins/grandrestaurant-elementor/templates/food-menu/index.php` — HTML struktura food menu k replikaci
- `wp-content/plugins/grandrestaurant-elementor/assets/css/grandrestaurant-elementor.css` (ř. 13043-13192) — CSS třídy food menu
- `wp-content/plugins/grandrestaurant-custom-post/grandrestaurant-custom-post.php` — vzor plugin struktury

## Ověření

1. Aktivovat plugin v WP admin → ověřit že se objeví "Denní menu" v menu s ikonou
2. Otevřít admin stránku → ověřit výchozí kategorie, datepicker, český formát data
3. Přidat/odebrat kategorie a položky → ověřit dynamické chování
4. Uložit → ověřit AJAX response a persistence po refreshi
5. Změnit data bez uložení, kliknout jinam → ověřit beforeunload warning
6. Vložit `[daily_menu]` na libovolnou stránku → ověřit zobrazení se styly food menu
7. Kliknout "Vytisknout" → ověřit A4 layout s Open Sans, tisk z prohlížeče
8. Otevřít admin stránku následující den → ověřit auto-fill na dnešní datum

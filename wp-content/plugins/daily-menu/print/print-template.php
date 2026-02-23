<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}

$data       = get_option( DAILY_MENU_OPTION_KEY );
$date       = isset( $data['date'] ) ? $data['date'] : '';
$categories = isset( $data['categories'] ) ? $data['categories'] : array();

$czech_days = array( 'neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota' );

$date_display = '';
if ( ! empty( $date ) ) {
    $timestamp    = strtotime( $date );
    $day_name     = $czech_days[ (int) date( 'w', $timestamp ) ];
    $date_display = $day_name . ' ' . date( 'j.n.', $timestamp );
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Denní menu – <?php echo esc_html( $date_display ); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: #000;
            background: #fff;
            font-size: 14px;
            line-height: 1.4;
            padding: 0;
        }

        #print-content {
            padding: 15mm;
            transform-origin: top left;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 5mm;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .print-date {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10mm;
        }

        .print-category {
            margin-bottom: 5mm;
        }

        .print-category-name {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            border-bottom: 2px solid #000;
            padding-bottom: 2mm;
            margin-bottom: 3mm;
        }

        .print-item {
            display: flex;
            align-items: baseline;
            width: 100%;
            padding: 1mm 0;
        }

        .print-item-name {
            font-weight: 400;
            padding-right: 2mm;
        }

        .print-item-amount {
            white-space: nowrap;
            color: #555;
            padding-right: 2mm;
            font-size: 12px;
            flex-shrink: 0;
        }

        .print-item-spacer {
            flex: 1;
        }

        .print-item-price {
            white-space: nowrap;
            text-align: right;
            font-weight: 600;
            padding-left: 2mm;
            flex-shrink: 0;
        }

        @page {
            size: A4;
            margin: 10mm;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            #print-content {
                padding: 0;
            }
        }

        .no-print {
            text-align: center;
            padding: 15px;
        }

        .no-print button {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            padding: 10px 30px;
            cursor: pointer;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        .no-print button:hover {
            background: #333;
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print();">Vytisknout</button>
    </div>

    <div id="print-content">
        <h1>Denní menu</h1>
        <?php if ( ! empty( $date_display ) ) : ?>
            <div class="print-date"><?php echo esc_html( $date_display ); ?></div>
        <?php endif; ?>

        <?php foreach ( $categories as $category ) : ?>
            <?php if ( empty( $category['items'] ) ) { continue; } ?>
            <div class="print-category">
                <div class="print-category-name"><?php echo esc_html( $category['name'] ); ?></div>
                <?php foreach ( $category['items'] as $item ) : ?>
                    <?php if ( empty( $item['name'] ) ) { continue; } ?>
                    <div class="print-item">
                        <span class="print-item-name"><?php echo esc_html( $item['name'] ); ?></span>
                        <?php if ( ! empty( $item['amount'] ) ) : ?>
                            <span class="print-item-amount">(<?php echo esc_html( $item['amount'] ); ?>)</span>
                        <?php endif; ?>
                        <span class="print-item-spacer"></span>
                        <?php if ( ! empty( $item['price'] ) ) : ?>
                            <span class="print-item-price"><?php echo esc_html( $item['price'] ); ?> Kč</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
    // Auto-scale content to fit one A4 page
    (function() {
        var content = document.getElementById('print-content');
        // A4 printable height: 297mm - 2×10mm margin = 277mm ≈ 1047px at 96dpi
        var maxHeight = 277 * (96 / 25.4); // ~1047px

        function fitToPage() {
            content.style.transform = 'none';
            var h = content.scrollHeight;
            if (h > maxHeight) {
                var scale = maxHeight / h;
                content.style.transform = 'scale(' + scale + ')';
                content.style.width = (100 / scale) + '%';
            }
        }

        // Fit after fonts load
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(fitToPage);
        } else {
            window.addEventListener('load', fitToPage);
        }
    })();
    </script>
</body>
</html>

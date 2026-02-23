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
            padding: 20mm 15mm;
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
            margin-bottom: 6mm;
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
            display: table;
            width: 100%;
            padding: 1.5mm 0;
        }

        .print-item-name {
            display: table-cell;
            width: 1%;
            white-space: nowrap;
            font-weight: 600;
            padding-right: 3mm;
        }

        .print-item-amount {
            display: table-cell;
            width: 1%;
            white-space: nowrap;
            color: #555;
            padding-right: 3mm;
            font-size: 12px;
        }

        .print-item-dots {
            display: table-cell;
            width: 98%;
            border-bottom: 1px dotted #999;
            position: relative;
            bottom: 4px;
        }

        .print-item-price {
            display: table-cell;
            width: 1%;
            white-space: nowrap;
            text-align: right;
            font-weight: 600;
            padding-left: 3mm;
        }

        @media print {
            body {
                padding: 10mm;
            }

            @page {
                size: A4;
                margin: 15mm;
            }

            .no-print {
                display: none !important;
            }
        }

        .no-print {
            text-align: center;
            margin-bottom: 20px;
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
                    <span class="print-item-dots"></span>
                    <?php if ( ! empty( $item['price'] ) ) : ?>
                        <span class="print-item-price"><?php echo esc_html( $item['price'] ); ?> Kč</span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>

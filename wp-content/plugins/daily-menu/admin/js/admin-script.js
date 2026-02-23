(function($) {
    'use strict';

    var isDirty = false;

    var czechDays = ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'];

    function formatCzechDate(dateStr) {
        var parts = dateStr.split('-');
        var d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
        var dayName = czechDays[d.getDay()];
        return dayName + ' ' + d.getDate() + '.' + (d.getMonth() + 1) + '.';
    }

    function updateDateDisplay() {
        var val = $('#daily-menu-date').val();
        if (val) {
            $('#daily-menu-date-display').text(formatCzechDate(val));
        }
    }

    function escAttr(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    function buildItemRowHtml(amount, name, price) {
        return '<tr class="daily-menu-item-row">' +
            '<td><input type="text" class="daily-menu-item-amount" value="' + escAttr(amount) + '" placeholder="0,33l" /></td>' +
            '<td><input type="text" class="daily-menu-item-name widefat" value="' + escAttr(name) + '" placeholder="Název jídla" /></td>' +
            '<td><input type="text" class="daily-menu-item-price" value="' + escAttr(price) + '" placeholder="89" /></td>' +
            '<td><button type="button" class="button daily-menu-remove-item"><span class="dashicons dashicons-no-alt"></span></button></td>' +
            '</tr>';
    }

    function buildCategoryHtml(name) {
        return '<div class="daily-menu-category">' +
            '<div class="daily-menu-category-header">' +
                '<input type="text" class="daily-menu-category-name" value="' + escAttr(name) + '" placeholder="Název kategorie" />' +
                '<button type="button" class="button daily-menu-remove-category"><span class="dashicons dashicons-no-alt"></span> Odebrat kategorii</button>' +
            '</div>' +
            '<table class="widefat daily-menu-items-table">' +
                '<thead><tr>' +
                    '<th class="col-amount">Množství</th>' +
                    '<th class="col-name">Název</th>' +
                    '<th class="col-price">Cena (Kč)</th>' +
                    '<th class="col-actions"></th>' +
                '</tr></thead>' +
                '<tbody></tbody>' +
            '</table>' +
            '<p><button type="button" class="button daily-menu-add-item">+ Přidat položku</button></p>' +
            '</div>';
    }

    function collectFormData() {
        var data = {
            date: $('#daily-menu-date').val(),
            categories: []
        };

        $('.daily-menu-category').each(function() {
            var cat = {
                name: $(this).find('.daily-menu-category-name').val(),
                items: []
            };

            $(this).find('.daily-menu-item-row').each(function() {
                cat.items.push({
                    amount: $(this).find('.daily-menu-item-amount').val(),
                    name:   $(this).find('.daily-menu-item-name').val(),
                    price:  $(this).find('.daily-menu-item-price').val()
                });
            });

            data.categories.push(cat);
        });

        return data;
    }

    $(document).ready(function() {

        // Datepicker with Czech locale
        $('#daily-menu-date').datepicker({
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            dayNamesMin: ['Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So'],
            dayNames: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
            monthNames: ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen',
                         'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'],
            monthNamesShort: ['Led', 'Úno', 'Bře', 'Dub', 'Kvě', 'Čer',
                              'Čvc', 'Srp', 'Zář', 'Říj', 'Lis', 'Pro'],
            onSelect: function() {
                isDirty = true;
                updateDateDisplay();
            }
        });

        updateDateDisplay();

        // Add category
        $('#daily-menu-add-category').on('click', function() {
            $('#daily-menu-categories').append(buildCategoryHtml(''));
            isDirty = true;
        });

        // Remove category
        $(document).on('click', '.daily-menu-remove-category', function() {
            if (confirm('Opravdu chcete odebrat tuto kategorii?')) {
                $(this).closest('.daily-menu-category').remove();
                isDirty = true;
            }
        });

        // Add item
        $(document).on('click', '.daily-menu-add-item', function() {
            var $tbody = $(this).closest('.daily-menu-category').find('tbody');
            $tbody.append(buildItemRowHtml('', '', ''));
            // Focus the first input of the new row
            $tbody.find('tr:last .daily-menu-item-amount').focus();
            isDirty = true;
        });

        // Remove item
        $(document).on('click', '.daily-menu-remove-item', function() {
            $(this).closest('tr').remove();
            isDirty = true;
        });

        // Dirty tracking on any input change
        $(document).on('change input', '#daily-menu-form', function() {
            isDirty = true;
        });

        // Unsaved changes warning
        $(window).on('beforeunload.daily-menu', function() {
            if (isDirty) {
                return 'Neuložené změny budou ztraceny.';
            }
        });

        // Save
        $('#daily-menu-save').on('click', function() {
            var data = collectFormData();

            $.ajax({
                url: dailyMenuAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'daily_menu_save',
                    nonce: dailyMenuAjax.nonce,
                    menu_data: JSON.stringify(data)
                },
                beforeSend: function() {
                    $('#daily-menu-save').prop('disabled', true).text('Ukládám...');
                },
                success: function(response) {
                    if (response.success) {
                        isDirty = false;
                        $('#daily-menu-messages').html(
                            '<div class="notice notice-success is-dismissible"><p>Menu bylo uloženo.</p></div>'
                        );
                    } else {
                        $('#daily-menu-messages').html(
                            '<div class="notice notice-error is-dismissible"><p>Chyba: ' + (response.data || 'Neznámá chyba') + '</p></div>'
                        );
                    }
                },
                error: function() {
                    $('#daily-menu-messages').html(
                        '<div class="notice notice-error is-dismissible"><p>Chyba spojení se serverem.</p></div>'
                    );
                },
                complete: function() {
                    $('#daily-menu-save').prop('disabled', false).text('Uložit menu');
                    // Scroll to top to show message
                    $('html, body').animate({ scrollTop: 0 }, 300);
                }
            });
        });

        // Print
        $('#daily-menu-print').on('click', function() {
            window.open(dailyMenuAjax.ajaxurl + '?action=daily_menu_print', '_blank');
        });

    });

})(jQuery);

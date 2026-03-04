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

    function updateDateDisplays() {
        var fromVal = $('#daily-menu-akce-date-from').val();
        var toVal = $('#daily-menu-akce-date-to').val();
        if (fromVal) {
            $('#daily-menu-akce-date-from-display').text(formatCzechDate(fromVal));
        }
        if (toVal) {
            $('#daily-menu-akce-date-to-display').text(formatCzechDate(toVal));
        }
    }

    function collectFormData() {
        return {
            image_url: $('#daily-menu-akce-image-url').val(),
            title:     $('#daily-menu-akce-title').val(),
            text:      $('#daily-menu-akce-text').val(),
            date_from: $('#daily-menu-akce-date-from').val(),
            date_to:   $('#daily-menu-akce-date-to').val()
        };
    }

    $(document).ready(function() {

        // Datepickers
        $('#daily-menu-akce-date-from, #daily-menu-akce-date-to').datepicker({
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
                updateDateDisplays();
            }
        });

        updateDateDisplays();

        // File upload for image
        $('#daily-menu-akce-file-input').on('change', function() {
            var file = this.files[0];
            if (!file) return;

            // Client-side validation
            if (file.size > 5 * 1024 * 1024) {
                alert('Obrázek je příliš velký. Maximální velikost je 5 MB.');
                $(this).val('');
                return;
            }

            var formData = new FormData();
            formData.append('action', 'daily_menu_akce_frontend_upload');
            formData.append('nonce', dailyMenuAkceAjax.nonce);
            formData.append('image', file);

            var $input = $(this);
            $input.prop('disabled', true);

            $.ajax({
                url: dailyMenuAkceAjax.ajaxurl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        var url = response.data.url;
                        $('#daily-menu-akce-image-url').val(url);
                        $('#daily-menu-akce-image-preview').html(
                            '<img src="' + url + '" style="max-width: 300px; height: auto; display: block;" />'
                        );
                        $('#daily-menu-akce-remove-image').show();
                        isDirty = true;
                    } else {
                        alert('Chyba: ' + (response.data || 'Nepodařilo se nahrát obrázek.'));
                    }
                },
                error: function() {
                    alert('Chyba spojení se serverem.');
                },
                complete: function() {
                    $input.prop('disabled', false).val('');
                }
            });
        });

        // Remove image
        $('#daily-menu-akce-remove-image').on('click', function() {
            $('#daily-menu-akce-image-url').val('');
            $('#daily-menu-akce-image-preview').html('');
            $('#daily-menu-akce-file-input').val('');
            $(this).hide();
            isDirty = true;
        });

        // Dirty tracking
        $(document).on('change input', '#daily-menu-akce-form', function() {
            isDirty = true;
        });

        // Unsaved changes warning
        $(window).on('beforeunload.daily-menu-akce', function() {
            if (isDirty) {
                return 'Neuložené změny budou ztraceny.';
            }
        });

        // Save
        $('#daily-menu-akce-save').on('click', function() {
            var data = collectFormData();

            $.ajax({
                url: dailyMenuAkceAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'daily_menu_akce_frontend_save',
                    nonce: dailyMenuAkceAjax.nonce,
                    akce_data: JSON.stringify(data)
                },
                beforeSend: function() {
                    $('#daily-menu-akce-save').prop('disabled', true).text('Ukládám...');
                },
                success: function(response) {
                    if (response.success) {
                        isDirty = false;
                        $('#daily-menu-akce-messages').html(
                            '<div class="notice notice-success is-dismissible"><p>Akce byla uložena.</p></div>'
                        );
                    } else {
                        $('#daily-menu-akce-messages').html(
                            '<div class="notice notice-error is-dismissible"><p>Chyba: ' + (response.data || 'Neznámá chyba') + '</p></div>'
                        );
                    }
                },
                error: function() {
                    $('#daily-menu-akce-messages').html(
                        '<div class="notice notice-error is-dismissible"><p>Chyba spojení se serverem.</p></div>'
                    );
                },
                complete: function() {
                    $('#daily-menu-akce-save').prop('disabled', false).text('Uložit akci');
                    $('html, body').animate({ scrollTop: 0 }, 300);
                }
            });
        });

    });

})(jQuery);

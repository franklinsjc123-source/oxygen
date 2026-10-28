<script>
/**
 * Table Export Handler for Oxygen
 * Supports Desktop, Mobile Browsers, and Android WebViews.
 * 1. Checks if button is a direct <a> link (leaves native link untouched)
 * 2. Prepares clean HTML table export
 * 3. Uses server-assisted GET download (/export-table-download/{token}/{filename})
 *    which Android DownloadManager handles natively with proper filename
 */
(function($) {
    'use strict';

    if (typeof $ === 'undefined') return;

    $(document).on('click', '.btn-export-excel', function(e) {
        var $btn = $(this);

        // If it's a native anchor link with an href, allow standard navigation (e.g., Download Report)
        if ($btn.is('a') && $btn.attr('href') && $btn.attr('href') !== '#' && $btn.attr('href').indexOf('javascript:') !== 0) {
            return;
        }

        e.preventDefault();

        var $card = $btn.closest('.card-body, .container-fluid, body');
        var $table = $card.find('table[data-toggle="table"]').length
            ? $card.find('table[data-toggle="table"]').first()
            : ($card.find('table').length ? $card.find('table').first() : $('table').first());

        if (!$table.length || $table.find('tbody tr.no-records-found').length > 0 || ($table.find('tbody tr').length === 1 && $table.find('tbody tr').text().indexOf('No matching records found') !== -1)) {
            alert('No records available to export.');
            return false;
        }

        var originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Exporting...');

        // Determine safe filename
        var pageTitle = $('.breadcrumb-item.active').text().trim() || $('h3').first().text().trim() || 'tableExport';
        var safeFilename = (pageTitle.replace(/[^a-zA-Z0-9_\-]/g, '_') || 'tableExport') + '.xls';

        // Clone table and remove non-exportable UI elements
        var $clone = $table.clone();
        $clone.find('thead th:first-child:has(input[type="checkbox"])').remove();
        $clone.find('tbody td:first-child:has(input[type="checkbox"])').remove();
        $clone.find('input[type="checkbox"]').remove();
        $clone.find('.no-export, [data-field="action"], th:contains("Action"), th:contains("ACTION")').each(function() {
            var idx = $(this).index();
            $clone.find('tr').each(function() {
                $(this).children().eq(idx).remove();
            });
        });
        $clone.find('img').each(function() {
            var alt = $(this).attr('alt') || '';
            $(this).replaceWith(alt ? '<span>' + alt + '</span>' : '');
        });
        $clone.find('.dropdown-menu, .modal, button, select').remove();
        $clone.find('tbody td .btn, tbody td a.btn, tbody td .badge').each(function() {
            var txt = $(this).text().trim();
            $(this).replaceWith(txt);
        });

        var tableHtml = $clone[0].outerHTML;
        var excelDoc = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">' +
            '<head>' +
            '<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">' +
            '<!--[if gte mso 9]><xml><' + 'x:ExcelWorkbook><' + 'x:ExcelWorksheets><' + 'x:ExcelWorksheet><' + 'x:Name>Export<' + '/x:Name><' + 'x:WorksheetOptions><' + 'x:DisplayGridlines/><' + '/x:WorksheetOptions><' + '/x:ExcelWorksheet><' + '/x:ExcelWorksheets><' + '/x:ExcelWorkbook></xml><![endif]-->' +
            '<' + 'style>' +
            'table { border-collapse: collapse; width: 100%; font-family: Calibri, Arial, sans-serif; }' +
            'th, td { border: 0.5pt solid #cccccc; padding: 6px 10px; text-align: left; vertical-align: middle; }' +
            'th { background-color: #183543; color: #ffffff; font-weight: bold; }' +
            'tr:nth-child(even) { background-color: #f9f9f9; }' +
            '<' + '/style>' +
            '<' + '/head><' + 'body>' +
            tableHtml +
            '<' + '/body><' + '/html>';

        function fallbackDirect(doc, filename) {
            var exportUrl = '{{ route("table.export.direct", [], false) }}';
            var $form = $('<form></form>').attr({
                method: 'POST',
                action: exportUrl,
                style: 'display:none;'
            });
            $form.append($('<textarea name="content"></textarea>').val(doc));
            $form.append($('<input type="hidden" name="filename">').val(filename));
            var token = $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}';
            $form.append($('<input type="hidden" name="_token">').val(token));
            $('body').append($form);
            $form.submit();
            setTimeout(function() {
                $form.remove();
            }, 3000);
        }

        // Store temp file and redirect to GET URL with filename
        var storeUrl = '{{ route("table.export.store", [], false) }}';
        var csrfToken = $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}';

        $.ajax({
            url: storeUrl,
            type: 'POST',
            data: {
                content: excelDoc,
                filename: safeFilename,
                mime_type: 'application/vnd.ms-excel',
                _token: csrfToken
            },
            dataType: 'json',
            timeout: 10000,
            success: function(resp) {
                if (resp && resp.download_url) {
                    window.location.href = resp.download_url;
                } else {
                    fallbackDirect(excelDoc, safeFilename);
                }
            },
            error: function() {
                fallbackDirect(excelDoc, safeFilename);
            },
            complete: function() {
                setTimeout(function() {
                    $btn.prop('disabled', false).html(originalHtml);
                }, 2000);
            }
        });
    });
})(jQuery);
</script>

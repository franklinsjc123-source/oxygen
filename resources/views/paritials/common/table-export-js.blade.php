<script>
/**
 * Table Export Handler for Oxygen
 * Uses a hidden form POST to directly download the file.
 * Works on Desktop, Mobile browsers, AND Android WebView
 * because it's a plain HTTP form submission — no AJAX, no blob URLs, no iframe.
 * When the server responds with Content-Disposition: attachment, the browser
 * downloads the file without navigating away from the current page.
 */
(function($) {
    'use strict';

    if (typeof $ === 'undefined') return;

    $(document).on('click', '.btn-export-excel', function(e) {
        e.preventDefault();
        var $btn = $(this);
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

        // Build a hidden form and submit it directly.
        // The server returns Content-Disposition: attachment so the browser downloads
        // the file without leaving the current page. This works everywhere.
        var exportUrl = '{{ route("table.export.direct", [], false) }}';

        var $form = $('<form></form>');
        $form.attr({
            method: 'POST',
            action: exportUrl,
            style: 'display:none;'
        });

        // Content goes in a textarea to preserve HTML
        var $contentField = $('<textarea name="content"></textarea>');
        $contentField.val(excelDoc);
        $form.append($contentField);
        $form.append('<input type="hidden" name="filename" value="' + safeFilename + '">');

        $('body').append($form);
        $form.submit();

        // Re-enable button and clean up form after download starts
        setTimeout(function() {
            $btn.prop('disabled', false).html(originalHtml);
            $form.remove();
        }, 2000);
    });
})(jQuery);
</script>

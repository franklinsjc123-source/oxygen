/**
 * Custom Table Export Handler for Oxygen
 * Works on Desktop (Instant Blob Download) and Mobile WebViews (HTTP server-assisted download or Android bridge)
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

        // Clone table and remove non-exportable UI elements (checkboxes, action buttons, modals, dropdowns)
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
            '<style>' +
            'table { border-collapse: collapse; width: 100%; font-family: Calibri, Arial, sans-serif; }' +
            'th, td { border: 0.5pt solid #cccccc; padding: 6px 10px; text-align: left; vertical-align: middle; }' +
            'th { background-color: #183543; color: #ffffff; font-weight: bold; }' +
            'tr:nth-child(even) { background-color: #f9f9f9; }' +
            '</style>' +
            '</head><body>' +
            tableHtml +
            '</body></html>';

        var downloadDirectBlob = function() {
            try {
                var blob = new Blob(['\ufeff' + excelDoc], { type: 'application/vnd.ms-excel;charset=utf-8;' });
                if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                    window.navigator.msSaveOrOpenBlob(blob, safeFilename);
                    $btn.prop('disabled', false).html(originalHtml);
                    return true;
                }
                var link = document.createElement('a');
                if (link.download !== undefined) {
                    var blobUrl = URL.createObjectURL(blob);
                    link.setAttribute('href', blobUrl);
                    link.setAttribute('download', safeFilename);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    setTimeout(function() {
                        if (link.parentNode) link.parentNode.removeChild(link);
                        URL.revokeObjectURL(blobUrl);
                        $btn.prop('disabled', false).html(originalHtml);
                    }, 500);
                    return true;
                }
            } catch (e) {
                console.warn('Direct blob download error:', e);
            }
            return false;
        };

        // Android Native Bridge
        if (window.Android && typeof window.Android.downloadBase64File === 'function') {
            try {
                var b64 = btoa(unescape(encodeURIComponent(excelDoc)));
                window.Android.downloadBase64File(b64, safeFilename, 'application/vnd.ms-excel');
                $btn.prop('disabled', false).html(originalHtml);
                return;
            } catch (e) {}
        }

        // Detect Mobile / Android WebView
        var ua = navigator.userAgent || '';
        var isAndroid = /Android/i.test(ua);
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(ua);
        var isWebView = /(wv|\.0\.0\.0|Version\/[\d\.]+|MobileApp|ReactNative|Flutter|Cordova|MobileWeb)/i.test(ua) || window.Android !== undefined;
        var mustUseHttpDownload = isAndroid || isMobile || isWebView;

        // Desktop non-mobile browsers: instant Blob download
        if (!mustUseHttpDownload && downloadDirectBlob()) {
            return;
        }

        // Server-assisted download for Android WebView
        var exportUrl = window.tableExportUrl || '/export-table-data';
        var csrfToken = $('meta[name="csrf-token"]').attr('content') || '';

        $.ajax({
            url: exportUrl,
            type: 'POST',
            data: JSON.stringify({
                filename: safeFilename,
                content: excelDoc,
                is_base64: false,
                mime_type: 'application/vnd.ms-excel'
            }),
            contentType: 'application/json',
            dataType: 'json',
            headers: csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {},
            timeout: 30000,
            success: function(res) {
                $btn.prop('disabled', false).html(originalHtml);
                if (res && (res.full_download_url || res.download_url)) {
                    var downloadUri = res.full_download_url;
                    if (!downloadUri || downloadUri.indexOf('http') !== 0) {
                        var rel = res.download_url || '';
                        if (rel.charAt(0) !== '/') rel = '/' + rel;
                        downloadUri = window.location.origin + rel;
                    }
                    window.location.href = downloadUri;
                } else {
                    if (!mustUseHttpDownload && downloadDirectBlob()) {
                        return;
                    }
                    alert('Export failed. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                $btn.prop('disabled', false).html(originalHtml);
                console.warn('Server export error:', error);
                if (!mustUseHttpDownload && downloadDirectBlob()) {
                    return;
                }
                alert('Failed to generate export file. Please check connection and try again.');
            }
        });
    });
})(jQuery);

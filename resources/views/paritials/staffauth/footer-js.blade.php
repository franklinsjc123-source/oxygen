<!-- latest jquery-->
    

<!--  jquery validation-->
  

    


 
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
        <script src="{{asset('assets/js/Datepicker1/dist/mc-calendar.min.js')}}"></script>

<script src="{{asset('assets/js/imask.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>

    <!-- Sidebar jquery-->
    
    <script src="{{asset('assets/js/slick.js')}}"></script>

    <!-- Jsgrid js-->
    <script src="{{asset('assets/js/jsgrid/jsgrid.min.js')}}"></script>
    <script src="{{asset('assets/js/jsgrid/griddata-invoice.js')}}"></script>
    <script src="{{asset('assets/js/jsgrid/jsgrid-invoice.js')}}"></script>

    <!-- lazyload js-->
    <script src="{{asset('assets/js/lazysizes.min.js')}}"></script>

    <!--right sidebar js-->
    <!--<script src="{{asset('assets/js/chat-menu.js')}}"></script> -->

    <!--script admin-->
    <script src="{{asset('assets/js/admin-script.js')}}"></script>
    <script>
        $('.single-item').slick({
            arrows: false,
            dots: true
        });
    </script>




<!-- Bootstrap js-->


<!-- feather icon js
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>-->

<!-- Sidebar jquery-->




<!-- Datatable js-->
<script src="{{asset('assets/js/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables/custom-basic.js')}}"></script>

<!--Customizer admin-->
<script src="{{asset('assets/js/admin-customizer.js')}}"></script>

<!-- lazyload js-->
<script src="{{asset('assets/js/lazysizes.min.js')}}"></script>

<!--right sidebar js-->
<script src="{{asset('assets/js/chat-menu.js')}}"></script>

<!--script admin-->
<script src="{{asset('assets/js/admin-script.js')}}"></script>

<!--chartist js-->
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>

<!--chartjs js-->
<script src="{{asset('assets/js/chart/chartjs/chart.min.js')}}"></script>
<!-- lazyload js-->
<script src="{{asset('assets/js/lazysizes.min.js')}}"></script>

<!--peity chart js-->
<script src="{{asset('assets/js/chart/peity-chart/peity.jquery.js')}}"></script>

<!--dashboard custom js-->
<!--<script src="{{asset('assets/js/dashboard/default.js')}}"></script>-->
<!--new-->

 <!-- jquery
		============================================ -->
   
    <!-- bootstrap JS
		============================================ -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- wow JS
		============================================ -->
    
    <!-- data table JS
		============================================ -->
    <script src="{{asset('assets/js/data-table/bootstrap-table.js')}}"></script>
    <script src="{{asset('assets/js/data-table/tableExport.js')}}?v={{ file_exists(public_path('assets/js/data-table/tableExport.js')) ? filemtime(public_path('assets/js/data-table/tableExport.js')) : '1.1' }}"></script>
    <script src="{{asset('assets/js/data-table/data-table-active.js')}}"></script>
    <script src="{{asset('assets/js/data-table/bootstrap-table-editable.js')}}"></script>
    <script src="{{asset('assets/js/data-table/bootstrap-editable.js')}}"></script>
    <script src="{{asset('assets/js/data-table/bootstrap-table-resizable.js')}}"></script>
    <script src="{{asset('assets/js/data-table/colResizable-1.5.source.js')}}"></script>
    <script src="{{asset('assets/js/data-table/bootstrap-table-export.js')}}"></script>
    <!--  editable JS
		============================================ -->

    <script>
        $(document).ready(function() {
            $(document).on('click', 'a[href*="logout"], a[href*="customer-logout"], a[href*="userlogout"]', function(e) {
                e.preventDefault();
                var logoutUrl = $(this).attr('href');
                
                function performLogoutConfirm() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to logout?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, logout!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = logoutUrl;
                        }
                    });
                }

                if (typeof Swal === 'undefined') {
                    $.getScript('https://cdn.jsdelivr.net/npm/sweetalert2@11', function() {
                        performLogoutConfirm();
                    });
                } else {
                    performLogoutConfirm();
                }
            });
        });
    </script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            // Inject global SweetAlert2 styling for size consistency
            const style = document.createElement('style');
            style.innerHTML = `
                .swal2-popup {
                    font-size: 1.6rem !important;
                }
            `;
            document.head.appendChild(style);

            // Override native alert
            window.alert = function(message) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Notification',
                        text: message,
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                } else {
                    console.log("Native Alert:", message);
                }
            };

            // Override native confirm
            const nativeConfirm = window.confirm;
            window.confirm = function(message) {
                const event = window.event;
                if (!event) {
                    return nativeConfirm(message);
                }

                const target = event.currentTarget || event.target || event.srcElement;
                if (target && target.dataset && target.dataset.swalConfirmed === 'true') {
                    delete target.dataset.swalConfirmed;
                    return true;
                }

                event.preventDefault();
                event.stopPropagation();
                if (event.stopImmediatePropagation) {
                    event.stopImmediatePropagation();
                }

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (target) {
                                target.dataset.swalConfirmed = 'true';
                                if (target.tagName === 'FORM') {
                                    target.submit();
                                } else {
                                    target.click();
                                }
                            }
                        }
                    });
                } else {
                    return nativeConfirm(message);
                }

                return false;
            };

            // Alias swal to Swal.fire for backward compatibility
        })();
    </script>
    <script>
        window.tableExportUrl = "{{ url('export-table-data') }}";

        $(document).on('click', '.btn-export-excel', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $card = $btn.closest('.card-body, .container-fluid, body');
            var $table = $card.find('table[data-toggle="table"]').length ? $card.find('table[data-toggle="table"]').first() : ($card.find('table').length ? $card.find('table').first() : $('table').first());
            
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
                '<!--[if gte mso 9]><xml><' + 'x:ExcelWorkbook><' + 'x:ExcelWorksheets><' + 'x:ExcelWorksheet><' + 'x:Name>Export</' + 'x:Name><' + 'x:WorksheetOptions><' + 'x:DisplayGridlines/></' + 'x:WorksheetOptions></' + 'x:ExcelWorksheet></' + 'x:ExcelWorksheets></' + 'x:ExcelWorkbook></xml><![endif]-->' +
                '<style>' +
                'table { border-collapse: collapse; width: 100%; font-family: Calibri, Arial, sans-serif; }' +
                'th, td { border: 0.5pt solid #cccccc; padding: 6px 10px; text-align: left; vertical-align: middle; }' +
                'th { background-color: #183543; color: #ffffff; font-weight: bold; }' +
                'tr:nth-child(even) { background-color: #f9f9f9; }' +
                '</style>' +
                '</head><body>' +
                tableHtml +
                '</body></html>';

            $.ajax({
                url: "{{ url('export-table-data') }}",
                type: 'POST',
                data: JSON.stringify({
                    filename: safeFilename,
                    content: excelDoc,
                    is_base64: false,
                    mime_type: 'application/vnd.ms-excel'
                }),
                contentType: 'application/json',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}'
                },
                timeout: 30000,
                success: function(res) {
                    $btn.prop('disabled', false).html(originalHtml);
                    if (res && res.download_url) {
                        window.location.href = res.download_url;
                    } else {
                        alert('Export failed. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    $btn.prop('disabled', false).html(originalHtml);
                    console.error('Export error:', error, xhr.responseText);
                    alert('Failed to generate export file. Please check connection and try again.');
                }
            });
        });
    </script>
    </body>

    </html>
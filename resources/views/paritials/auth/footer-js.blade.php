<!-- latest jquery-->
    

<!--  jquery validation-->
  

    


 
    <!-- Bootstrap js-->
    <!-- <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script> -->
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
    <script src="{{asset('assets/js/data-table/tableExport.js')}}"></script>
    <script src="{{asset('assets/js/data-table/data-table-active.js')}}"></script>
    <script src="{{asset('assets/js/data-table/bootstrap-table-editable.js')}}"></script>
    <script src="{{asset('assets/js/data-table/bootstrap-editable.js')}}"></script>
    <script src="{{asset('assets/js/data-table/bootstrap-table-resizable.js')}}"></script>
    <script src="{{asset('assets/js/data-table/colResizable-1.5.source.js')}}"></script>
    <script src="{{asset('assets/js/data-table/bootstrap-table-export.js')}}"></script>
    <!--  editable JS
		============================================ -->

    <script>
        // Stabilize profile dropdown (logout menu): click toggle instead of fragile hover-only behavior.
        $(document).ready(function() {
            if (!document.getElementById('stable-profile-dropdown-style')) {
                $('<style id="stable-profile-dropdown-style">\
                    .nav-menus > li.onhover-dropdown{padding-bottom:10px;margin-bottom:-10px;}\
                    .nav-menus > li.onhover-dropdown > .onhover-show-div{top:calc(100% + 2px)!important;}\
                    .nav-menus li.onhover-dropdown.manual-open > .onhover-show-div{opacity:1!important;visibility:visible!important;transform:translateY(0)!important;}\
                </style>').appendTo('head');
            }

            var $profileDrops = $('.nav-menus > li.onhover-dropdown').has('> ul.profile-dropdown');
            $profileDrops.each(function() {
                var $drop = $(this);
                var $toggle = $drop.children('.media').first();
                $toggle.css('cursor', 'pointer');

                $toggle.off('click.stableProfile').on('click.stableProfile', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $profileDrops.not($drop).removeClass('manual-open');
                    $drop.toggleClass('manual-open');
                });
            });

            $(document).off('click.stableProfileOutside').on('click.stableProfileOutside', function(e) {
                if ($(e.target).closest('.nav-menus > li.onhover-dropdown.manual-open').length === 0) {
                    $profileDrops.removeClass('manual-open');
                }
            });
        });
    </script>
    <script>
        // Global close-button behavior for non-modal pages.
        $(document).on('click', 'button[type="button"]', function(e) {
            var $btn = $(this);
            var label = $.trim($btn.text()).toLowerCase();
            if (label !== 'close') return;

            // Keep modal/tab/custom-close buttons on their own behavior.
            if (
                $btn.is('[data-bs-dismiss], [data-dismiss], [data-bs-toggle], [onclick], .close, .btn-close') ||
                $btn.attr('id') === 'upload-top-tab'
            ) {
                return;
            }

            var $modal = $btn.closest('.modal');
            if ($modal.length) {
                if (window.bootstrap && bootstrap.Modal) {
                    var modalInstance = bootstrap.Modal.getInstance($modal[0]) || new bootstrap.Modal($modal[0]);
                    modalInstance.hide();
                    return;
                }
                if (typeof $modal.modal === 'function') {
                    $modal.modal('hide');
                    return;
                }
            }

            e.preventDefault();
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        });
    </script>
    <script>
        // Prevent accidental multi-submit (double/triple clicks) on all forms.
        $(document).on('submit', 'form', function(e) {
            var $form = $(this);
            if (e.isDefaultPrevented()) return;

            if ($form.data('submitting') === true) {
                e.preventDefault();
                return false;
            }

            $form.data('submitting', true);
            var $submitButtons = $form.find('button[type="submit"], input[type="submit"]');
            $submitButtons.prop('disabled', true).addClass('disabled');

            // Safety fallback: unlock if page doesn't navigate (validation/ajax edge cases).
            setTimeout(function() {
                if ($form.closest('html').length) {
                    $form.data('submitting', false);
                    $submitButtons.prop('disabled', false).removeClass('disabled');
                }
            }, 15000);
        });
    </script>
    <script>
        // Adds clear (X) button to bootstrap-table search inputs across listing pages.
        (function() {
            function enhanceSearchInput($input) {
                if ($input.data('clear-ready')) return;
                $input.data('clear-ready', true);
                $input.attr('type', 'search');
                $input.css('padding-right', '2rem');

                var $parent = $input.parent();
                if (!$parent.hasClass('table-search-wrap')) {
                    $parent.addClass('table-search-wrap').css('position', 'relative');
                }

                var $clearBtn = $('<button type="button" class="table-search-clear-btn" aria-label="Clear search">&times;</button>');
                $clearBtn.css({
                    position: 'absolute',
                    right: '8px',
                    top: '50%',
                    transform: 'translateY(-50%)',
                    border: 'none',
                    background: 'transparent',
                    color: '#6c757d',
                    fontSize: '18px',
                    lineHeight: '1',
                    padding: '0',
                    display: 'none',
                    cursor: 'pointer',
                    zIndex: '5'
                });

                function toggleClear() {
                    $clearBtn.toggle(($input.val() || '').length > 0);
                }

                $input.on('input keyup change', toggleClear);
                $clearBtn.on('click', function() {
                    $input.val('');
                    $input.trigger('input').trigger('keyup').trigger('change').focus();
                    toggleClear();
                });

                $parent.append($clearBtn);
                toggleClear();
            }

            function attachClearButtons(scope) {
                $(scope).find('.fixed-table-toolbar .search input, .bootstrap-table .search input').each(function() {
                    enhanceSearchInput($(this));
                });
            }

            $(document).ready(function() {
                attachClearButtons(document);
                setTimeout(function() {
                    attachClearButtons(document);
                }, 300);

                if (window.MutationObserver) {
                    var observer = new MutationObserver(function(mutations) {
                        mutations.forEach(function(mutation) {
                            if (mutation.addedNodes && mutation.addedNodes.length) {
                                attachClearButtons(mutation.target);
                            }
                        });
                    });
                    observer.observe(document.body, {
                        childList: true,
                        subtree: true
                    });
                }
            });
        })();
    </script>
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
            if (typeof Swal !== 'undefined') {
                window.swal = Swal.fire;
            }
        })();
    </script>
    </body>

    </html>

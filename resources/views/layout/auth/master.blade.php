<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @php
        $isSellerPortal = request()->is('seller', 'seller/*', 'vendor', 'vendor/*');
        $isAdminPortal = request()->is('admin', 'admin/*');
        $isStaffPortal = request()->is('staff', 'staff/*');
        $portalUserStatus = auth()->check() ? (int) auth()->user()->status : (int) session()->get('status');
    @endphp
    @if($isSellerPortal || ($portalUserStatus === 2 && !$isAdminPortal && !$isStaffPortal))
    <link rel="icon" href="{{ asset('assets/images/favicon/sell_fevicon.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/sell_fevicon.png') }}" type="image/png">
    @else
    <link rel="icon" href="{{ asset('assets/images/favicon/admin_fevicon.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/admin_fevicon.png') }}" type="image/png">
    @endif
    <title>@yield('title', 'Trymenow')</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>


    <link rel="stylesheet" href="{{ asset('assets/js/Datepicker1/dist/mc-calendar.min.css') }}" />
    <script src="{{ asset('assets/js/Datepicker1/dist/mc-calendar.min.js') }}"></script>


    <link rel="stylesheet" href="{{ asset('assets/css/data-table/bootstrap-table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/data-table/bootstrap-editable.css') }}">
    <!-- style CSS
  ============================================ -->

    <!-- validation CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/validation/screen.css') }}">


    <!-- modernizr JS
  ============================================ -->

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">

    <!-- Prism css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">

    <!-- Chartist css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jsgrid.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/admin.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap1.css') }}">

    <style>
        /* Fix breadcrumb spacing globally */
        .page-header .breadcrumb {
            display: flex !important;
            align-items: center !important;
        }
        .page-header .breadcrumb .breadcrumb-item + .breadcrumb-item {
            padding-left: 2px !important;
            margin-left: 2px !important;
        }
        .page-header .breadcrumb .breadcrumb-item + .breadcrumb-item::before {
            padding-right: 6px !important;
            padding-left: 0 !important;
            margin: 0 !important;
        }
        .page-header .breadcrumb .breadcrumb-item a {
            display: inline-flex !important;
            align-items: center !important;
            padding: 0 !important;
            margin: 0 !important;
            text-decoration: none !important;
        }
        /* Make the feather home icon visible alongside Home text */
        .page-header .breadcrumb .breadcrumb-item:first-child a svg,
        .page-header .breadcrumb .breadcrumb-item:first-child a i {
            display: inline-block !important;
            width: 14px !important;
            height: 14px !important;
            vertical-align: middle !important;
            color: #555555 !important;
        }
        .page-header .breadcrumb .breadcrumb-item:first-child a::after {
            content: "Home";
            font-weight: 600;
            color: #555555;
            margin-left: 4px;
        }
        .page-header .breadcrumb-item {
            display: flex !important;
            align-items: center !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        /* Mobile-only floating bottom action bar */
        .mobile-bottom-action-bar {
            display: none;
        }
        @media (max-width: 767.98px) {
            .mobile-bottom-action-bar {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1050;
                background: rgba(33, 37, 41, 0.95);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                padding: 10px 16px;
                gap: 10px;
                justify-content: center;
                align-items: center;
                box-shadow: 0 -2px 12px rgba(0,0,0,0.25);
                border-top: 1px solid rgba(255,255,255,0.1);
            }
            .mobile-bottom-action-bar .btn {
                flex: 1;
                font-size: 14px;
                font-weight: 600;
                padding: 10px 12px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
            }
            /* Push page content up so it doesn't hide behind the bar */
            body.has-mobile-bottom-bar .page-body-wrapper {
                padding-bottom: 70px;
            }
        }

        /* Remove spinner arrows from number inputs */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important;
        }
        input[type=number] {
            -moz-appearance: textfield !important;
        }
    </style>

    @include('paritials.auth.header-css')


</head>

<body>

    @yield('contents')

    @php
        $isUserLoggedIn = auth()->check() || session()->has('login_id') || session()->has('userId');
        $isAuthPage = request()->is('login', '*/login', 'register', '*/register', 'forgot*', '*/forgot*', 'reset*', '*/reset*', 'portal-selection', '*/portal-selection');
        $portalUserStatus = auth()->check() ? (int) auth()->user()->status : (int) session()->get('status');
        $isAdminPath = request()->is('admin', 'admin/*');
        $isStaffPath = request()->is('staff', 'staff/*');
        $isSellerPath = request()->is('seller', 'seller/*', 'vendor', 'vendor/*');
    @endphp

    @if($isUserLoggedIn && !$isAuthPage)
        {{-- Priority 1: Exact URL prefix matching (Admin & Staff MUST take precedence over substring matches) --}}
        @if($isAdminPath || $isStaffPath)
            @include('paritials.auth.mobile-footer')
        @elseif($isSellerPath)
            @include('paritials.vendorauth.mobile-footer')
        {{-- Priority 2: User role fallback if route prefix is neutral --}}
        @elseif($portalUserStatus === 1 || $portalUserStatus === 3)
            @include('paritials.auth.mobile-footer')
        @elseif($portalUserStatus === 2)
            @include('paritials.vendorauth.mobile-footer')
        @endif
    @endif
@include('paritials.auth.footer-js')
@include('paritials.auth.js')

{{-- CKEditor 4 - Global --}}
<style>.cke_notifications_area, .cke_notification, .cke_notification_warning, .cke_notification_inner, .cke_notification_message, [class*="cke_notification"] { display: none !important; }</style>
<script>window.CKEDITOR_BASEPATH = 'https://cdn.ckeditor.com/4.22.1/full/';</script>
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.config.versionCheck = false;
    }
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof CKEDITOR !== 'undefined') {
            // Auto-init all textareas with class 'ckeditor'
            var els = document.querySelectorAll('textarea.ckeditor');
            for (var i = 0; i < els.length; i++) {
                var id = els[i].id || els[i].name;
                if (id && !CKEDITOR.instances[id]) {
                    CKEDITOR.replace(id, {
                        height: 300,
                        allowedContent: true,
                        removePlugins: 'elementspath'
                    });
                }
            }
        }
    });
</script>

@stack('scripts')

<!-- Global Bootstrap Table State Persistence (Same menu only) -->
<script>
    var isNavigatingAway = false;

    // Detect when user clicks ANY navigation link leading to a DIFFERENT menu/page
    $(document).on('click', 'a[href]', function() {
        var href = this.getAttribute('href');
        if (href && href !== '#' && !href.startsWith('javascript:')) {
            try {
                var targetPath = this.pathname || new URL(this.href, window.location.origin).pathname;
                if (targetPath && targetPath !== window.location.pathname) {
                    isNavigatingAway = true;
                    sessionStorage.removeItem('globalTableSearch_' + window.location.pathname);
                    sessionStorage.removeItem('globalTablePage_' + window.location.pathname);
                }
            } catch (e) {}
        }
    });

    // Save table state on reload / form submit / update / delete within the SAME page
    window.addEventListener('beforeunload', function() {
        if (isNavigatingAway) {
            return; // Do not save state when moving to another menu
        }
        var $table = $('#table');
        if ($table.length && typeof $table.bootstrapTable === 'function') {
            try {
                var options = $table.bootstrapTable('getOptions');
                if (options) {
                    var searchText = options.searchText || $('.fixed-table-toolbar .search input').val() || '';
                    var currentPage = options.pageNumber || 1;
                    var path = window.location.pathname;
                    
                    if (searchText) {
                        sessionStorage.setItem('globalTableSearch_' + path, searchText);
                    } else {
                        sessionStorage.removeItem('globalTableSearch_' + path);
                    }
                    sessionStorage.setItem('globalTablePage_' + path, currentPage);
                }
            } catch (e) {}
        }
    });

    // Restore table state on page load ONLY IF reloaded on the same page
    $(document).ready(function() {
        var currentPath = window.location.pathname;
        var lastPath = sessionStorage.getItem('globalTableLastPath');

        // If arriving from a different menu/page, clear saved search so it starts clean
        if (lastPath && lastPath !== currentPath) {
            sessionStorage.removeItem('globalTableSearch_' + currentPath);
            sessionStorage.removeItem('globalTablePage_' + currentPath);
        }
        sessionStorage.setItem('globalTableLastPath', currentPath);

        var savedSearch = sessionStorage.getItem('globalTableSearch_' + currentPath);
        var savedPage = sessionStorage.getItem('globalTablePage_' + currentPath);
        
        if (savedSearch || savedPage) {
            setTimeout(function() {
                var $table = $('#table');
                if ($table.length && typeof $table.bootstrapTable === 'function') {
                    if (savedSearch) {
                        var $searchInp = $('.fixed-table-toolbar .search input');
                        $searchInp.val(savedSearch);
                        $table.bootstrapTable('resetSearch', savedSearch);
                        $searchInp.trigger('input').trigger('change').trigger('update-clear');
                        $searchInp.parent().find('.table-search-clear-btn').show();
                    }
                    if (savedPage) {
                        var pageNum = parseInt(savedPage, 10);
                        if (pageNum > 1) {
                            $table.bootstrapTable('selectPage', pageNum);
                        }
                    }
                }
                // Clear after restoration so it only survives one reload/edit
                sessionStorage.removeItem('globalTableSearch_' + currentPath);
                sessionStorage.removeItem('globalTablePage_' + currentPath);
            }, 400);
        }
    });
    
    // Global handler to disallow negative numbers, minus sign, and 'e' in number inputs
    $(document).on('keydown', 'input[type="number"]', function(e) {
        if (e.key === '-' || e.key === 'e' || e.key === 'E' || e.key === '+') {
            e.preventDefault();
        }
    });
    $(document).on('input paste', 'input[type="number"]', function() {
        var el = this;
        setTimeout(function() {
            if (el.value && parseFloat(el.value) < 0) {
                el.value = Math.abs(el.value);
            }
        }, 1);
    });
</script>

</body>

</html>

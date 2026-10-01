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
    @if(session('status') == 2)
    <link rel="icon" href="{{ asset('assets/images/dashboard/logo/4.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/dashboard/logo/4.png') }}" type="image/x-icon">
    @else
    <link rel="icon" href="{{ asset('assets/images/dashboard/logo/fav.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/dashboard/logo/fav.png') }}" type="image/x-icon">
    @endif
    <title>Trymenow</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>


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
            display: flex;
            align-items: center;
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
            display: flex;
            align-items: center;
            padding: 0 !important;
            margin: 0 !important;
        }
        /* Hide the feather home icon and use text 'Home' instead */
        .page-header .breadcrumb .breadcrumb-item:first-child a svg {
            display: none !important;
        }
        .page-header .breadcrumb .breadcrumb-item:first-child a::before {
            content: "Home";
            font-weight: 600;
            color: #555555;
        }
        .page-header .breadcrumb-item {
            display: flex;
            align-items: center;
            padding: 0;
            margin: 0;
        }
    </style>

    @include('paritials.auth.header-css')


</head>

<body>

    @yield('contents')




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

<!-- Global Bootstrap Table State Persistence -->
<script>
    // Save table state before leaving the page or reloading
    window.addEventListener('beforeunload', function() {
        var $table = $('#table');
        if ($table.length && typeof $table.bootstrapTable === 'function') {
            try {
                var options = $table.bootstrapTable('getOptions');
                if (options) {
                    var searchText = options.searchText || $('.fixed-table-toolbar .search input').val() || '';
                    var currentPage = options.pageNumber || 1;
                    var path = window.location.pathname;
                    
                    sessionStorage.setItem('globalTableSearch_' + path, searchText);
                    sessionStorage.setItem('globalTablePage_' + path, currentPage);
                }
            } catch (e) {
                // Ignore if table isn't fully initialized
            }
        }
    });

    // Restore table state on page load
    $(document).ready(function() {
        var path = window.location.pathname;
        var savedSearch = sessionStorage.getItem('globalTableSearch_' + path);
        var savedPage = sessionStorage.getItem('globalTablePage_' + path);
        
        if (savedSearch || savedPage) {
            setTimeout(function() {
                var $table = $('#table');
                if ($table.length && typeof $table.bootstrapTable === 'function') {
                    if (savedSearch) {
                        $('.fixed-table-toolbar .search input').val(savedSearch);
                        $table.bootstrapTable('resetSearch', savedSearch);
                    }
                    if (savedPage) {
                        var pageNum = parseInt(savedPage, 10);
                        if (pageNum > 1) {
                            $table.bootstrapTable('selectPage', pageNum);
                        }
                    }
                }
                // Clear so it doesn't artificially persist longer than one navigation/reload
                sessionStorage.removeItem('globalTableSearch_' + path);
                sessionStorage.removeItem('globalTablePage_' + path);
            }, 500);
        }
    });
    
</script>

</body>

</html>

<style>
    /* ── Sidebar Toggle Button Fix ── */
    .mobile-sidebar .switch-sm .switch {
        width: auto !important;
        height: auto !important;
        overflow: visible !important;
    }

    .mobile-sidebar .sidebar-toggle-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 50px;
        min-height: 50px;
        padding: 5px;
        cursor: pointer;
        z-index: 9999 !important;
        position: relative;
        touch-action: manipulation;
        -webkit-tap-highlight-color: transparent;
        user-select: none;
        -webkit-user-select: none;
    }

    .mobile-sidebar .sidebar-toggle-btn svg,
    .mobile-sidebar .sidebar-toggle-btn i {
        width: 22px;
        height: 22px;
        pointer-events: none;
    }

    a:focus, button:focus, .btn:focus, .sidebar-header:focus, .profile-dropdown a:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    
    .pull-right {
        float: right !important;
    }
    
    @media only screen and (max-width: 767px) {
        .page-wrapper .page-body-wrapper .page-header .row .col {
            display: block;
            width: 100%;
        }
        .page-wrapper .page-body-wrapper .page-header .breadcrumb.pull-right {
            float: left !important;
            margin-top: 10px;
            display: flex;
            justify-content: flex-start;
        }
    }

    /* Mobile sidebar: page body always full width (JS handles sidebar positioning via inline styles) */
    @media only screen and (max-width: 991px) {
        .page-wrapper .page-body-wrapper .page-sidebar ~ .page-body,
        .page-wrapper .page-body-wrapper .page-sidebar.open ~ .page-body {
            margin-left: 0 !important;
        }
    }

    /* Modal Spacing and Padding for Mobile */
    @media (max-width: 575.98px) {
        .modal-dialog {
            margin: 0.5rem 15px !important;
        }
        .modal-body {
            padding: 20px 20px !important;
        }
    }

    /* Fix Horizontal Overflow/Left-Right Scroll on Mobile */
    html, body, .page-wrapper, .page-body-wrapper {
        overflow-x: hidden !important;
    }

    /* Bootstrap Table Mobile Toolbar & Pagination Fix */
    @media (max-width: 575.98px) {
        .fixed-table-toolbar .search {
            width: 100% !important;
            float: none !important;
            padding-left: 0 !important;
            margin-bottom: 10px !important;
        }
        .fixed-table-toolbar .columns {
            width: 100% !important;
            float: none !important;
            display: flex !important;
            justify-content: flex-start !important;
            margin-top: 5px !important;
            margin-bottom: 10px !important;
        }
    }

    /* ── Bootstrap Table Pagination Alignment: Rows per page (Left), < 1 2 3 > (Centre), Showing info (Right) ── */
    .fixed-table-pagination {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        flex-wrap: nowrap !important;
        width: 100% !important;
        margin-top: 15px !important;
        margin-bottom: 15px !important;
        position: relative !important;
        clear: both !important;
    }
    .fixed-table-pagination:before,
    .fixed-table-pagination:after {
        display: none !important;
    }
    .fixed-table-pagination .pull-left,
    .fixed-table-pagination .pull-right {
        float: none !important;
    }
    .fixed-table-pagination .pagination-detail {
        display: contents !important;
    }
    .fixed-table-pagination .page-list {
        order: 1 !important;
        flex: 1 1 0% !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        text-align: left !important;
        margin: 0 !important;
        white-space: nowrap !important;
    }
    .fixed-table-pagination .page-list .btn-group {
        position: relative;
        display: inline-block;
        vertical-align: middle;
        margin-right: 8px !important;
    }
    .fixed-table-pagination div.pagination {
        order: 2 !important;
        flex: 0 0 auto !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        margin: 0 auto !important;
        float: none !important;
    }
    .fixed-table-pagination div.pagination .pagination {
        margin: 0 !important;
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    .fixed-table-pagination .pagination-info {
        order: 3 !important;
        flex: 1 1 0% !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        text-align: right !important;
        margin: 0 !important;
        white-space: nowrap !important;
        line-height: normal !important;
    }
    @media (max-width: 767.98px) {
        .fixed-table-pagination {
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 10px !important;
        }
        .fixed-table-pagination .page-list,
        .fixed-table-pagination div.pagination,
        .fixed-table-pagination .pagination-info {
            flex: 0 0 auto !important;
            width: 100% !important;
            justify-content: center !important;
            text-align: center !important;
        }
    }

    /* Toolbar flex ordering: Search input -> Column filter toggle (joined edges) -> Action buttons (Export & Add with gap) */
    .fixed-table-toolbar {
        display: flex !important;
        align-items: center !important;
    }
    .fixed-table-toolbar .search {
        order: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
    }
    .fixed-table-toolbar .search .form-control {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    .fixed-table-toolbar .columns {
        order: 1 !important;
        margin-left: 0 !important;
        margin-right: 15px !important;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
    }
    .fixed-table-toolbar .columns > .btn,
    .fixed-table-toolbar .columns > .btn-group > .btn,
    .fixed-table-toolbar .columns button {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
        border-left: 0 !important;
    }
    .fixed-table-toolbar .bs-bars {
        order: 2 !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
    }

    /* Remove dotted column resizer drag guide border */
    .JCLRgripDrag {
        border-left: none !important;
    }

    /* ── SweetAlert2 Modal Sizing & Styling Overrides ── */
    .swal2-popup {
        font-size: 1.6rem !important;
        width: 500px !important;
        max-width: 90% !important;
    }

    /* ── Table Toolbar Buttons Always Visible ── */
    .fixed-table-toolbar .columns > .btn,
    .fixed-table-toolbar .columns > .btn-group > .btn,
    .fixed-table-toolbar .columns button[name="refresh"],
    .fixed-table-toolbar .columns button[name="toggle"],
    .fixed-table-toolbar .columns button[name="paginationSwitch"],
    .fixed-table-toolbar .columns .keep-open > button {
        display: inline-block !important;
        opacity: 1 !important;
        visibility: visible !important;
        background-color: #fff !important;
        border: 1px solid #ccc !important;
        color: #333 !important;
    }
    .fixed-table-toolbar .columns > .btn:hover,
    .fixed-table-toolbar .columns > .btn-group > .btn:hover,
    .fixed-table-toolbar .columns button[name="refresh"]:hover,
    .fixed-table-toolbar .columns button[name="toggle"]:hover,
    .fixed-table-toolbar .columns .keep-open > button:hover {
        background-color: #e6e6e6 !important;
        border-color: #adadad !important;
    }
    /* Ensure glyphicon icons inside toolbar buttons are visible */
    .fixed-table-toolbar .columns .glyphicon,
    .fixed-table-toolbar .columns .icon-refresh {
        color: #333 !important;
    }

    /* Make form-select match form-control size and height */
    .form-select {
        padding: .5rem 2.25rem .5rem .75rem !important;
        font-size: 1.5rem !important;
        line-height: 1.5 !important;
        height: auto !important;
    }
</style>


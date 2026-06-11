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
        .fixed-table-pagination .pagination-detail {
            display: block !important;
            margin-bottom: 10px !important;
            float: none !important;
            text-align: center !important;
        }
        .fixed-table-pagination div.pagination {
            display: block !important;
            float: none !important;
            text-align: center !important;
        }
        .fixed-table-pagination div.pagination .pagination {
            justify-content: center !important;
        }
    }

    /* Remove dotted column resizer drag guide border */
    .JCLRgripDrag {
        border-left: none !important;
    }
</style>

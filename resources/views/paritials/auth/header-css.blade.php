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

    /* ── Bootstrap Table Mobile Toolbar Fix: Search and Filter button on Row 1, Action buttons on Row 2 ── */
    @media (max-width: 767.98px) {
        .fixed-table-toolbar {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            justify-content: flex-start !important;
            margin-bottom: 10px !important;
            width: 100% !important;
        }
        .fixed-table-toolbar .search {
            order: 1 !important;
            flex: 1 1 auto !important;
            min-width: 0 !important;
            width: auto !important;
            margin: 4px 0 !important;
            padding: 0 !important;
            float: none !important;
        }
        .fixed-table-toolbar .search .form-control,
        .fixed-table-toolbar .search input {
            width: 100% !important;
            height: 38px !important;
            min-height: 38px !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            font-size: 13px !important;
            padding: 6px 10px !important;
            box-sizing: border-box !important;
        }
        .fixed-table-toolbar .columns {
            order: 2 !important;
            flex: 0 0 auto !important;
            width: auto !important;
            margin: 4px 0 !important;
            margin-right: 0 !important;
            float: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
        }
        .fixed-table-toolbar .columns > .btn,
        .fixed-table-toolbar .columns > .btn-group > .btn,
        .fixed-table-toolbar .columns button {
            height: 38px !important;
            min-height: 38px !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-left: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 6px 12px !important;
            margin: 0 !important;
            background-color: #fff !important;
            color: #333 !important;
            border-color: #ced4da !important;
        }
        .fixed-table-toolbar .bs-bars {
            order: 3 !important;
            flex: 0 0 100% !important;
            width: 100% !important;
            margin: 10px 0 8px 0 !important;
            float: none !important;
        }
        .fixed-table-toolbar .bs-bars #toolbar,
        .fixed-table-toolbar .bs-bars > div {
            display: flex !important;
            flex-wrap: nowrap !important;
            align-items: center !important;
            gap: 8px !important;
            width: 100% !important;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
            box-sizing: border-box !important;
        }
        .fixed-table-toolbar .bs-bars #toolbar::-webkit-scrollbar,
        .fixed-table-toolbar .bs-bars > div::-webkit-scrollbar {
            display: none !important;
        }
        .fixed-table-toolbar .bs-bars .btn,
        .fixed-table-toolbar .bs-bars a.btn,
        .fixed-table-toolbar .bs-bars a > .btn,
        .fixed-table-toolbar .bs-bars button {
            height: 38px !important;
            min-height: 38px !important;
            font-size: 11.5px !important;
            font-weight: 600 !important;
            padding: 6px 8px !important;
            white-space: nowrap !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            margin-right: 0 !important;
            margin-left: 0 !important;
            flex: 1 1 0 !important;
            min-width: 0 !important;
            line-height: 1.2 !important;
            box-sizing: border-box !important;
            border-radius: 6px !important;
            text-align: center !important;
        }
        .fixed-table-toolbar .bs-bars a {
            display: inline-flex !important;
            flex: 1 1 0 !important;
            min-width: 0 !important;
            margin: 0 !important;
            text-decoration: none !important;
        }
        .fixed-table-toolbar .bs-bars .btn.border,
        .fixed-table-toolbar .bs-bars button.border {
            background-color: #ffffff !important;
        }
        .fixed-table-toolbar .bs-bars .accept:hover,
        .fixed-table-toolbar .bs-bars .delivered:hover {
            background-color: #e8f5e9 !important;
        }
        .fixed-table-toolbar .bs-bars .dispatch:hover {
            background-color: #e7f1ff !important;
        }
        .fixed-table-toolbar .bs-bars .cancelbulk:hover,
        .fixed-table-toolbar .bs-bars .cancelbulkdispatch:hover {
            background-color: #ffebee !important;
        }
        .fixed-table-toolbar .bs-bars .btn-export-excel:hover {
            background-color: #218838 !important;
            border-color: #1e7e34 !important;
        }
        .fixed-table-toolbar .bs-bars .btn-import-auction-desktop,
        .fixed-table-toolbar .bs-bars button.btn-import-auction-desktop {
            display: none !important;
        }

        /* ── Custom Toolbar Row Fix (Activity Tracker, Cities, States, etc.) ── */
        .toolbar-row {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 10px !important;
            width: 100% !important;
            padding: 4px 0 !important;
        }
        .toolbar-row .search-box {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            width: 100% !important;
        }
        .toolbar-row .search-box .form-control {
            height: 38px !important;
            min-height: 38px !important;
            font-size: 13px !important;
            padding: 6px 10px !important;
        }
        .toolbar-row .search-box .input-group-text {
            height: 38px !important;
            min-height: 38px !important;
            font-size: 13px !important;
            padding: 6px 12px !important;
        }
        .toolbar-row > div:last-child {
            width: 100% !important;
            margin-left: 0 !important;
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
            align-items: center !important;
            justify-content: flex-start !important;
        }
        .toolbar-row .btn {
            height: 38px !important;
            min-height: 38px !important;
            font-size: 12px !important;
            padding: 6px 12px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
        }
        .toolbar-row a {
            display: inline-flex !important;
            text-decoration: none !important;
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
        padding: 0 !important;
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
        list-style: none !important;
        gap: 4px !important;
    }
    .fixed-table-pagination div.pagination .pagination > li {
        display: inline-block !important;
        margin: 0 !important;
    }
    .fixed-table-pagination .pagination a,
    .fixed-table-pagination div.pagination .pagination > li > a {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 32px !important;
        height: 32px !important;
        padding: 0 10px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        line-height: 1 !important;
        color: #495057 !important;
        background-color: #ffffff !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 6px !important;
        text-decoration: none !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
        transition: all 0.15s ease-in-out !important;
        user-select: none !important;
    }
    .fixed-table-pagination div.pagination .pagination > li:not(.active):not(.disabled) > a:hover {
        background-color: #f1f3f5 !important;
        border-color: #ced4da !important;
        color: #183543 !important;
    }
    /* ── Selected / Active Page Highlight ── */
    .fixed-table-pagination div.pagination .pagination > li.active > a,
    .fixed-table-pagination div.pagination .pagination > li.page-number.active > a,
    .fixed-table-pagination div.pagination .pagination > li.active > a:hover,
    .fixed-table-pagination div.pagination .pagination > li.active > a:focus {
        background-color: #183543 !important;
        border-color: #183543 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        cursor: default !important;
        box-shadow: 0 2px 6px rgba(24, 53, 67, 0.35) !important;
    }
    /* ── Disabled Buttons (< and > at bounds, ellipsis separators) ── */
    .fixed-table-pagination div.pagination .pagination > li.disabled > a,
    .fixed-table-pagination div.pagination .pagination > li.page-first-separator > a,
    .fixed-table-pagination div.pagination .pagination > li.page-last-separator > a {
        color: #adb5bd !important;
        background-color: #f8f9fa !important;
        border-color: #e9ecef !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
        box-shadow: none !important;
        opacity: 0.65 !important;
    }
    /* ── Dark Mode Support ── */
    body.dark .fixed-table-pagination div.pagination .pagination > li > a {
        background-color: #232b3e !important;
        border-color: #323c52 !important;
        color: #e0e6ed !important;
    }
    body.dark .fixed-table-pagination div.pagination .pagination > li:not(.active):not(.disabled) > a:hover {
        background-color: #2f3a53 !important;
        border-color: #424e6b !important;
        color: #ffffff !important;
    }
    body.dark .fixed-table-pagination div.pagination .pagination > li.active > a,
    body.dark .fixed-table-pagination div.pagination .pagination > li.page-number.active > a {
        background-color: #183543 !important;
        border-color: #00baf2 !important;
        color: #ffffff !important;
        box-shadow: 0 0 8px rgba(0, 186, 242, 0.45) !important;
    }
    body.dark .fixed-table-pagination div.pagination .pagination > li.disabled > a,
    body.dark .fixed-table-pagination div.pagination .pagination > li.page-first-separator > a,
    body.dark .fixed-table-pagination div.pagination .pagination > li.page-last-separator > a {
        background-color: #1e2533 !important;
        border-color: #2a3346 !important;
        color: #616e85 !important;
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
    @media (min-width: 768px) {
        .fixed-table-toolbar {
            display: flex !important;
            align-items: center !important;
            flex-wrap: nowrap !important;
        }
        .fixed-table-toolbar .search {
            order: 1 !important;
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
            order: 2 !important;
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
            order: 3 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }
        .fixed-table-toolbar .bs-bars > div {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        .fixed-table-toolbar .bs-bars .btn,
        .fixed-table-toolbar .bs-bars a.btn,
        .fixed-table-toolbar .bs-bars a > .btn,
        .fixed-table-toolbar .bs-bars button {
            flex: 0 0 auto !important;
            width: auto !important;
            padding: 6px 14px !important;
        }
        .fixed-table-toolbar .bs-bars a {
            flex: 0 0 auto !important;
            width: auto !important;
        }
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

    /* ── jQuery DataTables Pagination Selected Page Highlight ── */
    div.dataTables_wrapper div.dataTables_paginate {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        gap: 4px !important;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination > li > a,
    div.dataTables_wrapper div.dataTables_paginate ul.pagination > li.paginate_button > a,
    div.dataTables_wrapper div.dataTables_paginate .paginate_button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 32px !important;
        height: 32px !important;
        padding: 0 10px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        line-height: 1 !important;
        color: #495057 !important;
        background: #ffffff !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 6px !important;
        text-decoration: none !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
        transition: all 0.15s ease-in-out !important;
        user-select: none !important;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination > li:not(.active):not(.disabled) > a:hover,
    div.dataTables_wrapper div.dataTables_paginate .paginate_button:not(.current):not(.disabled):hover {
        background: #f1f3f5 !important;
        border-color: #ced4da !important;
        color: #183543 !important;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination > li.active > a,
    div.dataTables_wrapper div.dataTables_paginate ul.pagination > li.active > a:hover,
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.current,
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.current:hover {
        background: #183543 !important;
        border-color: #183543 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        cursor: default !important;
        box-shadow: 0 2px 6px rgba(24, 53, 67, 0.35) !important;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination > li.disabled > a,
    div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled {
        color: #adb5bd !important;
        background: #f8f9fa !important;
        border-color: #e9ecef !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
        box-shadow: none !important;
        opacity: 0.65 !important;
    }

    /* ── Mobile Form Wizard Tabs & Action Buttons (Admin, Staff, Vendor) ── */
    @media (max-width: 767.98px) {
        /* Segmented 2-Column Tabs on Mobile (Staff & Form Wizards) */
        .tab2-card ul#top-tab,
        .tab2-card ul.nav-material,
        ul#top-tab.nav-material {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 8px !important;
            width: 100% !important;
            padding: 6px !important;
            padding-bottom: 6px !important;
            margin-bottom: 18px !important;
            background-color: #f1f5f9 !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 12px !important;
            box-sizing: border-box !important;
        }
        .tab2-card ul#top-tab::before,
        .tab2-card ul#top-tab::after,
        ul#top-tab.nav-material::before,
        ul#top-tab.nav-material::after {
            display: none !important;
        }
        .tab2-card ul#top-tab li.nav-item,
        .tab2-card ul.nav-material li.nav-item,
        ul#top-tab.nav-material li.nav-item {
            display: flex !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .tab2-card ul#top-tab li.nav-item a.nav-link,
        .tab2-card ul.nav-material li.nav-item a.nav-link,
        ul#top-tab.nav-material li.nav-item a.nav-link {
            width: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            padding: 9px 6px !important;
            font-size: 11.5px !important;
            font-weight: 600 !important;
            line-height: 1.25 !important;
            border-radius: 9px !important;
            border: 1px solid transparent !important;
            border-bottom: 1px solid transparent !important;
            background-color: transparent !important;
            color: #475569 !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-sizing: border-box !important;
            white-space: normal !important;
            word-break: break-word !important;
            text-decoration: none !important;
        }
        .tab2-card ul#top-tab li.nav-item a.nav-link::before,
        .tab2-card ul#top-tab li.nav-item a.nav-link::after,
        ul#top-tab.nav-material li.nav-item a.nav-link::before,
        ul#top-tab.nav-material li.nav-item a.nav-link::after {
            display: none !important;
        }
        .tab2-card ul#top-tab li.nav-item a.nav-link svg,
        .tab2-card ul#top-tab li.nav-item a.nav-link i,
        ul#top-tab.nav-material li.nav-item a.nav-link svg,
        ul#top-tab.nav-material li.nav-item a.nav-link i {
            margin: 0 0 4px 0 !important;
            width: 16px !important;
            height: 16px !important;
            font-size: 15px !important;
            display: inline-block !important;
        }
        .tab2-card ul#top-tab li.nav-item a.nav-link span,
        ul#top-tab.nav-material li.nav-item a.nav-link span {
            display: inline-block !important;
            text-align: center !important;
        }
        .tab2-card ul#top-tab li.nav-item a.nav-link.active,
        .tab2-card ul.nav-material li.nav-item a.nav-link.active,
        ul#top-tab.nav-material li.nav-item a.nav-link.active {
            color: #ff4c3b !important;
            background-color: #ffffff !important;
            border-color: rgba(255, 76, 59, 0.25) !important;
            border-bottom-color: rgba(255, 76, 59, 0.25) !important;
            box-shadow: 0 2px 8px rgba(255, 76, 59, 0.14), 0 1px 3px rgba(0, 0, 0, 0.05) !important;
            font-weight: 700 !important;
        }

        /* ── Mobile Wizard & Action Buttons (Previous, Next, Save, Close) ── */
        #staff-wizard-controls,
        #final-wizard-controls,
        .staff-final-actions,
        #vendor-wizard-controls,
        .vendor-final-actions,
        .tab2-card .modal-footer {
            width: 100% !important;
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            gap: 8px !important;
            margin-top: 24px !important;
            margin-bottom: 10px !important;
            padding: 0 !important;
            justify-content: stretch !important;
            align-items: center !important;
            border-top: none !important;
            box-sizing: border-box !important;
        }
        #staff-wizard-controls.d-none,
        #final-wizard-controls.d-none,
        .staff-final-actions.d-none,
        #vendor-wizard-controls.d-none,
        .vendor-final-actions.d-none {
            display: none !important;
        }
        #staff-wizard-controls .btn,
        #final-wizard-controls .btn,
        .staff-final-actions .btn,
        #vendor-wizard-controls .btn,
        .vendor-final-actions .btn,
        .tab2-card .modal-footer .btn {
            flex: 1 1 0 !important;
            width: 100% !important;
            min-width: 0 !important;
            height: 42px !important;
            min-height: 42px !important;
            max-height: 42px !important;
            padding: 0 8px !important;
            font-size: 13.5px !important;
            font-weight: 600 !important;
            line-height: 40px !important;
            border-radius: 8px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            margin: 0 !important;
            box-sizing: border-box !important;
            white-space: nowrap !important;
        }
    }
</style>


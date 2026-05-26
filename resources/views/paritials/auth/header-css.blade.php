<style>
    /* ── Sidebar Toggle Button Fix ──
       The .switch class is designed for CSS toggle switches (25×16px).
       We must override it when used as a sidebar toggle icon button
       to make the click/touch area large enough (44×44px per mobile guidelines). */
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
        z-index: 9999 !important; /* Ensure it stays above any overlays */
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
        pointer-events: none;  /* Clicks pass through to the <a> parent */
    }

    /* Remove blue focus outlines globally from links and buttons */
    a:focus, button:focus, .btn:focus, .sidebar-header:focus, .profile-dropdown a:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    
    .pull-right {
        float: right !important;
    }
    
    /* Ensure breadcrumb is visible and aligned in mobile view */
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

    /* ── Mobile/App Sidebar Overlay Approach ──
       Uses transform:translateX + overlay backdrop for reliable WebView/app sidebar.
       This overrides the default margin-left approach which fails in some Android WebViews. */
    @media only screen and (max-width: 991px) {
        /* Overlay backdrop when sidebar is open */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Override sidebar to use transform instead of margin */
        .page-wrapper .page-body-wrapper .page-sidebar {
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            width: 260px !important;
            height: 100vh !important;
            z-index: 100 !important;
            transform: translateX(-100%);
            -webkit-transform: translateX(-100%);
            transition: transform 0.3s ease !important;
            -webkit-transition: -webkit-transform 0.3s ease !important;
            margin-left: 0 !important;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch;
        }

        /* When sidebar is visible (no .open class = visible) */
        .page-wrapper .page-body-wrapper .page-sidebar:not(.open) {
            transform: translateX(0) !important;
            -webkit-transform: translateX(0) !important;
        }

        /* When sidebar is hidden (.open class = hidden) */
        .page-wrapper .page-body-wrapper .page-sidebar.open {
            transform: translateX(-100%) !important;
            -webkit-transform: translateX(-100%) !important;
            margin-left: 0 !important;
        }

        /* Page body always full width on mobile */
        .page-wrapper .page-body-wrapper .page-sidebar ~ .page-body {
            margin-left: 0 !important;
        }

        .page-wrapper .page-body-wrapper .page-sidebar.open ~ .page-body {
            margin-left: 0 !important;
        }
    }
</style>

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

    /* ── Mobile/App Sidebar Fix ──
       On mobile/WebView, the default margin-left toggle fails.
       We override with left positioning + overlay backdrop.
       Using very high z-index to break out of any stacking context. */
    @media only screen and (max-width: 991px) {
        /* Overlay backdrop */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99990 !important;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Force sidebar to use left positioning instead of margin-left */
        .page-sidebar,
        .page-wrapper .page-body-wrapper .page-sidebar {
            position: fixed !important;
            top: 0 !important;
            left: -270px !important;
            width: 260px !important;
            height: 100vh !important;
            z-index: 99999 !important;
            margin-left: 0 !important;
            transition: left 0.3s ease !important;
            -webkit-transition: left 0.3s ease !important;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch;
        }

        /* When sidebar is VISIBLE (no .open class) */
        .page-sidebar:not(.open),
        .page-wrapper .page-body-wrapper .page-sidebar:not(.open) {
            left: 0 !important;
            margin-left: 0 !important;
        }

        /* When sidebar is HIDDEN (.open class) */
        .page-sidebar.open,
        .page-wrapper .page-body-wrapper .page-sidebar.open {
            left: -270px !important;
            margin-left: 0 !important;
        }

        /* Page body always full width on mobile */
        .page-sidebar ~ .page-body,
        .page-sidebar.open ~ .page-body,
        .page-wrapper .page-body-wrapper .page-sidebar ~ .page-body,
        .page-wrapper .page-body-wrapper .page-sidebar.open ~ .page-body {
            margin-left: 0 !important;
        }
    }
</style>

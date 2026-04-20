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
</style>

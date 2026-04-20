<style>
    /* Keep mobile sidebar toggle visible/clickable */
    .mobile-sidebar .switch a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .mobile-sidebar #sidebar-toggle, .mobile-toggle {
        cursor: pointer;
        z-index: 999;
        position: relative;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        min-width: 44px; /* standard mobile touch target */
        min-height: 44px;
        pointer-events: auto !important;
    }

    /* Remove blue focus outlines globally from links and buttons */
    a:focus, button:focus, .btn:focus, .sidebar-header:focus, .profile-dropdown a:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    
</style>

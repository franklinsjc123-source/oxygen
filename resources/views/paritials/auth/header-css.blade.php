<style>
    /* Keep mobile sidebar toggle visible/clickable */
    .mobile-sidebar .switch a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        min-height: 32px;
    }

    .mobile-sidebar #sidebar-toggle {
        cursor: pointer;
        z-index: 12;
        position: relative;
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

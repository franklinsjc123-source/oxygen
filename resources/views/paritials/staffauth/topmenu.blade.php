<div class="page-wrapper">

    <!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-right row p-0">
            <div class="main-header-left d-lg-none w-auto">
                <div class="logo-wrapper"><a href="dashboard.php"><img class="blur-up lazyloaded"
                            src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt=""></a></div>
            </div>
            <div class="mobile-sidebar w-auto">
                <div class="media-body text-end switch-sm">
                    <a href="javascript:void(0)" class="sidebar-toggle-btn" id="sidebar-toggle" aria-label="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="pointer-events:none;"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg>
                    </a>
                </div>
            </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.querySelector('.page-sidebar');
    var toggleBtn = document.getElementById('sidebar-toggle');
    var sidebarOpen = false;

    var overlay = document.getElementById('sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'sidebar-overlay';
        document.body.appendChild(overlay);
        overlay.style.cssText = 'display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:99998;opacity:0;transition:opacity 0.3s ease;';
    }

    function isMobile() { return window.innerWidth <= 991; }

    function showMobileSidebar() {
        if (!sidebar || !isMobile()) return;
        sidebarOpen = true;
        sidebar.style.cssText = 'position:fixed !important;top:0 !important;left:0 !important;width:260px !important;height:100vh !important;z-index:99999 !important;margin-left:0 !important;overflow-y:auto !important;-webkit-overflow-scrolling:touch;transition:left 0.3s ease !important;background:#183543 !important;display:block !important;';
        overlay.style.display = 'block';
        setTimeout(function() { overlay.style.opacity = '1'; }, 10);
    }

    function hideMobileSidebar() {
        if (!sidebar || !isMobile()) return;
        sidebarOpen = false;
        sidebar.style.cssText = 'position:fixed !important;top:0 !important;left:-270px !important;width:260px !important;height:100vh !important;z-index:99999 !important;margin-left:0 !important;overflow-y:auto !important;-webkit-overflow-scrolling:touch;transition:left 0.3s ease !important;background:#183543 !important;display:block !important;';
        overlay.style.opacity = '0';
        setTimeout(function() { overlay.style.display = 'none'; }, 300);
    }

    function toggleMobileSidebar(e) {
        if (e) { e.preventDefault(); e.stopPropagation(); }
        if (sidebarOpen) { hideMobileSidebar(); } else { showMobileSidebar(); }
    }

    if (sidebar && isMobile()) { hideMobileSidebar(); }

    if (toggleBtn) {
        var touchFired = false;
        toggleBtn.addEventListener('touchend', function(e) {
            touchFired = true;
            toggleMobileSidebar(e);
            setTimeout(function() { touchFired = false; }, 500);
        }, { passive: false });
        toggleBtn.addEventListener('click', function(e) {
            if (touchFired) return;
            toggleMobileSidebar(e);
        });
    }

    overlay.addEventListener('click', function() { hideMobileSidebar(); });
    overlay.addEventListener('touchend', function(e) { e.preventDefault(); hideMobileSidebar(); }, { passive: false });

    window.addEventListener('resize', function() {
        if (!isMobile() && sidebar) {
            sidebar.style.cssText = '';
            overlay.style.display = 'none';
            overlay.style.opacity = '0';
            sidebarOpen = false;
        }
    });
});
</script>
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li class="onhover-dropdown"><i data-feather="bell"></i><span
                            class="badge badge-pill badge-primary pull-right notification-badge">3</span><span
                            class="dot"></span>
                        <ul class="notification-dropdown onhover-show-div p-0">
                            <li>Notification <span class="badge badge-pill badge-primary pull-right">3</span></li>
                            <li>
                                <div class="media">
                                    <div class="media-body">
                                        <h6 class="mt-0"><span><i class="shopping-color"
                                                    data-feather="shopping-bag"></i></span>Your 1 order </h6>
                                        <p class="mb-0">Short top</p>
                                    </div>
                                </div>
                            </li>


                            <li class="txt-dark"><a href="#">All</a> notification</li>
                        </ul>
                    </li>
                    <li class="onhover-dropdown">
                        <div class="media align-items-center"><img
                                class="align-self-center pull-right img-30 rounded-circle blur-up lazyloaded"
                                src="{{ asset('assets/images/dashboard/logo/fav.png') }}" alt="header-user">
                            <div class="dotted-animation"><span class="animate-circle"></span><span
                                    class="main-circle"></span></div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            <li><a href="#"><i data-feather="user"></i>Edit Profile</a></li>
                            <li><a href="#"><i data-feather="mail"></i>Inbox</a></li>
                            <li><a href="#"><i data-feather="lock"></i>Lock Screen</a></li>
                            <li><a href="#"><i data-feather="settings"></i>Settings</a></li>
                            <li><a href="index.php"><i data-feather="log-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>

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
    var toggleBtn = document.getElementById('sidebar-toggle');
    if (toggleBtn) {
        toggleBtn.addEventListener('touchend', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (window.toggleSidebarMenu) window.toggleSidebarMenu(e);
        }, { passive: false });
        toggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (window.toggleSidebarMenu) window.toggleSidebarMenu(e);
        });
    }
    // Sidebar overlay for mobile/app
    if (!document.getElementById('sidebar-overlay')) {
        var overlay = document.createElement('div');
        overlay.id = 'sidebar-overlay';
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);
        overlay.addEventListener('click', function() {
            var sidebar = document.querySelector('.page-sidebar');
            if (sidebar && !sidebar.classList.contains('open')) {
                sidebar.classList.add('open');
                var header = document.querySelector('.page-main-header');
                if (header) header.classList.add('open');
                document.body.classList.remove('sidebar-open');
                overlay.classList.remove('active');
            }
        });
        overlay.addEventListener('touchend', function(e) {
            e.preventDefault();
            var sidebar = document.querySelector('.page-sidebar');
            if (sidebar && !sidebar.classList.contains('open')) {
                sidebar.classList.add('open');
                var header = document.querySelector('.page-main-header');
                if (header) header.classList.add('open');
                document.body.classList.remove('sidebar-open');
                overlay.classList.remove('active');
            }
        }, { passive: false });
    }
    var sidebarEl = document.querySelector('.page-sidebar');
    if (sidebarEl && window.MutationObserver) {
        var observer = new MutationObserver(function() {
            var overlay = document.getElementById('sidebar-overlay');
            if (!overlay) return;
            if (sidebarEl.classList.contains('open')) {
                overlay.classList.remove('active');
            } else {
                if (window.innerWidth <= 991) overlay.classList.add('active');
            }
        });
        observer.observe(sidebarEl, { attributes: true, attributeFilter: ['class'] });
    }
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


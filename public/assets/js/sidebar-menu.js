(function($) {
    "use strict";
    $.sidebarMenu = function(menu) {
        var animationSpeed = 300,
            subMenuSelector = '.sidebar-submenu';
        $(menu).on('click', 'li a', function(e) {
            var $this = $(this);
            var checkElement = $this.next();
            if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
                checkElement.slideUp(animationSpeed, function() {
                    checkElement.removeClass('menu-open');
                });
                checkElement.parent("li").removeClass("active");
            } else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
                var parent_li = $this.parent("li");
                checkElement.slideDown(animationSpeed, function() {
                    checkElement.addClass('menu-open');
                    parent_li.addClass('active');
                });
            }
            if (checkElement.is(subMenuSelector)) {
                e.preventDefault();
            }
        });
    }

    $(function() {
        $.sidebarMenu($('.sidebar-menu'));

        function isMobileSidebar() {
            if (window.matchMedia) {
                return window.matchMedia('(max-width: 991px)').matches;
            }

            var viewportWidth = window.innerWidth || document.documentElement.clientWidth || $(window).width();
            return viewportWidth <= 991;
        }

        function hideSidebar() {
            $('.page-sidebar').addClass('open');
            $('.page-main-header').addClass('open');
            $('body').removeClass('sidebar-open');
        }

        function showSidebar() {
            $('.page-sidebar').removeClass('open');
            $('.page-main-header').removeClass('open');
            $('body').addClass('sidebar-open');
        }

        function syncSidebarState(forceVisible) {
            if (typeof forceVisible === 'boolean') {
                if (forceVisible) {
                    showSidebar();
                } else {
                    hideSidebar();
                }
                return;
            }

            if ($('.page-sidebar').hasClass('open')) {
                showSidebar();
            } else {
                hideSidebar();
            }
        }

        // Debounce flag to prevent dual touchstart + click firing
        var sidebarToggleLock = false;

        // Robust Toggle Function
        function toggleSidebar(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            // Prevent dual-fire: if touchend/touchstart just handled it, skip the click
            if (sidebarToggleLock) return;
            sidebarToggleLock = true;
            setTimeout(function() { sidebarToggleLock = false; }, 400);

            syncSidebarState();
        }

        // EXPOSE globally so inline onclick/ontouchstart in HTML works in Android WebView
        window.toggleSidebarMenu = function(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            toggleSidebar(e);
        };

        // Bind to click (works on both desktop and mobile browser)
        $(document).on('click', '.sidebar-toggle-btn, #sidebar-toggle', function(e) {
            toggleSidebar(e);
        });

        // Also bind touchend for faster response on touch devices
        $(document).on('touchend', '.sidebar-toggle-btn, #sidebar-toggle', function(e) {
            toggleSidebar(e);
        });

        // Some WebViews are inconsistent with delegated jQuery touch/click events.
        // Bind native listeners directly as a fallback for the toggle button.
        function bindNativeSidebarToggle() {
            var toggleEl = document.getElementById('sidebar-toggle');
            if (!toggleEl || toggleEl.dataset.nativeSidebarBound === 'true') return;

            toggleEl.dataset.nativeSidebarBound = 'true';

            ['pointerup', 'touchend', 'click'].forEach(function(eventName) {
                toggleEl.addEventListener(eventName, function(e) {
                    window.toggleSidebarMenu(e);
                }, { passive: false });
            });
        }

        bindNativeSidebarToggle();

        // Close sidebar on outside click in mobile view (click only, no touchstart)
        $(document).on('click', function(e) {
            if (!isMobileSidebar()) return;
            // If sidebar is hidden (has .open class), do nothing
            if ($('.page-sidebar').hasClass('open')) return;
            
            // If the click is on the toggle button or sidebar itself, let it happen
            if ($(e.target).closest('.page-sidebar, .sidebar-toggle-btn, #sidebar-toggle').length) return;
            
            // Otherwise, close it
            hideSidebar();
        });

        // Close sidebar after selecting a leaf menu item in mobile
        $(document).on('click', '.page-sidebar .sidebar-menu a', function() {
            if (!isMobileSidebar()) return;
            var hasSubmenu = $(this).next('.sidebar-submenu').length > 0;
            if (!hasSubmenu) {
                hideSidebar();
            }
        });

        // initial state
        if (isMobileSidebar()) {
            hideSidebar();
        } else {
            showSidebar();
        }

        $(window).resize(function() {
            bindNativeSidebarToggle();

            if (isMobileSidebar()) {
                hideSidebar();
            } else {
                showSidebar();
            }
        });

        // Menu active state handling
        $(".sidebar-menu").find("a").removeClass("active");
        $(".sidebar-menu").find("li").removeClass("active");

        var current = window.location.pathname.replace(/\/+$/, "");
        $(".sidebar-menu a").filter(function() {
            var link = $(this).attr("href");
            if (!link || link === "#" || link.indexOf("javascript:") === 0) {
                return false;
            }

            var linkPath = "";
            try {
                linkPath = new URL(link, window.location.origin).pathname;
            } catch (e) {
                linkPath = link;
            }
            linkPath = (linkPath || "").replace(/\/+$/, "");
            if (!linkPath) {
                return false;
            }

            var isMatch = current === linkPath || current.indexOf(linkPath + "/") === 0;
            if (isMatch) {
                $(this).parents("li").addClass("active");
                $(this).addClass("active");
                return true;
            }
            return false;
        });

        // Keep current parent menu expanded on page load
        $(".sidebar-menu li.active").children(".sidebar-submenu").addClass("menu-open").show();
    });

})(jQuery);

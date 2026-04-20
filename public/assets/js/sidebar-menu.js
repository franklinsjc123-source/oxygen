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
$.sidebarMenu($('.sidebar-menu'))
$nav = $('.page-sidebar');
$header = $('.page-main-header');

function isMobileSidebar() {
    return ($(window).width() + 17) <= 991;
}

function closeSidebar() {
    $nav.addClass('open');
    $header.addClass('open');
}

function openSidebar() {
    $nav.removeClass('open');
    $header.removeClass('open');
}

function toggleSidebar() {
    $nav.toggleClass('open');
    $header.toggleClass('open');
}

// Use delegated binding so feather icon replacement does not break click handling
$(document).on('click', '.sidebar-toggle-btn, #sidebar-toggle', function(e) {
    e.preventDefault();
    e.stopPropagation();
    toggleSidebar();
});

// Close sidebar on outside click in mobile view
$(document).on('click touchstart', function(e) {
    if (!isMobileSidebar()) return;
    if ($nav.hasClass('open')) return; // already hidden
    if ($(e.target).closest('.page-sidebar, .sidebar-toggle-btn, #sidebar-toggle').length) return;
    closeSidebar();
});

// Close sidebar after selecting a leaf menu item in mobile
$(document).on('click', '.page-sidebar .sidebar-menu a', function() {
    if (!isMobileSidebar()) return;
    var hasSubmenu = $(this).next('.sidebar-submenu').length > 0;
    if (!hasSubmenu) {
        closeSidebar();
    }
});

//    responsive sidebar
var $window = $(window);
var widthwindow = $window.width();
(function($) {
    "use strict";
    if (widthwindow + 17 <= 991) {
        closeSidebar();
    } else {
        openSidebar();
    }
})(jQuery);
$(window).resize(function() {
    var widthwindaw = $window.width();
    if (widthwindaw + 17 <= 991) {
        closeSidebar();
    } else {
        openSidebar();
    }
});

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

// Keep current parent menu expanded on page load.
$(".sidebar-menu li.active").children(".sidebar-submenu").addClass("menu-open").show();

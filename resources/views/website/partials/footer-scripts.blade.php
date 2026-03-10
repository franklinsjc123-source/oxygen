<!-- latest jquery-->
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script>
// Note: This is only hard coded for example purposes, it should probably come from user input


function myFunction() {

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if (username == 'admin' || password == 'admin123') {
        window.location = "dashboard.php";
    } else {

        alert("username & password wrong");
    }
}
</script>
<!-- Bootstrap js-->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>
<script src="../assets/js/slick.js"></script>

<!-- Jsgrid js-->
<script src="../assets/js/jsgrid/jsgrid.min.js"></script>
<script src="../assets/js/jsgrid/griddata-invoice.js"></script>
<script src="../assets/js/jsgrid/jsgrid-invoice.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>
<script>
$('.single-item').slick({
    arrows: false,
    dots: true
});
</script>
<script>
    // Keep account/logout dropdown stable on hover/click.
    (function() {
        function initStableDropdowns() {
            if (!document.getElementById('stable-website-dropdown-style')) {
                var style = document.createElement('style');
                style.id = 'stable-website-dropdown-style';
                style.textContent = '.header-dropdown > li.onhover-dropdown{padding-bottom:10px;margin-bottom:-10px;}\
                    .header-dropdown > li.onhover-dropdown > .onhover-show-div{top:calc(100% + 2px)!important;}\
                    .header-dropdown li.onhover-dropdown.manual-open > .onhover-show-div{opacity:1!important;visibility:visible!important;transform:translateY(0)!important;}';
                document.head.appendChild(style);
            }

            var drops = document.querySelectorAll('.header-dropdown > li.onhover-dropdown');
            drops.forEach(function(drop) {
                var hasLogout = drop.querySelector('a[href*="logout"], a[href*="customer-logout"], a[href*="userlogout"]');
                if (!hasLogout) return;
                var toggle = drop.querySelector(':scope > i, :scope > a, :scope > div');
                if (!toggle) return;
                toggle.style.cursor = 'pointer';
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    drops.forEach(function(other) {
                        if (other !== drop) other.classList.remove('manual-open');
                    });
                    drop.classList.toggle('manual-open');
                });
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.header-dropdown > li.onhover-dropdown.manual-open')) {
                    drops.forEach(function(drop) {
                        drop.classList.remove('manual-open');
                    });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', initStableDropdowns);
    })();
</script>
<script>
    // Prevent accidental multi-submit (double/triple clicks) on all forms.
    $(document).on('submit', 'form', function(e) {
        var $form = $(this);
        if (e.isDefaultPrevented()) return;

        if ($form.data('submitting') === true) {
            e.preventDefault();
            return false;
        }

        $form.data('submitting', true);
        var $submitButtons = $form.find('button[type="submit"], input[type="submit"]');
        $submitButtons.prop('disabled', true).addClass('disabled');

        setTimeout(function() {
            if ($form.closest('html').length) {
                $form.data('submitting', false);
                $submitButtons.prop('disabled', false).removeClass('disabled');
            }
        }, 15000);
    });
</script>
<script>
    // Adds clear (X) button to bootstrap-table search inputs for website listing pages.
    (function() {
        function enhanceSearchInput($input) {
            if ($input.data('clear-ready')) return;
            $input.data('clear-ready', true);
            $input.attr('type', 'search');
            $input.css('padding-right', '2rem');

            var $parent = $input.parent();
            if (!$parent.hasClass('table-search-wrap')) {
                $parent.addClass('table-search-wrap').css('position', 'relative');
            }

            var $clearBtn = $('<button type="button" class="table-search-clear-btn" aria-label="Clear search">&times;</button>');
            $clearBtn.css({
                position: 'absolute',
                right: '8px',
                top: '50%',
                transform: 'translateY(-50%)',
                border: 'none',
                background: 'transparent',
                color: '#6c757d',
                fontSize: '18px',
                lineHeight: '1',
                padding: '0',
                display: 'none',
                cursor: 'pointer',
                zIndex: '5'
            });

            function toggleClear() {
                $clearBtn.toggle(($input.val() || '').length > 0);
            }

            $input.on('input keyup change', toggleClear);
            $clearBtn.on('click', function() {
                $input.val('');
                $input.trigger('input').trigger('keyup').trigger('change').focus();
                toggleClear();
            });

            $parent.append($clearBtn);
            toggleClear();
        }

        function attachClearButtons(scope) {
            $(scope).find('.fixed-table-toolbar .search input, .bootstrap-table .search input').each(function() {
                enhanceSearchInput($(this));
            });
        }

        $(document).ready(function() {
            attachClearButtons(document);
            setTimeout(function() {
                attachClearButtons(document);
            }, 300);
        });
    })();
</script>

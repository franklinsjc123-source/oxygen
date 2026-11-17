@php
    // Strict Portal Isolation: NEVER render Seller footer on Admin or Staff pages or for Admin/Staff accounts
    $isAdminRoute = request()->is('admin', 'admin/*');
    $isStaffRoute = request()->is('staff', 'staff/*');
    $portalUserStatus = auth()->check() ? (int) auth()->user()->status : (int) session()->get('status');

    if ($isAdminRoute || $isStaffRoute || $portalUserStatus === 1 || $portalUserStatus === 3) {
        return;
    }

    $sellerId = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : null);
    if (!$sellerId && auth()->check() && (int)auth()->user()->status === 2) {
        $sellerId = auth()->user()->login_id ?? auth()->id();
    }
    if (!$sellerId && session()->has('userId') && (int)session()->get('status') === 2) {
        $sellerId = session()->get('userId');
    }
    $homeUrl = $sellerId ? route('vendordashboard', $sellerId) : url('seller/dashboard');
    $isLoggedIn = !empty($sellerId) || (auth()->check() && (int)auth()->user()->status === 2);
    $isAuthPage = request()->is('login', '*/login', 'register', '*/register', 'forgot*', '*/forgot*', 'reset*', '*/reset*', 'portal-selection', '*/portal-selection');

    if (!$isLoggedIn || $isAuthPage) {
        return;
    }

    $isHome = request()->is('*dashboard*') || (request()->is('seller') && !request()->is('seller/*')) || (request()->is('vendor') && !request()->is('vendor/*'));
    $isProducts = (request()->is('*product*') || request()->is('*vendorproduct*')) && !request()->is('*order*');
    $isOrders = request()->is('*order*') && !request()->is('*forgot*');
    $isOffers = request()->is('*offer*');
    $isAccount = request()->is('*profile*') || request()->is('*setting*') || request()->is('*account*');
    $isLogin = request()->is('*login*') || request()->is('*register*');
@endphp

<!-- Seller Mobile Bottom Sticky Navigation -->
<nav class="seller-mobile-footer" aria-label="Seller Mobile Navigation">
    {{-- 1. Home --}}
    <a href="{{ $homeUrl }}" class="seller-footer-item {{ $isHome ? 'active' : '' }}" title="Dashboard">
        <div class="seller-footer-icon-wrap">
            <i class="fa fa-home seller-footer-icon"></i>
        </div>
        <span class="seller-footer-text">Home</span>
    </a>

    {{-- 2. Products --}}
    <a href="{{ route('vendorproducts.crud.listing') }}" class="seller-footer-item {{ $isProducts ? 'active' : '' }}" title="Products">
        <div class="seller-footer-icon-wrap">
            <i class="fa fa-cube seller-footer-icon"></i>
        </div>
        <span class="seller-footer-text">Products</span>
    </a>

    {{-- 3. Orders --}}
    <a href="{{ route('vendor.order') }}" class="seller-footer-item {{ $isOrders ? 'active' : '' }}" title="Orders">
        <div class="seller-footer-icon-wrap">
            <i class="fa fa-shopping-bag seller-footer-icon"></i>
        </div>
        <span class="seller-footer-text">Orders</span>
    </a>

    {{-- 4. Offers --}}
    <a href="{{ route('vendoroffer.list.index') }}" class="seller-footer-item {{ $isOffers ? 'active' : '' }}" title="Offers">
        <div class="seller-footer-icon-wrap">
            <i class="fa fa-tags seller-footer-icon"></i>
        </div>
        <span class="seller-footer-text">Offers</span>
    </a>

    {{-- 5. Login / Account --}}
    @if($isLoggedIn)
        <a href="{{ route('vendor.profile') }}" class="seller-footer-item {{ $isAccount ? 'active' : '' }}" title="Account Profile">
            <div class="seller-footer-icon-wrap">
                <i class="fa fa-user seller-footer-icon"></i>
            </div>
            <span class="seller-footer-text">Account</span>
        </a>
    @else
        <a href="{{ url('seller/login') }}" class="seller-footer-item {{ $isLogin ? 'active' : '' }}" title="Seller Login">
            <div class="seller-footer-icon-wrap">
                <i class="fa fa-sign-in-alt seller-footer-icon"></i>
            </div>
            <span class="seller-footer-text">Login</span>
        </a>
    @endif
</nav>

<style>
    /* Desktop: Hidden */
    .seller-mobile-footer {
        display: none !important;
    }

    /* Mobile & Tablet (< 992px, matching vendor mobile layout) */
    @media (max-width: 991.98px) {
        .seller-mobile-footer {
            display: flex !important;
            position: fixed !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            height: 60px !important;
            background: #ffffff !important;
            border-top: 1px solid #e2e8f0 !important;
            box-shadow: 0 -4px 18px rgba(15, 23, 42, 0.08) !important;
            z-index: 1040 !important;
            padding: 4px 6px !important;
            padding-bottom: max(4px, env(safe-area-inset-bottom)) !important;
            justify-content: space-around !important;
            align-items: center !important;
            box-sizing: border-box !important;
            margin: 0 !important;
        }

        /* Prevent bottom content from overlapping the fixed navigation bar */
        .page-body,
        .page-body-wrapper,
        .dashboard-container {
            padding-bottom: 75px !important;
        }

        .seller-mobile-footer .seller-footer-item {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-decoration: none !important;
            color: #64748b !important;
            padding: 4px 2px !important;
            position: relative !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border-radius: 8px !important;
            cursor: pointer !important;
            -webkit-tap-highlight-color: transparent !important;
        }

        .seller-mobile-footer .seller-footer-icon-wrap {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 32px !important;
            height: 28px !important;
            border-radius: 14px !important;
            transition: all 0.25s ease !important;
            margin-bottom: 2px !important;
        }

        .seller-mobile-footer .seller-footer-icon {
            font-size: 19px !important;
            line-height: 1 !important;
            color: #64748b !important;
            transition: all 0.25s ease !important;
        }

        .seller-mobile-footer .seller-footer-text {
            font-size: 11px !important;
            font-weight: 600 !important;
            line-height: 1.15 !important;
            color: #64748b !important;
            margin: 0 !important;
            letter-spacing: 0.2px !important;
            transition: all 0.25s ease !important;
            white-space: nowrap !important;
            text-align: center !important;
        }

        /* Active State */
        .seller-mobile-footer .seller-footer-item.active {
            color: #183543 !important;
        }

        .seller-mobile-footer .seller-footer-item.active .seller-footer-icon-wrap {
            background: rgba(24, 53, 67, 0.12) !important;
            transform: translateY(-2px) !important;
        }

        .seller-mobile-footer .seller-footer-item.active .seller-footer-icon {
            color: #183543 !important;
            transform: scale(1.08) !important;
        }

        .seller-mobile-footer .seller-footer-item.active .seller-footer-text {
            color: #183543 !important;
            font-weight: 700 !important;
        }

        /* Hover / Touch State */
        .seller-mobile-footer .seller-footer-item:active {
            transform: scale(0.95) !important;
        }

        /* Ensure modals appear cleanly on top of bottom navigation */
        body.modal-open .seller-mobile-footer {
            z-index: 1030 !important;
        }
    }
</style>

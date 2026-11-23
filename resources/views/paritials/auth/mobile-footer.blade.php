@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB;

    // Strict Portal Isolation: NEVER render Admin/Staff footer on Seller pages or for Seller accounts
    $isSellerRoute = request()->is('seller', 'seller/*', 'vendor', 'vendor/*');
    $portalUserStatus = auth()->check() ? (int) auth()->user()->status : (int) session()->get('status');

    if ($isSellerRoute || $portalUserStatus === 2) {
        return;
    }

    $isStaff = request()->is('staff', 'staff/*') || (auth()->check() && (int)auth()->user()->status === 3);
    $isLoggedIn = session()->has('login_id') || session()->has('userId') || auth()->check();
    $isAuthPage = request()->is('login', '*/login', 'register', '*/register', 'forgot*', '*/forgot*', 'reset*', '*/reset*', 'portal-selection', '*/portal-selection');

    if (!$isLoggedIn || $isAuthPage) {
        return;
    }

    // 1. Home URL
    if ($isStaff) {
        $staffId = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : null);
        $homeUrl = $staffId ? (Route::has('staffdashboard') ? route('staffdashboard', $staffId) : url('staff/dashboard/' . $staffId)) : url('staff/dashboard');
    } else {
        $homeUrl = Route::has('admindashboard') ? route('admindashboard') : url('admin/dashboard');
    }

    // 2. Task (Activity Tracker) URL
    $taskUrl = $isStaff 
        ? (Route::has('staffactivity_trackers.index') ? route('staffactivity_trackers.index') : url('staff/activity_trackers')) 
        : (Route::has('activity_trackers.index') ? route('activity_trackers.index') : url('admin/activity_trackers'));

    // 3. Orders URL
    $ordersUrl = $isStaff 
        ? (Route::has('stafforder') ? route('stafforder') : url('staff/order')) 
        : (Route::has('order') ? route('order') : url('admin/order'));

    // 4. Requests (Seller Requests) URL
    $requestsUrl = $isStaff 
        ? (Route::has('staff.seller_leads.index') ? route('staff.seller_leads.index') : url('staff/seller-requests')) 
        : (Route::has('admin.seller_leads.index') ? route('admin.seller_leads.index') : url('admin/seller-requests'));

    // Pending Requests count for badge
    $pendingRequestsCount = 0;
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('seller_leads')) {
            $pendingRequestsCount = \Illuminate\Support\Facades\DB::table('seller_leads')->where('status', 'pending')->count();
        }
    } catch (\Throwable $e) {}

    // 5. Account / Login URL
    if ($isLoggedIn) {
        $accountUrl = $isStaff ? url('staff/profile') : url('admin/profile');
    } else {
        $accountUrl = $isStaff ? url('staff/login') : url('admin/login');
    }

    // Active Tab Checks
    $isHome = request()->is('*dashboard*') || (request()->is('admin') && !request()->is('admin/*')) || (request()->is('staff') && !request()->is('staff/*'));
    $isTasks = request()->is('*activity*');
    $isOrders = request()->is('*order*') && !request()->is('*forgot*');
    $isRequests = request()->is('*seller_lead*') || request()->is('*seller-request*') || request()->is('*request*');
    $isAccount = request()->is('*profile*') || request()->is('*setting*') || request()->is('*account*');
    $isLogin = request()->is('*login*') || request()->is('*register*');
@endphp

<!-- Admin / Staff Mobile Bottom Sticky Navigation -->
<nav class="admin-mobile-footer" aria-label="Portal Mobile Navigation">
    {{-- 1. Home --}}
    <a href="{{ $homeUrl }}" class="admin-footer-item {{ $isHome ? 'active' : '' }}" title="Dashboard">
        <div class="admin-footer-icon-wrap">
            <i class="fa fa-home admin-footer-icon"></i>
        </div>
        <span class="admin-footer-text">Home</span>
    </a>

    {{-- 2. Task (Activity Tracker) --}}
    <a href="{{ $taskUrl }}" class="admin-footer-item {{ $isTasks ? 'active' : '' }}" title="Activity Tracker">
        <div class="admin-footer-icon-wrap">
            <i class="fa fa-tasks admin-footer-icon"></i>
        </div>
        <span class="admin-footer-text">Task</span>
    </a>

    {{-- 3. Orders --}}
    <a href="{{ $ordersUrl }}" class="admin-footer-item {{ $isOrders ? 'active' : '' }}" title="Orders">
        <div class="admin-footer-icon-wrap">
            <i class="fa fa-shopping-bag admin-footer-icon"></i>
        </div>
        <span class="admin-footer-text">Orders</span>
    </a>

    {{-- 4. Requests --}}
    <a href="{{ $requestsUrl }}" class="admin-footer-item {{ $isRequests ? 'active' : '' }}" title="Seller Requests">
        <div class="admin-footer-icon-wrap">
            <i class="fa fa-clipboard-list admin-footer-icon"></i>
            @if($pendingRequestsCount > 0)
                <span class="admin-footer-badge">{{ $pendingRequestsCount > 99 ? '99+' : $pendingRequestsCount }}</span>
            @endif
        </div>
        <span class="admin-footer-text">Requests</span>
    </a>

    {{-- 5. Account / Login --}}
    @if($isLoggedIn)
        <a href="{{ $accountUrl }}" class="admin-footer-item {{ $isAccount ? 'active' : '' }}" title="Account Profile">
            <div class="admin-footer-icon-wrap">
                <i class="fa fa-user admin-footer-icon"></i>
            </div>
            <span class="admin-footer-text">Account</span>
        </a>
    @else
        <a href="{{ $accountUrl }}" class="admin-footer-item {{ $isLogin ? 'active' : '' }}" title="Login">
            <div class="admin-footer-icon-wrap">
                <i class="fa fa-sign-in-alt admin-footer-icon"></i>
            </div>
            <span class="admin-footer-text">Login</span>
        </a>
    @endif
</nav>

<style>
    /* Desktop: Hidden */
    .admin-mobile-footer {
        display: none !important;
    }

    /* Mobile & Tablet (< 992px) */
    @media (max-width: 991.98px) {
        .admin-mobile-footer {
            display: flex !important;
            position: fixed !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            min-height: 58px !important;
            height: calc(58px + env(safe-area-inset-bottom, 0px)) !important;
            background: #ffffff !important;
            border-top: 1px solid #e2e8f0 !important;
            box-shadow: 0 -4px 18px rgba(15, 23, 42, 0.08) !important;
            z-index: 1040 !important;
            padding: 5px 6px max(5px, env(safe-area-inset-bottom, 0px)) 6px !important;
            justify-content: space-around !important;
            align-items: flex-start !important;
            box-sizing: border-box !important;
            margin: 0 !important;
            overflow: visible !important;
        }

        /* Prevent bottom content overlap */
        .page-body,
        .page-body-wrapper,
        .dashboard-container {
            padding-bottom: calc(75px + env(safe-area-inset-bottom, 0px)) !important;
        }

        .admin-mobile-footer .admin-footer-item {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: flex-start !important;
            text-decoration: none !important;
            color: #64748b !important;
            padding: 2px !important;
            margin: 0 !important;
            height: 46px !important;
            position: relative !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border-radius: 8px !important;
            cursor: pointer !important;
            -webkit-tap-highlight-color: transparent !important;
        }

        .admin-mobile-footer .admin-footer-icon-wrap {
            position: relative !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 32px !important;
            height: 26px !important;
            border-radius: 13px !important;
            transition: all 0.25s ease !important;
            margin-bottom: 2px !important;
        }

        .admin-mobile-footer .admin-footer-icon {
            font-size: 18px !important;
            line-height: 1 !important;
            color: #64748b !important;
            transition: all 0.25s ease !important;
        }

        .admin-mobile-footer .admin-footer-text {
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

        .admin-mobile-footer .admin-footer-badge {
            position: absolute !important;
            top: -2px !important;
            right: -6px !important;
            background: #ff5252 !important;
            color: #ffffff !important;
            font-size: 9px !important;
            font-weight: 700 !important;
            line-height: 1 !important;
            padding: 2px 5px !important;
            border-radius: 10px !important;
            box-shadow: 0 2px 5px rgba(255, 82, 82, 0.4) !important;
        }

        /* Active State */
        .admin-mobile-footer .admin-footer-item.active {
            color: #183543 !important;
        }

        .admin-mobile-footer .admin-footer-item.active .admin-footer-icon-wrap {
            background: rgba(24, 53, 67, 0.12) !important;
            transform: translateY(-1px) !important;
        }

        .admin-mobile-footer .admin-footer-item.active .admin-footer-icon {
            color: #183543 !important;
            transform: scale(1.08) !important;
        }

        .admin-mobile-footer .admin-footer-item.active .admin-footer-text {
            color: #183543 !important;
            font-weight: 700 !important;
        }

        /* Hover / Touch State */
        .admin-mobile-footer .admin-footer-item:active {
            transform: scale(0.95) !important;
        }

        /* Ensure modals open above bottom navigation */
        body.modal-open .admin-mobile-footer {
            z-index: 1030 !important;
        }
    }
</style>
